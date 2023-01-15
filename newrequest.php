<?php
require 'conn.php';

$name=$_POST['name'];
$requestnotes=$_POST['requestnotes'];
$pat_id=$_POST['pat_id'];
$visit_id=$_POST['visit_id'];
$created_by=$_POST['user_id'];
$services=''; 
$service_type='';
if (isset($_POST['tests'])) {
	
$services=implode(',', $_POST['tests']);
$service_type=1;
}

if (isset($_POST['procedure'])) {
	
$services=implode(',', $_POST['procedure']);
$service_type=2;
}
$provider=$_POST['provider'];


$query=mysqli_query($conn,"INSERT INTO `requests`(`request_type`, `requested_services`, `request_notes`, `receiptient`, `patient_id`, `visit_id`, `created_by`) VALUES ('$service_type','$services','$requestnotes','$provider','$pat_id','$visit_id','$created_by')");

if ($query) {
	header("Location:seepatient.php?msg=New Request Record Has been Created&visit_id=".$visit_id);

}else{
	header("Location:seepatient.php?err=Sorry System Encounter An Error ".mysqli_error($conn)."&visit_id=".$visit_id);
}



