<?php
session_start();

// Agar user login hai to session destroy karo
if(isset($_SESSION['enrollmentno'])){
    session_unset();
    session_destroy();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Logout - Attendify</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#000428,#004e92);
color:white;
overflow:hidden;
}

body::before{
content:'';
position:absolute;
width:500px;
height:500px;
background:radial-gradient(circle,#00ffff55,transparent 70%);
top:-150px;
left:-150px;
animation:moveGlow 6s infinite alternate;
z-index:-1;
}

@keyframes moveGlow{
0%{transform:translate(0,0);}
100%{transform:translate(200px,200px);}
}

.logout-box{
width:400px;
padding:40px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(15px);
border-radius:20px;
box-shadow:0 8px 30px rgba(0,0,0,0.4);
text-align:center;
}

.logout-box h2{
color:#00ffff;
margin-bottom:20px;
}

.logout-box p{
margin-bottom:25px;
font-size:16px;
opacity:0.9;
}

.btn{
padding:12px 40px;
border:none;
border-radius:30px;
background:linear-gradient(90deg,#00ffff,#0072ff);
color:white;
font-size:15px;
cursor:pointer;
transition:0.3s;
box-shadow:0 0 15px #00ffff80;
}

.btn:hover{
transform:scale(1.05);
box-shadow:0 0 25px #00ffff;
}
</style>

<!-- Auto Redirect After 3 Seconds -->
<script>
setTimeout(function(){
    window.location.href = "admin_login.html";
},3000);
</script>

</head>

<body>

<div class="logout-box">
<h2>Logged Out Successfully</h2>
<p>You have been securely logged out.</p>

<button class="btn" onclick="window.location.href='admin_login.html'">
Go to Login
</button>

<p style="margin-top:20px;font-size:13px;opacity:0.6;">
Redirecting to Login page...
</p>

</div>

</body>
</html>