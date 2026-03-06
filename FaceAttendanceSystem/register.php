<?php
include "db.php";

if(isset($_POST['enrollmentno'])){

$enrollmentno = $_POST['enrollmentno'];
$name = $_POST['name'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$gender = $_POST['gender'];

$photo = $enrollmentno.".jpg";
$tmp = $_FILES['photo']['tmp_name'];

$check = $conn->prepare("SELECT enrollmentno FROM students WHERE enrollmentno=?");
$check->bind_param("s",$enrollmentno);
$check->execute();
$result = $check->get_result();

if($result->num_rows > 0){
header("Location: register.html?error=Student already registered");
exit;
}

move_uploaded_file($tmp,"uploads/".$photo);

$sql = "INSERT INTO students(enrollmentno,name,password,gender,photo)
VALUES('$enrollmentno','$name','$password','$gender','$photo')";

if(mysqli_query($conn,$sql)){
header("Location: register_success.html");
exit;
}else{
echo "Error";
}

}
?>