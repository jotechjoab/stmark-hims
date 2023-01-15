<?php
require 'conn.php';
$proc_id=$_POST['proc_id'];
$user_id=$_POST['user_id'];




	$get_serv=mysqli_query($conn,"SELECT * FROM temp_med_theatre WHERE proc_id='$proc_id'");
	
while ($serv=mysqli_fetch_array($get_serv)) {

	// $price=$serv['cost'];
	$item=$serv['item_id'];
	$qty=$serv['qty'];
	$freq=$serv['freq'];
	$duration=$serv['duration'];
	

	$insert_billdetails=mysqli_query($conn,"INSERT INTO drugs_fluid (item,qty,freq,duration,proc_id,created_by) VALUES('$item','$qty','$freq','$duration','$proc_id','$user_id')");

}

$del=mysqli_query($conn,"DELETE FROM temp_med_theatre WHERE proc_id='$proc_id'");
if($del){

header("Location:procedure_details.php?proc_id=".$proc_id."&msg=Prescription has been created ".mysqli_error($conn));

}else{
	header("Location:procedure_details.php?err=An Error Happened ".mysqli_error($conn)."&proc_id=".$proc_id);
}



