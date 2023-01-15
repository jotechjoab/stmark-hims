<?php
require 'conn.php';

$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$category=$_POST['category'];
$username=$_POST['username'];
$password=md5($_POST['password']);
$created_by=$_POST['user_id']; 


$query=mysqli_query($conn,"INSERT INTO partners(name,phone,email,category,username,password,created_by) VALUES('$name','$phone','$email','$category','$username','$password','$created_by')");

if ($query) {
	header("Location:partners.php?msg=New Parter Record Has been Created");

}else{
	header("Location:partners.php?err=Sorry System Encounter An Error ".mysqli_error($conn));
}



