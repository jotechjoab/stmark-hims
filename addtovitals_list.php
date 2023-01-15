<?php
require 'conn.php';

$name=$_POST['name'];
$units=$_POST['units'];
$created_by=$_POST['user_id']; 
$price=0;

$query=mysqli_query($conn,"INSERT INTO vitals_list(name,units) VALUES('$name','$units')");

if ($query) {
	header("Location:vitals_list.php?msg=New Vital Record Has been Created");

}else{
	header("Location:vitals_list.php?err=Sorry System Encounter An Error ".mysqli_error($conn));
}



