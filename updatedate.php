<?php
require 'conn.php';
$id=$_POST['proc_id'];
$pro_date=$_POST['pro_date'];
$created_by=$_POST['user_id']; 

$query=mysqli_query($conn,"UPDATE  theatre_assignments  SET surge_on='$pro_date' WHERE id='$id'");

if ($query) {
	header("Location:pendingtheatrelist.php?msg=Procedure Record Has been Updated");

}else{
	header("Location:pendingtheatrelist.php?err=Sorry System Encounter An Error ".mysqli_error($conn));
}



