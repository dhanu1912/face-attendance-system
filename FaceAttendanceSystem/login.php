<?php
session_start();
include "db.php";

if(isset($_POST['enrollmentno']) && isset($_POST['password'])){

    $enrollmentno = $_POST['enrollmentno'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE enrollmentno='$enrollmentno'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        if($password == $row['password']){

            $_SESSION['enrollmentno'] = $row['enrollmentno'];
            $_SESSION['name'] = $row['name'];

            header("Location: dashboard.php");
            exit();

        }else{
            echo "Wrong Password";
        }

    }else{
        echo "User Not Found";
    }
}
?>