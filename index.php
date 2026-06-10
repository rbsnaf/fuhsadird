<?php
require_once 'config.php';
$db = getDB();
$admin = isAdmin();

// Fetch data
$gallery = $db ? $db->query("SELECT * FROM gallery ORDER BY created_at DESC")->fetchAll() : [];
$news = $db ? $db->query("SELECT * FROM news ORDER BY created_at DESC")->fetchAll() : [];
$pubs = $db ? $db->query("SELECT * FROM publications ORDER BY pub_year DESC, id DESC")->fetchAll() : [];
$beneficiaries = $db ? $db->query("SELECT * FROM beneficiaries ORDER BY grant_year DESC, id DESC")->fetchAll() : [];
$leaders = $db ? $db->query("SELECT * FROM leadership ORDER BY id ASC")->fetchAll() : [];
$downloads = $db ? $db->query("SELECT * FROM downloads ORDER BY created_at DESC")->fetchAll() : [];
$studentResearch = $db ? $db->query("SELECT * FROM student_research ORDER BY year DESC, id DESC")->fetchAll() : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FUHSA — Directorate of Innovation, Research & Development</title>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --navy:#0a1f5c;--navy2:#122478;--blue:#1a40b0;
  --gold:#c9921a;--gold2:#f0b429;--gold3:#ffd97d;
  --green:#1a7a3c;--green2:#23a352;--red:#b01a1a;
  --cream:#fdf9f0;--light:#f0f4ff;--text:#1a1a2e;--muted:#5a6080;
  --border:rgba(10,31,92,0.12);
}
html{scroll-behavior:smooth}
body{font-family:'Nunito',sans-serif;color:var(--text);background:var(--cream);line-height:1.7}

/* TOPBAR */
.topbar{background:var(--navy);padding:7px 2rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap}
.topbar-left{color:rgba(255,255,255,.75);font-size:12.5px}
.topbar-right{display:flex;gap:1.5rem}
.topbar-right a,.topbar-right button{color:var(--gold3);font-size:12px;text-decoration:none;font-weight:700;cursor:pointer;background:none;border:none;transition:color .2s}
.topbar-right a:hover,.topbar-right button:hover{color:white}

/* NAV */
nav{background:linear-gradient(90deg,var(--navy2),var(--blue));border-bottom:4px solid var(--gold);position:sticky;top:0;z-index:100;box-shadow:0 4px 24px rgba(0,0,0,.25)}
.nav-inner{max-width:1200px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;padding:0 2rem;height:72px}
.nav-brand{display:flex;align-items:center;gap:14px;text-decoration:none}
.nav-brand-title{font-family:'Merriweather',serif;font-size:17px;font-weight:900;color:#fff;line-height:1.2}
.nav-brand-sub{font-size:11px;color:var(--gold3);font-weight:600;letter-spacing:.06em}
.nav-links{display:flex;list-style:none;align-items:center;gap:0}
.nav-links > li{position:relative}
.nav-links > li > a{display:block;padding:0 .9rem;line-height:72px;color:rgba(255,255,255,.85);text-decoration:none;font-size:13px;font-weight:700;text-transform:uppercase;transition:color .2s,background .2s;white-space:nowrap}
.nav-links > li > a:hover{color:var(--gold3);background:rgba(255,255,255,.07)}

/* DROPDOWN */
.nav-dropdown{display:none;position:absolute;top:72px;left:0;background:white;min-width:260px;box-shadow:0 12px 40px rgba(0,0,0,.18);border-radius:0 0 12px 12px;z-index:200;overflow:hidden}
.nav-links > li:hover .nav-dropdown{display:block}
.nav-dropdown a{display:block;padding:12px 20px;color:var(--navy);font-size:13px;font-weight:700;text-decoration:none;border-bottom:1px solid var(--border);transition:background .2s}
.nav-dropdown a:hover{background:var(--light);color:var(--blue)}
.nav-dropdown a:last-child{border-bottom:none}

/* ADMIN BAR */
.admin-bar{background:linear-gradient(90deg,#051240,var(--navy2));color:white;padding:9px 2rem;display:flex;align-items:center;justify-content:center;gap:1.5rem;font-size:13px;font-weight:700}
.admin-bar span{color:var(--gold3)}
.admin-bar form{display:inline}
.admin-bar button{background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:white;padding:5px 16px;border-radius:6px;font-size:12px;font-weight:700;cursor:pointer}

/* HERO */
.hero{position:relative;overflow:hidden;min-height:82vh;display:flex;align-items:center}
.hero-ss{position:absolute;inset:0;z-index:0}
.hero-ss img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0;transition:opacity 1.5s}
.hero-ss img.active{opacity:1}
.hero-ov{position:absolute;inset:0;background:linear-gradient(120deg,rgba(10,31,92,.88),rgba(10,31,92,.65) 55%,rgba(26,64,176,.45));z-index:1}
.hero-ct{position:relative;z-index:2;max-width:1200px;margin:0 auto;padding:100px 2rem 80px;width:100%}
.hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(201,146,26,.25);border:1px solid rgba(240,180,41,.55);color:var(--gold3);font-size:12px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:6px 18px;border-radius:30px;margin-bottom:22px}
.bdot{width:7px;height:7px;border-radius:50%;background:var(--gold2);animation:blink 1.8s infinite}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.2}}
.hero h1{font-family:'Merriweather',serif;font-size:clamp(2rem,4.5vw,3.4rem);font-weight:900;color:white;line-height:1.18;margin-bottom:1.2rem}
.hl{color:var(--gold2)}
.hero-desc{font-size:1.07rem;color:rgba(255,255,255,.82);max-width:600px;margin-bottom:2.2rem}
.hero-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:rgba(255,255,255,.12);border-radius:14px;overflow:hidden;border:1px solid rgba(255,255,255,.18);max-width:500px}
.sbox{background:rgba(255,255,255,.07);padding:1.2rem 1rem;text-align:center;backdrop-filter:blur(6px)}
.snum{font-family:'Merriweather',serif;font-size:2rem;font-weight:900;color:var(--gold2);line-height:1}
.slbl{font-size:11px;color:rgba(255,255,255,.65);margin-top:4px;font-weight:600;text-transform:uppercase;letter-spacing:.05em}
.btn-gold{background:linear-gradient(135deg,var(--gold),var(--gold2));color:var(--navy);padding:14px 28px;border-radius:7px;text-decoration:none;font-weight:800;font-size:15px;box-shadow:0 4px 18px rgba(201,146,26,.5);display:inline-block;cursor:pointer;border:none;transition:transform .2s}
.btn-gold:hover{transform:translateY(-2px)}

/* SECTION BASE */
section{padding:76px 2rem}
.si{max-width:1200px;margin:0 auto}
.slabel{display:inline-block;background:var(--light);color:var(--blue);font-size:11.5px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;padding:5px 14px;border-radius:20px;margin-bottom:12px;border:1px solid rgba(26,64,176,.2)}
.stitle{font-family:'Merriweather',serif;font-size:clamp(1.6rem,3vw,2.3rem);font-weight:900;color:var(--navy);margin-bottom:.8rem;line-height:1.25}
.stitle span{color:var(--gold)}
.ssub{color:var(--muted);font-size:1.02rem;max-width:600px;margin-bottom:2.8rem}
.gline{width:56px;height:4px;background:linear-gradient(90deg,var(--gold),var(--gold2));border-radius:4px;margin:14px 0 2rem}

