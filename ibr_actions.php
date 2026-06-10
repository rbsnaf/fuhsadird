<?php
require_once 'config.php';
$db = getDB();
if (!$db) { die(json_encode(['success'=>false,'msg'=>'DB error'])); }

$action = $_POST['action'] ?? $_GET['action'] ?? '';
header('Content-Type: application/json');

// ─── EMAIL HELPER ───
function sendNotification($db, $to, $subject, $body) {
    if (!$to || !filter_var($to, FILTER_VALIDATE_EMAIL)) return false;
    $headers = "From: FUHSA DIRD <dird@fuhsa.edu.ng>\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $htmlBody = '<div style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;border:1px solid #ddd;border-radius:10px;overflow:hidden">
      <div style="background:#0a1f5c;padding:20px 24px;color:white"><h2 style="margin:0;font-size:18px">FUHSA — DIRD IBR Platform</h2><p style="margin:4px 0 0;font-size:12px;color:#f0b429">Directorate of Innovation, Research & Development</p></div>
      <div style="padding:24px;font-size:14px;color:#333;line-height:1.7">'.$body.'</div>
      <div style="background:#f0f4ff;padding:14px 24px;font-size:11px;color:#888;text-align:center">Federal University of Health Sciences, Azare · KM3 Potiskum Road, Azare, Bauchi State</div>
    </div>';
    $sent = @mail($to, $subject, $htmlBody, $headers);
    if ($db) { $db->prepare("INSERT INTO ibr_email_log (recipient_email, subject) VALUES (?, ?)")->execute([$to, $subject]); }
    return $sent;
}

// ─── IBR LOGIN ───
if ($action === 'ibr_login') {
    $staffId = strtoupper(trim($_POST['staff_id'] ?? ''));
    $pass = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'applicant';

    if (!$staffId) { echo json_encode(['success'=>false,'msg'=>'Enter Staff ID']); exit; }

    // Admin/Director login with config credentials
    if ($role === 'admin' && $pass === ADMIN_PASS) {
        // Check if admin exists in ibr_users, create if not
        $stmt = $db->prepare("SELECT * FROM ibr_users WHERE staff_id = ? AND role = 'admin'");
        $stmt->execute([$staffId]);
        $user = $stmt->fetch();
        if (!$user) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $db->prepare("INSERT IGNORE INTO ibr_users (staff_id, full_name, email, role, password_hash) VALUES (?, 'DIRD Administrator', 'dird@fuhsa.edu.ng', 'admin', ?)")->execute([$staffId, $hash]);
            $uid = $db->lastInsertId() ?: 1;
            $user = ['id' => $uid, 'staff_id' => $staffId, 'full_name' => 'DIRD Administrator', 'role' => 'admin'];
        }
        $_SESSION['ibr_user_id'] = $user['id'];
        $_SESSION['ibr_staff_id'] = $user['staff_id'];
        $_SESSION['ibr_name'] = $user['full_name'];
        $_SESSION['ibr_role'] = 'admin';
        echo json_encode(['success'=>true,'name'=>$user['full_name'],'role'=>'admin']);
        exit;
    }

    // Regular user login (applicant or reviewer)
    $stmt = $db->prepare("SELECT * FROM ibr_users WHERE staff_id = ?");
    $stmt->execute([$staffId]);
    $user = $stmt->fetch();

    if (!$user) { echo json_encode(['success'=>false,'msg'=>'No account found. Please register.']); exit; }
    if (!password_verify($pass, $user['password_hash'])) { echo json_encode(['success'=>false,'msg'=>'Incorrect password.']); exit; }

    // Reviewer must login as reviewer
    if ($role === 'reviewer' && $user['role'] !== 'reviewer') { echo json_encode(['success'=>false,'msg'=>'This account is not registered as a reviewer.']); exit; }

    $_SESSION['ibr_user_id'] = $user['id'];
    $_SESSION['ibr_staff_id'] = $user['staff_id'];
    $_SESSION['ibr_name'] = $user['full_name'];
    $_SESSION['ibr_role'] = ($role === 'reviewer' && $user['role'] === 'reviewer') ? 'reviewer' : 'applicant';
    echo json_encode(['success'=>true,'name'=>$user['full_name'],'role'=>$_SESSION['ibr_role']]);
    exit;
}

