<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>FUHSA IBR Online Application Platform</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--navy:#0a3352;--navy-light:#1a4a70;--gold:#c8922a;--gold-light:#f0b955;--teal:#0d7a6e;--teal-light:#15a393;--red:#c0392b;--green:#27ae60;--bg:#f0f4f8;--card:#fff;--text:#1e2d3d;--muted:#5a7184;--border:#d6e4ef;--shadow:0 4px 20px rgba(10,51,82,.1);--radius:12px}
body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);min-height:100vh}
header{background:linear-gradient(135deg,var(--navy),var(--navy-light) 60%,#1e5f8a);color:#fff;position:sticky;top:0;z-index:100;box-shadow:0 2px 20px rgba(0,0,0,.3)}
.header-inner{max-width:1200px;margin:auto;padding:14px 24px;display:flex;align-items:center;gap:16px}
.header-logo{width:52px;height:52px;background:var(--gold);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:700;color:var(--navy);flex-shrink:0}
.header-text h1{font-family:'Playfair Display',serif;font-size:18px;font-weight:700;line-height:1.2}
.header-text p{font-size:12px;opacity:.8;margin-top:2px}
.header-badge{margin-left:auto;background:rgba(200,146,42,.25);border:1px solid var(--gold);border-radius:20px;padding:4px 14px;font-size:11px;font-weight:600;color:var(--gold-light)}
.user-pill{display:flex;align-items:center;gap:8px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.25);border-radius:20px;padding:5px 14px;font-size:12px;color:#fff;cursor:pointer;transition:.2s}
.user-pill:hover{background:rgba(255,255,255,.2)}
.nav-tabs{background:var(--navy);border-bottom:3px solid var(--gold)}
.nav-inner{max-width:1200px;margin:auto;display:flex;overflow-x:auto}
.nav-tab{padding:12px 22px;background:none;border:none;color:rgba(255,255,255,.7);font-size:13px;font-weight:500;cursor:pointer;border-bottom:3px solid transparent;margin-bottom:-3px;white-space:nowrap;transition:.2s;font-family:'Inter',sans-serif;display:flex;align-items:center;gap:8px}
.nav-tab:hover{color:#fff;background:rgba(255,255,255,.07)}
.nav-tab.active{color:var(--gold-light);border-bottom-color:var(--gold-light);background:rgba(200,146,42,.1)}
main{max-width:1200px;margin:0 auto;padding:24px 16px 48px}
.card{background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);padding:24px;margin-bottom:20px;border:1px solid var(--border)}
.card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;padding-bottom:14px;border-bottom:2px solid var(--border)}
.card-title{font-family:'Playfair Display',serif;font-size:18px;color:var(--navy);display:flex;align-items:center;gap:10px}
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:24px}
.stat-card{background:linear-gradient(135deg,var(--navy),var(--navy-light));border-radius:var(--radius);padding:20px 16px;color:#fff;text-align:center}
.stat-card.gold{background:linear-gradient(135deg,var(--gold),#e6a832)}
.stat-card.teal{background:linear-gradient(135deg,var(--teal),var(--teal-light))}
.stat-card.gn{background:linear-gradient(135deg,#065f46,var(--green))}
.stat-card.red{background:linear-gradient(135deg,#8e1f17,var(--red))}
.stat-num{font-size:36px;font-weight:700;line-height:1}
.stat-label{font-size:11px;opacity:.85;margin-top:6px;text-transform:uppercase;letter-spacing:.5px}
.form-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px}
.form-group{display:flex;flex-direction:column;gap:6px}
.form-group label{font-size:12px;font-weight:600;color:var(--navy);text-transform:uppercase;letter-spacing:.4px}
.req{color:var(--red)}
input[type=text],input[type=email],input[type=number],input[type=date],input[type=password],textarea,select{width:100%;padding:10px 14px;border:1.5px solid var(--border);border-radius:8px;font-size:14px;font-family:'Inter',sans-serif;color:var(--text);background:#fafcfe;outline:none;transition:.2s}
input:focus,textarea:focus,select:focus{border-color:var(--navy-light);box-shadow:0 0 0 3px rgba(10,51,82,.1)}
textarea{min-height:90px;resize:vertical}
.form-full{grid-column:1/-1}
.btn{padding:10px 20px;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;font-family:'Inter',sans-serif;display:inline-flex;align-items:center;gap:7px;transition:.2s}
.btn-primary{background:var(--navy);color:#fff}
.btn-primary:hover{background:var(--navy-light);transform:translateY(-1px)}
.btn-gold{background:var(--gold);color:#fff}
.btn-teal{background:var(--teal);color:#fff}
.btn-outline{background:transparent;border:1.5px solid var(--navy);color:var(--navy)}
.btn-outline:hover{background:var(--navy);color:#fff}
.btn-sm{padding:6px 12px;font-size:12px}
.btn-danger{background:var(--red);color:#fff}
.btn-success{background:var(--green);color:#fff}
.btn-group{display:flex;gap:10px;flex-wrap:wrap;margin-top:16px}
table{width:100%;border-collapse:collapse;font-size:13px}
thead th{background:var(--navy);color:#fff;padding:11px 14px;text-align:left;font-size:11px;text-transform:uppercase;letter-spacing:.5px}
tbody tr{border-bottom:1px solid var(--border);transition:.15s}
tbody tr:hover{background:#f0f7ff}
tbody td{padding:11px 14px;vertical-align:middle}
.empty-row td{text-align:center;color:var(--muted);padding:30px;font-style:italic}
.badge{display:inline-flex;align-items:center;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;gap:5px}
.badge-submitted{background:#dbeafe;color:#1e40af}
.badge-review{background:#fef3c7;color:#92400e}
.badge-approved{background:#d1fae5;color:#065f46}
.badge-revision{background:#fee2e2;color:#991b1b}
.badge-rejected{background:#f3e8ff;color:#6b21a8}
.tab-section{display:none}.tab-section.active{display:block}
.info-box{background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:16px;margin-bottom:18px;font-size:13px;color:#1e40af;display:flex;gap:10px}
.info-box.warning{background:#fffbeb;border-color:#fde68a;color:#92400e}
.steps{display:flex;gap:0;margin-bottom:24px;overflow-x:auto}
.step{display:flex;align-items:center;flex:1;min-width:0}
.step-circle{width:28px;height:28px;border-radius:50%;background:var(--border);color:var(--muted);font-size:12px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:.3s}
.step-circle.active{background:var(--navy);color:#fff}
.step-circle.done{background:var(--green);color:#fff}
.step-line{flex:1;height:2px;background:var(--border)}
.step-line.done{background:var(--green)}
.file-upload-zone{border:2px dashed var(--border);border-radius:10px;padding:20px;text-align:center;cursor:pointer;transition:.2s;color:var(--muted);background:#fafcfe}
.file-upload-zone:hover{border-color:var(--navy);background:#f0f7ff;color:var(--navy)}
.file-upload-zone input{display:none}
.uploaded-files{display:flex;flex-direction:column;gap:6px;margin-top:10px}
.uploaded-file{display:flex;align-items:center;gap:10px;padding:8px 12px;background:#f0f7ff;border-radius:6px;font-size:12px}
.uploaded-file .remove{margin-left:auto;color:var(--red);cursor:pointer;background:none;border:none;font-size:16px}
.filter-bar{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:16px;align-items:center}
.filter-bar input{flex:1;min-width:180px}
.filter-bar select{min-width:140px}
.score-bar{height:6px;border-radius:3px;background:#e5e7eb;overflow:hidden;margin-top:4px}
.score-fill{height:100%;border-radius:3px;background:linear-gradient(90deg,var(--gold),var(--teal))}
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:200;align-items:center;justify-content:center}
.modal-overlay.open{display:flex}
.modal{background:#fff;border-radius:16px;padding:32px;max-width:560px;width:95%;max-height:90vh;overflow-y:auto;position:relative;box-shadow:0 20px 60px rgba(0,0,0,.3)}
.modal-title{font-family:'Playfair Display',serif;font-size:20px;color:var(--navy);margin-bottom:20px}
.modal-close{position:absolute;top:16px;right:16px;background:none;border:none;font-size:22px;cursor:pointer;color:var(--muted)}
.criteria-item{background:#f8fafc;border-radius:8px;padding:14px;margin-bottom:10px;border:1px solid var(--border)}
.criteria-header{display:flex;justify-content:space-between;font-size:13px;font-weight:600;margin-bottom:6px}
.criteria-score{display:flex;gap:6px;flex-wrap:wrap}
.score-btn{padding:3px 9px;border:1.5px solid var(--border);border-radius:6px;background:#fff;font-size:12px;cursor:pointer;transition:.15s}
.score-btn.selected{background:var(--navy);color:#fff;border-color:var(--navy)}
.notification{position:fixed;top:80px;right:20px;background:#fff;border-radius:10px;padding:14px 18px;box-shadow:0 8px 30px rgba(0,0,0,.2);z-index:300;max-width:320px;display:flex;align-items:center;gap:12px;font-size:13px;border-left:4px solid var(--green);transform:translateX(400px);transition:transform .3s}
.notification.show{transform:translateX(0)}
.notification.error{border-left-color:var(--red)}
.notification.warning{border-left-color:var(--gold)}
#loginScreen{position:fixed;inset:0;background:linear-gradient(135deg,var(--navy),#0d4a6e 50%,var(--teal));z-index:500;display:flex;align-items:center;justify-content:center;flex-direction:column}
#loginScreen.hidden{display:none}
.login-box{background:#fff;border-radius:20px;padding:40px 36px;width:100%;max-width:420px;box-shadow:0 24px 60px rgba(0,0,0,.4);text-align:center}
.login-logo{width:72px;height:72px;background:var(--gold);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:30px;font-weight:700;color:var(--navy)}
.login-title{font-family:'Playfair Display',serif;font-size:20px;color:var(--navy);margin-bottom:4px}
.login-sub{font-size:12px;color:var(--muted);margin-bottom:28px}
.role-selector{display:flex;gap:12px;margin-bottom:24px}
.role-btn{flex:1;padding:14px 10px;border:2px solid var(--border);border-radius:12px;background:#f8fafc;cursor:pointer;transition:.2s;font-family:'Inter',sans-serif;font-size:13px;font-weight:500;color:var(--muted)}
.role-btn:hover{border-color:var(--navy-light);color:var(--navy);background:#eff6ff}
.role-btn.selected{border-color:var(--navy);background:var(--navy);color:#fff}
.role-btn .role-icon{font-size:24px;display:block;margin-bottom:6px}
.login-input-group{text-align:left;margin-bottom:16px}
.login-input-group label{display:block;font-size:12px;font-weight:600;color:var(--navy);margin-bottom:6px;text-transform:uppercase;letter-spacing:.4px}
.login-btn{width:100%;padding:13px;background:var(--navy);color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;font-family:'Inter',sans-serif;transition:.2s;margin-top:4px}
.login-btn:hover{background:var(--navy-light);transform:translateY(-1px)}
.login-error{background:#fee2e2;color:#991b1b;border-radius:8px;padding:10px 14px;font-size:13px;margin-top:12px;display:none}
.login-error.show{display:block}
.login-footer{margin-top:18px;font-size:11px;color:var(--muted)}
.section-divider{height:1px;background:var(--border);margin:20px 0}
.app-id{font-family:monospace;font-size:12px;color:var(--muted)}
.action-btns{display:flex;gap:6px}
.detail-label{font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.4px}
.detail-value{font-size:14px;color:var(--text);margin-top:2px;font-weight:500}
.detail-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px}
.back-link{display:inline-flex;align-items:center;gap:6px;color:var(--navy);text-decoration:none;font-size:13px;font-weight:600;margin-bottom:20px;padding:8px 16px;border-radius:8px;border:1.5px solid var(--border);transition:.2s}
.back-link:hover{background:var(--navy);color:#fff}
@media(max-width:640px){.header-badge{display:none}.form-grid{grid-template-columns:1fr}.stats-grid{grid-template-columns:repeat(2,1fr)}}
</style>
</head>
<body>

<!-- LOGIN SCREEN -->
<div id="loginScreen" <?php if(isset($_SESSION['ibr_user_id'])) echo 'class="hidden"'; ?>>
<div class="login-box">
  <div class="login-logo"><img = src ="fuhsa_dird\uploads/logo.jpg" /></div>
  <div class="login-title">FUHSA IBR Platform</div>
  <div class="login-sub">Federal University of Health Sciences, Azare<br>2025/2026 Application Cycle</div>
  <div class="role-selector">
    <button class="role-btn selected" id="roleApplicant" onclick="selectRole('applicant')"><span class="role-icon">🎓</span>Applicant</button>
    <button class="role-btn" id="roleReviewer" onclick="selectRole('reviewer')"><span class="role-icon">🔍</span>Reviewer</button>
    <button class="role-btn" id="roleAdmin" onclick="selectRole('admin')"><span class="role-icon">🏛️</span>Director</button>
  </div>
  <div id="signinPanel">
    <div class="login-input-group"><label>Staff ID / Email</label><input type="text" id="loginUser" placeholder="e.g. STAFF001" onkeydown="if(event.key==='Enter')doLogin()"></div>
    <div class="login-input-group"><label>Password <span id="adminHint" style="font-size:10px;color:var(--muted);display:none"></span></label><input type="password" id="loginPass" placeholder="Enter password" onkeydown="if(event.key==='Enter')doLogin()"></div>
    <button class="login-btn" onclick="doLogin()">Sign In →</button>
    <div class="login-error" id="loginError"></div>
    <div id="signupToggleRow" style="margin-top:16px;text-align:center;font-size:13px;color:var(--muted)">Don't have an account? <button onclick="showSignup()" style="background:none;border:none;color:var(--navy);font-weight:600;cursor:pointer;font-size:13px">Create Account</button></div>
  </div>
  <div id="signupPanel" style="display:none">
    <div style="text-align:left;margin-bottom:14px"><div style="font-size:15px;font-weight:600;color:var(--navy)">Create Applicant Account</div></div>
    <input type="hidden" id="suRegRole" value="applicant">
    <div class="login-input-group"><label>Full Name <span class="req">*</span></label><input type="text" id="suName" placeholder="Dr. Amina Yusuf"></div>
    <div class="login-input-group"><label>Staff ID <span class="req">*</span></label><input type="text" id="suStaffId" placeholder="STAFF001"></div>
    <div class="login-input-group"><label>Email <span class="req">*</span></label><input type="email" id="suEmail" placeholder="amina@fuhsa.edu.ng"></div>
    <div class="login-input-group"><label>Department <span class="req">*</span></label><input type="text" id="suDept" placeholder="Community Medicine"></div>
    <div id="specRow" style="display:none"><input type="hidden" id="suSpec" value=""></div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
      <div class="login-input-group"><label>Password <span class="req">*</span></label><input type="password" id="suPass" placeholder="Min. 8 chars, A-Z, 0-9, !@#"></div>
      <div class="login-input-group"><label>Confirm <span class="req">*</span></label><input type="password" id="suPass2" placeholder="Repeat"></div>
    </div>
    <button class="login-btn" onclick="doSignup()" style="background:var(--teal)">Create Account →</button>
    <div class="login-error" id="signupError"></div>
    <div style="margin-top:14px;text-align:center;font-size:13px;color:var(--muted)">Already registered? <button onclick="showSignin()" style="background:none;border:none;color:var(--navy);font-weight:600;cursor:pointer;font-size:13px">Sign In</button></div>
  </div>
  <div class="login-footer">DIRD, FUHSA Azare · Secure Platform</div>
</div>
</div>

<header>
<div class="header-inner">
  <div class="header-logo">🔬</div>
  <div class="header-text"><h1>Federal University of Health Sciences, Azare</h1><p>DIRD — IBR Online Application & Review Platform</p></div>
  <div style="margin-left:auto;display:flex;align-items:center;gap:12px">
    <div class="header-badge">2025/2026 CYCLE</div>
    <div class="user-pill" onclick="doLogout()" title="Sign out"><span id="userPillName">—</span> <span id="userPillRole"></span> ⏻</div>
  </div>
</div>
</header>

<div class="nav-tabs">
<div class="nav-inner">
  <a href="index.php" class="back-link" style="color:#fff;border-color:rgba(255,255,255,.3);margin:8px 0 5px 0;font-size:11px;padding:6px 12px">← Back to FUHSA</a>
  <button class="nav-tab active" id="tabBtnApplicant" onclick="switchTab('applicant',this)"><span>📋</span> Applicant Portal</button>
  <button class="nav-tab" id="tabBtnReviewer" onclick="switchTab('reviewer',this)" style="display:none"><span>🔍</span> Reviewer</button>
  <button class="nav-tab" id="tabBtnAdmin" onclick="switchTab('admin',this)" style="display:none"><span>🏛️</span> Directorate</button>
</div>
</div>

<main>

<!-- APPLICANT PORTAL -->
<div id="tab-applicant" class="tab-section active">
  <div class="card">
    <div class="card-header">
      <div class="card-title"><span style="color:var(--gold)">📝</span> New IBR Application</div>
      <div style="display:flex;flex-direction:column;min-width:220px">
        <div class="steps">
          <div class="step"><div class="step-circle active" id="sc1">1</div><div class="step-line" id="sl1"></div></div>
          <div class="step"><div class="step-circle" id="sc2">2</div><div class="step-line" id="sl2"></div></div>
          <div class="step"><div class="step-circle" id="sc3">3</div></div>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:10px;color:var(--muted)"><span>Applicant</span><span>Research</span><span>Upload</span></div>
      </div>
    </div>

    <!-- STEP 1 -->
    <div id="formStep1">
      <div class="info-box">📌 Complete all required fields (<span class="req">*</span>). One proposal per staff per cycle.</div>
      <div class="form-grid">
        <div class="form-group"><label>PI Name <span class="req">*</span></label><input type="text" id="piName" placeholder="Full name"></div>
        <div class="form-group"><label>Staff Number <span class="req">*</span></label><input type="text" id="staffNo" placeholder="FUHSA/001"></div>
        <div class="form-group"><label>Email <span class="req">*</span></label><input type="email" id="email" placeholder="name@fuhsa.edu.ng"></div>
        <div class="form-group"><label>Phone <span class="req">*</span></label><input type="text" id="phone" placeholder="+234 xxx xxxx xxx"></div>
        <div class="form-group"><label>Faculty <span class="req">*</span></label><select id="faculty" onchange="updateDepartments()"><option value="">— Select Faculty —</option></select></div>
        <div class="form-group"><label>Department <span class="req">*</span></label><select id="department"><option value="">— Select Department —</option></select></div>
        <div class="form-group"><label>Academic Rank</label><select id="rank"><option value="">— Select —</option><option>Lecturer II</option><option>Lecturer I</option><option>Senior Lecturer</option><option>Associate Professor</option><option>Professor</option></select></div>
        <div class="form-group"><label>Staff Category</label><input type="text" id="staffCat" value="Academic Staff" readonly style="background:#f0f4ff;cursor:not-allowed"></div>
      </div>
      <div class="section-divider"></div>
      <p style="font-size:12px;color:var(--muted);margin-bottom:14px"><strong>Co-Investigators</strong> (optional — add as many as needed)</p>
      <div id="coInvestigators"></div>
      <button type="button" class="btn btn-sm btn-outline" onclick="addCoPI()" style="margin-top:8px">+ Add Co-Investigator</button>
      <div class="btn-group"><button class="btn btn-primary" onclick="nextStep(2)">Next: Research Details →</button></div>
    </div>

    <!-- STEP 2 -->
    <div id="formStep2" style="display:none">
      <div class="form-group form-full" style="margin-bottom:14px"><label>Research Title <span class="req">*</span></label><input type="text" id="title" placeholder="Full research title"></div>
      <div class="form-grid" style="margin-bottom:14px">
        <div class="form-group"><label>Thematic Research Area <span class="req">*</span></label><select id="resArea"><option value="">— Select Thematic Area —</option><option>Anatomy, Physiology & Biochemistry</option><option>Clinical & Diagnostic Sciences</option><option>Clinical Medicine & Surgery</option><option>Maternal, Child & Reproductive Health</option><option>Community & Family Medicine</option><option>Mental Health & Neurosciences</option><option>Allied Health & Rehabilitation Sciences</option><option>Nursing Science & Practice</option><option>Medical Laboratory & Diagnostic Research</option><option>Dental Sciences & Oral Health</option><option>Pharmacology & Therapeutics</option><option>Public Health & Epidemiology</option><option>Infectious Diseases & Parasitology</option><option>Non-Communicable Diseases</option><option>Nutrition, Dietetics & Food Science</option><option>Environmental Health & Toxicology</option><option>Health Informatics & Data Science</option><option>Biotechnology & Molecular Biology</option><option>Forensic Sciences</option><option>Medical Education & Health Policy</option><option>Pure & Applied Sciences</option><option>Other</option></select></div>
        <div class="form-group"><label>Duration (Months) <span class="req">*</span></label><input type="number" id="duration" min="3" max="48" placeholder="12"></div>
        <div class="form-group"><label>Start Date</label><input type="date" id="startDate"></div>
        <div class="form-group"><label>Budget (₦) <span class="req">*</span></label><input type="number" id="budget" min="0" placeholder="2000000"></div>
      </div>
      <div class="form-group form-full" style="margin-bottom:14px"><label>Abstract <span class="req">*</span></label><textarea id="abstract" rows="5" placeholder="Concise summary (max 500 words)..."></textarea></div>
      <div class="form-grid" style="margin-bottom:14px">
        <div class="form-group form-full"><label>Problem Statement</label><textarea id="problem" rows="3" placeholder="Problem this research addresses..."></textarea></div>
        <div class="form-group form-full"><label>Objectives</label><textarea id="objectives" rows="3" placeholder="Specific objectives..."></textarea></div>
      </div>
      <div class="btn-group"><button class="btn btn-outline" onclick="showStep(1)">← Back</button><button class="btn btn-primary" onclick="nextStep(3)">Next: Documents →</button></div>
    </div>

    <!-- STEP 3 -->
    <div id="formStep3" style="display:none">
      <div class="info-box">📎 Upload documents in Word format only (.doc, .docx).</div>
      <div class="file-upload-zone" onclick="document.getElementById('fileInput').click()">
        <input type="file" id="fileInput" multiple accept=".doc,.docx" onchange="handleFiles(this.files)">
        <div style="font-size:32px;margin-bottom:8px">📁</div>
        <div style="font-weight:600;margin-bottom:4px">Click to upload or drag files here</div>
        <div style="font-size:12px">Word Documents Only (.doc, .docx)</div>
      </div>
      <div class="uploaded-files" id="uploadedFiles"></div>
      <div class="section-divider"></div>
      <div class="form-grid">
        <div class="form-group"><label>Ethics Approval Status</label><select id="ethicsStatus"><option>Approved</option><option>Pending</option><option>Not Required</option></select></div>
        <div class="form-group"><label>Departmental Approval</label><select id="deptApproval"><option>Yes</option><option>Pending</option></select></div>
      </div>
      <div class="btn-group"><button class="btn btn-outline" onclick="showStep(2)">← Back</button><button class="btn btn-gold" onclick="submitApplication()">🚀 Submit Application</button></div>
    </div>
  </div>

  <!-- MY APPLICATIONS -->
  <div class="card">
    <div class="card-header"><div class="card-title"><span style="color:var(--gold)">📂</span> My Applications</div></div>
    <div class="filter-bar">
      <input type="text" id="mySearch" placeholder="🔍 Search..." onkeyup="renderApplicant()">
      <select id="myFilter" onchange="renderApplicant()"><option value="">All</option><option>Submitted</option><option>Under Review</option><option>Approved</option><option>Revision Required</option></select>
    </div>
    <div style="overflow-x:auto">
      <table><thead><tr><th>ID</th><th>Title</th><th>Area</th><th>Budget</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
      <tbody id="myApplications"><tr class="empty-row"><td colspan="7">No applications yet.</td></tr></tbody></table>
    </div>
  </div>
</div>

<!-- REVIEWER DASHBOARD -->
<div id="tab-reviewer" class="tab-section">
  <div class="stats-grid">
    <div class="stat-card"><div class="stat-num" id="rv-total">0</div><div class="stat-label">Total</div></div>
    <div class="stat-card gold"><div class="stat-num" id="rv-pending">0</div><div class="stat-label">Pending</div></div>
    <div class="stat-card teal"><div class="stat-num" id="rv-completed">0</div><div class="stat-label">Reviewed</div></div>
  </div>
  <div class="card">
    <div class="card-header"><div class="card-title"><span style="color:var(--gold)">🔍</span> Applications for Review</div></div>
    <div style="overflow-x:auto">
      <table><thead><tr><th>ID</th><th>Title</th><th>Area</th><th>Score</th><th>Status</th><th>Action</th></tr></thead>
      <tbody id="reviewTable"><tr class="empty-row"><td colspan="6">No applications.</td></tr></tbody></table>
    </div>
  </div>
</div>

<!-- ADMIN DASHBOARD -->
<div id="tab-admin" class="tab-section">
  <div class="stats-grid">
    <div class="stat-card"><div class="stat-num" id="ad-total">0</div><div class="stat-label">Total</div></div>
    <div class="stat-card gold"><div class="stat-num" id="ad-submitted">0</div><div class="stat-label">Submitted</div></div>
    <div class="stat-card teal"><div class="stat-num" id="ad-reviewed">0</div><div class="stat-label">Under Review</div></div>
    <div class="stat-card gn"><div class="stat-num" id="ad-approved">0</div><div class="stat-label">Approved</div></div>
    <div class="stat-card red"><div class="stat-num" id="ad-revision">0</div><div class="stat-label">Needs Revision</div></div>
  </div>
  <div class="card">
    <div class="card-header"><div class="card-title"><span style="color:var(--gold)">🏛️</span> All Applications</div>
    <div style="display:flex;gap:8px"><button class="btn btn-sm btn-outline" onclick="exportCSV(60)">📤 Export 60%+</button><button class="btn btn-sm btn-outline" onclick="exportCSV(40)">📤 Export 40%+</button></div></div>
    <div class="filter-bar">
      <input type="text" id="adSearch" placeholder="🔍 Search..." onkeyup="renderAdmin()">
      <select id="adStatus" onchange="renderAdmin()"><option value="">All</option><option>Submitted</option><option>Under Review</option><option>Approved</option><option>Revision Required</option><option>Rejected</option></select>
    </div>
    <div style="overflow-x:auto">
      <table><thead><tr><th>ID</th><th>PI</th><th>Title</th><th>Area</th><th>Budget</th><th>Status</th><th>Score</th><th>Assigned To</th><th>Actions</th></tr></thead>
      <tbody id="adminTable"><tr class="empty-row"><td colspan="9">No applications.</td></tr></tbody></table>
    </div>
  </div>

  <!-- MANAGE REVIEWERS -->
  <div class="card">
    <div class="card-header"><div class="card-title"><span style="color:var(--teal)">🔍</span> Manage Reviewers</div>
    <button class="btn btn-sm btn-primary" onclick="openCreateReviewer()">+ Create Reviewer</button></div>
    <div id="reviewersList" style="font-size:13px;color:var(--muted)">Loading reviewers...</div>
  </div>
</div>

</main>

<!-- REVIEW MODAL -->
<div class="modal-overlay" id="reviewModal">
<div class="modal" style="max-width:660px">
  <button class="modal-close" onclick="closeModal('reviewModal')">✕</button>
  <div class="modal-title">📊 Submit Review</div>
  <div id="reviewAppDetails" style="margin-bottom:18px"></div>
  <input type="hidden" id="reviewAppId">
  <input type="hidden" id="reviewAppDbId">

  <!-- Applicant Submitted Documents -->
  <div style="margin-bottom:20px;padding:16px;background:#f8fafc;border-radius:12px;border:1px solid var(--border)">
    <div style="font-size:13px;font-weight:700;color:var(--navy);text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px;display:flex;align-items:center;gap:8px">📎 Applicant's Documents <span style="font-size:11px;color:var(--muted);font-weight:400;text-transform:none">(download to review)</span></div>
    <div id="reviewApplicantFiles" style="font-size:13px;color:var(--muted)">Loading files...</div>
  </div>

  <!-- Reviewer Upload Area -->
  <div style="margin-bottom:20px;padding:16px;background:#fffbeb;border-radius:12px;border:1px solid #fde68a">
    <div style="font-size:13px;font-weight:700;color:#92400e;text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px;display:flex;align-items:center;gap:8px">📤 Upload Annotated / Corrected Documents</div>
    <div style="font-size:12px;color:#92400e;margin-bottom:12px">Upload reviewed files here — the applicant will be able to download them.</div>
    <div id="reviewerUploadZone" style="border:2px dashed #fde68a;border-radius:10px;padding:16px;text-align:center;cursor:pointer;background:white;transition:.2s" onclick="document.getElementById('reviewFileInput').click()">
      <input type="file" id="reviewFileInput" multiple accept=".pdf,.doc,.docx,.xlsx,.xls" style="display:none" onchange="handleReviewerFiles(this.files)">
      <div style="font-size:24px;margin-bottom:6px">📁</div>
      <div style="font-weight:600;font-size:13px;color:var(--navy)">Click to select files</div>
      <div style="font-size:11px;color:var(--muted)">PDF, DOC, DOCX, XLSX</div>
    </div>
    <div id="reviewerFilesList" style="margin-top:8px"></div>
    <div id="reviewerExistingFiles" style="margin-top:10px"></div>
    <button class="btn btn-sm btn-gold" id="btnUploadReview" onclick="uploadReviewerFiles()" style="margin-top:10px;display:none">⬆️ Upload Files</button>
  </div>

  <div id="criteriaForm"></div>
  <div class="form-group" style="margin-top:16px"><label>Recommendation</label>
    <select id="reviewRecommendation"><option value="">— Select —</option><option value="Approved">✅ Approved</option><option value="Minor Revision">🟡 Minor Revision</option><option value="Major Revision">🟠 Major Revision</option><option value="Rejected">❌ Rejected</option></select>
  </div>
  <div class="form-group" style="margin-top:12px"><label>Comments</label><textarea id="reviewComments" placeholder="Detailed feedback..."></textarea></div>
  <div class="btn-group"><button class="btn btn-primary" onclick="submitReview()">Submit Review</button><button class="btn btn-outline" onclick="closeModal('reviewModal')">Cancel</button></div>
</div>
</div>

<!-- DETAIL MODAL -->
<div class="modal-overlay" id="detailModal">
<div class="modal"><button class="modal-close" onclick="closeModal('detailModal')">✕</button><div class="modal-title">📋 Application Details</div><div id="detailContent"></div></div>
</div>

<!-- APPROVAL LETTER MODAL (Director only) -->
<div class="modal-overlay" id="approvalModal">
<div class="modal" style="max-width:480px">
  <button class="modal-close" onclick="closeModal('approvalModal')">✕</button>
  <div class="modal-title">📜 Upload Approval Letter</div>
  <div id="approvalAppDetails" style="margin-bottom:14px"></div>
  <input type="hidden" id="approvalAppDbId">
  <div style="background:#d1fae5;border:1px solid #6ee7b7;border-radius:10px;padding:14px;margin-bottom:14px;font-size:12px;color:#065f46">Upload the official approval/decision letter for this applicant. They will be able to download it from their portal.</div>
  <div class="form-group" style="margin-bottom:14px"><label>Select Letter File</label><input type="file" id="approvalFileInput" accept=".pdf,.doc,.docx" style="font-size:13px"></div>
  <div id="approvalExisting" style="margin-bottom:12px"></div>
  <div class="btn-group"><button class="btn btn-success" onclick="uploadApprovalLetter()">📜 Upload Letter</button><button class="btn btn-outline" onclick="closeModal('approvalModal')">Cancel</button></div>
</div>
</div>

<!-- CREATE REVIEWER MODAL -->
<div class="modal-overlay" id="createReviewerModal">
<div class="modal" style="max-width:500px">
  <button class="modal-close" onclick="closeModal('createReviewerModal')">✕</button>
  <div class="modal-title">🔍 Create Reviewer Account</div>
  <p style="font-size:13px;color:var(--muted);margin-bottom:18px">Create a reviewer account. The reviewer will use these credentials to login and review assigned applications.</p>
  <div class="form-group" style="margin-bottom:12px"><label>Full Name <span style="color:var(--red)">*</span></label><input type="text" id="crName" placeholder="Dr. Suleiman Garba"></div>
  <div class="form-group" style="margin-bottom:12px"><label>Staff ID <span style="color:var(--red)">*</span></label><input type="text" id="crStaffId" placeholder="REV001"></div>
  <div class="form-group" style="margin-bottom:12px"><label>Email <span style="color:var(--red)">*</span></label><input type="email" id="crEmail" placeholder="sgarba@fuhsa.edu.ng"></div>
  <div class="form-group" style="margin-bottom:12px"><label>Department</label><input type="text" id="crDept" placeholder="Medical Microbiology"></div>
  <div class="form-group" style="margin-bottom:12px"><label>Area of Specialization <span style="color:var(--red)">*</span></label><input type="text" id="crSpec" placeholder="e.g. Epidemiology, Pharmacology, Surgery"></div>
  <div class="form-group" style="margin-bottom:12px"><label>Password <span style="color:var(--red)">*</span></label><input type="password" id="crPass" placeholder="Min 8 chars, A-Z, 0-9, !@#$"></div>
  <div id="crError" style="background:#fee2e2;color:#991b1b;border-radius:8px;padding:10px;font-size:13px;margin-bottom:12px;display:none"></div>
  <div class="btn-group"><button class="btn btn-primary" onclick="createReviewer()">✅ Create Reviewer</button><button class="btn btn-outline" onclick="closeModal('createReviewerModal')">Cancel</button></div>
</div>
</div>

<!-- ASSIGN REVIEWER MODAL -->
<div class="modal-overlay" id="assignModal">
<div class="modal" style="max-width:480px">
  <button class="modal-close" onclick="closeModal('assignModal')">✕</button>
  <div class="modal-title">📋 Assign Reviewer</div>
  <div id="assignAppDetails" style="margin-bottom:16px"></div>
  <input type="hidden" id="assignAppId">
  <input type="hidden" id="assignAppDbId">
  <div class="form-group" style="margin-bottom:16px">
    <label>Select Reviewer (by specialization)</label>
    <select id="assignReviewerSelect" style="width:100%;padding:12px;border:1.5px solid var(--border);border-radius:8px;font-size:14px">
      <option value="">Loading reviewers...</option>
    </select>
  </div>
  <div id="assignReviewerInfo" style="font-size:12px;color:var(--muted);margin-bottom:14px"></div>
  <div class="btn-group">
    <button class="btn btn-primary" onclick="assignReviewer()">✅ Assign & Notify Reviewer</button>
    <button class="btn btn-outline" onclick="closeModal('assignModal')">Cancel</button>
  </div>
</div>
</div>

<!-- NOTIFICATION -->
<div class="notification" id="notification"><span id="notifIcon">✅</span><span id="notifText">Success</span></div>

<script>
// ═══ STATE ═══
let applications = [];
let uploadedFilesList = [];
let currentStep = 1;
let reviewScores = {};
let selectedLoginRole = 'applicant';

<?php if(isset($_SESSION['ibr_user_id'])): ?>
let currentRole = '<?= $_SESSION['ibr_role'] ?? 'applicant' ?>';
let currentUser = '<?= $_SESSION['ibr_staff_id'] ?? '' ?>';
let currentUserData = {staffId:'<?= $_SESSION['ibr_staff_id'] ?? '' ?>',name:'<?= addslashes($_SESSION['ibr_name'] ?? '') ?>'};
document.addEventListener('DOMContentLoaded',()=>{applyRole();loadApps()});
<?php else: ?>
let currentRole=null,currentUser=null,currentUserData=null;
<?php endif; ?>

// ═══ HELPERS ═══
const FACULTIES = {
  'Faculty of Basic Medical Sciences':['Human Anatomy','Human Physiology','Biochemistry'],
  'Faculty of Basic Clinical Sciences':['Chemical Pathology','Haematology','Histopathology','Medical Microbiology and Parasitology','Clinical Pharmacology and Therapeutics'],
  'Faculty of Clinical Sciences':['Medicine','Surgery','Paediatrics','Obstetrics and Gynaecology','Community Medicine','Family Medicine','Psychiatry','Ophthalmology','Otorhinolaryngology (ENT)','Anaesthesia','Radiology'],
  'Faculty of Allied Health Sciences':['Nursing Science','Medical Laboratory Science','Radiography','Physiotherapy','Optometry','Audiology','Human Nutrition and Dietetics','Environmental Health Sciences'],
  'Faculty of Dentistry':['Preventive Dentistry','Restorative Dentistry','Oral and Maxillofacial Surgery','Child Dental Health','Oral Pathology and Oral Medicine'],
  'Faculty of Science':['Microbiology','Biotechnology','Biological Sciences','Chemistry','Physics','Mathematics and Statistics','Data Science and Artificial Intelligence'],
  'Faculty of Integrated Sciences':['Environmental Health Sciences','Public Health','Epidemiology and Biostatistics','Human Nutrition and Dietetics','Health Information Management and Health Informatics','Forensic Sciences','Environmental Science and Management']
};
function populateFaculties(){
  const sel=document.getElementById('faculty');if(!sel)return;
  sel.innerHTML='<option value="">— Select Faculty —</option>'+Object.keys(FACULTIES).map(f=>'<option value="'+f+'">'+f+'</option>').join('');
}
function updateDepartments(){
  const fac=document.getElementById('faculty').value;
  const sel=document.getElementById('department');
  const depts=FACULTIES[fac]||[];
  sel.innerHTML='<option value="">— Select Department —</option>'+depts.map(d=>'<option value="'+d+'">'+d+'</option>').join('');
}
document.addEventListener('DOMContentLoaded',populateFaculties);

function v(id){return(document.getElementById(id)?.value||'').trim()}
function badge(s){const m={'Submitted':'submitted','Under Review':'review','Approved':'approved','Revision Required':'revision','Rejected':'rejected'};const ic={'Submitted':'📨','Under Review':'🔍','Approved':'✅','Revision Required':'⚠️','Rejected':'❌'};return'<span class="badge badge-'+(m[s]||'submitted')+'">'+(ic[s]||'')+' '+s+'</span>'}
function notify(msg,type='success'){const el=document.getElementById('notification');const ic={success:'✅',error:'❌',warning:'⚠️'};document.getElementById('notifIcon').textContent=ic[type]||'✅';document.getElementById('notifText').textContent=msg;el.className='notification '+type+' show';setTimeout(()=>el.classList.remove('show'),3500)}
function closeModal(id){document.getElementById(id).classList.remove('open')}
document.querySelectorAll('.modal-overlay').forEach(m=>m.addEventListener('click',function(e){if(e.target===this)this.classList.remove('open')}));

// ═══ AJAX ═══
function ajaxPost(data,cb){const fd=(data instanceof FormData)?data:(()=>{const f=new FormData();Object.keys(data).forEach(k=>f.append(k,data[k]));return f})();fetch('ibr_actions.php',{method:'POST',body:fd}).then(r=>r.json()).then(cb).catch(e=>notify('Error: '+e.message,'error'))}

function loadApps(){
  fetch('ibr_actions.php?action=ibr_get_apps').then(r=>r.json()).then(data=>{
    applications=data.map(a=>({id:a.app_id,dbId:a.id,piName:a.pi_name,staffNo:a.staff_no,email:a.email,phone:a.phone,department:a.department,faculty:a.faculty,rank:a.academic_rank,title:a.title,resArea:a.research_area,duration:a.duration_months,budget:a.budget,abstract:a.abstract,status:a.status,score:a.score,recommendation:a.recommendation,reviewerComments:a.reviewer_comments,submittedAt:a.submitted_at,submittedBy:a.staff_no,assignedReviewerId:a.assigned_reviewer_id,assignedReviewerName:a.reviewer_name||'',files:a.file_names?a.file_names.split(',').map(n=>({name:n})):[]}));
    renderAll();
    if(currentRole==='admin') updateStats();
  }).catch(()=>{applications=[];renderAll()});
}

function updateStats(){
  fetch('ibr_actions.php?action=ibr_stats').then(r=>r.json()).then(s=>{
    ['ad-total','ad-submitted','ad-reviewed','ad-approved','ad-revision'].forEach(id=>{const el=document.getElementById(id);if(el)el.textContent=s[{
      'ad-total':'total','ad-submitted':'submitted','ad-reviewed':'review','ad-approved':'approved','ad-revision':'revision'
    }[id]]||0});
  }).catch(()=>{});
}

// ═══ AUTH ═══
function selectRole(r){selectedLoginRole=r;document.getElementById('roleApplicant').classList.toggle('selected',r==='applicant');document.getElementById('roleReviewer').classList.toggle('selected',r==='reviewer');document.getElementById('roleAdmin').classList.toggle('selected',r==='admin');document.getElementById('signupToggleRow').style.display=(r==='admin'||r==='reviewer')?'none':'';document.getElementById('adminHint').style.display=(r==='admin'||r==='reviewer')?'inline':'none';if(r==='admin')document.getElementById('adminHint').textContent='(Contact DIRD)';if(r==='reviewer')document.getElementById('adminHint').textContent='(Created by Director)'}
function setRegRole(r){document.getElementById('suRegRole').value=r;document.getElementById('regRoleApp').classList.toggle('selected',r==='applicant');document.getElementById('regRoleRev').classList.toggle('selected',r==='reviewer');document.getElementById('specRow').style.display=r==='reviewer'?'':'none'}
function showSignup(){document.getElementById('signinPanel').style.display='none';document.getElementById('signupPanel').style.display=''}
function showSignin(){document.getElementById('signupPanel').style.display='none';document.getElementById('signinPanel').style.display=''}

function doLogin(){
  const user=document.getElementById('loginUser').value.trim().toUpperCase(),pass=document.getElementById('loginPass').value,err=document.getElementById('loginError');
  err.classList.remove('show');if(!user){err.textContent='Enter Staff ID';err.classList.add('show');return}
  ajaxPost({action:'ibr_login',staff_id:user,password:pass,role:selectedLoginRole},r=>{
    if(r.success){currentRole=r.role;currentUser=user;currentUserData={staffId:user,name:r.name};applyRole();document.getElementById('loginScreen').classList.add('hidden');loadApps();notify('Welcome, '+r.name,'success')}
    else{err.textContent=r.msg;err.classList.add('show')}
  });
}
function doSignup(){
  const n=document.getElementById('suName').value.trim(),s=document.getElementById('suStaffId').value.trim().toUpperCase(),e=document.getElementById('suEmail').value.trim(),d=document.getElementById('suDept').value.trim(),p=document.getElementById('suPass').value,p2=document.getElementById('suPass2').value,err=document.getElementById('signupError');
  err.classList.remove('show');if(!n||!s||!e||!d||!p){err.textContent='Fill all fields';err.classList.add('show');return}
  if(p.length<8){err.textContent='Password must be 8+ characters with uppercase, number & special character';err.classList.add('show');return}
  if(!/[A-Z]/.test(p)){err.textContent='Password needs at least one uppercase letter (A-Z)';err.classList.add('show');return}
  if(!/[0-9]/.test(p)){err.textContent='Password needs at least one number (0-9)';err.classList.add('show');return}
  if(!/[!@#$%^&*()_+\-=\[\]{}|;:,.<>?]/.test(p)){err.textContent='Password needs at least one special character (!@#$%...)';err.classList.add('show');return}
  if(p!==p2){err.textContent='Passwords don\'t match';err.classList.add('show');return}
  ajaxPost({action:'ibr_register',full_name:n,staff_id:s,email:e,department:d,password:p,reg_role:document.getElementById('suRegRole').value,specialization:document.getElementById('suSpec').value.trim()},r=>{
    if(r.success){currentRole=r.role;currentUser=s;currentUserData={staffId:s,name:n};applyRole();document.getElementById('loginScreen').classList.add('hidden');loadApps();notify('Account created!','success')}
    else{err.textContent=r.msg;err.classList.add('show')}
  });
}
function doLogout(){if(!confirm('Sign out?'))return;ajaxPost({action:'ibr_logout'},()=>location.reload())}

function applyRole(){
  const isA=currentRole==='admin',isR=currentRole==='reviewer';
  // Each role sees ONLY their own tab
  document.getElementById('tabBtnApplicant').style.display=(!isA&&!isR)?'':'none';
  document.getElementById('tabBtnReviewer').style.display=isR?'':'none';
  document.getElementById('tabBtnAdmin').style.display=isA?'':'none';
  document.getElementById('userPillName').textContent=currentUserData?.name||currentUser;
  document.getElementById('userPillRole').textContent=isA?'· Director':isR?'· Reviewer':'· Applicant';
  document.querySelectorAll('.tab-section').forEach(s=>s.classList.remove('active'));
  document.querySelectorAll('.nav-tab').forEach(b=>b.classList.remove('active'));
  if(isA){document.getElementById('tab-admin').classList.add('active');document.getElementById('tabBtnAdmin').classList.add('active')}
  else if(isR){document.getElementById('tab-reviewer').classList.add('active');document.getElementById('tabBtnReviewer').classList.add('active')}
  else{document.getElementById('tab-applicant').classList.add('active');document.getElementById('tabBtnApplicant').classList.add('active');
    if(currentUserData){const p=document.getElementById('piName'),s=document.getElementById('staffNo'),e=document.getElementById('email'),d=document.getElementById('department');if(p&&!p.value)p.value=currentUserData.name||'';if(s&&!s.value)s.value=currentUserData.staffId||''}
  }
}

// ═══ TABS & STEPS ═══
function switchTab(id,btn){document.querySelectorAll('.tab-section').forEach(s=>s.classList.remove('active'));document.querySelectorAll('.nav-tab').forEach(b=>b.classList.remove('active'));document.getElementById('tab-'+id).classList.add('active');btn.classList.add('active')}
function nextStep(n){if(n===2&&(!v('piName')||!v('staffNo')||!v('email')||!v('phone')||!v('department')||!v('faculty')))return notify('Complete Step 1 fields','error');if(n===3&&(!v('title')||!v('resArea')||!v('duration')||!v('budget')||!v('abstract')))return notify('Complete Step 2 fields','error');showStep(n)}
function showStep(n){currentStep=n;['formStep1','formStep2','formStep3'].forEach((id,i)=>document.getElementById(id).style.display=(i+1===n)?'block':'none');for(let i=1;i<=3;i++){document.getElementById('sc'+i).className='step-circle'+(i<n?' done':i===n?' active':'');if(i<3)document.getElementById('sl'+i).className='step-line'+(i<n?' done':'')}}

// ═══ FILE UPLOAD ═══
function handleFiles(files){[...files].forEach(f=>uploadedFilesList.push(f));renderUploadedFiles()}
function renderUploadedFiles(){document.getElementById('uploadedFiles').innerHTML=uploadedFilesList.map((f,i)=>'<div class="uploaded-file"><span>📎</span><span>'+f.name+'</span><span style="color:var(--muted);font-size:11px;margin-left:6px">('+( f.size/1024).toFixed(1)+' KB)</span><button class="remove" onclick="removeFile('+i+')">✕</button></div>').join('')}
function removeFile(i){uploadedFilesList.splice(i,1);renderUploadedFiles()}

// ═══ DYNAMIC CO-INVESTIGATORS ═══
let coPICount = 0;
function addCoPI(){
  coPICount++;
  const div = document.createElement('div');
  div.className = 'form-grid';
  div.id = 'copi-row-'+coPICount;
  div.style.marginBottom = '8px';
  div.innerHTML = '<div class="form-group"><label>Co-PI '+coPICount+' Name</label><input type="text" class="copi-name" placeholder="Full name"></div><div class="form-group"><label>Speciality / Area</label><input type="text" class="copi-spec" placeholder="e.g. Epidemiology"></div><div class="form-group" style="align-self:end"><button type="button" class="btn btn-sm btn-danger" onclick="document.getElementById(\'copi-row-'+coPICount+'\').remove()">✕ Remove</button></div>';
  document.getElementById('coInvestigators').appendChild(div);
}
function getCoPIs(){
  const names = document.querySelectorAll('.copi-name');
  const specs = document.querySelectorAll('.copi-spec');
  const list = [];
  names.forEach((n,i) => { if(n.value.trim()) list.push(n.value.trim() + (specs[i]&&specs[i].value.trim()?' ['+specs[i].value.trim()+']':'')); });
  return list.join('|||');
}

// ═══ SUBMIT APPLICATION ═══
function submitApplication(){
  const fd=new FormData();fd.append('action','ibr_submit');
  const fields={pi_name:'piName',staff_no:'staffNo',email:'email',phone:'phone',department:'department',faculty:'faculty',academic_rank:'rank',staff_category:'staffCat',title:'title',research_area:'resArea',duration_months:'duration',start_date:'startDate',budget:'budget',abstract:'abstract',problem_statement:'problem',objectives:'objectives',ethics_status:'ethicsStatus',dept_approval:'deptApproval'};
  Object.keys(fields).forEach(k=>fd.append(k,v(fields[k])));
  fd.append('co_investigators', getCoPIs());
  uploadedFilesList.forEach(f=>fd.append('documents[]',f));
  ajaxPost(fd,r=>{if(r.success){notify('Application '+r.app_id+' submitted!','success');resetForm();loadApps()}else notify(r.msg||'Failed','error')});
}
function resetForm(){['piName','staffNo','email','phone','department','faculty','rank','staffCat','title','resArea','duration','startDate','budget','abstract','problem','objectives','ethicsStatus','deptApproval'].forEach(id=>{const el=document.getElementById(id);if(el)el.value=''});uploadedFilesList=[];document.getElementById('uploadedFiles').innerHTML='';document.getElementById('coInvestigators').innerHTML='';coPICount=0;showStep(1)}

// ═══ RENDER ═══
function renderAll(){renderApplicant();renderReviewer();renderAdmin()}

function renderApplicant(){
  const q=(document.getElementById('mySearch')?.value||'').toLowerCase(),sf=document.getElementById('myFilter')?.value||'';
  const userApps=currentRole==='admin'?applications:applications.filter(a=>a.submittedBy===currentUser||a.staffNo===currentUser);
  const list=userApps.filter(a=>(!q||a.title.toLowerCase().includes(q)||a.id.toLowerCase().includes(q))&&(!sf||a.status===sf));
  const tb=document.getElementById('myApplications');
  if(!list.length){tb.innerHTML='<tr class="empty-row"><td colspan="7">No applications found.</td></tr>';return}
  tb.innerHTML=list.map(a=>{
    const decided=['Approved','Revision Required','Rejected'].includes(a.status);
    let btns='<button class="btn btn-sm btn-outline" onclick="showDetail(\''+a.id+'\')">View</button>';
    btns+='<button class="btn btn-sm btn-teal" onclick="showFilesPanel(\''+a.id+'\')">📁 Files</button>';
    if(decided){btns+='<button class="btn btn-sm btn-success" onclick="showFilesPanel(\''+a.id+'\')">📜 Letter</button>'}
    return'<tr'+(decided?' style="background:'+(a.status==='Approved'?'#d1fae5':a.status==='Rejected'?'#fee2e2':'#fef3c7')+'"':'')+'>'+
      '<td><span class="app-id">'+a.id+'</span></td>'+
      '<td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="'+a.title+'">'+a.title+'</td>'+
      '<td>'+(a.resArea||'—')+'</td>'+
      '<td>'+(a.budget?'₦'+Number(a.budget).toLocaleString():'—')+'</td>'+
      '<td>'+badge(a.status)+(a.score!=null?' <span style="font-size:11px;color:var(--muted)">('+a.score+'/100)</span>':'')+'</td>'+
      '<td style="font-size:12px;color:var(--muted)">'+new Date(a.submittedAt).toLocaleDateString()+'</td>'+
      '<td class="action-btns">'+btns+'</td></tr>';
  }).join('');
}

function renderReviewer(){
  // Backend already filters apps for the logged-in reviewer — no JS filter needed
  const list = applications;
  const tb=document.getElementById('reviewTable');
  // Update reviewer-specific stats
  const rvTotal=list.length, rvPending=list.filter(a=>a.score==null).length, rvDone=list.filter(a=>a.score!=null).length;
  const rt=document.getElementById('rv-total'),rp=document.getElementById('rv-pending'),rc=document.getElementById('rv-completed');
  if(rt)rt.textContent=rvTotal;if(rp)rp.textContent=rvPending;if(rc)rc.textContent=rvDone;
  if(!list.length){tb.innerHTML='<tr class="empty-row"><td colspan="6">No applications assigned to you yet.</td></tr>';return}
  tb.innerHTML=list.map(a=>{
    const scored=a.score!=null;
    const sh=scored?'<strong>'+a.score+'/100</strong><div class="score-bar"><div class="score-fill" style="width:'+a.score+'%"></div></div>':'<span style="color:var(--muted);font-size:12px">Pending</span>';
    const sendBtn=scored&&a.status==='Under Review'?'<button class="btn btn-sm btn-gold" onclick="sendToDirector(\''+a.id+'\')">📤 Send to Director</button>':'';
    return'<tr><td><span class="app-id">'+a.id+'</span></td><td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">'+a.title+'</td><td>'+(a.resArea||'—')+'</td><td>'+sh+'</td><td>'+badge(a.status)+'</td><td class="action-btns"><button class="btn btn-sm btn-primary" onclick="openReview(\''+a.id+'\')">Review</button><button class="btn btn-sm btn-outline" onclick="showDetail(\''+a.id+'\')">View</button>'+sendBtn+'</td></tr>'}).join('');
}

function renderAdmin(){
  const q=(document.getElementById('adSearch')?.value||'').toLowerCase(),sf=document.getElementById('adStatus')?.value||'';
  const list=applications.filter(a=>(!q||a.title.toLowerCase().includes(q)||a.piName.toLowerCase().includes(q)||a.id.toLowerCase().includes(q))&&(!sf||a.status===sf));
  const tb=document.getElementById('adminTable');
  if(!list.length){tb.innerHTML='<tr class="empty-row"><td colspan="9">No applications.</td></tr>';return}
  tb.innerHTML=list.map(a=>{
    const assignBtn = a.status==='Submitted'&&!a.assignedReviewerId ? '<button class="btn btn-sm btn-gold" onclick="openAssign(\''+a.id+'\')">📋 Assign</button>' : (a.assignedReviewerName ? '<span style="font-size:11px;color:var(--teal)">→ '+a.assignedReviewerName+'</span>' : '');
    // Show Send to Applicant buttons when review is complete (has score)
    let actionBtns='<button class="btn btn-sm btn-outline" onclick="showDetail(\''+a.id+'\')">View</button>';
    if(a.score!=null && (a.status==='Under Review'||a.status==='Submitted')){
      actionBtns+='<button class="btn btn-sm btn-success" onclick="sendToApplicant(\''+a.id+'\',\'Approved\')">✅</button>';
      actionBtns+='<button class="btn btn-sm" style="background:#d97706;color:white" onclick="sendToApplicant(\''+a.id+'\',\'Revision Required\')">⚠️</button>';
      actionBtns+='<button class="btn btn-sm btn-danger" onclick="sendToApplicant(\''+a.id+'\',\'Rejected\')">❌</button>';
    } else if(a.status==='Approved'||a.status==='Revision Required'||a.status==='Rejected'){
      actionBtns+='<button class="btn btn-sm" style="background:#059669;color:white" onclick="openApprovalModal(\''+a.id+'\')">📜 Letter</button>';
    } else {
      actionBtns+='<button class="btn btn-sm btn-teal" onclick="changeStatus(\''+a.id+'\')">Status</button>';
    }
    actionBtns+='<button class="btn btn-sm btn-danger" onclick="deleteApp(\''+a.id+'\')">Del</button>';
    return'<tr><td><span class="app-id">'+a.id+'</span></td><td>'+a.piName+'</td><td style="max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="'+a.title+'">'+a.title+'</td><td style="font-size:12px">'+(a.resArea||'—')+'</td><td style="font-size:12px">₦'+Number(a.budget||0).toLocaleString()+'</td><td>'+badge(a.status)+'</td><td>'+(a.score!=null?'<strong>'+a.score+'/100</strong>':'—')+'</td><td>'+assignBtn+'</td><td class="action-btns">'+actionBtns+'</td></tr>'}).join('');
}

// ═══ ADMIN ACTIONS ═══
function changeStatus(appId){const app=applications.find(a=>a.id===appId);if(!app)return;const st=['Submitted','Under Review','Approved','Revision Required','Rejected'];const next=st[(st.indexOf(app.status)+1)%st.length];ajaxPost({action:'ibr_update_status',id:app.dbId,status:next},r=>{if(r.success){notify('Status → '+next,'success');loadApps()}})}
function deleteApp(appId){const app=applications.find(a=>a.id===appId);if(!app||!confirm('Delete '+appId+'?'))return;ajaxPost({action:'ibr_delete',id:app.dbId},r=>{if(r.success){notify('Deleted','warning');loadApps()}})}
function exportCSV(threshold){window.location='ibr_actions.php?action=ibr_export&threshold='+(threshold||0)}

// ═══ DETAIL MODAL (with files) ═══
function showDetail(id){
  const a=applications.find(x=>x.id===id);if(!a)return;
  const decided=['Approved','Revision Required','Rejected'].includes(a.status);
  const decColors={Approved:'#d1fae5','Revision Required':'#fef3c7',Rejected:'#fee2e2'};
  const decEmoji={Approved:'✅','Revision Required':'⚠️',Rejected:'❌'};

  let html='';
  // Decision banner for decided applications
  if(decided){
    html+='<div style="background:'+(decColors[a.status]||'#f0f4ff')+';border-radius:12px;padding:18px;text-align:center;margin-bottom:18px;border:2px solid '+(a.status==='Approved'?'#6ee7b7':a.status==='Rejected'?'#fca5a5':'#fde68a')+'"><div style="font-size:32px;margin-bottom:6px">'+(decEmoji[a.status]||'')+'</div><div style="font-size:20px;font-weight:800;color:var(--navy)">'+a.status+'</div>'+(a.score!=null?'<div style="font-size:14px;color:var(--muted);margin-top:4px">Score: <strong>'+a.score+'/100</strong></div>':'')+'</div>';
  }

  html+='<div class="detail-grid" style="margin-bottom:16px"><div><div class="detail-label">Application ID</div><div class="detail-value app-id">'+a.id+'</div></div><div><div class="detail-label">Status</div><div class="detail-value">'+badge(a.status)+'</div></div><div><div class="detail-label">Submitted</div><div class="detail-value">'+new Date(a.submittedAt).toLocaleDateString()+'</div></div><div><div class="detail-label">Score</div><div class="detail-value">'+(a.score!=null?a.score+'/100':'—')+'</div></div></div>'+
    '<div class="section-divider"></div>'+
    '<div style="margin-bottom:12px"><div class="detail-label">Principal Investigator</div><div class="detail-value">'+(currentRole==='reviewer'?'<em style="color:var(--muted)">Confidential</em>':a.piName)+'</div></div>'+
    '<div class="detail-grid" style="margin-bottom:12px"><div><div class="detail-label">Department</div><div class="detail-value">'+(a.department||'—')+'</div></div><div><div class="detail-label">Faculty</div><div class="detail-value">'+(a.faculty||'—')+'</div></div><div><div class="detail-label">Email</div><div class="detail-value">'+(a.email||'—')+'</div></div></div>'+
    '<div class="section-divider"></div>'+
    '<div style="margin-bottom:10px"><div class="detail-label">Research Title</div><div class="detail-value">'+a.title+'</div></div>'+
    '<div class="detail-grid"><div><div class="detail-label">Area</div><div class="detail-value">'+(a.resArea||'—')+'</div></div><div><div class="detail-label">Duration</div><div class="detail-value">'+(a.duration?a.duration+' months':'—')+'</div></div><div><div class="detail-label">Budget</div><div class="detail-value">₦'+Number(a.budget||0).toLocaleString()+'</div></div></div>'+
    (a.abstract?'<div style="margin-top:14px"><div class="detail-label">Abstract</div><div style="font-size:13px;line-height:1.6;margin-top:4px;background:#f8fafc;padding:12px;border-radius:8px">'+a.abstract+'</div></div>':'')+
    (a.reviewerComments?'<div style="margin-top:14px"><div class="detail-label">Reviewer Comments</div><div style="font-size:13px;line-height:1.6;margin-top:4px;background:#fffbeb;padding:12px;border-radius:8px;border-left:3px solid var(--gold)">'+a.reviewerComments+'</div></div>':'')+
    '<div id="detailFilesSection" style="margin-top:18px"><div style="font-size:12px;color:var(--muted)">Loading files...</div></div>';
  document.getElementById('detailContent').innerHTML=html;
  document.getElementById('detailModal').classList.add('open');
  // Load files
  fetch('ibr_actions.php?action=ibr_get_files&app_id='+a.dbId).then(r=>r.json()).then(f=>{
    let fh='';
    // Approval letters first (prominently)
    const approvalLetters=(f.reviewer_files||[]).filter(fi=>fi.file_name.startsWith('APPROVAL:'));
    const otherRevFiles=(f.reviewer_files||[]).filter(fi=>!fi.file_name.startsWith('APPROVAL:'));
    if(approvalLetters.length){
      fh+='<div style="background:#d1fae5;border:2px solid #6ee7b7;border-radius:12px;padding:16px;margin-bottom:14px"><div style="font-weight:700;color:#065f46;font-size:14px;margin-bottom:10px">📜 Official Letter from Director</div>';
      fh+=approvalLetters.map(fi=>fileItem(fi,'reviewer')).join('');
      fh+='</div>';
    }
    if(f.applicant_files&&f.applicant_files.length){
      fh+='<div class="detail-label" style="margin-bottom:8px">📎 Submitted Documents</div>';
      fh+=f.applicant_files.map(fi=>fileItem(fi,'applicant')).join('');
    }
    if(otherRevFiles.length){
      fh+='<div class="detail-label" style="margin-top:14px;margin-bottom:8px">📤 Reviewer Feedback Documents</div>';
      fh+=otherRevFiles.map(fi=>fileItem(fi,'reviewer')).join('');
    }
    if(!fh)fh='<div style="font-size:13px;color:var(--muted);padding:12px;background:#f8fafc;border-radius:8px;text-align:center">No documents attached.</div>';
    document.getElementById('detailFilesSection').innerHTML=fh;
  }).catch(()=>{document.getElementById('detailFilesSection').innerHTML='<div style="color:var(--muted);font-size:12px">Could not load files.</div>'});
}

function fileItem(fi,type){
  const icons={'application/pdf':'📕','application/msword':'📄','application/vnd.openxmlformats-officedocument.wordprocessingml.document':'📄'};
  const icon=icons[fi.file_type]||'📎';
  const sz=fi.file_size?(fi.file_size/1024).toFixed(1)+' KB':'';
  const bg=type==='reviewer'?'#fffbeb':'#f0f7ff';
  const border=type==='reviewer'?'#fde68a':'var(--border)';
  return'<div style="display:flex;align-items:center;gap:12px;padding:10px 14px;background:'+bg+';border:1.5px solid '+border+';border-radius:10px;margin-bottom:6px;font-size:13px"><span style="font-size:20px;flex-shrink:0">'+icon+'</span><div style="flex:1;min-width:0"><div style="font-weight:600;color:var(--navy);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">'+fi.file_name+'</div><div style="font-size:11px;color:var(--muted)">'+sz+'</div></div><a href="ibr_actions.php?action=ibr_download&file_id='+fi.id+'&type='+type+'" class="btn btn-sm btn-teal" style="text-decoration:none;flex-shrink:0">⬇ Download</a></div>';
}

// ═══ FILES PANEL (for applicant to see reviewer files) ═══
function showFilesPanel(id){
  const a=applications.find(x=>x.id===id);if(!a)return;
  const decided=['Approved','Revision Required','Rejected'].includes(a.status);
  const decEmoji={Approved:'✅','Revision Required':'⚠️',Rejected:'❌'};
  let html='<div style="margin-bottom:16px"><div class="detail-label">Application</div><div class="detail-value">'+a.id+' — '+a.title+'</div></div>';
  if(decided){html+='<div style="background:'+(a.status==='Approved'?'#d1fae5':a.status==='Rejected'?'#fee2e2':'#fef3c7')+';border-radius:10px;padding:14px;text-align:center;margin-bottom:16px;font-weight:700;font-size:16px">'+(decEmoji[a.status]||'')+' '+a.status+(a.score!=null?' — Score: '+a.score+'/100':'')+'</div>'}
  html+='<div id="filesPanelContent" style="font-size:13px;color:var(--muted)">Loading files...</div>';
  document.getElementById('detailContent').innerHTML=html;
  document.getElementById('detailModal').classList.add('open');
  fetch('ibr_actions.php?action=ibr_get_files&app_id='+a.dbId).then(r=>r.json()).then(f=>{
    let fh='';
    // Separate approval letters from other reviewer files
    const approvalLetters=(f.reviewer_files||[]).filter(fi=>fi.file_name.startsWith('APPROVAL:'));
    const otherRevFiles=(f.reviewer_files||[]).filter(fi=>!fi.file_name.startsWith('APPROVAL:'));
    // Show approval letters first with prominent styling
    if(approvalLetters.length){
      fh+='<div style="background:#d1fae5;border:2px solid #6ee7b7;border-radius:12px;padding:16px;margin-bottom:16px"><div style="font-weight:700;color:#065f46;font-size:15px;margin-bottom:10px">📜 Official Letter from Director</div>';
      fh+=approvalLetters.map(fi=>fileItem(fi,'reviewer')).join('');
      fh+='</div>';
    }
    if(f.applicant_files&&f.applicant_files.length){
      fh+='<div style="font-weight:700;color:var(--navy);font-size:14px;margin-bottom:10px">📎 Your Submitted Documents</div>';
      fh+=f.applicant_files.map(fi=>fileItem(fi,'applicant')).join('');
    }
    if(otherRevFiles.length){
      fh+='<div style="font-weight:700;color:#92400e;font-size:14px;margin-top:18px;margin-bottom:10px">📤 Reviewer Feedback Documents</div>';
      fh+='<div style="background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:12px;margin-bottom:12px;font-size:12px;color:#92400e">Download, review the comments, and resubmit if revision is required.</div>';
      fh+=otherRevFiles.map(fi=>fileItem(fi,'reviewer')).join('');
    }
    if(!approvalLetters.length&&!f.applicant_files?.length&&!otherRevFiles.length)fh='<div style="text-align:center;padding:2rem;color:var(--muted)">No files for this application.</div>';
    document.getElementById('filesPanelContent').innerHTML=fh;
  }).catch(()=>{document.getElementById('filesPanelContent').innerHTML='Could not load files.'});
}

// ═══ REVIEWER FILE HANDLING ═══
let reviewerFilesList=[];
function handleReviewerFiles(files){[...files].forEach(f=>reviewerFilesList.push(f));renderReviewerFiles();document.getElementById('btnUploadReview').style.display='inline-flex'}
function renderReviewerFiles(){document.getElementById('reviewerFilesList').innerHTML=reviewerFilesList.map((f,i)=>'<div style="display:flex;align-items:center;gap:8px;padding:6px 10px;background:#fff;border:1px solid #fde68a;border-radius:6px;margin-top:4px;font-size:12px"><span>📎</span><span style="flex:1">'+f.name+' <span style="color:var(--muted)">('+( f.size/1024).toFixed(1)+' KB)</span></span><button onclick="reviewerFilesList.splice('+i+',1);renderReviewerFiles()" style="background:none;border:none;color:var(--red);cursor:pointer;font-size:14px">✕</button></div>').join('')}
function uploadReviewerFiles(){
  if(!reviewerFilesList.length)return notify('Select files first','warning');
  const dbId=document.getElementById('reviewAppDbId').value;if(!dbId)return notify('No application selected','error');
  const fd=new FormData();fd.append('action','ibr_upload_review_file');fd.append('app_id',dbId);
  reviewerFilesList.forEach(f=>fd.append('review_files[]',f));
  ajaxPost(fd,r=>{if(r.success){notify(r.count+' file(s) uploaded','success');reviewerFilesList=[];renderReviewerFiles();document.getElementById('btnUploadReview').style.display='none';loadReviewFiles(dbId)}else notify(r.msg||'Upload failed','error')});
}
function loadReviewFiles(dbId){
  fetch('ibr_actions.php?action=ibr_get_files&app_id='+dbId).then(r=>r.json()).then(f=>{
    const el=document.getElementById('reviewerExistingFiles');if(!el)return;
    if(f.reviewer_files&&f.reviewer_files.length){el.innerHTML='<div style="font-size:11px;font-weight:700;color:#92400e;text-transform:uppercase;margin-bottom:6px">Previously Uploaded:</div>'+f.reviewer_files.map(fi=>fileItem(fi,'reviewer')).join('')}
    else{el.innerHTML=''}
  }).catch(()=>{});
}
function uploadApprovalLetter(){
  const file=document.getElementById('approvalFileInput').files[0];
  if(!file)return notify('Select a file first','warning');
  const dbId=document.getElementById('approvalAppDbId').value;if(!dbId)return notify('No application','error');
  const fd=new FormData();fd.append('action','ibr_upload_approval');fd.append('app_id',dbId);fd.append('approval_file',file);
  ajaxPost(fd,r=>{if(r.success){notify('Approval letter uploaded!','success');document.getElementById('approvalFileInput').value='';closeModal('approvalModal');loadApps()}else notify(r.msg||'Failed','error')});
}
function openApprovalModal(appId){
  const app=applications.find(a=>a.id===appId);if(!app)return;
  document.getElementById('approvalAppDbId').value=app.dbId;
  document.getElementById('approvalAppDetails').innerHTML='<div style="background:#f8fafc;padding:10px;border-radius:8px;font-size:13px"><strong>'+app.id+'</strong> — '+app.piName+'<br><span style="color:var(--muted)">'+app.title+'</span></div>';
  // Show existing uploaded letters
  fetch('ibr_actions.php?action=ibr_get_files&app_id='+app.dbId).then(r=>r.json()).then(f=>{
    const el=document.getElementById('approvalExisting');
    const letters=(f.reviewer_files||[]).filter(fi=>fi.file_name.startsWith('APPROVAL:'));
    if(letters.length){el.innerHTML='<div style="font-size:12px;font-weight:700;color:var(--navy);margin-bottom:6px">Previously Uploaded:</div>'+letters.map(fi=>fileItem(fi,'reviewer')).join('')}
    else{el.innerHTML=''}
  }).catch(()=>{});
  document.getElementById('approvalModal').classList.add('open');
}

// ═══ REVIEW MODAL ═══
const CRITERIA=[{key:'method',label:'Methodology',max:30},{key:'merit',label:'Scientific Merit',max:25},{key:'objective',label:'Objective',max:20},{key:'innov',label:'Innovation & Relevance',max:10},{key:'feasib',label:'Feasibility',max:10},{key:'budget',label:'Budget Justification',max:5}];

function openReview(id){
  const app=applications.find(a=>a.id===id);if(!app)return;
  document.getElementById('reviewAppId').value=id;
  document.getElementById('reviewAppDbId').value=app.dbId;
  document.getElementById('reviewAppDetails').innerHTML='<div class="detail-grid"><div><div class="detail-label">ID</div><div class="detail-value app-id">'+app.id+'</div></div><div><div class="detail-label">PI</div><div class="detail-value">'+app.piName+'</div></div><div><div class="detail-label">Title</div><div class="detail-value">'+app.title+'</div></div></div>';
  // Load applicant files into review modal
  reviewerFilesList=[];renderReviewerFiles();document.getElementById('btnUploadReview').style.display='none';
  fetch('ibr_actions.php?action=ibr_get_files&app_id='+app.dbId).then(r=>r.json()).then(f=>{
    const aEl=document.getElementById('reviewApplicantFiles');
    if(f.applicant_files&&f.applicant_files.length){aEl.innerHTML=f.applicant_files.map(fi=>fileItem(fi,'applicant')).join('')}
    else{aEl.innerHTML='<div style="padding:14px;text-align:center;background:#f8fafc;border-radius:8px;border:1.5px dashed var(--border);color:var(--muted);font-size:12px">No documents uploaded by applicant.</div>'}
    loadReviewFiles(app.dbId);
  }).catch(()=>{document.getElementById('reviewApplicantFiles').innerHTML='Could not load files.'});
  // Scoring criteria
  reviewScores={};
  document.getElementById('criteriaForm').innerHTML=CRITERIA.map(c=>{const steps=[];for(let i=0;i<=c.max;i+=Math.max(1,Math.floor(c.max/5)))steps.push(i);steps[steps.length-1]=c.max;return'<div class="criteria-item"><div class="criteria-header"><span>'+c.label+'</span><span style="color:var(--gold)">'+c.max+' pts</span></div><div class="criteria-score" id="scores-'+c.key+'">'+steps.map(s=>'<button class="score-btn" onclick="selectScore(\''+c.key+'\','+s+',this)">'+s+'</button>').join('')+'</div></div>'}).join('');
  document.getElementById('reviewRecommendation').value=app.recommendation||'';
  document.getElementById('reviewComments').value=app.reviewerComments||'';
  document.getElementById('reviewModal').classList.add('open');
}
function selectScore(key,val,btn){reviewScores[key]=val;document.querySelectorAll('#scores-'+key+' .score-btn').forEach(b=>b.classList.remove('selected'));btn.classList.add('selected')}
function submitReview(){
  const appId=document.getElementById('reviewAppId').value;const app=applications.find(a=>a.id===appId);if(!app)return;
  const total=Object.values(reviewScores).reduce((s,v)=>s+v,0);const rec=v('reviewRecommendation'),comments=v('reviewComments');
  if(!rec)return notify('Select recommendation','error');
  const fd={action:'ibr_submit_review',app_id:app.dbId,total_score:total,recommendation:rec,comments:comments};
  Object.keys(reviewScores).forEach(k=>fd['score_'+k]=reviewScores[k]);
  ajaxPost(fd,r=>{if(r.success){closeModal('reviewModal');notify('Review submitted — '+total+'/100','success');loadApps()}});
}

// ═══ MANAGE REVIEWERS (Director) ═══
function openCreateReviewer(){
  ['crName','crStaffId','crEmail','crDept','crSpec','crPass'].forEach(id=>{const el=document.getElementById(id);if(el)el.value=''});
  document.getElementById('crError').style.display='none';
  document.getElementById('createReviewerModal').classList.add('open');
}
function createReviewer(){
  const name=document.getElementById('crName').value.trim();
  const staffId=document.getElementById('crStaffId').value.trim().toUpperCase();
  const email=document.getElementById('crEmail').value.trim();
  const dept=document.getElementById('crDept').value.trim();
  const spec=document.getElementById('crSpec').value.trim();
  const pass=document.getElementById('crPass').value;
  const err=document.getElementById('crError');
  err.style.display='none';
  if(!name||!staffId||!email||!spec||!pass){err.textContent='Fill all required fields.';err.style.display='block';return}
  ajaxPost({action:'ibr_create_reviewer',full_name:name,staff_id:staffId,email:email,department:dept,specialization:spec,password:pass},r=>{
    if(r.success){closeModal('createReviewerModal');notify('Reviewer "'+name+'" created! Login: '+staffId,'success');loadReviewersList()}
    else{err.textContent=r.msg;err.style.display='block'}
  });
}
function loadReviewersList(){
  fetch('ibr_actions.php?action=ibr_get_reviewers').then(r=>r.json()).then(revs=>{
    const el=document.getElementById('reviewersList');if(!el)return;
    if(!revs.length){el.innerHTML='<div style="text-align:center;padding:20px;color:var(--muted)">No reviewers created yet. Click "+ Create Reviewer" above.</div>';return}
    el.innerHTML='<table style="width:100%;font-size:13px"><thead><tr style="border-bottom:2px solid var(--border)"><th style="padding:8px;text-align:left;font-size:11px;color:var(--muted)">Name</th><th style="padding:8px;text-align:left;font-size:11px;color:var(--muted)">Staff ID</th><th style="padding:8px;text-align:left;font-size:11px;color:var(--muted)">Email</th><th style="padding:8px;text-align:left;font-size:11px;color:var(--muted)">Specialization</th><th style="padding:8px;text-align:left;font-size:11px;color:var(--muted)">Department</th></tr></thead><tbody>'+revs.map(r=>'<tr style="border-bottom:1px solid var(--border)"><td style="padding:8px;font-weight:600">'+r.full_name+'</td><td style="padding:8px;font-family:monospace;font-size:12px">'+r.staff_id+'</td><td style="padding:8px">'+r.email+'</td><td style="padding:8px"><span style="background:#e6faf5;color:var(--teal);padding:2px 8px;border-radius:10px;font-size:11px;font-weight:700">'+(r.specialization||'—')+'</span></td><td style="padding:8px">'+(r.department||'—')+'</td></tr>').join('')+'</tbody></table>';
  }).catch(()=>{});
}
// Load on page ready for admin
<?php if(isset($_SESSION['ibr_role']) && $_SESSION['ibr_role']==='admin'): ?>
document.addEventListener('DOMContentLoaded',loadReviewersList);
<?php endif; ?>

// ═══ SEND TO DIRECTOR (Reviewer) ═══
function sendToDirector(appId){
  const app=applications.find(a=>a.id===appId);if(!app)return;
  if(!confirm('Send reviewed application '+appId+' back to the Director?'))return;
  ajaxPost({action:'ibr_send_to_director',app_id:app.dbId},r=>{
    if(r.success){notify('Sent to Director! They will be notified.','success');loadApps()}
    else notify(r.msg||'Failed','error');
  });
}

// ═══ SEND TO APPLICANT (Director) ═══
function sendToApplicant(appId,decision){
  const app=applications.find(a=>a.id===appId);if(!app)return;
  const valid=['Approved','Revision Required','Rejected'];
  if(!valid.includes(decision)){
    decision=prompt('Enter decision for '+appId+':\n\n1. Approved\n2. Revision Required\n3. Rejected\n\nType your choice:');
    if(!decision||!valid.includes(decision))return notify('Invalid decision','error');
  }
  if(!confirm('Send '+appId+' to applicant as "'+decision+'"? They will receive an email notification.'))return;
  ajaxPost({action:'ibr_send_to_applicant',app_id:app.dbId,decision:decision},r=>{
    if(r.success){notify('Sent to applicant with status: '+decision,'success');loadApps()}
    else notify(r.msg||'Failed','error');
  });
}

// ═══ ASSIGN REVIEWER ═══
function openAssign(id){
  const app=applications.find(a=>a.id===id);if(!app)return;
  document.getElementById('assignAppId').value=id;
  document.getElementById('assignAppDbId').value=app.dbId;
  document.getElementById('assignAppDetails').innerHTML='<div style="background:#f8fafc;padding:12px;border-radius:8px;border:1px solid var(--border)"><div style="font-size:12px;color:var(--muted)">Application</div><div style="font-weight:700;color:var(--navy)">'+app.id+' — '+app.piName+'</div><div style="font-size:13px;color:var(--muted);margin-top:4px">'+app.title+'</div><div style="font-size:12px;color:var(--teal);margin-top:4px"><strong>Area:</strong> '+(app.resArea||'—')+'</div></div>';
  // Load reviewers
  fetch('ibr_actions.php?action=ibr_get_reviewers').then(r=>r.json()).then(revs=>{
    const sel=document.getElementById('assignReviewerSelect');
    if(!revs.length){sel.innerHTML='<option value="">No reviewers registered yet</option>';return}
    sel.innerHTML='<option value="">— Select a reviewer —</option>'+revs.map(r=>'<option value="'+r.id+'" data-spec="'+(r.specialization||'')+'" data-email="'+(r.email||'')+'" data-dept="'+(r.department||'')+'">'+r.full_name+(r.specialization?' — '+r.specialization:'')+'</option>').join('');
    sel.onchange=function(){
      const opt=this.options[this.selectedIndex];
      const info=document.getElementById('assignReviewerInfo');
      if(this.value){info.innerHTML='<strong>Specialization:</strong> '+(opt.dataset.spec||'N/A')+' · <strong>Dept:</strong> '+(opt.dataset.dept||'N/A')+' · <strong>Email:</strong> '+(opt.dataset.email||'N/A')}
      else{info.innerHTML=''}
    };
  });
  document.getElementById('assignModal').classList.add('open');
}
function assignReviewer(){
  const dbId=document.getElementById('assignAppDbId').value;
  const revId=document.getElementById('assignReviewerSelect').value;
  if(!revId)return notify('Select a reviewer','warning');
  ajaxPost({action:'ibr_assign_reviewer',app_id:dbId,reviewer_id:revId},r=>{
    if(r.success){closeModal('assignModal');notify(r.msg||'Assigned!','success');loadApps()}
    else notify(r.msg||'Failed','error');
  });
}
</script>
</body>
</html>
