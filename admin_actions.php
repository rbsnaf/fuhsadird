<?php
require_once 'config.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';
$db = getDB();

if (!$db) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'msg' => 'Database connection failed.']);
    exit;
}

// ---------- LOGIN / LOGOUT ----------
if ($action === 'login') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    if ($user === ADMIN_USER && $pass === ADMIN_PASS) {
        $_SESSION['fuhsa_admin'] = true;
        header('Location: index.php?logged_in=1');
    } else {
        header('Location: index.php?login_error=1');
    }
    exit;
}

if ($action === 'logout') {
    $_SESSION['fuhsa_admin'] = false;
    session_destroy();
    header('Location: index.php?logged_out=1');
    exit;
}

// All remaining actions require admin
if (!isAdmin()) {
    header('Location: index.php?auth_required=1');
    exit;
}

// ---------- GALLERY ----------
if ($action === 'add_gallery') {
    $caption = clean($_POST['caption'] ?? '');
    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (in_array($ext, $allowed)) {
            $filename = 'gallery_' . time() . '_' . mt_rand(1000,9999) . '.' . $ext;
            $dest = UPLOAD_DIR . $filename;
            if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755, true);
            move_uploaded_file($_FILES['image']['tmp_name'], $dest);
            $stmt = $db->prepare("INSERT INTO gallery (caption, image_path) VALUES (?, ?)");
            $stmt->execute([$caption, $dest]);
        }
    }
    header('Location: index.php#gallery');
    exit;
}

if ($action === 'delete_gallery') {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0) {
        $stmt = $db->prepare("DELETE FROM gallery WHERE id = ?");
        $stmt->execute([$id]);
    }
    header('Location: index.php#gallery');
    exit;
}

// ---------- NEWS ----------
if ($action === 'add_news') {
    $title   = clean($_POST['title'] ?? '');
    $summary = clean($_POST['summary'] ?? '');
    $tag     = clean($_POST['tag'] ?? 'General');
    $link    = clean($_POST['link'] ?? '#');
    if ($title) {
        $stmt = $db->prepare("INSERT INTO news (title, summary, tag, link) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $summary, $tag, $link]);
    }
    header('Location: index.php#news');
    exit;
}

if ($action === 'delete_news') {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0) {
        $stmt = $db->prepare("DELETE FROM news WHERE id = ?");
        $stmt->execute([$id]);
    }
    header('Location: index.php#news');
    exit;
}

// ---------- PUBLICATIONS ----------
if ($action === 'add_publication') {
    $type    = clean($_POST['pub_type'] ?? 'journal');
    $year    = intval($_POST['pub_year'] ?? date('Y'));
    $title   = clean($_POST['title'] ?? '');
    $authors = clean($_POST['authors'] ?? '');
    $journal = clean($_POST['journal'] ?? '');
    $doi     = clean($_POST['doi'] ?? '');
    if ($title && $authors) {
        $stmt = $db->prepare("INSERT INTO publications (pub_type, pub_year, title, authors, journal, doi) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$type, $year, $title, $authors, $journal, $doi]);
    }
    header('Location: index.php#publications');
    exit;
}

if ($action === 'delete_publication') {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0) {
        $stmt = $db->prepare("DELETE FROM publications WHERE id = ?");
        $stmt->execute([$id]);
    }
    header('Location: index.php#publications');
    exit;
}

if ($action === 'edit_publication') {
    $id      = intval($_POST['id'] ?? 0);
    $type    = clean($_POST['pub_type'] ?? 'journal');
    $year    = intval($_POST['pub_year'] ?? date('Y'));
    $title   = clean($_POST['title'] ?? '');
    $authors = clean($_POST['authors'] ?? '');
    $journal = clean($_POST['journal'] ?? '');
    $doi     = clean($_POST['doi'] ?? '');
    if ($id > 0 && $title) {
        $stmt = $db->prepare("UPDATE publications SET pub_type=?, pub_year=?, title=?, authors=?, journal=?, doi=? WHERE id=?");
        $stmt->execute([$type, $year, $title, $authors, $journal, $doi, $id]);
    }
    header('Location: index.php#publications');
    exit;
}

// ---------- BENEFICIARIES ----------
if ($action === 'add_beneficiary') {
    $name    = clean($_POST['full_name'] ?? '');
    $dept    = clean($_POST['department'] ?? '');
    $fac     = clean($_POST['faculty'] ?? '');
    $gtype   = clean($_POST['grant_type'] ?? 'IBR');
    $year    = intval($_POST['grant_year'] ?? date('Y'));
    $amount  = floatval($_POST['amount'] ?? 0);
    $ptitle  = clean($_POST['project_title'] ?? '');
    $prog    = in_array($_POST['progress'] ?? '', ['Ongoing','Completed']) ? $_POST['progress'] : 'Ongoing';
    if ($name) {
        $stmt = $db->prepare("INSERT INTO beneficiaries (full_name, department, faculty, grant_type, grant_year, amount, project_title, progress) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $dept, $fac, $gtype, $year, $amount, $ptitle, $prog]);
    }
    header('Location: index.php#beneficiaries');
    exit;
}

if ($action === 'delete_beneficiary') {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0) {
        $stmt = $db->prepare("DELETE FROM beneficiaries WHERE id = ?");
        $stmt->execute([$id]);
    }
    header('Location: index.php#beneficiaries');
    exit;
}