// ─── IBR REGISTER (applicant or reviewer) ───
if ($action === 'ibr_register') {
    $name = trim($_POST['full_name'] ?? '');
    $staffId = strtoupper(trim($_POST['staff_id'] ?? ''));
    $email = trim($_POST['email'] ?? '');
    $dept = trim($_POST['department'] ?? '');
    $pass = $_POST['password'] ?? '';
    $regRole = $_POST['reg_role'] ?? 'applicant';
    $specialization = trim($_POST['specialization'] ?? '');

    if (!$name || !$staffId || !$email || !$pass) { echo json_encode(['success'=>false,'msg'=>'Fill all required fields.']); exit; }
    if (strlen($pass) < 8 || !preg_match('/[A-Z]/', $pass) || !preg_match('/[0-9]/', $pass) || !preg_match('/[!@#$%^&*()\-_=+\[\]{}|;:,.<>?]/', $pass)) {
        echo json_encode(['success'=>false,'msg'=>'Password must be 8+ chars with uppercase, number & special character.']); exit;
    }

    $exists = $db->prepare("SELECT id FROM ibr_users WHERE staff_id = ?");
    $exists->execute([$staffId]);
    if ($exists->fetch()) { echo json_encode(['success'=>false,'msg'=>'Staff ID already registered.']); exit; }

    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $role = ($regRole === 'reviewer') ? 'reviewer' : 'applicant';
    $stmt = $db->prepare("INSERT INTO ibr_users (staff_id, full_name, email, department, specialization, password_hash, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$staffId, $name, $email, $dept, $specialization, $hash, $role]);
    $uid = $db->lastInsertId();

    $_SESSION['ibr_user_id'] = $uid;
    $_SESSION['ibr_staff_id'] = $staffId;
    $_SESSION['ibr_name'] = $name;
    $_SESSION['ibr_role'] = $role;
    echo json_encode(['success'=>true,'name'=>$name,'role'=>$role]);
    exit;
}

// ─── IBR LOGOUT ───
if ($action === 'ibr_logout') {
    unset($_SESSION['ibr_user_id'], $_SESSION['ibr_staff_id'], $_SESSION['ibr_name'], $_SESSION['ibr_role']);
    echo json_encode(['success'=>true]);
    exit;
}

// ─── AUTH CHECK ───
function ibrUser() { return $_SESSION['ibr_user_id'] ?? null; }
function ibrRole() { return $_SESSION['ibr_role'] ?? 'applicant'; }

// ─── SUBMIT APPLICATION ───
if ($action === 'ibr_submit') {
    $uid = ibrUser();
    if (!$uid) { echo json_encode(['success'=>false,'msg'=>'Not logged in']); exit; }

    $appId = 'IBR-' . date('Y') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    $fields = ['pi_name','staff_no','email','phone','department','faculty','academic_rank','staff_category',
               'title','research_area','duration_months','start_date',
               'budget','abstract','problem_statement','objectives','ethics_status','dept_approval'];
    $data = [];
    foreach ($fields as $f) { $data[$f] = trim($_POST[$f] ?? ''); }
    $data['budget'] = floatval($data['budget']);
    $data['duration_months'] = intval($data['duration_months']);
    if (!$data['start_date']) $data['start_date'] = null;
    $coInvestigators = trim($_POST['co_investigators'] ?? '');

    $stmt = $db->prepare("INSERT INTO ibr_applications (app_id, user_id, pi_name, staff_no, email, phone, department, faculty, academic_rank, staff_category, co_investigator1, co_investigator2, title, research_area, duration_months, start_date, budget, abstract, problem_statement, objectives, ethics_status, dept_approval) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$appId, $uid, $data['pi_name'], $data['staff_no'], $data['email'], $data['phone'],
        $data['department'], $data['faculty'], $data['academic_rank'], $data['staff_category'],
        $coInvestigators, $data['title'], $data['research_area'],
        $data['duration_months'], $data['start_date'], $data['budget'], $data['abstract'],
        $data['problem_statement'], $data['objectives'], $data['ethics_status'], $data['dept_approval']]);
    $insertId = $db->lastInsertId();

    // Handle file uploads
    if (!empty($_FILES['documents'])) {
        $dir = UPLOAD_DIR . 'ibr/';
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        $wordOnly = ['doc','docx'];
        foreach ($_FILES['documents']['name'] as $i => $fname) {
            if ($_FILES['documents']['error'][$i] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($fname, PATHINFO_EXTENSION));
                if (!in_array($ext, $wordOnly)) continue; // Skip non-Word files
                $safe = $appId . '_' . ($i+1) . '_' . time() . '.' . $ext;
                $dest = $dir . $safe;
                move_uploaded_file($_FILES['documents']['tmp_name'][$i], $dest);
                $fstmt = $db->prepare("INSERT INTO ibr_files (application_id, file_name, file_path, file_size, file_type) VALUES (?, ?, ?, ?, ?)");
                $fstmt->execute([$insertId, $fname, $dest, $_FILES['documents']['size'][$i], $_FILES['documents']['type'][$i]]);
            }
        }
    }
    // Send email to Director (admin)
    $admins = $db->query("SELECT email FROM ibr_users WHERE role='admin' AND email IS NOT NULL")->fetchAll();
    foreach ($admins as $adm) {
        sendNotification($db, $adm['email'], 'New IBR Application: '.$appId,
            '<h3>New Application Submitted</h3><p><strong>App ID:</strong> '.$appId.'</p><p><strong>PI:</strong> '.$data['pi_name'].'</p><p><strong>Title:</strong> '.$data['title'].'</p><p><strong>Area:</strong> '.$data['research_area'].'</p><p><strong>Budget:</strong> ₦'.number_format($data['budget'],2).'</p><p style="margin-top:16px">Please login to the IBR Platform to review and assign a reviewer.</p>');
    }
    // Confirm to applicant
    if ($data['email']) {
        sendNotification($db, $data['email'], 'IBR Application Received: '.$appId,
            '<h3>Application Submitted Successfully</h3><p>Dear '.$data['pi_name'].',</p><p>Your IBR research proposal <strong>'.$appId.'</strong> has been received by the Directorate of Innovation, Research & Development.</p><p><strong>Title:</strong> '.$data['title'].'</p><p>You will be notified when a reviewer is assigned and when your proposal status changes.</p>');
    }
    echo json_encode(['success'=>true,'app_id'=>$appId]);
    exit;
}

