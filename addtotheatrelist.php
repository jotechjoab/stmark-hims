<?php
require 'conn.php';

$name=$_POST['name'];
$diagnosis=$_POST['diagnosis'];
$procedure=$_POST['procedure'];
$pat_id=$_POST['pat_id'];
$visit_id=$_POST['visit_id'];
$created_by=$_POST['user_id'];
$doctors=implode(',', $_POST['doctors']);	
$nurses=implode(',', $_POST['nurses']);
$proc_date=$_POST['provider'];
$status=$_POST['status'];

$query=mysqli_query($conn,"INSERT INTO `theatre_assignments`( `visit_id`, `proceedure_id`, `diagnosis`, `surgions`, `nurses`, `surge_on`, `status`, `created_by`) VALUES ('$visit_id','$procedure','$diagnosis','$doctors','$nurses','$proc_date','$status','$created_by')");

if ($query) {
	header("Location:seepatient.php?msg=New Theatre Listing Record Has been Created&visit_id=".$visit_id);

}else{
	header("Location:seepatient.php?err=Sorry System Encounter An Error ".mysqli_error($conn)."&visit_id=".$visit_id);
}



