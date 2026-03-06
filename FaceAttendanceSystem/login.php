<?php
session_start();
include "db.php";
print_r($_POST);

if(isset($_POST['enrollmentno']) && isset($_POST['password'])){

    $enrollmentno = $_POST['enrollmentno'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE enrollmentno='$enrollmentno'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        if(password_verify($password, $row['password'])){

            $_SESSION['enrollmentno'] = $row['enrollmentno'];
            $_SESSION['name'] = $row['name'];

            header("Location: dashboard.php");
            exit();

        } else {
            echo "Wrong Password";
        }

    } else {
        echo "User Not Found";
    }
}
?>