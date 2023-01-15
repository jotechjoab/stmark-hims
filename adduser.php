<?php
require 'conn.php';

$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$role=$_POST['role'];
$username=$_POST['username'];
$password=md5($_POST['password']);
$created_by=$_POST['user_id']; 


$query=mysqli_query($conn,"INSERT INTO users(name,phone,email,role,username,password,created_by) VALUES('$name','$phone','$email','$role','$username','$password','$created_by')");

if ($query) {
	header("Location:users.php?msg=New User Record Has been Created");

}else{
	header("Location:users.php?err=Sorry System Encounter An Error ".mysqli_error($conn));
}



