<?php
require 'conn.php';

$name=$_POST['name'];
$description=$_POST['description'];
$category=$_POST['category'];
$created_by=$_POST['user_id']; 
$price=0;

$query=mysqli_query($conn,"INSERT INTO services(name,description,category_id,cost,created_by) VALUES('$name','$description','$category','$price','$created_by')");

if ($query) {
	header("Location:services.php?msg=New Service Record Has been Created");

}else{
	header("Location:services.php?err=Sorry System Encounter An Error ".mysqli_error($conn));
}



