<?php 
require 'conn.php';

$id=$_POST['patient_id'];
$visit_notes=$_POST['visit_notes'];

$allowed =  array('png' ,'jpg','jpeg','pdf');
$filename = $_FILES['results']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if(!in_array($ext,$allowed) ) {
    echo 'Sorry File Type Is not Allow Kindly select .Png,.Jpg,.Jpeg Files ';
}else{
	
		$upload=move_uploaded_file($_FILES['results']['tmp_name'],"Uploads/requests/{$_FILES['results']['name']}");
		$photo="Uploads/requests/{$_FILES['results']['name']}";
		if ($upload) {
			$sql=mysqli_query($conn,"UPDATE requests set request_result_url='$photo',results_notes='$visit_notes',status='Completed' WHERE id='$id'");
			
			if ($sql) {
				header("Location:labrequests.php?msg=Results have been uploaded");
			}else{
				header("Location:labrequests.php?err=Results couldnt be uploaded".mysqli_error($conn));
			}
		}

	}