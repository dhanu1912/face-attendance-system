<?php
session_start();

if(!isset($_SESSION['admin'])){
header("Location: admin_login.html");
exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Attendify Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
height:100vh;
background: linear-gradient(-45deg,#000428,#004e92,#0072ff,#00c6ff);
background-size: 400% 400%;
animation: gradient 12s ease infinite;
color:white;
}

@keyframes gradient{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

.navbar{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px 60px;
background:rgba(0,0,0,0.4);
backdrop-filter:blur(10px);
}

.logo{
font-size:28px;
font-weight:700;
color:#00ffff;
}

.nav-links{
display:flex;
align-items:center;
gap:25px;
}

.nav-links a{
text-decoration:none;
color:white;
font-size:18px;
transition:0.3s;
}

.nav-links a:hover{
color:#00ffff;
}

.welcome{
font-size:16px;
opacity:0.8;
}

.main{
height:85vh;
display:flex;
justify-content:center;
align-items:center;
}

.card{
width:500px;
padding:50px;
background:rgba(255,255,255,0.1);
backdrop-filter:blur(20px);
border-radius:20px;
text-align:center;
box-shadow:0 8px 30px rgba(0,0,0,0.3);
transition:0.5s;
}

.card:hover{
transform:translateY(-10px);
box-shadow:0 12px 40px rgba(0,255,255,0.5);
}

.card h1{
font-size:35px;
margin-bottom:20px;
}

.card p{
font-size:18px;
margin-bottom:40px;
opacity:0.9;
}

.btn{
padding:15px 40px;
font-size:18px;
border:none;
border-radius:30px;
background:linear-gradient(90deg,#00ffff,#0072ff);
color:white;
cursor:pointer;
transition:0.4s;
}

.btn:hover{
transform:scale(1.1);
box-shadow:0 0 20px #00ffff;
}
</style>
</head>

<body>

<div class="navbar">
<div class="logo">Attendify</div>

<div class="nav-links">
<span class="welcome">Welcome <?php echo $_SESSION['admin']; ?></span>
<a href="view_records.php">View Records</a>
<a href="about.html">About</a>
<a href="logout.php">Logout</a>
</div>
</div>

<div class="main">
<div class="card">
<h1>Smart Face Attendance</h1>
<p>
An AI-powered face recognition system designed to automate
and secure attendance marking with real-time detection.
</p>

<button class="btn" onclick="window.location.href='camera.html'">
Start Attendance
</button>

</div>
</div>

</body>
</html>