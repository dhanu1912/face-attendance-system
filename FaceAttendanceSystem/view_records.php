<?php
session_start();
include 'db.php';

$student = $_GET['student'] ?? '';
$month = $_GET['month'] ?? date('Y-m');

$first_day = date("Y-m-01", strtotime($month));
$last_day  = date("Y-m-t", strtotime($month));
?>

<!DOCTYPE html>
<html>
<head>

<title>View Attendance Records</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
min-height:100vh;
background: linear-gradient(-45deg,#000428,#004e92,#0072ff,#00c6ff);
color:white;
display:flex;
justify-content:center;
align-items:flex-start;
padding:40px;
}

/* animation hata diya hai */

.container{
width:100%;
max-width:1100px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(20px);
border-radius:20px;
padding:40px;
box-shadow:0 10px 40px rgba(0,0,0,0.4);
}

h2{
text-align:center;
margin-bottom:25px;
font-size:32px;
}

form{
display:flex;
justify-content:center;
align-items:center;
gap:15px;
margin-bottom:30px;
flex-wrap:wrap;
}

select,input,button{
padding:12px 16px;
border:none;
border-radius:10px;
font-size:15px;
}

select,input{
background:rgba(255,255,255,0.15);
color:white;
}

button{
background:linear-gradient(90deg,#00ffff,#0072ff);
color:white;
cursor:pointer;
font-weight:600;
transition:0.3s;
}

button:hover{
transform:scale(1.05);
box-shadow:0 0 15px #00ffff;
}

table{
width:100%;
border-collapse:collapse;
overflow:hidden;
border-radius:10px;
}

th{
background:rgba(0,0,0,0.5);
padding:14px;
}

td{
padding:12px;
background:rgba(255,255,255,0.05);
}

th,td{
text-align:center;
border-bottom:1px solid rgba(255,255,255,0.1);
}

tr:hover td{
background:rgba(0,255,255,0.1);
}

/* STATUS COLORS */

.present{
background:rgba(34,197,94,0.4);
}

.late{
background:rgba(234,179,8,0.5);
color:black;
}

.absent{
background:rgba(239,68,68,0.5);
}

</style>

</head>

<body>

<div class="container">

<h2>Attendance Records</h2>

<form method="GET">

<select name="student" required>

<option value="">Select Student</option>

<?php
$students = mysqli_query($conn,"SELECT enrollmentno,name FROM students");

while($row = mysqli_fetch_assoc($students)){
?>

<option value="<?php echo $row['enrollmentno']; ?>"
<?php if($student==$row['enrollmentno']) echo "selected"; ?>>

<?php echo $row['name']." (".$row['enrollmentno'].")"; ?>

</option>

<?php } ?>

</select>

<input type="month" name="month" value="<?php echo $month; ?>">

<button type="submit">View</button>

</form>


<?php

if($student!=""){

$present_count = 0;
$absent_count = 0;

$query = "
SELECT * FROM attendance_records
WHERE enrollmentno='$student'
AND date BETWEEN '$first_day' AND '$last_day'
ORDER BY date ASC
";

$result = mysqli_query($conn,$query);

echo "<table>";

echo "<tr>
<th>Date</th>
<th>Time</th>
<th>Event</th>
<th>Status</th>
<th>Source</th>
<th>Remark</th>
</tr>";

while($row = mysqli_fetch_assoc($result)){

$class="present";

if($row['event_type']=="LATE ENTRY")
$class="late";

if($row['status']=="Present"){
$present_count++;
}else{
$absent_count++;
}

echo "<tr class='$class'>";

echo "<td>".$row['date']."</td>";
echo "<td>".$row['time']."</td>";
echo "<td>".$row['event_type']."</td>";
echo "<td>".$row['status']."</td>";
echo "<td>".$row['source']."</td>";
echo "<td>".$row['remark']."</td>";

echo "</tr>";
}

echo "</table>";

echo "<div style='margin-top:20px;font-size:18px;text-align:right;'>";
echo "Total Present : <b>$present_count</b> &nbsp;&nbsp; | &nbsp;&nbsp; ";
echo "Total Absent : <b>$absent_count</b>";
echo "</div>";

}

?>

</div>

</body>
</html>