// ─── GET APPLICATIONS ───
if ($action === 'ibr_get_apps') {
    $uid = ibrUser();
    $role = ibrRole();
    if (!$uid) { echo json_encode([]); exit; }

    if ($role === 'admin') {
        $apps = $db->query("SELECT a.*, GROUP_CONCAT(DISTINCT f.file_name) as file_names, r.full_name as reviewer_name FROM ibr_applications a LEFT JOIN ibr_files f ON f.application_id = a.id LEFT JOIN ibr_users r ON r.id = a.assigned_reviewer_id GROUP BY a.id ORDER BY a.submitted_at DESC")->fetchAll();
    } elseif ($role === 'reviewer') {
        $stmt = $db->prepare("SELECT a.*, GROUP_CONCAT(DISTINCT f.file_name) as file_names, r.full_name as reviewer_name FROM ibr_applications a LEFT JOIN ibr_files f ON f.application_id = a.id LEFT JOIN ibr_users r ON r.id = a.assigned_reviewer_id WHERE a.assigned_reviewer_id = ? GROUP BY a.id ORDER BY a.submitted_at DESC");
        $stmt->execute([$uid]);
        $apps = $stmt->fetchAll();
    } else {
        $stmt = $db->prepare("SELECT a.*, GROUP_CONCAT(DISTINCT f.file_name) as file_names, r.full_name as reviewer_name FROM ibr_applications a LEFT JOIN ibr_files f ON f.application_id = a.id LEFT JOIN ibr_users r ON r.id = a.assigned_reviewer_id WHERE a.user_id = ? GROUP BY a.id ORDER BY a.submitted_at DESC");
        $stmt->execute([$uid]);
        $apps = $stmt->fetchAll();
    }
    echo json_encode($apps);
    exit;
}

// ─── UPDATE STATUS (Admin) ───
if ($action === 'ibr_update_status') {
    if (ibrRole() !== 'admin') { echo json_encode(['success'=>false,'msg'=>'Access denied']); exit; }
    $id = intval($_POST['id'] ?? 0);
    $status = $_POST['status'] ?? '';
    $valid = ['Submitted','Under Review','Approved','Revision Required','Rejected'];
    if (!in_array($status, $valid)) { echo json_encode(['success'=>false,'msg'=>'Invalid status']); exit; }
    $stmt = $db->prepare("UPDATE ibr_applications SET status = ?, reviewed_at = NOW() WHERE id = ?");
    $stmt->execute([$status, $id]);
    // Email applicant on status change
    $app = $db->prepare("SELECT * FROM ibr_applications WHERE id=?"); $app->execute([$id]); $app = $app->fetch();
    if ($app && $app['email']) {
        $emoji = ['Approved'=>'✅','Rejected'=>'❌','Revision Required'=>'⚠️','Under Review'=>'🔍','Submitted'=>'📨'];
        sendNotification($db, $app['email'], 'IBR Application Status: '.$status.' — '.$app['app_id'],
            '<h3>'.($emoji[$status]??'').' Application Status Updated</h3><p>Dear '.$app['pi_name'].',</p><p>Your IBR proposal <strong>'.$app['app_id'].'</strong> status has been updated to:</p><div style="background:#f0f4ff;padding:14px;border-radius:8px;text-align:center;font-size:20px;font-weight:bold;color:#0a1f5c;margin:12px 0">'.$status.'</div><p>Login to the IBR Platform to view details.</p>');
    }
    echo json_encode(['success'=>true]);
    exit;
}

