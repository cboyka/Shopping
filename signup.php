<?php
session_start();
$connect = mysqli_connect("localhost","root","","testing");

if(isset($_POST["login"]))
{

$idcode = "Select * from `admin_login`";
$idresult = mysqli_query($connect, $idcode);
$currentid = mysqli_num_rows($idresult);

$newid = $currentid + 1;
$name = $_POST["member_name"];
$pass = md5($_POST["member_password"]);
$gender = $_POST["gender"];

$query= "Insert into `admin_login` values ('".$newid."','".$name."','".$pass."','".$gender."')";
$result = mysqli_query($connect, $query);

$_SESSION["admin_name"] = $name;
//header("location:login.php");
}
echo '<script> window.location="homepage.php";</script>';
?>
