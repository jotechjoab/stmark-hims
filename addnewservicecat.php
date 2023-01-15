<?php
require 'conn.php';

$name=$_POST['name'];


$query=mysqli_query($conn,"INSERT INTO pat_categories(name) VALUES('$name')");

if ($query) {
	header("Location:service_category.php?msg=New Service Category Record Has been Created");

}else{
	header("Location:service_category.php?err=Sorry System Encounter An Error ".mysqli_error($conn));
}



