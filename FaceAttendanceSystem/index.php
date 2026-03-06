<?php
include "db.php";
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
background: linear-gradient(135deg,#000428,#004e92);
color:white;
min-height:100vh;
}

/* NAVBAR */
.navbar{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px 60px;
background:rgba(0,0,0,0.4);
backdrop-filter:blur(10px);
}

.logo{
font-size:30px;
font-weight:700;
color:#00ffff;
}

.nav-links a{
margin-left:30px;
text-decoration:none;
color:white;
font-size:18px;
transition:0.3s;
}

.nav-links a:hover{
color:#00ffff;
}

/* HERO SECTION */
.hero{
height:80vh;
display:flex;
flex-direction:column;
justify-content:center;
align-items:center;
text-align:center;
}

.hero h1{
font-size:60px;
margin-bottom:20px;
}

.hero p{
font-size:22px;
margin-bottom:40px;
}

.btn{
padding:18px 60px;
font-size:20px;
border:none;
border-radius:40px;
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
<a href="register.html">Register</a>
<a href="login.html">Login</a>
</div>
</div>

<div class="hero">
<h1>Smart Face Attendance</h1>
<p>AI Powered Automatic Recognition System</p>

<button class="btn" onclick="window.location.href='login.html'">
Start Attendance
</button>

</div>

</body>
</html>