/* LEADERSHIP - UNIBEN VC-REMARKS STYLE */
.lead-block{margin-bottom:3rem}
.lead-block:last-child{margin-bottom:0}
.lead-row{display:flex;gap:0;border-radius:18px;overflow:hidden;box-shadow:0 16px 48px rgba(10,31,92,.15);min-height:440px}
.lead-block:nth-child(3n+1) .lead-row{background:linear-gradient(135deg,#0a1f5c,#122478)}
.lead-block:nth-child(3n+2) .lead-row{background:linear-gradient(135deg,#1a7a3c,#0d6e35)}
.lead-block:nth-child(3n+3) .lead-row{background:linear-gradient(135deg,#7c2d12,#b45309)}
.lead-photo{flex:0 0 400px;position:relative;overflow:hidden}
.lead-photo img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .4s}
.lead-row:hover .lead-photo img{transform:scale(1.03)}
.lead-photo-label{position:absolute;bottom:0;left:0;right:0;padding:14px 18px;background:linear-gradient(to top,rgba(0,0,0,.8),transparent);color:white;font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase}
.lead-text{flex:1;padding:2.5rem 3rem;color:white;display:flex;flex-direction:column;justify-content:center}
.lead-desk{font-family:'Merriweather',serif;font-size:13px;font-weight:700;color:var(--gold2);text-transform:uppercase;letter-spacing:.12em;margin-bottom:18px;display:flex;align-items:center;gap:10px}
.lead-desk::before{content:'';width:40px;height:3px;background:var(--gold2);border-radius:3px}
.lead-text h3{font-family:'Merriweather',serif;font-size:1.5rem;font-weight:900;line-height:1.3;margin-bottom:4px}
.lead-text .ltitles{font-size:14px;color:rgba(255,255,255,.7);margin-bottom:6px;font-weight:600}
.lead-text .lrole-pill{display:inline-block;background:var(--gold);color:var(--navy);font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.12em;padding:5px 16px;border-radius:20px;margin-bottom:18px}
.lead-text p{font-size:14.5px;line-height:1.8;color:rgba(255,255,255,.85);margin-bottom:1.2rem}
.lead-readmore{display:inline-flex;align-items:center;gap:8px;color:var(--gold2);font-size:13px;font-weight:800;text-decoration:none;text-transform:uppercase;letter-spacing:.06em;transition:color .2s}
.lead-readmore:hover{color:white}
.lead-del{position:absolute;top:10px;right:10px;z-index:5;background:rgba(176,26,26,.85);color:white;border:none;border-radius:8px;padding:5px 12px;font-size:11px;font-weight:700;cursor:pointer;display:none;backdrop-filter:blur(4px)}
.admin-mode .lead-del{display:block}
@media(max-width:900px){.lead-row{flex-direction:column}.lead-photo{flex:none;height:350px}.lead-text{padding:2rem}}

/* GALLERY - SLIDING CAROUSEL */
.gal-sec{background:var(--navy);padding:76px 0}
.gal-inner{max-width:1200px;margin:0 auto;padding:0 2rem}
.gal-sec .slabel{background:rgba(255,255,255,.1);color:var(--gold3);border-color:rgba(255,255,255,.15)}
.gal-sec .stitle{color:white}
.gal-sec .stitle span{color:var(--gold2)}
.gal-sec .gline{background:linear-gradient(90deg,var(--gold),var(--gold2))}
.gal-sec .ssub{color:rgba(255,255,255,.6)}
/* Thumbnail strip */
.gal-thumbstrip{display:flex;gap:6px;overflow-x:auto;padding:8px 0 18px;scrollbar-width:thin;scrollbar-color:var(--gold) transparent}
.gal-thumbstrip::-webkit-scrollbar{height:5px}
.gal-thumbstrip::-webkit-scrollbar-thumb{background:var(--gold);border-radius:4px}
.gal-thumb{flex:0 0 80px;height:60px;border-radius:6px;overflow:hidden;cursor:pointer;border:3px solid transparent;transition:border-color .2s,transform .2s;opacity:.6}
.gal-thumb:hover,.gal-thumb.active{border-color:var(--gold);opacity:1;transform:scale(1.05)}
.gal-thumb img{width:100%;height:100%;object-fit:cover;display:block}
/* Sliding stage */
.gal-stage{position:relative;overflow:hidden;border-radius:14px;border:3px solid rgba(201,146,26,.4);margin-top:8px}
.gal-track{display:flex;transition:transform .65s cubic-bezier(.25,.46,.45,.94);will-change:transform}
.gal-slide{position:relative;flex:0 0 33.3333%;cursor:pointer}
.gal-slide-img{width:100%;height:340px;overflow:hidden}
.gal-slide-img img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .4s,filter .3s;filter:brightness(.8)}
.gal-slide:hover .gal-slide-img img{transform:scale(1.05);filter:brightness(1)}
.gal-slide-cap{padding:12px 14px;background:#0d1a3a;color:rgba(255,255,255,.85);font-size:12.5px;font-weight:600;line-height:1.3;border-top:2px solid var(--gold)}
.gal-del{position:absolute;top:8px;right:8px;background:rgba(176,26,26,.9);color:white;border:none;border-radius:6px;padding:4px 10px;font-size:11px;font-weight:700;cursor:pointer;display:none;z-index:5}
.admin-mode .gal-del{display:block}
.gal-arrow{position:absolute;top:50%;transform:translateY(-50%);z-index:10;width:50px;height:50px;border-radius:50%;background:rgba(0,0,0,.45);border:2px solid rgba(255,255,255,.4);color:white;font-size:22px;cursor:pointer;backdrop-filter:blur(6px);transition:.2s;display:flex;align-items:center;justify-content:center}
.gal-arrow:hover{background:var(--gold);border-color:var(--gold);color:var(--navy);transform:translateY(-50%) scale(1.1)}
.gal-prev{left:12px}
.gal-next{right:12px}
.gal-dots{display:flex;justify-content:center;gap:8px;padding:16px 0}
.gdot{width:9px;height:9px;border-radius:50%;background:rgba(255,255,255,.25);border:none;cursor:pointer;transition:.25s}
.gdot.active{background:var(--gold);transform:scale(1.5)}
/* Lightbox */
.gal-lightbox{display:none;position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:500;align-items:center;justify-content:center;flex-direction:column;padding:2rem;cursor:pointer}
.gal-lightbox.open{display:flex}
.gal-lightbox img{max-width:90%;max-height:75vh;border-radius:12px;box-shadow:0 20px 60px rgba(0,0,0,.6);object-fit:contain}
.gal-lightbox-cap{color:white;font-size:15px;font-weight:600;margin-top:16px;text-align:center}
.gal-lightbox-close{position:absolute;top:20px;right:28px;color:white;font-size:32px;cursor:pointer;background:none;border:none;opacity:.7;transition:opacity .2s}
.gal-lightbox-close:hover{opacity:1}
.gal-lightbox-nav{position:absolute;top:50%;transform:translateY(-50%);color:white;font-size:36px;cursor:pointer;background:rgba(255,255,255,.1);border:none;width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:background .2s}
.gal-lightbox-nav:hover{background:var(--gold);color:var(--navy)}
.gal-lb-prev{left:20px}
.gal-lb-next{right:20px}
@media(max-width:900px){.gal-slide{flex:0 0 100%}.gal-slide-img{height:260px}.gal-thumb{flex:0 0 60px;height:45px}}

/* BENEFICIARIES */
.ben-table{width:100%;border-collapse:collapse;margin-top:1.5rem;font-size:14px}
.ben-table th{background:var(--navy);color:white;padding:12px 16px;text-align:left;font-size:12px;text-transform:uppercase;letter-spacing:.06em;position:sticky;top:0;z-index:2}
.ben-table td{padding:12px 16px;border-bottom:1px solid var(--border)}
.ben-table tr:nth-child(even){background:var(--light)}
.ben-type{display:inline-block;padding:2px 10px;border-radius:10px;font-size:11px;font-weight:800}
.ben-ibr{background:#e8f8ee;color:var(--green)}
.ben-nrf{background:#f0f4ff;color:var(--blue)}
.ben-del{background:var(--red);color:white;border:none;border-radius:6px;padding:4px 10px;font-size:11px;cursor:pointer;display:none}
.admin-mode .ben-del{display:block}

/* NEWS - UNIBEN STYLE (image-topped cards) */
.news-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem}
.news-header a{color:var(--gold);font-size:13px;font-weight:700;text-decoration:none;text-transform:uppercase;letter-spacing:.06em}
.ngrid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem}
.ncard{background:white;border-radius:14px;overflow:hidden;box-shadow:0 4px 20px rgba(10,31,92,.08);transition:transform .25s,box-shadow .25s;border:1px solid var(--border)}
.ncard:hover{transform:translateY(-6px);box-shadow:0 20px 48px rgba(10,31,92,.14)}
.ncard-img{position:relative;height:180px;overflow:hidden;background:var(--navy)}
.ncard-img img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .4s}
.ncard:hover .ncard-img img{transform:scale(1.06)}
.ncard-img .ntag{position:absolute;top:12px;left:12px;background:var(--gold);color:var(--navy);font-size:10px;font-weight:800;padding:4px 12px;border-radius:6px;text-transform:uppercase;letter-spacing:.06em;z-index:2}
.ncard-img-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:48px;background:linear-gradient(135deg,var(--navy),var(--blue))}
.ncard-body{padding:1.3rem 1.5rem 1.5rem}
.nmeta{font-size:11px;color:var(--muted);margin-bottom:6px;font-weight:600}
.ncard-body h3{font-family:'Merriweather',serif;font-size:.95rem;font-weight:700;color:var(--navy);margin-bottom:8px;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.ncard-body p{font-size:13px;color:var(--muted);margin-bottom:10px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;line-height:1.6}
.ncard-link{color:var(--blue);font-size:12px;font-weight:700;text-decoration:none;text-transform:uppercase;letter-spacing:.04em}
.ndel{background:var(--red);color:white;border:none;border-radius:6px;padding:4px 10px;font-size:11px;cursor:pointer;display:none;position:absolute;top:12px;right:12px;z-index:3}
.admin-mode .ndel{display:block}

/* PUBLICATIONS */
.pub-card{background:white;border:1px solid var(--border);border-radius:14px;padding:1.5rem 1.8rem;display:flex;gap:1.2rem;align-items:flex-start;transition:box-shadow .2s,transform .2s;margin-bottom:1rem}
.pub-card:hover{box-shadow:0 8px 28px rgba(10,31,92,.1);transform:translateY(-2px)}
.pub-badge{flex-shrink:0;width:52px;height:52px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px}
.pub-j{background:#f0f4ff} .pub-c{background:#e8f8ee} .pub-t{background:#fff8e6} .pub-b{background:#ffeaea}
.pub-meta{font-size:12px;color:var(--muted);font-weight:600;margin-bottom:5px;display:flex;gap:8px;flex-wrap:wrap}
.pub-year{background:var(--light);color:var(--blue);padding:2px 9px;border-radius:10px;font-weight:800;font-size:11px}
.pub-type{background:#e8f8ee;color:var(--green);padding:2px 9px;border-radius:10px;font-weight:800;font-size:11px}
.pub-title{font-family:'Merriweather',serif;font-size:1rem;font-weight:700;color:var(--navy);margin-bottom:5px;line-height:1.4}
.pub-authors{font-size:13px;color:var(--muted);margin-bottom:3px}
.pub-journal{font-size:13px;color:var(--blue);font-style:italic;font-weight:600}
.pub-del{background:var(--red);color:white;border:none;border-radius:6px;padding:4px 10px;font-size:11px;cursor:pointer;display:none;float:right}
.admin-mode .pub-del{display:block}

/* IBR GUIDE (collapsible - attractive) */
.ibr-guide-wrap{margin-top:2.5rem;border:2px solid var(--border);border-radius:18px;overflow:hidden;background:white;box-shadow:0 8px 32px rgba(10,31,92,.06)}
.ibr-guide-toggle{width:100%;padding:20px 24px;background:linear-gradient(135deg,rgba(10,31,92,.04),rgba(26,64,176,.06));border:none;text-align:left;font-family:'Merriweather',serif;font-size:1.05rem;font-weight:700;color:var(--navy);cursor:pointer;display:flex;justify-content:space-between;align-items:center;transition:background .2s;gap:1rem}
.ibr-guide-toggle:hover{background:rgba(26,64,176,.1)}
.ibr-guide-toggle .toggle-badge{background:linear-gradient(135deg,var(--gold),var(--gold2));color:var(--navy);font-size:10px;font-weight:800;padding:4px 14px;border-radius:20px;letter-spacing:.08em;text-transform:uppercase;white-space:nowrap}
.ibr-guide-body{display:none;padding:0}
.ibr-guide-wrap.open .ibr-guide-body{display:block}
.ibr-guide-wrap.open .toggle-arrow{transform:rotate(180deg)}
.toggle-arrow{transition:transform .3s;font-size:18px;color:var(--gold)}
.ibr-steps{display:grid;grid-template-columns:1fr 1fr;gap:0}
.ibr-step{display:flex;gap:16px;align-items:flex-start;padding:20px 24px;border-bottom:1px solid var(--border);border-right:1px solid var(--border);transition:background .2s}
.ibr-step:hover{background:rgba(26,64,176,.03)}
.ibr-step:nth-child(even){border-right:none}
.ibr-step:nth-last-child(-n+2){border-bottom:none}
.step-num{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:900;font-size:16px;color:white;flex-shrink:0}
.step-num.sn1{background:linear-gradient(135deg,var(--navy),var(--blue))}
.step-num.sn2{background:linear-gradient(135deg,var(--gold),var(--gold2));color:var(--navy)}
.step-num.sn3{background:linear-gradient(135deg,var(--green),var(--green2))}
.step-num.sn4{background:linear-gradient(135deg,var(--navy),var(--blue))}
.step-num.sn5{background:linear-gradient(135deg,var(--gold),var(--gold2));color:var(--navy)}
.step-num.sn6{background:linear-gradient(135deg,var(--green),var(--green2))}
.step-text h4{font-size:14px;font-weight:800;color:var(--navy);margin-bottom:3px}
.step-text p{font-size:13px;color:var(--muted);line-height:1.55}
.ibr-warnings{padding:20px 24px;background:linear-gradient(135deg,rgba(176,26,26,.04),rgba(176,26,26,.08));border-top:2px solid rgba(176,26,26,.12)}
.ibr-warnings h4{font-size:14px;color:var(--red);font-weight:800;margin-bottom:10px}
.ibr-warnings ul{padding-left:1.2rem;font-size:13px;color:var(--muted)}
.ibr-warnings li{margin-bottom:4px}
@media(max-width:700px){.ibr-steps{grid-template-columns:1fr}.ibr-step{border-right:none}}

/* CONTACT */
.contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:3rem}
.contact-info{display:flex;flex-direction:column;gap:1rem}
.ci-item{display:flex;gap:12px;align-items:flex-start;font-size:14px;color:var(--muted)}
.ci-icon{font-size:1.5rem}

/* FOOTER */
footer{background:#050e2e;color:rgba(255,255,255,.65);padding:56px 2rem 24px}
.fi{max-width:1200px;margin:0 auto}
.fgrid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:3rem;margin-bottom:3rem}
.fname{font-family:'Merriweather',serif;font-size:1.3rem;font-weight:900;color:var(--gold2);margin-bottom:14px}
.fcol h4{color:var(--gold3);font-size:12px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;margin-bottom:1.2rem}
.fcol ul{list-style:none}
.fcol li{margin-bottom:9px}
.fcol a{color:rgba(255,255,255,.6);text-decoration:none;font-size:14px;transition:color .2s}
.fcol a:hover{color:var(--gold2)}
.fbar{text-align:center;font-size:13px;margin-top:2rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,.1)}

/* MODAL */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(5,14,46,.78);z-index:400;backdrop-filter:blur(5px);align-items:center;justify-content:center;padding:1rem}
.modal-overlay.open{display:flex}
.modal-box{background:white;border-radius:20px;width:100%;max-width:600px;max-height:90vh;overflow-y:auto;box-shadow:0 32px 80px rgba(0,0,0,.35)}
.modal-hdr{background:linear-gradient(135deg,var(--navy),var(--blue));padding:1.5rem 2rem;border-radius:20px 20px 0 0;display:flex;justify-content:space-between;align-items:center}
.modal-hdr h2{font-family:'Merriweather',serif;color:white;font-size:1.1rem}
.modal-close{background:rgba(255,255,255,.15);border:none;color:white;width:36px;height:36px;border-radius:50%;font-size:18px;cursor:pointer}
.modal-body{padding:2rem}
.fg{margin-bottom:1.2rem}
.fg label{display:block;font-size:13px;font-weight:700;color:var(--navy);margin-bottom:6px}
.fg input,.fg textarea,.fg select{width:100%;padding:12px 14px;border:1.5px solid var(--border);border-radius:10px;font-size:14px;font-family:'Nunito',sans-serif;outline:none}
.fg textarea{min-height:80px;resize:vertical}
.sbtn{width:100%;padding:14px;background:linear-gradient(135deg,var(--navy),var(--blue));color:white;border:none;border-radius:10px;font-size:15px;font-weight:800;cursor:pointer;margin-top:.5rem}

/* ADMIN ADD BUTTONS */
.admin-add{display:none;margin-top:1rem}
.admin-mode .admin-add{display:inline-block}

/* TOAST */
.toast{position:fixed;top:90px;right:2rem;background:var(--green);color:white;padding:14px 22px;border-radius:12px;font-size:14px;font-weight:700;z-index:500;opacity:0;transform:translateY(-10px);transition:all .35s;pointer-events:none}
.toast.show{opacity:1;transform:translateY(0)}

/* RESPONSIVE */
@media(max-width:900px){
  .lead-card{flex:0 0 100%}
  .lead-img{width:200px;height:200px}
  .contact-grid{grid-template-columns:1fr}
  .fgrid{grid-template-columns:1fr}
  .nav-links{display:none}
  .hero-stats{grid-template-columns:1fr 1fr}
}
</style>
</head>
<body class="<?= $admin ? 'admin-mode' : '' ?>">

<?php if($admin): ?>
<div class="admin-bar">
  <span>🔐 Admin Mode Active</span>
  <form action="admin_actions.php" method="post" style="display:inline">
    <input type="hidden" name="action" value="logout">
    <button type="submit">Logout</button>
  </form>
</div>
<?php endif; ?>

<!-- NEWS MARQUEE -->
<div style="background:var(--gold);overflow:hidden;padding:6px 0">
<div style="display:flex;animation:marquee 30s linear infinite;white-space:nowrap">
  <?php foreach($news as $n): ?>
  <span style="display:inline-flex;align-items:center;gap:8px;padding:0 3rem;font-size:12px;font-weight:700;color:var(--navy)">📢 <?= clean($n['title']) ?></span>
  <?php endforeach; ?>
  <?php if(empty($news)): ?>
  <span style="padding:0 3rem;font-size:12px;font-weight:700;color:var(--navy)">📢 Welcome to FUHSA — Directorate of Innovation, Research & Development</span>
  <?php endif; ?>
</div>
</div>
<style>@keyframes marquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}</style>

<!-- TOPBAR -->
<div class="topbar">
  <div class="topbar-left">📍 KM3, Potiskum Road, Azare, Bauchi State, Nigeria</div>
  <div class="topbar-right">
    <a href="https://fuhsa.safsrms.com" target="_blank">Portal Login</a>
    <a href="https://mail.google.com" target="_blank">Staff Email</a>
    <?php if(!$admin): ?>
    <button onclick="document.getElementById('loginModal').classList.add('open')">⚙️ Admin</button>
    <?php endif; ?>
  </div>
</div>

<!-- NAV -->
<nav>
<div class="nav-inner">
  <a href="#" class="nav-brand">
    <img src="uploads/logo.jpg" alt="FUHSA" style="width:48px;height:48px;border-radius:50%;object-fit:cover;border:2px solid var(--gold2);flex-shrink:0">
    <div>
      <div class="nav-brand-title">FUHSA — DIRD</div>
      <div class="nav-brand-sub">Directorate of Innovation, Research & Development</div>
    </div>
  </a>
  <ul class="nav-links" style="margin-left:auto">
    <li><a href="#about">About</a></li>
    <li><a href="#leadership">Leaders</a></li>
    <li>
      <a href="#research">Research ▾</a>
      <div class="nav-dropdown">
        <a href="ibr_platform.php">🔬 IBR Platform</a>
        <a href="https://nrf.tetfund.gov.ng/" target="_blank">🏛️ NRF Platform</a>
        <a href="#student-research">🎓 Student Research</a>
      </div>
    </li>
    <li><a href="#publications">Publications</a></li>
    <li><a href="#beneficiaries">Beneficiaries</a></li>
    <li><a href="#downloads">Downloads</a></li>
    <li><a href="#gallery">Gallery</a></li>
    <li><a href="#news">News</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul>
</div>
</nav>

<!-- HERO -->
<div class="hero" id="home">
  <div class="hero-ss"><img src="uploads/Gate.jpg" alt="FUHSA Gate" class="active" style="opacity:1"></div>
  <div class="hero-ov"></div>
  <div class="hero-ct">
    <div class="hero-badge"><span class="bdot"></span> Federal University of Health Sciences Azare</div>
    <h1>Advancing <span class="hl">Health Sciences</span><br>Through Research & Innovation</h1>
    <p class="hero-desc">The Directorate of Innovation, Research & Development (DIRD) coordinates institutional research, manages grants, and drives knowledge creation at Nigeria's premier health sciences university.</p>
    <div style="display:flex;gap:14px;flex-wrap:wrap;margin-bottom:3rem">
      <a href="ibr_platform.php" class="btn-gold">🔬 IBR Platform</a>
      <a href="https://nrf.tetfund.gov.ng/" target="_blank" class="btn-gold" style="background:linear-gradient(135deg,var(--navy),var(--blue));color:white">🏛️ NRF Platform</a>
      <a href="#publications" class="btn-gold" style="background:transparent;border:2px solid var(--gold);color:var(--gold3)">🏛️ Book Manuscripts</a>
    </div>
    <div class="hero-stats">
      <div class="sbox"><div class="snum">140+</div><div class="slbl">Active Projects</div></div>
      <div class="sbox"><div class="snum">₦2.1B</div><div class="slbl">Grants Awarded</div></div>
      <div class="sbox"><div class="snum"><?= count($pubs) ?>+</div><div class="slbl">Publications</div></div>
    </div>
  </div>
</div>

<!-- ABOUT -->
<section class="lead-sec" id="about" style="background:white">
<div class="si">
  <div class="slabel">About FUHSA DIRD</div>
  <h2 class="stitle">Nigeria's Leading <span>Health Sciences University</span></h2>
  <div class="gline"></div>
  <p class="ssub">The Federal University of Health Sciences Azare (FUHSA) is dedicated to producing highly trained health professionals and advancing medical knowledge through rigorous research and innovation.</p>
  <p style="color:var(--muted);max-width:800px;margin-bottom:1rem">The Directorate of Innovation, Research and Development (DIRD) coordinates all institutional research activities, manages grant applications, and ensures research quality and ethics compliance across the university. Located on Potiskum Road, Azare, Bauchi State, FUHSA provides world-class health sciences education supported by modern infrastructure and dedicated academic staff.</p>
</div>
</section>

<!-- LEADERSHIP - FROM THE DESK STYLE -->
<section id="leadership" style="background:linear-gradient(180deg,var(--cream),#e8edf8);padding:76px 2rem">
<div style="max-width:1200px;margin:0 auto">
  <div class="slabel">University Leadership</div>
  <h2 class="stitle">Our <span>Leaders</span></h2>
  <div class="gline"></div>
  <button onclick="openModal('leader')" class="btn-gold admin-add" style="border:none;font-size:14px;padding:10px 20px;margin-bottom:2rem">+ Add Leader</button>
  <?php foreach($leaders as $l): $deskTitle = strtoupper(clean($l['role_key'])); ?>
  <div class="lead-block">
    <div class="lead-row">
      <div class="lead-photo">
        <img src="<?= clean($l['image_path']) ?>" alt="<?= clean($l['full_name']) ?>" onerror="this.style.display='none'">
        <div class="lead-photo-label"><?= clean($l['role_key']) ?></div>
      </div>
      <div class="lead-text">
        <div style="display:flex;justify-content:space-between;align-items:flex-start">
          <div class="lead-desk">From the <?= clean($l['role_key']) ?>'s Desk</div>
          <?php if($admin): ?>
          <div style="display:flex;gap:5px;flex-shrink:0">
            <form action="admin_actions.php" method="post" style="display:inline"><input type="hidden" name="action" value="move_leader"><input type="hidden" name="id" value="<?=$l['id']?>"><input type="hidden" name="direction" value="up"><button type="submit" style="background:rgba(255,255,255,.2);border:1px solid rgba(255,255,255,.3);color:white;border-radius:6px;padding:4px 8px;font-size:12px;cursor:pointer" title="Move Up">▲</button></form>
            <form action="admin_actions.php" method="post" style="display:inline"><input type="hidden" name="action" value="move_leader"><input type="hidden" name="id" value="<?=$l['id']?>"><input type="hidden" name="direction" value="down"><button type="submit" style="background:rgba(255,255,255,.2);border:1px solid rgba(255,255,255,.3);color:white;border-radius:6px;padding:4px 8px;font-size:12px;cursor:pointer" title="Move Down">▼</button></form>
            <button onclick="openEditModal('leader',<?= $l['id'] ?>,'<?= addslashes(clean($l['full_name'])) ?>','<?= addslashes(clean($l['role_key'])) ?>','<?= addslashes(clean($l['titles'])) ?>','<?= addslashes(clean($l['bio'])) ?>')" style="background:rgba(26,64,176,.85);color:white;border:none;border-radius:6px;padding:4px 10px;font-size:11px;font-weight:700;cursor:pointer">✎ Edit</button>
            <form action="admin_actions.php" method="post" style="display:inline"><input type="hidden" name="action" value="delete_leader"><input type="hidden" name="id" value="<?=$l['id']?>"><button type="submit" style="background:rgba(176,26,26,.85);color:white;border:none;border-radius:6px;padding:4px 10px;font-size:11px;font-weight:700;cursor:pointer" onclick="return confirm('Remove?')">✕ Delete</button></form>
          </div>
          <?php endif; ?>
        </div>
        <h3><?= clean($l['full_name']) ?></h3>
        <div class="ltitles"><?= clean($l['titles']) ?></div>
        <div class="lrole-pill"><?= clean($l['role_key']) ?> — FUHSA</div>
        <p><?= clean($l['bio']) ?></p>
        <a href="#" class="lead-readmore">Read More →</a>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  <?php if(empty($leaders)): ?>
  <p style="color:var(--muted);text-align:center;padding:3rem 0">No leaders added yet. Admin can add leaders above.</p>
  <?php endif; ?>
</div>
</section>

<!-- RESEARCH FOCUS -->
<section id="research" style="background:var(--light)">
<div class="si">
  <div class="slabel">Research Focus Areas</div>
  <h2 class="stitle">Our <span>Thematic Research Domains</span></h2>
  <div class="gline"></div>
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:1.2rem">
    <div class="pub-card" style="flex-direction:column;align-items:flex-start"><div class="pub-badge pub-j">🧬</div><h3 style="font-family:'Merriweather',serif;font-size:.95rem;color:var(--navy)">Anatomy, Physiology & Biochemistry</h3><p style="font-size:13px;color:var(--muted)">Structural, functional, and molecular basis of human biology.</p></div>
    <div class="pub-card" style="flex-direction:column;align-items:flex-start"><div class="pub-badge pub-c">🔬</div><h3 style="font-family:'Merriweather',serif;font-size:.95rem;color:var(--navy)">Clinical & Diagnostic Sciences</h3><p style="font-size:13px;color:var(--muted)">Pathology, haematology, microbiology, and clinical pharmacology.</p></div>
    <div class="pub-card" style="flex-direction:column;align-items:flex-start"><div class="pub-badge pub-t">🏥</div><h3 style="font-family:'Merriweather',serif;font-size:.95rem;color:var(--navy)">Clinical Medicine & Surgery</h3><p style="font-size:13px;color:var(--muted)">Medicine, surgery, paediatrics, obstetrics, anaesthesia, and radiology.</p></div>
    <div class="pub-card" style="flex-direction:column;align-items:flex-start"><div class="pub-badge pub-b">👩‍⚕️</div><h3 style="font-family:'Merriweather',serif;font-size:.95rem;color:var(--navy)">Allied Health & Nursing</h3><p style="font-size:13px;color:var(--muted)">Nursing, physiotherapy, radiography, lab science, and optometry.</p></div>
    <div class="pub-card" style="flex-direction:column;align-items:flex-start"><div class="pub-badge pub-j">🦷</div><h3 style="font-family:'Merriweather',serif;font-size:.95rem;color:var(--navy)">Dental Sciences & Oral Health</h3><p style="font-size:13px;color:var(--muted)">Preventive, restorative, and oral maxillofacial research.</p></div>
    <div class="pub-card" style="flex-direction:column;align-items:flex-start"><div class="pub-badge pub-c">🦠</div><h3 style="font-family:'Merriweather',serif;font-size:.95rem;color:var(--navy)">Public Health & Epidemiology</h3><p style="font-size:13px;color:var(--muted)">Disease surveillance, biostatistics, and community health.</p></div>
    <div class="pub-card" style="flex-direction:column;align-items:flex-start"><div class="pub-badge pub-t">🧪</div><h3 style="font-family:'Merriweather',serif;font-size:.95rem;color:var(--navy)">Pure & Applied Sciences</h3><p style="font-size:13px;color:var(--muted)">Microbiology, biotechnology, chemistry, physics, and data science.</p></div>
    <div class="pub-card" style="flex-direction:column;align-items:flex-start"><div class="pub-badge pub-b">🍎</div><h3 style="font-family:'Merriweather',serif;font-size:.95rem;color:var(--navy)">Nutrition, Environment & Forensics</h3><p style="font-size:13px;color:var(--muted)">Dietetics, environmental health, forensic sciences, and health informatics.</p></div>
  </div>
</div>
</section>

<!-- IBR PLATFORM -->
<section id="ibr-platform" style="background:white">
<div class="si">
  <div class="slabel">IBR Platform</div>
  <h2 class="stitle">Institutional-Based <span>Research Portal</span></h2>
  <div class="gline"></div>
  <p class="ssub">Submit proposals, track ethics clearance, manage budgets and monitor your IBR research projects.</p>
  <div style="background:linear-gradient(135deg,var(--navy),var(--blue));border-radius:18px;padding:2.5rem;color:white;margin-bottom:2rem">
    <h3 style="font-family:'Merriweather',serif;font-size:1.4rem;margin-bottom:12px">🚀 FUHSA IBR Online Portal — Version 4</h3>
    <p style="color:rgba(255,255,255,.8);margin-bottom:1.5rem">Proposal Submission • Ethics Review • Document Upload • Budget Management • Progress Tracking</p>
    <a href="ibr_platform.php" class="btn-gold" style="font-size:16px">Launch IBR Platform →</a>
    <a href="#downloads" style="margin-left:14px;color:var(--gold3);font-size:14px;font-weight:700;text-decoration:none">📥 Download Forms & Annexures ↓</a>
  </div>

  <!-- IBR Guide (Collapsible — Attractive) -->
  <div class="ibr-guide-wrap" id="ibrGuide">
    <button class="ibr-guide-toggle" onclick="this.parentElement.classList.toggle('open')">
      <span>📋 IBR Application Guide — Step-by-Step Instructions</span>
      <span style="display:flex;align-items:center;gap:10px">
        <span class="toggle-badge">6 Steps</span>
        <span class="toggle-arrow">▼</span>
      </span>
    </button>
    <div class="ibr-guide-body">
      <div class="ibr-steps">
        <div class="ibr-step">
          <div class="step-num sn1">1</div>
          <div class="step-text"><h4>Prepare Your Proposal</h4><p>Include project title, executive summary, objectives, methodology, budget justification, and Vancouver-style references.</p></div>
        </div>
        <div class="ibr-step">
          <div class="step-num sn2">2</div>
          <div class="step-text"><h4>Obtain Institutional Approvals</h4><p>Secure departmental, faculty, ethics committee, and Vice Chancellor approvals before submission.</p></div>
        </div>
        <div class="ibr-step">
          <div class="step-num sn3">3</div>
          <div class="step-text"><h4>Register on the Portal</h4><p>Create your account on the IBR platform using your institutional email address and complete verification.</p></div>
        </div>
        <div class="ibr-step">
          <div class="step-num sn4">4</div>
          <div class="step-text"><h4>Complete Application Form</h4><p>Fill in applicant details, staff number, faculty, department, academic rank, and contact information.</p></div>
        </div>
        <div class="ibr-step">
          <div class="step-num sn5">5</div>
          <div class="step-text"><h4>Upload Supporting Documents</h4><p>Attach full proposal, ethical clearance, CV, institutional endorsement letters, and Gantt chart.</p></div>
        </div>
        <div class="ibr-step">
          <div class="step-num sn6">6</div>
          <div class="step-text"><h4>Review &amp; Submit</h4><p>Verify all sections, confirm budget calculations, submit and download your acknowledgement slip.</p></div>
        </div>
      </div>
      <div class="ibr-warnings">
        <h4>⚠️ Common Errors to Avoid</h4>
        <ul>
          <li>Incomplete or missing documentation</li>
          <li>Incorrect budget calculations</li>
          <li>Wrong or corrupt file formats</li>
          <li>Missing ethical clearance certificate</li>
          <li>Submitting duplicate applications</li>
          <li>Missing submission deadlines</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</section>

<!-- NRF PLATFORM (Dummy) -->
<section id="nrf-platform" style="background:var(--cream)">
<div class="si">
  <div class="slabel">NRF Platform</div>
  <h2 class="stitle">National Research <span>Fund Portal</span></h2>
  <div class="gline"></div>
  <p class="ssub">Access the National Research Fund (NRF) application portal for competitive research grants across Nigerian universities.</p>
  <div style="background:linear-gradient(135deg,var(--green),var(--green2));border-radius:18px;padding:2.5rem;color:white;margin-bottom:2rem">
    <h3 style="font-family:'Merriweather',serif;font-size:1.4rem;margin-bottom:12px">🏛️ NRF Grant Application Portal</h3>
    <p style="color:rgba(255,255,255,.8);margin-bottom:1.5rem">Access the official TETFund National Research Fund portal for competitive research grant applications.</p>
    <a href="https://nrf.tetfund.gov.ng/" target="_blank" class="btn-gold" style="font-size:14px">Visit NRF Portal →</a>
  </div>
</div>
</section>

<!-- STUDENT RESEARCH -->
<section id="student-research" style="background:white">
<div class="si">
  <div class="slabel">Student Projects</div>
  <h2 class="stitle">Student <span>Research Area</span></h2>
  <div class="gline"></div>
  <p class="ssub">Browse research projects completed by FUHSA students across all faculties and programmes.</p>
  <button onclick="openModal('student_research')" class="btn-gold admin-add" style="border:none;font-size:14px;padding:10px 20px;margin-bottom:1.5rem">+ Add Student Project</button>
  <?php if(!empty($studentResearch)): ?>
  <div style="max-height:480px;overflow-y:auto;padding-right:6px">
    <?php $srn=0; foreach($studentResearch as $sr): $srn++; ?>
    <div style="display:flex;gap:1rem;align-items:flex-start;padding:1.2rem 1.5rem;background:var(--light);border-radius:14px;margin-bottom:.8rem;border:1px solid var(--border);transition:box-shadow .2s;position:relative">
      <div style="flex-shrink:0;width:36px;height:36px;border-radius:50%;background:var(--navy);color:white;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:800"><?= $srn ?></div>
      <div style="flex:1;min-width:0">
        <div style="font-family:'Merriweather',serif;font-size:1rem;font-weight:700;color:var(--navy);margin-bottom:4px"><?= clean($sr['project_title']) ?></div>
        <div style="font-size:13px;color:var(--muted);margin-bottom:6px">
          <strong>👤 <?= clean($sr['student_name']) ?></strong>
          <?php if($sr['matric_no']): ?> · <?= clean($sr['matric_no']) ?><?php endif; ?>
          <?php if($sr['department']): ?> · <?= clean($sr['department']) ?><?php endif; ?>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;font-size:11px">
          <?php if($sr['programme']): ?><span style="background:#e8f8ee;color:var(--green);padding:2px 10px;border-radius:10px;font-weight:700"><?= clean($sr['programme']) ?></span><?php endif; ?>
          <?php if($sr['year']): ?><span style="background:var(--light);color:var(--blue);padding:2px 10px;border-radius:10px;font-weight:700;border:1px solid var(--border)"><?= $sr['year'] ?></span><?php endif; ?>
          <?php if($sr['supervisor']): ?><span style="color:var(--muted)">Supervisor: <?= clean($sr['supervisor']) ?></span><?php endif; ?>
        </div>
        <?php if($sr['abstract']): ?><div style="font-size:13px;color:var(--muted);margin-top:8px;line-height:1.6;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden"><?= clean($sr['abstract']) ?></div><?php endif; ?>
      </div>
      <?php if($admin): ?>
      <form action="admin_actions.php" method="post"><input type="hidden" name="action" value="delete_student_research"><input type="hidden" name="id" value="<?=$sr['id']?>"><button type="submit" style="background:var(--red);color:white;border:none;border-radius:6px;padding:4px 10px;font-size:11px;cursor:pointer">✕</button></form>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>
  <?php else: ?>
  <p style="color:var(--muted);text-align:center;padding:2rem 0">No student projects added yet.</p>
  <?php endif; ?>
</div>
</section>

<!-- DOWNLOADS - Forms & Annexures -->
<section id="downloads" style="background:var(--light)">
<div class="si">
  <div class="slabel">Downloads</div>
  <h2 class="stitle">Forms & <span>Annexures</span></h2>
  <div class="gline"></div>
  <p class="ssub">Download official application forms, templates, and research documents.</p>
  <button onclick="openModal('download')" class="btn-gold admin-add" style="border:none;font-size:14px;padding:10px 20px;margin-bottom:1.5rem">+ Add Download</button>
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1rem">
    <?php $dlIcons = ['pdf'=>'📕','docx'=>'📄','doc'=>'📄','xlsx'=>'📊','xls'=>'📊','pptx'=>'📑','zip'=>'📦'];
    foreach($downloads as $dl):
      $ext = strtolower(pathinfo($dl['file_name'], PATHINFO_EXTENSION));
      $dlIcon = $dlIcons[$ext] ?? '📎';
      $bgColor = in_array($ext, ['pdf']) ? '#fee2e2' : (in_array($ext, ['docx','doc']) ? '#dbeafe' : '#e8f8ee');
    ?>
    <div style="display:flex;align-items:center;gap:16px;padding:18px 20px;border:2px solid var(--border);border-radius:14px;background:white;transition:all .2s;position:relative">
      <div style="width:52px;height:52px;border-radius:12px;background:<?= $bgColor ?>;display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0"><?= $dlIcon ?></div>
      <div style="flex:1;min-width:0">
        <div style="font-size:14px;font-weight:700;color:var(--navy)"><?= clean($dl['title']) ?></div>
        <div style="font-size:12px;color:var(--muted);margin-top:2px"><?= clean($dl['description']) ?></div>
        <a href="<?= clean($dl['file_path']) ?>" download style="display:inline-block;margin-top:6px;color:var(--blue);font-size:12px;font-weight:700;text-decoration:none">⬇ Download File</a>
      </div>
      <?php if($admin): ?>
      <form action="admin_actions.php" method="post" style="position:absolute;top:8px;right:8px"><input type="hidden" name="action" value="delete_download"><input type="hidden" name="id" value="<?=$dl['id']?>"><button type="submit" class="gal-del" style="display:block">✕</button></form>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
    <?php if(empty($downloads)): ?>
    <p style="color:var(--muted);text-align:center;padding:2rem 0;grid-column:1/-1">No downloads available yet. Admin can add forms above.</p>
    <?php endif; ?>
  </div>
</div>
</section>

<!-- BENEFICIARIES -->
<section id="beneficiaries" style="background:white">
<div class="si">
  <div class="slabel">Grant Recipients</div>
  <h2 class="stitle">Research Grant <span>Beneficiaries</span></h2>
  <div class="gline"></div>
  <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:1.5rem">
    <button onclick="openModal('beneficiary')" class="btn-gold admin-add" style="border:none;font-size:14px;padding:10px 20px">+ Add Beneficiary</button>
    <button onclick="openModal('bulk_beneficiary')" class="btn-gold admin-add" style="border:none;font-size:14px;padding:10px 20px;background:linear-gradient(135deg,var(--navy),var(--blue));color:white">📤 Bulk Upload (CSV)</button>
  </div>
  <?php if(count($beneficiaries) > 0): ?>
  <div style="overflow-x:auto;max-height:380px;overflow-y:auto;border:1px solid var(--border);border-radius:12px">
  <table class="ben-table">
    <thead><tr><th>S/N</th><th>Name</th><th>Department</th><th>Type</th><th>Year</th><th>Project Title</th><th>Progress</th><?php if($admin):?><th></th><?php endif;?></tr></thead>
    <tbody>
    <?php $sn=0; foreach($beneficiaries as $b): $sn++; $prog = $b['progress'] ?? 'Ongoing'; ?>
    <tr>
      <td style="font-weight:700;color:var(--navy)"><?= $sn ?></td>
      <td style="font-weight:700"><?= clean($b['full_name']) ?></td>
      <td><?= clean($b['department']) ?></td>
      <td><span class="ben-type <?= $b['grant_type']==='IBR'?'ben-ibr':'ben-nrf' ?>"><?= $b['grant_type'] ?></span></td>
      <td><?= $b['grant_year'] ?></td>
      <td style="font-size:13px"><?= clean($b['project_title']) ?></td>
      <td><?php if($prog==='Completed'): ?><span style="display:inline-flex;align-items:center;gap:4px;background:linear-gradient(135deg,#059669,#10b981);color:white;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700">✅ Completed</span><?php else: ?><span style="display:inline-flex;align-items:center;gap:4px;background:linear-gradient(135deg,#d97706,#f59e0b);color:white;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700">🔄 Ongoing</span><?php endif; ?></td>
      <?php if($admin):?>
      <td style="white-space:nowrap"><button class="ben-del" onclick="openEditModal('beneficiary',<?=$b['id']?>,'<?= addslashes(clean($b['full_name'])) ?>','<?= addslashes(clean($b['department'])) ?>','<?= addslashes(clean($b['faculty'])) ?>','<?=$b['grant_type']?>','<?=$b['grant_year']?>','<?=$b['amount']?>','<?= addslashes(clean($b['project_title'])) ?>','<?=$prog?>')" style="background:var(--blue)">✎</button> <form action="admin_actions.php" method="post" style="display:inline"><input type="hidden" name="action" value="delete_beneficiary"><input type="hidden" name="id" value="<?=$b['id']?>"><button type="submit" class="ben-del">✕</button></form></td>
      <?php endif;?>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  <?php else: ?>
  <p style="color:var(--muted)">No beneficiaries recorded yet.</p>
  <?php endif; ?>
</div>
</section>

<!-- GALLERY - SLIDING CAROUSEL -->
<section class="gal-sec" id="gallery">
<div class="gal-inner">
  <div class="slabel">Campus Gallery</div>
  <h2 class="stitle">Life at <span>FUHSA, Azare</span></h2>
  <div class="gline"></div>
  <p class="ssub">Explore our beautiful campus, dedicated students, and vibrant academic community.</p>
  <button onclick="openModal('gallery')" class="btn-gold admin-add" style="border:none;font-size:14px;padding:10px 20px;margin-bottom:1rem">+ Add Photo</button>

  <!-- Scrolling thumbnail strip -->
  <div class="gal-thumbstrip">
    <?php foreach($gallery as $i => $g): ?>
    <div class="gal-thumb <?= $i===0?'active':'' ?>" onclick="galGoTo(<?= $i ?>)" data-idx="<?= $i ?>">
      <img src="<?= clean($g['image_path']) ?>" alt="">
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Sliding stage -->
  <div class="gal-stage" id="galStage">
    <div class="gal-track" id="galTrack">
      <?php foreach($gallery as $i => $g): ?>
      <div class="gal-slide" onclick="galOpen(<?= $i ?>)">
        <div class="gal-slide-img"><img src="<?= clean($g['image_path']) ?>" alt="<?= clean($g['caption']) ?>"></div>
        <div class="gal-slide-cap"><?= clean($g['caption']) ?></div>
        <form action="admin_actions.php" method="post" onclick="event.stopPropagation()"><input type="hidden" name="action" value="delete_gallery"><input type="hidden" name="id" value="<?=$g['id']?>"><button type="submit" class="gal-del">✕</button></form>
      </div>
      <?php endforeach; ?>
    </div>
    <button class="gal-arrow gal-prev" onclick="galMove(-1)">&#8592;</button>
    <button class="gal-arrow gal-next" onclick="galMove(1)">&#8594;</button>
  </div>
  <div class="gal-dots" id="galDots"></div>
</div>
</section>

<!-- Lightbox -->
<div class="gal-lightbox" id="galLightbox" onclick="galCloseLB(event)">
  <button class="gal-lightbox-close" onclick="galCloseLB(event)">✕</button>
  <button class="gal-lightbox-nav gal-lb-prev" onclick="event.stopPropagation();galLBNav(-1)">&#8592;</button>
  <img id="galLBImg" src="" alt="">
  <div class="gal-lightbox-cap" id="galLBCap"></div>
  <button class="gal-lightbox-nav gal-lb-next" onclick="event.stopPropagation();galLBNav(1)">&#8594;</button>
</div>

<!-- NEWS - UNIBEN STYLE -->
<section id="news" style="background:var(--cream)">
<div class="si">
  <div class="news-header">
    <div><div class="slabel">Latest Updates</div><h2 class="stitle">News & <span>Announcements</span></h2><div class="gline"></div></div>
    <a href="#">All News →</a>
  </div>
  <button onclick="openModal('news')" class="btn-gold admin-add" style="border:none;font-size:14px;padding:10px 20px;margin-bottom:1.5rem">+ Add News</button>
  <div class="ngrid">
    <?php $icons = ['📰','🏛️','🔬','🎓','📋','🏥'];
    foreach($news as $i => $n): ?>
    <div class="ncard">
      <div class="ncard-img">
        <?php if($admin):?><form action="admin_actions.php" method="post"><input type="hidden" name="action" value="delete_news"><input type="hidden" name="id" value="<?=$n['id']?>"><button type="submit" class="ndel">✕</button></form><?php endif;?>
        <div class="ntag"><?= clean($n['tag']) ?></div>
        <div class="ncard-img-placeholder"><?= $icons[$i % 6] ?></div>
      </div>
      <div class="ncard-body">
        <div class="nmeta"><?= date('F j, Y', strtotime($n['created_at'])) ?></div>
        <h3><?= clean($n['title']) ?></h3>
        <p><?= clean($n['summary']) ?></p>
        <a href="<?= clean($n['link']) ?>" class="ncard-link">View Details →</a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<!-- PUBLICATIONS -->
<section id="publications" style="background:var(--light)">
<div class="si">
  <div class="slabel">Research Output</div>
  <h2 class="stitle">Publications & <span>Journal Repository</span></h2>
  <div class="gline"></div>
  <button onclick="openModal('publication')" class="btn-gold admin-add" style="border:none;font-size:14px;padding:10px 20px;margin-bottom:1.5rem">+ Add Publication</button>
  <div style="max-height:520px;overflow-y:auto;padding-right:8px" id="pubScroll">
  <?php
  $typeMap = ['journal'=>'Journal Article','conference'=>'Conference Paper','thesis'=>'Thesis','book'=>'Book Chapter/Manuscript'];
  $iconMap = ['journal'=>'🔬','conference'=>'🏆','thesis'=>'🎓','book'=>'📚'];
  $clsMap = ['journal'=>'pub-j','conference'=>'pub-c','thesis'=>'pub-t','book'=>'pub-b'];
  $psn=0; foreach($pubs as $p): $psn++; ?>
  <div class="pub-card">
    <div style="flex-shrink:0;width:32px;height:32px;border-radius:50%;background:var(--navy);color:white;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800"><?= $psn ?></div>
    <div class="pub-badge <?= $clsMap[$p['pub_type']] ?? 'pub-j' ?>"><?= $iconMap[$p['pub_type']] ?? '🔬' ?></div>
    <div style="flex:1;min-width:0">
      <?php if($admin):?><div style="float:right;display:flex;gap:5px"><button class="pub-del" style="display:inline-block;background:var(--blue)" onclick="openEditModal('publication',<?=$p['id']?>,'<?=$p['pub_type']?>','<?=$p['pub_year']?>','<?= addslashes(clean($p['title'])) ?>','<?= addslashes(clean($p['authors'])) ?>','<?= addslashes(clean($p['journal'])) ?>','<?= addslashes(clean($p['doi'])) ?>')">✎</button><form action="admin_actions.php" method="post" style="display:inline"><input type="hidden" name="action" value="delete_publication"><input type="hidden" name="id" value="<?=$p['id']?>"><button type="submit" class="pub-del" style="display:inline-block">✕</button></form></div><?php endif;?>
      <div class="pub-meta"><span class="pub-year"><?= $p['pub_year'] ?></span><span class="pub-type"><?= $typeMap[$p['pub_type']] ?? $p['pub_type'] ?></span></div>
      <div class="pub-title"><?= clean($p['title']) ?></div>
      <div class="pub-authors">👥 <?= clean($p['authors']) ?></div>
      <div class="pub-journal">📖 <?= clean($p['journal']) ?></div>
      <?php if($p['doi']): ?><a href="<?= clean($p['doi']) ?>" target="_blank" style="display:inline-block;margin-top:6px;color:var(--blue);font-weight:700;font-size:13px;text-decoration:none">🔗 View / DOI ↗</a><?php endif; ?>
    </div>
  </div>
  <?php endforeach; ?>
  </div>
</div>
</section>

<!-- CONTACT -->
<section id="contact" style="background:white">
<div class="si">
  <div class="slabel">Get in Touch</div>
  <h2 class="stitle">Contact <span>DIRD</span></h2>
  <div class="gline"></div>
  <div class="contact-grid">
    <div class="contact-info">
      <div class="ci-item"><span class="ci-icon">📍</span><div><strong>Address</strong><br>Directorate of Innovation, Research & Development<br>FUHSA, KM3 Potiskum Road, Azare, Bauchi State, Nigeria</div></div>
      <div class="ci-item"><span class="ci-icon">📧</span><div><strong>Email</strong><br>dird@fuhsa.edu.ng</div></div>
      <div class="ci-item"><span class="ci-icon">📞</span><div><strong>Phone</strong><br>+234 (0) 803 000 0000</div></div>
      <div class="ci-item"><span class="ci-icon">🕐</span><div><strong>Office Hours</strong><br>Monday – Friday: 8:00 AM – 4:00 PM</div></div>
    </div>
    <div>
      <div style="background:var(--light);padding:2rem;border-radius:14px;border:1px solid var(--border)">
        <h3 style="font-family:'Merriweather',serif;color:var(--navy);margin-bottom:1rem;font-size:1.1rem">📨 Send a Message</h3>
        <div class="fg"><label>Full Name</label><input type="text" placeholder="Your full name"></div>
        <div class="fg"><label>Email Address</label><input type="email" placeholder="you@example.com"></div>
        <div class="fg"><label>Subject</label><input type="text" placeholder="Research inquiry"></div>
        <div class="fg"><label>Message</label><textarea placeholder="Write your message..."></textarea></div>
        <button class="sbtn" onclick="alert('Message sent! We will respond within 2 working days.')">Send Message</button>
      </div>
    </div>
  </div>
</div>
</section>

<!-- FOOTER -->
<footer>
<div class="fi">
  <div class="fgrid">
    <div>
      <div class="fname">FUHSA — DIRD</div>
      <p style="font-size:13.5px;max-width:290px">Directorate of Innovation, Research & Development, Federal University of Health Sciences, Azare, Bauchi State.</p>
    </div>
    <div class="fcol"><h4>Quick Links</h4><ul><li><a href="#about">About</a></li><li><a href="#leadership">Leaders</a></li><li><a href="#publications">Publications</a></li><li><a href="#contact">Contact</a></li></ul></div>
    <div class="fcol"><h4>Platforms</h4><ul><li><a href="#ibr-platform">IBR Platform</a></li><li><a href="https://nrf.tetfund.gov.ng/" target="_blank">NRF Platform</a></li><li><a href="#student-research">Student Research</a></li><li><a href="#beneficiaries">Beneficiaries</a></li><li><a href="#downloads">Downloads</a></li></ul></div>
    <div class="fcol"><h4>Resources</h4><ul><li><a href="#">TETFund</a></li><li><a href="#">NUC</a></li><li><a href="#">Ethics Committee</a></li><li><a href="#">Library</a></li></ul></div>
  </div>
  <div class="fbar">© <?= date('Y') ?> FUHSA DIRD. All rights reserved.</div>
</div>
</footer>

<!-- LOGIN MODAL -->
<div class="modal-overlay" id="loginModal">
<div class="modal-box" style="max-width:420px">
  <div class="modal-hdr"><h2>🔐 Admin Login</h2><button class="modal-close" onclick="document.getElementById('loginModal').classList.remove('open')">✕</button></div>
  <div class="modal-body">
    <?php if(isset($_GET['login_error'])): ?><p style="color:var(--red);margin-bottom:1rem;font-weight:700">Invalid credentials. Please try again.</p><?php endif; ?>
    <form action="admin_actions.php" method="post">
      <input type="hidden" name="action" value="login">
      <div class="fg"><label>Username</label><input type="text" name="username" required></div>
      <div class="fg"><label>Password</label><input type="password" name="password" required></div>
      <button class="sbtn" type="submit">Login</button>
    </form>
  </div>
</div>
</div>

<!-- ADD MODALS -->
<div class="modal-overlay" id="addModal">
<div class="modal-box">
  <div class="modal-hdr"><h2 id="modalTitle">Add Item</h2><button class="modal-close" onclick="closeAddModal()">✕</button></div>
  <div class="modal-body" id="modalBody"></div>
</div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"></div>

<script>
// Hero is static (Gate image)

// ─── GALLERY SLIDING CAROUSEL ───
var galTrack = document.getElementById('galTrack');
var galSlides = galTrack ? galTrack.querySelectorAll('.gal-slide') : [];
var galThumbs = document.querySelectorAll('.gal-thumb');
var galTotal = galSlides.length;
var galPerView = window.innerWidth < 900 ? 1 : 3;
var galIdx = 0;
var galMaxIdx = Math.max(0, galTotal - galPerView);
var galAutoTimer = null;

function buildGalDots(){
  var dc = document.getElementById('galDots');
  if(!dc || galTotal <= galPerView){if(dc)dc.innerHTML='';return}
  dc.innerHTML='';
  for(var i=0;i<=galMaxIdx;i++){var d=document.createElement('button');d.className='gdot'+(i===0?' active':'');d.setAttribute('data-i',i);d.onclick=function(){galGoTo(parseInt(this.getAttribute('data-i')))};dc.appendChild(d)}
}
function galGoTo(idx){
  if(idx<0)idx=galMaxIdx;if(idx>galMaxIdx)idx=0;galIdx=idx;
  galTrack.style.transform='translateX(-'+(galIdx*(100/galPerView))+'%)';
  document.querySelectorAll('.gdot').forEach(function(d,i){d.classList.toggle('active',i===galIdx)});
  galThumbs.forEach(function(t){t.classList.remove('active')});
  if(galThumbs[galIdx])galThumbs[galIdx].classList.add('active');
}
function galMove(dir){galGoTo(galIdx+dir)}
function galAutoPlay(){galAutoTimer=setInterval(function(){galGoTo(galIdx+1)},4500)}
function galStopAuto(){if(galAutoTimer)clearInterval(galAutoTimer)}

if(galTotal>0){buildGalDots();galAutoPlay();var gs=document.getElementById('galStage');if(gs){gs.addEventListener('mouseenter',galStopAuto);gs.addEventListener('mouseleave',galAutoPlay)}}
window.addEventListener('resize',function(){var nv=window.innerWidth<900?1:3;if(nv!==galPerView){galPerView=nv;galMaxIdx=Math.max(0,galTotal-galPerView);galGoTo(0);buildGalDots()}});

// Lightbox
var galLBIdx=0;
function galOpen(idx){galLBIdx=idx;galUpdateLB();document.getElementById('galLightbox').classList.add('open');document.body.style.overflow='hidden'}
function galCloseLB(e){if(e.target.classList.contains('gal-lightbox')||e.target.classList.contains('gal-lightbox-close')){document.getElementById('galLightbox').classList.remove('open');document.body.style.overflow=''}}
function galLBNav(dir){galLBIdx=(galLBIdx+dir+galTotal)%galTotal;galUpdateLB()}
function galUpdateLB(){var s=galSlides[galLBIdx];if(!s)return;document.getElementById('galLBImg').src=s.querySelector('img').src;document.getElementById('galLBCap').textContent=s.querySelector('.gal-slide-cap').textContent}
document.addEventListener('keydown',function(e){var lb=document.getElementById('galLightbox');if(!lb.classList.contains('open'))return;if(e.key==='Escape'){lb.classList.remove('open');document.body.style.overflow=''}if(e.key==='ArrowLeft')galLBNav(-1);if(e.key==='ArrowRight')galLBNav(1)});

// Toast
function showToast(msg){
  var t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(function(){ t.classList.remove('show'); }, 3000);
}

<?php if(isset($_GET['logged_in'])): ?>showToast('✅ Logged in as Admin');<?php endif; ?>
<?php if(isset($_GET['logged_out'])): ?>showToast('Logged out successfully');<?php endif; ?>
<?php if(isset($_GET['login_error'])): ?>document.getElementById('loginModal').classList.add('open');<?php endif; ?>

// Add modals
function openModal(type){
  var title = '', body = '';
  if(type === 'gallery'){
    title = '📷 Add Gallery Photo';
    body = '<form action="admin_actions.php" method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="add_gallery"><div class="fg"><label>Photo Caption</label><input type="text" name="caption" placeholder="e.g. New Library Opening" required></div><div class="fg"><label>Upload Photo</label><input type="file" name="image" accept="image/*" required></div><button class="sbtn" type="submit">Upload Photo</button></form>';
  } else if(type === 'news'){
    title = '📰 Add News Article';
    body = '<form action="admin_actions.php" method="post"><input type="hidden" name="action" value="add_news"><div class="fg"><label>Title</label><input type="text" name="title" required></div><div class="fg"><label>Summary</label><textarea name="summary" required></textarea></div><div class="fg"><label>Tag</label><input type="text" name="tag" value="General"></div><div class="fg"><label>Link URL</label><input type="text" name="link" value="#"></div><button class="sbtn" type="submit">Add News</button></form>';
  } else if(type === 'publication'){
    title = '📖 Add Publication';
    body = '<form action="admin_actions.php" method="post"><input type="hidden" name="action" value="add_publication"><div class="fg"><label>Type</label><select name="pub_type"><option value="journal">Journal Article</option><option value="conference">Conference Paper</option><option value="thesis">Thesis</option><option value="book">Book Chapter/Manuscript</option></select></div><div class="fg"><label>Year</label><input type="number" name="pub_year" value="'+new Date().getFullYear()+'" required></div><div class="fg"><label>Title</label><input type="text" name="title" required></div><div class="fg"><label>Authors</label><input type="text" name="authors" required></div><div class="fg"><label>Name of Journal</label><input type="text" name="journal"></div><div class="fg"><label>DOI URL</label><input type="text" name="doi"></div><button class="sbtn" type="submit">Add Publication</button></form>';
  } else if(type === 'beneficiary'){
    title = '📋 Add Beneficiary';
    body = '<form action="admin_actions.php" method="post"><input type="hidden" name="action" value="add_beneficiary"><div class="fg"><label>Full Name</label><input type="text" name="full_name" required></div><div class="fg"><label>Department</label><input type="text" name="department"></div><div class="fg"><label>Faculty</label><input type="text" name="faculty"></div><div class="fg"><label>Grant Type</label><select name="grant_type"><option value="IBR">IBR</option><option value="NRF">NRF</option></select></div><div class="fg"><label>Year</label><input type="number" name="grant_year" value="'+new Date().getFullYear()+'" required></div><div class="fg"><label>Project Title</label><textarea name="project_title"></textarea></div><div class="fg"><label>Progress</label><select name="progress" style="padding:12px 14px"><option value="Ongoing">🔄 Ongoing</option><option value="Completed">✅ Completed</option></select></div><button class="sbtn" type="submit">Add Beneficiary</button></form>';
  } else if(type === 'leader'){
    title = '👔 Add Leader';
    body = '<form action="admin_actions.php" method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="add_leader"><div class="fg"><label>Full Name</label><input type="text" name="full_name" placeholder="e.g. Prof. Abdullahi Musa Kirfi" required></div><div class="fg"><label>Role / Position</label><input type="text" name="role_title" placeholder="e.g. Vice-Chancellor, Dean, DDIRD" required></div><div class="fg"><label>Titles / Qualifications</label><input type="text" name="titles" placeholder="e.g. MBBS, FWACS, PhD"></div><div class="fg"><label>Comment</label><textarea name="bio" rows="4" placeholder="Comment about the leader..."></textarea></div><div class="fg"><label>Photo</label><input type="file" name="image" accept="image/*" required></div><button class="sbtn" type="submit">Add Leader</button></form>';
  } else if(type === 'bulk_beneficiary'){
    title = '📤 Bulk Upload Beneficiaries (CSV)';
    body = '<form action="admin_actions.php" method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="add_bulk_beneficiary"><div style="background:var(--light);border:1px solid var(--border);border-radius:10px;padding:16px;margin-bottom:16px;font-size:13px;color:var(--navy)"><strong>CSV Format (with header row):</strong><br><code style="font-size:11px;color:var(--muted);display:block;margin-top:8px;background:white;padding:10px;border-radius:6px;line-height:1.6">Name, Department, Faculty, Grant Type, Year, Project Title<br>Dr. Amina Yusuf, Community Medicine, Faculty of Clinical Sciences, IBR, 2024, Prevalence of Hypertension...<br>Dr. Suleiman Garba, Anatomy, Faculty of Basic Medical Sciences, NRF, 2023, Morphometric Analysis...</code></div><div class="fg"><label>Upload CSV File</label><input type="file" name="csv_file" accept=".csv" required></div><button class="sbtn" type="submit">Upload & Import</button></form>';
  } else if(type === 'download'){
    title = '📥 Add Download';
    body = '<form action="admin_actions.php" method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="add_download"><div class="fg"><label>Document Title</label><input type="text" name="title" placeholder="e.g. IBR Annexure 2 — Budget Template" required></div><div class="fg"><label>Description</label><input type="text" name="description" placeholder="e.g. Official budget breakdown form (.xlsx)"></div><div class="fg"><label>Upload File</label><input type="file" name="file" accept=".pdf,.doc,.docx,.xlsx,.xls,.pptx,.zip" required></div><button class="sbtn" type="submit">Upload Document</button></form>';
  } else if(type === 'student_research'){
    title = '🎓 Add Student Research Project';
    body = '<form action="admin_actions.php" method="post"><input type="hidden" name="action" value="add_student_research"><div class="fg"><label>Student Name <span style="color:red">*</span></label><input type="text" name="student_name" placeholder="Full name" required></div><div class="fg"><label>Matric Number</label><input type="text" name="matric_no" placeholder="e.g. FUHSA/2022/001"></div><div style="display:grid;grid-template-columns:1fr 1fr;gap:12px"><div class="fg"><label>Department</label><input type="text" name="department" placeholder="e.g. Nursing Science"></div><div class="fg"><label>Faculty</label><input type="text" name="faculty" placeholder="e.g. Faculty of Nursing"></div></div><div style="display:grid;grid-template-columns:1fr 1fr;gap:12px"><div class="fg"><label>Programme</label><input type="text" name="programme" placeholder="e.g. BSc, MSc, PhD"></div><div class="fg"><label>Year</label><input type="number" name="year" value="'+new Date().getFullYear()+'"></div></div><div class="fg"><label>Project Title <span style="color:red">*</span></label><input type="text" name="project_title" placeholder="Full research project title" required></div><div class="fg"><label>Supervisor</label><input type="text" name="supervisor" placeholder="e.g. Prof. Abdullahi Kirfi"></div><div class="fg"><label>Abstract</label><textarea name="abstract" rows="3" placeholder="Brief summary..."></textarea></div><button class="sbtn" type="submit">Add Project</button></form>';
  }
  document.getElementById('modalTitle').textContent = title;
  document.getElementById('modalBody').innerHTML = body;
  document.getElementById('addModal').classList.add('open');
}
function closeAddModal(){
  document.getElementById('addModal').classList.remove('open');
}
function openEditModal(type){
  var args = Array.prototype.slice.call(arguments);
  var title = '', body = '';
  if(type === 'leader'){
    var id=args[1],name=args[2],role=args[3],titles=args[4],bio=args[5];
    title = '✎ Edit Leader';
    body = '<form action="admin_actions.php" method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="edit_leader"><input type="hidden" name="id" value="'+id+'"><div class="fg"><label>Full Name</label><input type="text" name="full_name" value="'+name+'" required></div><div class="fg"><label>Role / Position</label><input type="text" name="role_title" value="'+role+'" required></div><div class="fg"><label>Titles / Qualifications</label><input type="text" name="titles" value="'+titles+'"></div><div class="fg"><label>Comment</label><textarea name="bio" rows="4">'+bio+'</textarea></div><div class="fg"><label>New Photo (leave empty to keep current)</label><input type="file" name="image" accept="image/*"></div><button class="sbtn" type="submit">Save Changes</button></form>';
  } else if(type === 'beneficiary'){
    var id=args[1],name=args[2],dept=args[3],fac=args[4],gtype=args[5],year=args[6],amt=args[7],ptitle=args[8],prog=args[9]||'Ongoing';
    title = '✎ Edit Beneficiary';
    body = '<form action="admin_actions.php" method="post"><input type="hidden" name="action" value="edit_beneficiary"><input type="hidden" name="id" value="'+id+'"><div class="fg"><label>Full Name</label><input type="text" name="full_name" value="'+name+'" required></div><div class="fg"><label>Department</label><input type="text" name="department" value="'+dept+'"></div><div class="fg"><label>Faculty</label><input type="text" name="faculty" value="'+fac+'"></div><div class="fg"><label>Grant Type</label><select name="grant_type"><option value="IBR"'+(gtype==="IBR"?" selected":"")+'>IBR</option><option value="NRF"'+(gtype==="NRF"?" selected":"")+'>NRF</option></select></div><div class="fg"><label>Year</label><input type="number" name="grant_year" value="'+year+'" required></div><div class="fg"><label>Project Title</label><textarea name="project_title">'+ptitle+'</textarea></div><div class="fg"><label>Progress</label><select name="progress" style="padding:12px 14px"><option value="Ongoing"'+(prog==="Ongoing"?" selected":"")+'>🔄 Ongoing</option><option value="Completed"'+(prog==="Completed"?" selected":"")+'>✅ Completed</option></select></div><button class="sbtn" type="submit">Save Changes</button></form>';
  } else if(type === 'publication'){
    var id=args[1],ptype=args[2],year=args[3],ptitle=args[4],authors=args[5],journal=args[6],doi=args[7];
    title = '✎ Edit Publication';
    body = '<form action="admin_actions.php" method="post"><input type="hidden" name="action" value="edit_publication"><input type="hidden" name="id" value="'+id+'"><div class="fg"><label>Type</label><select name="pub_type"><option value="journal"'+(ptype==="journal"?" selected":"")+'>Journal Article</option><option value="conference"'+(ptype==="conference"?" selected":"")+'>Conference Paper</option><option value="thesis"'+(ptype==="thesis"?" selected":"")+'>Thesis</option><option value="book"'+(ptype==="book"?" selected":"")+'>Book Chapter/Manuscript</option></select></div><div class="fg"><label>Year</label><input type="number" name="pub_year" value="'+year+'" required></div><div class="fg"><label>Title</label><input type="text" name="title" value="'+ptitle+'" required></div><div class="fg"><label>Authors</label><input type="text" name="authors" value="'+authors+'" required></div><div class="fg"><label>Name of Journal</label><input type="text" name="journal" value="'+journal+'"></div><div class="fg"><label>DOI URL</label><input type="text" name="doi" value="'+doi+'"></div><button class="sbtn" type="submit">Save Changes</button></form>';
  }
  document.getElementById('modalTitle').textContent = title;
  document.getElementById('modalBody').innerHTML = body;
  document.getElementById('addModal').classList.add('open');
}
document.getElementById('addModal').addEventListener('click', function(e){ if(e.target===this) closeAddModal(); });
</script>
</body>
</html>
