<?php
require 'conn.php';

$name=$_POST['name'];
$description=$_POST['description'];
$price=0;

$query=mysqli_query($conn,"INSERT INTO  theatre_procedures (name,description) VALUES('$name','$description')");

if ($query) {
	header("Location:theatre_proceedure_list.php?msg=New theatre proceedure record Hhs been created");

}else{
	header("Location:theatre_proceedure_list.php?err=Sorry System Encounter An Error ".mysqli_error($conn));
}



