<?php
require 'conn.php';

$bp=$_POST['bp'];
$pr=$_POST['pr'];
$spo2=$_POST['spo2'];
$asa_class=$_POST['asa_class'];
$lignocaine=$_POST['lignocaine'];
$adrenaline=$_POST['adrenaline'];
$bupivacaine=$_POST['bupivacaine'];
$regional_block=$_POST['regional_block'];
$general_anesthesia=$_POST['general_anesthesia'];
$proc_date=$_POST['proc_date'];
$created_by=$_POST['user_id']; 
$proc_id=$_POST['proc_id'];
$post_op_inst=$_POST['post_op_inst'];


$query=mysqli_query($conn,"INSERT INTO anesthesia_report (proc_id,bp,pr,spo2,asa_class,lignocaine,adrenaline,bupivacaine,regional_block,general_anesthesia,post_operative_inst,created_by) VALUES('$proc_id','$bp','$pr','$spo2','$asa_class','$lignocaine','$adrenaline','$bupivacaine','regional_block','$general_anesthesia','$post_op_inst','$created_by')");

if ($query) {
	header("Location:procedure_details.php?msg=New Vital Record Has been Created&proc_id=".$proc_id);

}else{
	header("Location:procedure_details.php?err=Sorry System Encounter An Error ".mysqli_error($conn).'&proc_id='.$proc_id);
}