// ─── SUBMIT REVIEW SCORE ───
if ($action === 'ibr_submit_review') {
    $uid = ibrUser(); $role = ibrRole();
    if ($role !== 'admin' && $role !== 'reviewer') { echo json_encode(['success'=>false,'msg'=>'Reviewer or Admin only']); exit; }
    $id = intval($_POST['app_id'] ?? 0);
    $score = intval($_POST['total_score'] ?? 0);
    $rec = trim($_POST['recommendation'] ?? '');
    $comments = trim($_POST['comments'] ?? '');

    $stmt = $db->prepare("UPDATE ibr_applications SET score = ?, recommendation = ?, reviewer_comments = ?, reviewed_at = NOW() WHERE id = ?");
    $stmt->execute([$score, $rec, $comments, $id]);

    $criteria = ['merit','method','objective','innov','feasib','budget'];
    foreach ($criteria as $c) {
        $cs = intval($_POST['score_' . $c] ?? 0);
        $db->prepare("INSERT INTO ibr_review_scores (application_id, criteria_key, score) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE score = ?")->execute([$id, $c, $cs, $cs]);
    }
    // Email Director that review is complete
    $app = $db->prepare("SELECT * FROM ibr_applications WHERE id=?"); $app->execute([$id]); $app = $app->fetch();
    $admins = $db->query("SELECT email FROM ibr_users WHERE role='admin' AND email IS NOT NULL")->fetchAll();
    foreach ($admins as $adm) {
        sendNotification($db, $adm['email'], 'Review Complete: '.$app['app_id'].' — Score: '.$score.'/100',
            '<h3>Review Completed</h3><p><strong>App ID:</strong> '.$app['app_id'].'</p><p><strong>PI:</strong> '.$app['pi_name'].'</p><p><strong>Score:</strong> '.$score.'/100</p><p><strong>Recommendation:</strong> '.$rec.'</p><p style="margin-top:12px">Login to approve or request revision.</p>');
    }
    echo json_encode(['success'=>true]);
    exit;
}

// ─── DELETE APPLICATION (Admin) ───
if ($action === 'ibr_delete') {
    if (ibrRole() !== 'admin') { echo json_encode(['success'=>false,'msg'=>'Access denied']); exit; }
    $id = intval($_POST['id'] ?? 0);
    $db->prepare("DELETE FROM ibr_applications WHERE id = ?")->execute([$id]);
    echo json_encode(['success'=>true]);
    exit;
}

