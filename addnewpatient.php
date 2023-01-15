<?php
require 'conn.php';

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$mname=$_POST['mname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$dob=$_POST['dob'];
$address=$_POST['address'];
$nok=$_POST['nok'];
$nok_phone=$_POST['nok_phone'];
$nok_rship=$_POST['nok_rship'];
$marital_status=$_POST['marital_status'];
$hiv_status=$_POST['hiv_status'];
$level_of_education=$_POST['level_of_education'];
$occupation=$_POST['occupation'];
$alcohol=$_POST['alcohol'];
$tobaco=$_POST['tobaco'];
$allergies=$_POST['allergies'];
$trauma=$_POST['trauma'];
$admission=$_POST['admission'];
$surgery=$_POST['surgery'];
$created_by=$_POST['user_id']; 
$comorbodies=$_POST['comorbidities'];

$query=mysqli_query($conn,"INSERT INTO patient_details(fname,mname,lname,phone,email,dob,address,nok,nok_phone,nok_rship,marital_status,level_of_education,occupation,alcohol,tobaco,hiv,allergies,trauma,admission,surgery,comorbodies,created_by) VALUES('$fname','$mname','$lname','$phone','$email','$dob','$address','$nok','$nok_phone','$nok_rship','$marital_status','$level_of_education','$occupation','$alcohol','$tobaco','$hiv_status','$allergies','$trauma','$admission','$surgery','$comorbodies','$created_by')");

if ($query) {
	header("Location:patients.php?msg=Patient Record Has been Created");

}else{
	header("Location:patients.php?err=Sorry System Encounter An Error ".mysqli_error($conn));
}



