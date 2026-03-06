<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Unauthorized Access — Stop</title>
<meta name="robots" content="noindex,nofollow">

<style>
  :root{
    --bg:#0b1020;
    --card:#0f172a;
    --accent:#ff4d4f;
    --accent-2:#ffd166;
    --muted:#98a0b3;
    --glass: rgba(255,255,255,0.03);
  }

  *{box-sizing:border-box}
  html,body{height:100%}
  body{
    margin:0;
    font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    background:
      radial-gradient(1200px 600px at 10% 20%, rgba(255,77,79,0.06), transparent 8%),
      radial-gradient(900px 500px at 90% 80%, rgba(255,209,102,0.03), transparent 10%),
      var(--bg);
    color:#eef2ff;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
  }

  .card{
    width:min(980px,96%);
    background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
    border-radius:18px;
    box-shadow: 0 8px 40px rgba(2,6,23,0.7), inset 0 1px 0 rgba(255,255,255,0.02);
    padding:28px;
    display:grid;
    grid-template-columns: 420px 1fr;
    gap:24px;
    align-items:center;
    position:relative;
    overflow:hidden;
  }

  /* Left: cartoon / scene */
  .scene{
    position:relative;
    height:420px;
    display:flex;
    align-items:center;
    justify-content:center;
  }

  /* simple ground */
  .ground{
    position:absolute;
    bottom:18px;
    left:0; right:0;
    height:18px;
    background: linear-gradient(90deg, rgba(0,0,0,0.18), rgba(255,255,255,0.02));
    border-radius:8px;
    transform:translateY(12px);
    opacity:0.6;
  }

  /* Cartoon guard body using CSS shapes */
  .guard{
    width:220px;
    height:320px;
    position:relative;
    transform-origin:50% 40%;
    animation: bob 2000ms ease-in-out infinite;
  }

  @keyframes bob{
    0%{ transform: translateY(0) }
    50%{ transform: translateY(-6px) }
    100%{ transform: translateY(0) }
  }

  /* hat */
  .hat{
    position:absolute;
    left:50%;
    transform:translateX(-50%);
    top:8px;
    width:160px;
    height:46px;
    background: linear-gradient(180deg,#1b2a5e,#0e1a3a);
    border-radius:18px / 36px;
    box-shadow: 0 6px 18px rgba(2,6,23,0.6);
  }
  .hat:after{
    content:"";
    position:absolute;
    left:50%;
    transform:translateX(-50%);
    bottom:-14px;
    width:120px;
    height:18px;
    background:linear-gradient(90deg,#10224a,#0a1a3a);
    border-radius:8px;
  }

  /* face */
  .face{
    position:absolute;
    top:56px;
    left:50%;
    transform:translateX(-50%);
    width:140px;
    height:130px;
    background: linear-gradient(180deg,#ffd9b0,#ffc089);
    border-radius:40px;
    box-shadow: inset 0 6px 12px rgba(0,0,0,0.08);
  }

  .eye{
    position:absolute;
    top:46px;
    width:18px;height:12px;
    background:#07090b;
    border-radius:10px;
  }
  .eye.left{ left:34px; transform:translateY(0);}
  .eye.right{ right:34px; }

  .cheek{
    position:absolute; width:28px; height:14px; background: rgba(255,77,79,0.08);
    border-radius:12px; top:84px;
  }
  .cheek.left{ left:18px; }
  .cheek.right{ right:18px; }

  .mouth{
    position:absolute;
    width:60px;height:18px;
    background:transparent;
    border-bottom:4px solid rgba(13,13,13,0.75);
    border-radius:0 0 30px 30px;
    left:50%;
    transform:translateX(-50%);
    bottom:22px;
  }

  /* body */
  .body{
    position:absolute;
    left:50%;
    transform:translateX(-50%);
    top:146px;
    width:220px;
    height:160px;
    background: linear-gradient(180deg,#063b93,#074baf);
    border-radius:18px;
    display:block;
  }

  /* shield/stop sign */
  .stop-sign{
    position:absolute;
    right:-14px;
    top:36px;
    width:96px;
    height:96px;
    transform-origin:50% 50%;
    animation: shake 2500ms ease-in-out infinite;
  }
  @keyframes shake {
    0%{ transform: translateY(0) rotate(0deg) }
    25%{ transform: translateY(-6px) rotate(-6deg) }
    50%{ transform: translateY(0) rotate(0deg) }
    75%{ transform: translateY(-6px) rotate(6deg) }
    100%{ transform: translateY(0) rotate(0deg) }
  }
  .oct{
    width:100%; height:100%;
    background: linear-gradient(180deg,var(--accent), #ff6b6b);
    clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
    display:flex;
    align-items:center;
    justify-content:center;
    border:6px solid rgba(255,255,255,0.06);
    border-radius:8px;
    box-shadow: 0 10px 30px rgba(255,77,79,0.16);
  }
  .oct span{
    font-weight:700;
    color:white;
    font-size:18px;
    text-transform:uppercase;
    letter-spacing:1px;
    text-shadow: 0 3px 10px rgba(0,0,0,0.4);
  }

  /* Right content */
  .content{
    padding:6px 6px 6px 12px;
    min-height:320px;
    display:flex;
    flex-direction:column;
    justify-content:center;
  }
  .title{
    font-size:28px;
    font-weight:800;
    color:var(--accent-2);
    margin:0 0 8px 0;
    letter-spacing:0.6px;
  }
  .sub{
    color:var(--muted);
    margin:0 0 18px 0;
    font-size:15px;
  }

  .warning-badge{
    display:inline-flex;
    align-items:center;
    gap:10px;
    background: linear-gradient(90deg, rgba(255,77,79,0.14), rgba(255,209,102,0.02));
    padding:10px 14px;
    border-radius:999px;
    color:var(--accent-2);
    font-weight:700;
    width:max-content;
    margin-bottom:14px;
    box-shadow: 0 6px 20px rgba(2,6,23,0.55);
  }

  .desc{
    background:var(--glass);
    border-radius:12px;
    padding:12px;
    color:#cfd8f5;
    line-height:1.55;
    font-size:14px;
    margin-bottom:18px;
  }

  .actions{
    display:flex;
    gap:12px;
    align-items:center;
  }

  .btn{
    border:0;
    padding:12px 16px;
    border-radius:10px;
    font-weight:700;
    cursor:pointer;
    box-shadow: 0 6px 18px rgba(2,6,23,0.5);
    transition: transform .12s ease, box-shadow .12s ease;
  }
  .btn:active{ transform: translateY(2px) }
  .btn.primary{
    background: linear-gradient(90deg,var(--accent), #ff6b6b);
    color:#fff;
  }
  .btn.ghost{
    background:transparent;
    color:var(--accent-2);
    border:1px solid rgba(255,255,255,0.04);
  }

  .small{
    color:var(--muted);
    font-size:13px;
    margin-top:10px;
  }

  /* responsive */
  @media (max-width:880px){
    .card{ grid-template-columns: 1fr; padding:20px; gap:14px;}
    .scene{ height:300px }
  }

  /* a tiny pulse indicator */
  .pulse{
    position:absolute;
    left:18px; top:18px;
    width:12px; height:12px;
    background:var(--accent);
    border-radius:50%;
    box-shadow:0 0 0 6px rgba(255,77,79,0.08);
    animation: ping 1800ms infinite;
  }
  @keyframes ping{
    0%{ transform:scale(0.9); opacity:0.9 }
    70%{ transform:scale(1.6); opacity:0.15 }
    100%{ transform:scale(0.9); opacity:0.9 }
  }

  /* subtle floating bg shapes */
  .bg-dot{
    position:absolute;
    width:160px; height:160px;
    border-radius:999px;
    background: linear-gradient(180deg, rgba(255,209,102,0.06), transparent);
    filter: blur(12px);
    left:-40px; top:-40px;
    transform:rotate(8deg);
  }

</style>
</head>
<body>
  <div class="card" role="alert" aria-live="assertive">
    <div class="bg-dot" aria-hidden></div>
    <div class="pulse" aria-hidden></div>

    <div class="scene" aria-hidden>
      <div class="guard" id="guard">
        <div class="hat"></div>
        <div class="face">
          <div class="eye left"></div>
          <div class="eye right"></div>
          <div class="cheek left"></div>
          <div class="cheek right"></div>
          <div class="mouth"></div>
        </div>
        <div class="body"></div>

        <div class="stop-sign" aria-hidden>
          <div class="oct"><span>STOP</span></div>
        </div>
      </div>

      <div class="ground" aria-hidden></div>
    </div>

    <div class="content">
      <div class="warning-badge" title="Unauthorized">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden><path d="M12 2L2 7l10 5 10-5-10-5z" fill="currentColor" opacity="0.92"/></svg>
        UNAUTHORIZED ACCESS
      </div>

      <h2 class="title">Hold on — You don't have permission</h2>
      <p class="sub">This area is protected. Attempting to access without authorization is logged and may be reported.</p>

      <div class="desc">
        <strong>Why you're seeing this:</strong>
        <ul style="margin:8px 0 0 18px; padding:0; color:#dfe8ff">
          <li>You're trying to access a restricted page or resource.</li>
          <li>Your session may have expired or your role lacks permissions.</li>
          <li>Repeated unauthorized attempts are monitored by security.</li>
        </ul>
      </div>

      <div class="actions" role="group" aria-label="Actions">
        <button class="btn primary" id="goBack">Go Back</button>
        <button class="btn ghost" id="contact">Contact Admin</button>
      </div>

      <div class="small">If you believe this is a mistake, contact your administrator with the URL and timestamp shown in the support message.</div>
    </div>
  </div>

<script>
  // Simple interactivity: go back, contact admin
  document.getElementById('goBack').addEventListener('click', () => {
    // Try history back, otherwise to homepage
    if (window.history.length > 1) window.history.back();
    else window.location.href = '/';
  });

  document.getElementById('contact').addEventListener('click', () => {
    // Open mail client with prefilled subject & body (you can change the email)
    const adminEmail = 'admin@example.com'; // <-- change this
    const subject = encodeURIComponent('Unauthorized access alert');
    const body = encodeURIComponent(`I saw the unauthorized access warning page.\n\nURL: ${location.href}\nTime: ${new Date().toLocaleString()}\n\nPlease investigate.`);
    window.location.href = `mailto:${adminEmail}?subject=${subject}&body=${body}`;
  });

  // tiny animation: blink eyes & mouth expression
  (function animateFace(){
    const leftEye = document.querySelector('.eye.left');
    const rightEye = document.querySelector('.eye.right');
    const mouth = document.querySelector('.mouth');

    function blink(){
      leftEye.style.transform = 'scaleY(0.12)';
      rightEye.style.transform = 'scaleY(0.12)';
      setTimeout(()=> {
        leftEye.style.transform = '';
        rightEye.style.transform = '';
      }, 120);
    }

    function mouthFrown(){
      mouth.style.borderBottomColor = 'rgba(0,0,0,0.85)';
      mouth.style.borderBottomWidth = '6px';
      setTimeout(()=> {
        mouth.style.borderBottomColor = 'rgba(0,0,0,0.75)';
        mouth.style.borderBottomWidth = '4px';
      }, 700);
    }

    setInterval(blink, 3000 + Math.random()*2000);
    setInterval(mouthFrown, 4200 + Math.random()*1800);
  })();

  // Accessibility: focus trap & a11y hint for keyboard users
  (function a11yFocus(){
    const primary = document.getElementById('goBack');
    setTimeout(()=> primary.focus(), 300);
  })();

  // Optional: log the attempt to console and localStorage (server-side logging recommended)
  (function logAttempt(){
    try{
      const log = {
        url: location.href,
        time: new Date().toISOString(),
        userAgent: navigator.userAgent
      };
      console.warn('Unauthorized access attempt logged:', log);
      // store locally for demo; replace with fetch('/log_unauth.php', {method:'POST', body: JSON.stringify(log)})
      localStorage.setItem('unauth_last', JSON.stringify(log));
    }catch(e){}
  })();
</script>
</body>
</html>