if ($action === 'edit_beneficiary') {
    $id      = intval($_POST['id'] ?? 0);
    $name    = clean($_POST['full_name'] ?? '');
    $dept    = clean($_POST['department'] ?? '');
    $fac     = clean($_POST['faculty'] ?? '');
    $gtype   = clean($_POST['grant_type'] ?? 'IBR');
    $year    = intval($_POST['grant_year'] ?? date('Y'));
    $amount  = floatval($_POST['amount'] ?? 0);
    $ptitle  = clean($_POST['project_title'] ?? '');
    $prog    = in_array($_POST['progress'] ?? '', ['Ongoing','Completed']) ? $_POST['progress'] : 'Ongoing';
    if ($id > 0 && $name) {
        $stmt = $db->prepare("UPDATE beneficiaries SET full_name=?, department=?, faculty=?, grant_type=?, grant_year=?, amount=?, project_title=?, progress=? WHERE id=?");
        $stmt->execute([$name, $dept, $fac, $gtype, $year, $amount, $ptitle, $prog, $id]);
    }
    header('Location: index.php#beneficiaries');
    exit;
}

// ---------- STUDENT RESEARCH ----------
if ($action === 'add_student_research') {
    $name    = clean($_POST['student_name'] ?? '');
    $matric  = clean($_POST['matric_no'] ?? '');
    $dept    = clean($_POST['department'] ?? '');
    $fac     = clean($_POST['faculty'] ?? '');
    $prog    = clean($_POST['programme'] ?? '');
    $year    = intval($_POST['year'] ?? date('Y'));
    $title   = clean($_POST['project_title'] ?? '');
    $super   = clean($_POST['supervisor'] ?? '');
    $abstract = clean($_POST['abstract'] ?? '');
    if ($name && $title) {
        $stmt = $db->prepare("INSERT INTO student_research (student_name, matric_no, department, faculty, programme, year, project_title, supervisor, abstract) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $matric, $dept, $fac, $prog, $year, $title, $super, $abstract]);
    }
    header('Location: index.php#student-research');
    exit;
}

if ($action === 'delete_student_research') {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0) {
        $stmt = $db->prepare("DELETE FROM student_research WHERE id = ?");
        $stmt->execute([$id]);
    }
    header('Location: index.php#student-research');
    exit;
}

// ---------- DOWNLOADS ----------
if ($action === 'add_download') {
    $title = clean($_POST['title'] ?? '');
    $desc  = clean($_POST['description'] ?? '');
    if (!empty($_FILES['file']['name']) && $title) {
        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        $allowed = ['pdf','doc','docx','xlsx','xls','pptx','zip'];
        if (in_array($ext, $allowed)) {
            $filename = 'form_' . time() . '_' . mt_rand(1000,9999) . '.' . $ext;
            $dest = UPLOAD_DIR . $filename;
            if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755, true);
            move_uploaded_file($_FILES['file']['tmp_name'], $dest);
            $stmt = $db->prepare("INSERT INTO downloads (title, description, file_name, file_path, file_size) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $desc, $_FILES['file']['name'], $dest, $_FILES['file']['size']]);
        }
    }
    header('Location: index.php#downloads');
    exit;
}

if ($action === 'delete_download') {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0) {
        $stmt = $db->prepare("DELETE FROM downloads WHERE id = ?");
        $stmt->execute([$id]);
    }
    header('Location: index.php#downloads');
    exit;
}

// ---------- LEADERS ----------
if ($action === 'add_leader') {
    $name   = clean($_POST['full_name'] ?? '');
    $role   = clean($_POST['role_title'] ?? '');
    $titles = clean($_POST['titles'] ?? '');
    $bio    = clean($_POST['bio'] ?? '');
    $imgPath = '';

    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (in_array($ext, $allowed)) {
            $filename = 'leader_' . time() . '_' . mt_rand(1000,9999) . '.' . $ext;
            $dest = UPLOAD_DIR . $filename;
            if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755, true);
            move_uploaded_file($_FILES['image']['tmp_name'], $dest);
            $imgPath = $dest;
        }
    }

    if ($name && $role) {
        $roleKey = mb_substr($role, 0, 250);
        $stmt = $db->prepare("INSERT INTO leadership (role_key, full_name, titles, bio, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$roleKey, $name, $titles, $bio, $imgPath]);
    }
    header('Location: index.php#leadership');
    exit;
}

