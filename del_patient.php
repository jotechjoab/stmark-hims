<?php
include 'conn.php';

$id=$_POST['id'];

$ye=0;


		
$update_temp=mysqli_query($conn,"DELETE FROM patient_details  WHERE id='$id'");

if($update_temp){
	echo "Patient Deleted";
}



