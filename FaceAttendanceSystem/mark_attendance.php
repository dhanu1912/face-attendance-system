<?php

include "db.php";
print_r($_POST);

$enrollment = $_POST['enrollmentno'];

$date = date("Y-m-d");
$time = date("H:i:s");


$check = mysqli_query($conn,"
SELECT * FROM attendance_records 
WHERE enrollmentno='$enrollmentno' 
AND date='$date'
");


if(mysqli_num_rows($check)==0)
{

mysqli_query($conn,"
INSERT INTO attendance_records
(enrollmentno,date,time,status,source)

VALUES

('$enrollmentno','$date','$time','Present','face recognition')

");

echo "Attendance Marked";

}
else
{
echo "Already Marked";
}

?>