if ($action === 'delete_leader') {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0) {
        $stmt = $db->prepare("DELETE FROM leadership WHERE id = ?");
        $stmt->execute([$id]);
    }
    header('Location: index.php#leadership');
    exit;
}

if ($action === 'edit_leader') {
    $id     = intval($_POST['id'] ?? 0);
    $name   = clean($_POST['full_name'] ?? '');
    $role   = clean($_POST['role_title'] ?? '');
    $titles = clean($_POST['titles'] ?? '');
    $bio    = clean($_POST['bio'] ?? '');

    if ($id > 0 && $name) {
        // Check if new image uploaded
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','gif','webp'];
            if (in_array($ext, $allowed)) {
                $filename = 'leader_' . time() . '_' . mt_rand(1000,9999) . '.' . $ext;
                $dest = UPLOAD_DIR . $filename;
                if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755, true);
                move_uploaded_file($_FILES['image']['tmp_name'], $dest);
                $stmt = $db->prepare("UPDATE leadership SET role_key=?, full_name=?, titles=?, bio=?, image_path=? WHERE id=?");
                $stmt->execute([mb_substr($role, 0, 250), $name, $titles, $bio, $dest, $id]);
            }
        } else {
            $stmt = $db->prepare("UPDATE leadership SET role_key=?, full_name=?, titles=?, bio=? WHERE id=?");
            $stmt->execute([mb_substr($role, 0, 250), $name, $titles, $bio, $id]);
        }
    }
    header('Location: index.php#leadership');
    exit;
}

// ---------- MOVE LEADER (reorder) ----------
if ($action === 'move_leader') {
    $id = intval($_POST['id'] ?? 0);
    $dir = $_POST['direction'] ?? 'up';

    $current = $db->prepare("SELECT id FROM leadership ORDER BY id ASC");
    $current->execute();
    $ids = $current->fetchAll(PDO::FETCH_COLUMN);
    $pos = array_search($id, $ids);

    if ($pos !== false) {
        if ($dir === 'up' && $pos > 0) {
            $swapId = $ids[$pos - 1];
        } elseif ($dir === 'down' && $pos < count($ids) - 1) {
            $swapId = $ids[$pos + 1];
        } else {
            header('Location: index.php#leadership'); exit;
        }
        // Swap IDs by swapping all data
        $a = $db->prepare("SELECT * FROM leadership WHERE id = ?")->execute([$id]);
        $rowA = $db->prepare("SELECT role_key, full_name, titles, bio, image_path FROM leadership WHERE id = ?");
        $rowA->execute([$id]); $dataA = $rowA->fetch();
        $rowB = $db->prepare("SELECT role_key, full_name, titles, bio, image_path FROM leadership WHERE id = ?");
        $rowB->execute([$swapId]); $dataB = $rowB->fetch();

        $db->prepare("UPDATE leadership SET role_key=?, full_name=?, titles=?, bio=?, image_path=? WHERE id=?")
           ->execute([$dataB['role_key'], $dataB['full_name'], $dataB['titles'], $dataB['bio'], $dataB['image_path'], $id]);
        $db->prepare("UPDATE leadership SET role_key=?, full_name=?, titles=?, bio=?, image_path=? WHERE id=?")
           ->execute([$dataA['role_key'], $dataA['full_name'], $dataA['titles'], $dataA['bio'], $dataA['image_path'], $swapId]);
    }
    header('Location: index.php#leadership');
    exit;
}

// ---------- BULK BENEFICIARIES (CSV) ----------
if ($action === 'add_bulk_beneficiary') {
    if (!empty($_FILES['csv_file']['name']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['csv_file']['tmp_name'];
        $handle = fopen($file, 'r');
        $header = fgetcsv($handle); // skip header row
        $count = 0;
        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 4) continue;
            $name    = clean($row[0] ?? '');
            $dept    = clean($row[1] ?? '');
            $fac     = clean($row[2] ?? '');
            $gtype   = strtoupper(clean($row[3] ?? 'IBR'));
            if (!in_array($gtype, ['IBR','NRF'])) $gtype = 'IBR';
            $year    = intval($row[4] ?? date('Y'));
            $ptitle  = clean($row[5] ?? '');
            if ($name) {
                $stmt = $db->prepare("INSERT INTO beneficiaries (full_name, department, faculty, grant_type, grant_year, amount, project_title) VALUES (?, ?, ?, ?, ?, 0, ?)");
                $stmt->execute([$name, $dept, $fac, $gtype, $year, $ptitle]);
                $count++;
            }
        }
        fclose($handle);
    }
    header('Location: index.php#beneficiaries');
    exit;
}

// Default redirect
header('Location: index.php');
exit;
?>
