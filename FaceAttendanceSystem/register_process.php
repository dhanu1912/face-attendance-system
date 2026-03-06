<?php
session_start();
include "db.php";

if(isset($_POST['login'])){
    $enrollmentno = $_POST['enrollmentno'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE enrollmentno='$enrollmentno' AND password='$password'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['enrollmentno'] = $row['enrollmentno'];
        $_SESSION['name']   = $row['name'];

        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid Login'); window.location='login.php';</script>";
    }
}
?>