// ─── REVIEWER SENDS TO DIRECTOR ───
if ($action === 'ibr_send_to_director') {
    if (ibrRole() !== 'reviewer' && ibrRole() !== 'admin') { echo json_encode(['success'=>false,'msg'=>'Access denied']); exit; }
    $appDbId = intval($_POST['app_id'] ?? 0);
    if (!$appDbId) { echo json_encode(['success'=>false,'msg'=>'No application']); exit; }

    $app = $db->prepare("SELECT * FROM ibr_applications WHERE id=?"); $app->execute([$appDbId]); $app = $app->fetch();
    if (!$app) { echo json_encode(['success'=>false,'msg'=>'Application not found']); exit; }

    // Get reviewer files count
    $fileCount = $db->prepare("SELECT COUNT(*) FROM ibr_reviewer_files WHERE application_id=?"); $fileCount->execute([$appDbId]); $fileCount = $fileCount->fetchColumn();
    $reviewer = $db->prepare("SELECT full_name, email FROM ibr_users WHERE id=?"); $reviewer->execute([ibrUser()]); $reviewer = $reviewer->fetch();

    // Notify all directors
    $admins = $db->query("SELECT email, full_name FROM ibr_users WHERE role='admin' AND email IS NOT NULL")->fetchAll();
    foreach ($admins as $adm) {
        sendNotification($db, $adm['email'], '📋 Review Complete: '.$app['app_id'].' — Ready for Your Decision',
            '<h3>📋 Review Completed & Returned to You</h3>
            <p>Dear Director,</p>
            <p>Reviewer <strong>'.($reviewer['full_name']??'Unknown').'</strong> has completed the review and sent the following back to you:</p>
            <table style="width:100%;border-collapse:collapse;margin:14px 0">
              <tr style="border-bottom:1px solid #ddd"><td style="padding:8px;color:#888;font-size:13px">App ID</td><td style="padding:8px;font-weight:bold">'.$app['app_id'].'</td></tr>
              <tr style="border-bottom:1px solid #ddd"><td style="padding:8px;color:#888;font-size:13px">Research Title</td><td style="padding:8px;font-weight:bold">'.$app['title'].'</td></tr>
              <tr style="border-bottom:1px solid #ddd"><td style="padding:8px;color:#888;font-size:13px">Score</td><td style="padding:8px;font-weight:bold;color:#0d7a6e">'.$app['score'].'/100</td></tr>
              <tr style="border-bottom:1px solid #ddd"><td style="padding:8px;color:#888;font-size:13px">Recommendation</td><td style="padding:8px;font-weight:bold">'.$app['recommendation'].'</td></tr>
              <tr><td style="padding:8px;color:#888;font-size:13px">Documents Attached</td><td style="padding:8px;font-weight:bold">'.$fileCount.' file(s)</td></tr>
            </table>
            '.($app['reviewer_comments']?'<div style="background:#fffbeb;border-left:3px solid #f59e0b;padding:12px;border-radius:6px;margin:12px 0;font-size:13px"><strong>Reviewer Comments:</strong><br>'.$app['reviewer_comments'].'</div>':'').'
            <p style="margin-top:16px">Please login to the IBR Platform to:</p>
            <ol style="font-size:13px;color:#555">
              <li>Review the scorer\'s assessment and uploaded documents</li>
              <li>Make your final decision (✅ Approve / ⚠️ Revision / ❌ Reject)</li>
              <li>Send the decision back to the applicant</li>
            </ol>');
    }
    echo json_encode(['success'=>true]);
    exit;
}

// ─── DIRECTOR SENDS TO APPLICANT ───
if ($action === 'ibr_send_to_applicant') {
    if (ibrRole() !== 'admin') { echo json_encode(['success'=>false,'msg'=>'Director only']); exit; }
    $appDbId = intval($_POST['app_id'] ?? 0);
    $decision = $_POST['decision'] ?? '';
    $valid = ['Approved','Revision Required','Rejected'];
    if (!in_array($decision, $valid)) { echo json_encode(['success'=>false,'msg'=>'Invalid decision']); exit; }

    $stmt = $db->prepare("UPDATE ibr_applications SET status=?, reviewed_at=NOW() WHERE id=?");
    $stmt->execute([$decision, $appDbId]);

    $app = $db->prepare("SELECT * FROM ibr_applications WHERE id=?"); $app->execute([$appDbId]); $app = $app->fetch();
    if ($app && $app['email']) {
        $emoji = ['Approved'=>'✅','Revision Required'=>'⚠️','Rejected'=>'❌'];
        $msg = ['Approved'=>'Congratulations! Your research proposal has been <strong>approved</strong> by the Directorate. You may now proceed with your research activities as outlined in your proposal.',
                'Revision Required'=>'Your research proposal requires <strong>revisions</strong>. Please login to the IBR Platform, download the reviewer\'s comments and annotated documents, make the necessary corrections, and resubmit.',
                'Rejected'=>'After careful review, your research proposal has been <strong>declined</strong> at this time. Please review the feedback and consider resubmitting in the next cycle.'];
        sendNotification($db, $app['email'], ($emoji[$decision]??'').' IBR Decision: '.$decision.' — '.$app['app_id'],
            '<h3>'.($emoji[$decision]??'').' Final Decision on Your IBR Application</h3>
            <p>Dear '.$app['pi_name'].',</p>
            <p>The Director of DIRD has made a final decision on your IBR research proposal:</p>
            <div style="background:#f0f4ff;padding:18px;border-radius:10px;text-align:center;margin:16px 0">
              <div style="font-size:28px;margin-bottom:6px">'.($emoji[$decision]??'').'</div>
              <div style="font-size:22px;font-weight:bold;color:#0a1f5c">'.$decision.'</div>
            </div>
            <p><strong>App ID:</strong> '.$app['app_id'].'</p>
            <p><strong>Title:</strong> '.$app['title'].'</p>
            <p><strong>Score:</strong> '.($app['score'] ?? 'N/A').'/100</p>
            <p style="margin-top:16px">'.$msg[$decision].'</p>
            <p style="margin-top:16px">Login to the IBR Platform to view full details and download any documents.</p>');
    }
    echo json_encode(['success'=>true]);
    exit;
}

// ─── DIRECTOR CREATES REVIEWER ───
if ($action === 'ibr_create_reviewer') {
    if (ibrRole() !== 'admin') { echo json_encode(['success'=>false,'msg'=>'Director only']); exit; }
    $name = trim($_POST['full_name'] ?? '');
    $staffId = strtoupper(trim($_POST['staff_id'] ?? ''));
    $email = trim($_POST['email'] ?? '');
    $dept = trim($_POST['department'] ?? '');
    $spec = trim($_POST['specialization'] ?? '');
    $pass = $_POST['password'] ?? '';

    if (!$name || !$staffId || !$email || !$spec || !$pass) { echo json_encode(['success'=>false,'msg'=>'Fill all required fields.']); exit; }
    if (strlen($pass) < 8 || !preg_match('/[A-Z]/', $pass) || !preg_match('/[0-9]/', $pass) || !preg_match('/[!@#$%^&*()\-_=+\[\]{}|;:,.<>?]/', $pass)) {
        echo json_encode(['success'=>false,'msg'=>'Password must be 8+ chars with uppercase, number & special character.']); exit;
    }

    $exists = $db->prepare("SELECT id FROM ibr_users WHERE staff_id = ?");
    $exists->execute([$staffId]);
    if ($exists->fetch()) { echo json_encode(['success'=>false,'msg'=>'Staff ID "'.$staffId.'" already exists.']); exit; }

    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO ibr_users (staff_id, full_name, email, department, specialization, password_hash, role) VALUES (?, ?, ?, ?, ?, ?, 'reviewer')");
    $stmt->execute([$staffId, $name, $email, $dept, $spec, $hash]);

    // Send welcome email to reviewer
    sendNotification($db, $email, 'FUHSA IBR Platform — Reviewer Account Created',
        '<h3>Welcome to the IBR Review Platform</h3>
        <p>Dear '.$name.',</p>
        <p>The Director of DIRD has created a reviewer account for you on the FUHSA IBR Platform.</p>
        <table style="width:100%;border-collapse:collapse;margin:14px 0;font-size:13px">
          <tr style="border-bottom:1px solid #ddd"><td style="padding:8px;color:#888">Staff ID (Login)</td><td style="padding:8px;font-weight:bold">'.$staffId.'</td></tr>
          <tr style="border-bottom:1px solid #ddd"><td style="padding:8px;color:#888">Specialization</td><td style="padding:8px;font-weight:bold">'.$spec.'</td></tr>
          <tr><td style="padding:8px;color:#888">Role</td><td style="padding:8px;font-weight:bold">Reviewer</td></tr>
        </table>
        <p>Please login using your Staff ID and the password provided by the Director. Select <strong>"🔍 Reviewer"</strong> as your role when logging in.</p>
        <p>You will receive email notifications when applications are assigned to you for review.</p>');

    echo json_encode(['success'=>true]);
    exit;
}

// ─── GET REVIEWERS LIST ───
if ($action === 'ibr_get_reviewers') {
    $reviewers = $db->query("SELECT id, staff_id, full_name, email, department, specialization FROM ibr_users WHERE role='reviewer' ORDER BY full_name")->fetchAll();
    echo json_encode($reviewers);
    exit;
}

// ─── ASSIGN REVIEWER (Director) ───
if ($action === 'ibr_assign_reviewer') {
    if (ibrRole() !== 'admin') { echo json_encode(['success'=>false,'msg'=>'Director only']); exit; }
    $appDbId = intval($_POST['app_id'] ?? 0);
    $reviewerId = intval($_POST['reviewer_id'] ?? 0);
    if (!$appDbId || !$reviewerId) { echo json_encode(['success'=>false,'msg'=>'Select application and reviewer']); exit; }

    $stmt = $db->prepare("UPDATE ibr_applications SET assigned_reviewer_id=?, status='Under Review' WHERE id=?");
    $stmt->execute([$reviewerId, $appDbId]);

    // Get app and reviewer details for email
    $app = $db->prepare("SELECT * FROM ibr_applications WHERE id=?"); $app->execute([$appDbId]); $app = $app->fetch();
    $rev = $db->prepare("SELECT * FROM ibr_users WHERE id=?"); $rev->execute([$reviewerId]); $rev = $rev->fetch();

    if ($rev && $rev['email'] && $app) {
        sendNotification($db, $rev['email'], 'IBR Review Assignment: '.$app['app_id'],
            '<h3>Review Assignment</h3><p>Dear '.$rev['full_name'].',</p><p>You have been assigned to review the following IBR research proposal:</p><p><strong>App ID:</strong> '.$app['app_id'].'</p><p><strong>PI:</strong> '.$app['pi_name'].'</p><p><strong>Title:</strong> '.$app['title'].'</p><p><strong>Area:</strong> '.$app['research_area'].'</p><p style="margin-top:16px">Please login to the IBR Platform to download the documents, review, and submit your scores.</p>');
    }
    // Notify applicant
    if ($app && $app['email']) {
        sendNotification($db, $app['email'], 'IBR Application Under Review: '.$app['app_id'],
            '<h3>Application Under Review</h3><p>Dear '.$app['pi_name'].',</p><p>Your IBR proposal <strong>'.$app['app_id'].'</strong> has been assigned to a reviewer. You will be notified when the review is complete.</p>');
    }
    echo json_encode(['success'=>true,'msg'=>'Reviewer assigned and notified']);
    exit;
}

// ─── GET STATS ───
if ($action === 'ibr_stats') {
    $total = $db->query("SELECT COUNT(*) FROM ibr_applications")->fetchColumn();
    $submitted = $db->query("SELECT COUNT(*) FROM ibr_applications WHERE status='Submitted'")->fetchColumn();
    $review = $db->query("SELECT COUNT(*) FROM ibr_applications WHERE status='Under Review'")->fetchColumn();
    $approved = $db->query("SELECT COUNT(*) FROM ibr_applications WHERE status='Approved'")->fetchColumn();
    $revision = $db->query("SELECT COUNT(*) FROM ibr_applications WHERE status='Revision Required'")->fetchColumn();
    $pending = $db->query("SELECT COUNT(*) FROM ibr_applications WHERE score IS NULL")->fetchColumn();
    $reviewed = $db->query("SELECT COUNT(*) FROM ibr_applications WHERE score IS NOT NULL")->fetchColumn();
    echo json_encode(compact('total','submitted','review','approved','revision','pending','reviewed'));
    exit;
}

// ─── EXPORT CSV ───
if ($action === 'ibr_export') {
    if (ibrRole() !== 'admin') { exit; }
    $threshold = intval($_GET['threshold'] ?? 0);
    $label = $threshold > 0 ? '_above_'.$threshold.'pct' : '_all';
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=FUHSA_IBR_Applications'.$label.'_'.date('Y-m-d').'.csv');

    if ($threshold > 0) {
        $stmt = $db->prepare("SELECT * FROM ibr_applications WHERE score >= ? ORDER BY score DESC, submitted_at DESC");
        $stmt->execute([$threshold]);
        $apps = $stmt->fetchAll();
    } else {
        $apps = $db->query("SELECT * FROM ibr_applications ORDER BY submitted_at DESC")->fetchAll();
    }
    $out = fopen('php://output', 'w');
    fputcsv($out, ['App ID','PI Name','Staff No','Email','Department','Faculty','Co-Investigators','Title','Area','Budget','Status','Score','Recommendation','Submitted']);
    foreach ($apps as $a) {
        $coText = str_replace('|||', '; ', $a['co_investigator1'] ?? '');
        fputcsv($out, [$a['app_id'],$a['pi_name'],$a['staff_no'],$a['email'],$a['department'],$a['faculty'],$coText,$a['title'],$a['research_area'],$a['budget'],$a['status'],$a['score'],$a['recommendation'],$a['submitted_at']]);
    }
    fclose($out);
    exit;
}

// ─── GET FILES for an application (both applicant & reviewer) ───
if ($action === 'ibr_get_files') {
    $appDbId = intval($_GET['app_id'] ?? $_POST['app_id'] ?? 0);
    if (!$appDbId) { echo json_encode(['applicant_files'=>[],'reviewer_files'=>[]]); exit; }
    $af = $db->prepare("SELECT id, file_name, file_path, file_size, file_type, uploaded_at FROM ibr_files WHERE application_id = ? ORDER BY id");
    $af->execute([$appDbId]);
    $rf = $db->prepare("SELECT id, file_name, file_path, file_size, file_type, uploaded_at FROM ibr_reviewer_files WHERE application_id = ? ORDER BY id");
    $rf->execute([$appDbId]);
    echo json_encode(['applicant_files'=>$af->fetchAll(), 'reviewer_files'=>$rf->fetchAll()]);
    exit;
}

// ─── DOWNLOAD a file ───
if ($action === 'ibr_download') {
    $fileId = intval($_GET['file_id'] ?? 0);
    $type = $_GET['type'] ?? 'applicant'; // 'applicant' or 'reviewer'
    $table = $type === 'reviewer' ? 'ibr_reviewer_files' : 'ibr_files';
    $stmt = $db->prepare("SELECT file_name, file_path, file_type FROM $table WHERE id = ?");
    $stmt->execute([$fileId]);
    $file = $stmt->fetch();
    if ($file && file_exists($file['file_path'])) {
        header('Content-Type: ' . ($file['file_type'] ?: 'application/octet-stream'));
        header('Content-Disposition: attachment; filename="' . basename($file['file_name']) . '"');
        header('Content-Length: ' . filesize($file['file_path']));
        readfile($file['file_path']);
        exit;
    }
    http_response_code(404);
    echo 'File not found';
    exit;
}

// ─── REVIEWER uploads annotated file back ───
if ($action === 'ibr_upload_review_file') {
    if (ibrRole() !== 'admin' && ibrRole() !== 'reviewer') { echo json_encode(['success'=>false,'msg'=>'Access denied']); exit; }
    $appDbId = intval($_POST['app_id'] ?? 0);
    if (!$appDbId) { echo json_encode(['success'=>false,'msg'=>'No application ID']); exit; }

    $uploaded = 0;
    if (!empty($_FILES['review_files'])) {
        $dir = UPLOAD_DIR . 'ibr_reviews/';
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        foreach ($_FILES['review_files']['name'] as $i => $fname) {
            if ($_FILES['review_files']['error'][$i] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($fname, PATHINFO_EXTENSION));
                $safe = 'review_' . $appDbId . '_' . time() . '_' . ($i+1) . '.' . $ext;
                $dest = $dir . $safe;
                move_uploaded_file($_FILES['review_files']['tmp_name'][$i], $dest);
                $fstmt = $db->prepare("INSERT INTO ibr_reviewer_files (application_id, file_name, file_path, file_size, file_type) VALUES (?, ?, ?, ?, ?)");
                $fstmt->execute([$appDbId, $fname, $dest, $_FILES['review_files']['size'][$i], $_FILES['review_files']['type'][$i]]);
                $uploaded++;
            }
        }
    }
    echo json_encode(['success'=>true,'count'=>$uploaded]);
    exit;
}

// ─── ADMIN uploads approval letter ───
if ($action === 'ibr_upload_approval') {
    if (ibrRole() !== 'admin' && ibrRole() !== 'reviewer') { echo json_encode(['success'=>false,'msg'=>'Access denied']); exit; }
    $appDbId = intval($_POST['app_id'] ?? 0);
    if (!$appDbId) { echo json_encode(['success'=>false,'msg'=>'No application ID']); exit; }

    if (!empty($_FILES['approval_file']) && $_FILES['approval_file']['error'] === UPLOAD_ERR_OK) {
        $dir = UPLOAD_DIR . 'ibr_approvals/';
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        $ext = strtolower(pathinfo($_FILES['approval_file']['name'], PATHINFO_EXTENSION));
        $safe = 'approval_' . $appDbId . '_' . time() . '.' . $ext;
        $dest = $dir . $safe;
        move_uploaded_file($_FILES['approval_file']['tmp_name'], $dest);
        $fstmt = $db->prepare("INSERT INTO ibr_reviewer_files (application_id, file_name, file_path, file_size, file_type) VALUES (?, ?, ?, ?, ?)");
        $fstmt->execute([$appDbId, 'APPROVAL: '.$_FILES['approval_file']['name'], $dest, $_FILES['approval_file']['size'], $_FILES['approval_file']['type']]);
        echo json_encode(['success'=>true]);
    } else {
        echo json_encode(['success'=>false,'msg'=>'No file selected']);
    }
    exit;
}

echo json_encode(['success'=>false,'msg'=>'Unknown action']);
?>
