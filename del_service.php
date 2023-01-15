<?php
include 'conn.php';

$id=$_POST['id'];

$ye=0;


		
$update_temp=mysqli_query($conn,"DELETE FROM services  WHERE id='$id'");

if($update_temp){
	echo "Service Deleted";
}



