<?php
require 'conn.php';

$vital=$_POST['vital'];
$rec_date=$_POST['rec_date'];
$rec_time=$_POST['rec_time'];
$created_by=$_POST['user_id']; 
$proc_id=$_POST['proc_id'];
$value=$_POST['value'];
$date_time=$rec_date.' '.$rec_time.':00';

$query=mysqli_query($conn,"INSERT INTO anesthesia_vitals(vital,value,date_time,created_by,proc_id) VALUES('$vital','$value','$date_time','$created_by','$proc_id')");

if ($query) {
	header("Location:procedure_details.php?msg=New Vital Record Has been Created&proc_id=".$proc_id);

}else{
	header("Location:procedure_details.php?err=Sorry System Encounter An Error ".mysqli_error($conn));
}



