<?php

include "db.php";

error_reporting(E_ALL);
ini_set('display_errors',1);

// POST se enrollment number lena
$enrollmentno = $_POST['enrollmentno'] ?? '';

if(!$enrollmentno){
    echo "Invalid Data";
    exit;
}

// Time config
date_default_timezone_set("Asia/Kolkata");
$current_time = date("H:i");
$current_datetime = date("Y-m-d H:i:s");

// Entry time
$entry_start = "00:00";
$entry_end   = "23:59";

if($current_time >= $entry_start && $current_time <= $entry_end){

$date = date("Y-m-d");
$time = date("H:i:s");
$event_type = "ENTRY";
$status = "Present";
$source = "Face Recognition";
$remark = "Entry attendance marked";
$created_at = date("Y-m-d H:i:s");

}else{
    echo "Attendance allowed only between 09:30 AM to 10:30 AM";
    exit;
}

// Duplicate check
$check = $conn->prepare("SELECT enrollmentno FROM attendance_records 
WHERE enrollmentno=? AND event_type=? AND DATE(created_at)=CURDATE()");

$check->bind_param("ss",$enrollmentno,$event_type);
$check->execute();
$result = $check->get_result();

if($result->num_rows > 0){
    echo "ENTRY already marked today";
    exit;
}

// Insert
$insert = $conn->prepare("INSERT INTO attendance_records
(enrollmentno, date, time, event_type, status, source, remark, created_at)
VALUES (?,?,?,?,?,?,?,?)");

$insert->bind_param("ssssssss",
$enrollmentno,
$date,
$time,
$event_type,
$status,
$source,
$remark,
$created_at
);

if($insert->execute()){

    // student mobile fetch
    $getMobile = mysqli_query($conn,"SELECT mobile,name FROM students WHERE enrollmentno='$enrollmentno'");
    $data = mysqli_fetch_assoc($getMobile);

    $mobile = $data['mobile'];
    $name = $data['name'];

    echo "ENTRY marked successfully";
}else{
    echo "Error: ".$conn->error;
}