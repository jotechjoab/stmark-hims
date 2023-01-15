<?php
require 'conn.php';

$name=$_POST['name'];
$description=$_POST['description'];
$units=$_POST['units'];
$created_by=$_POST['user_id']; 
$price=0;

$query=mysqli_query($conn,"INSERT INTO medications_list(name,description,units,unit_cost,created_by) VALUES('$name','$description','$units','$price','$created_by')");

if ($query) {
	header("Location:medication_list.php?msg=New Medication Record Has been Created");

}else{
	header("Location:medication_list.php?err=Sorry System Encounter An Error ".mysqli_error($conn));
}



