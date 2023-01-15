<?php
include 'conn.php';

$user_id=$_POST['user'];
$proc_id=$_POST['proc_id'];
$service=$_POST['service'];
$ye=0;

foreach ($service as $key => $value) {
	

		$check=mysqli_query($conn,"SELECT * FROM  temp_med_theatre  WHERE proc_id='$proc_id' AND item_id='$value'");

		if (mysqli_num_rows($check)>0) {
			
			$ye++;
		}else{
		
			$insert_temp=mysqli_query($conn,"INSERT INTO  temp_med_theatre (proc_id,item_id,freq,qty,duration,created_by) VALUES ('$proc_id','$value',1,1,1,'$user_id')");
		}
	


}


if ($ye>0) {
	echo '<tr><td colspan="7"><div class="alert alert-warning"> '.$ye.' Item(s) are already on the Prescription <div></td></tr>';
}

$get_bill=mysqli_query($conn,"SELECT t.id,s.name,t.freq,t.duration,t.qty,s.units FROM  temp_med_theatre  t,medications_list s WHERE (t.created_by='$user_id' AND t.proc_id='$proc_id') AND t.item_id=s.id");
$i=1;
$total_bill=0;
if (mysqli_num_rows($get_bill)>0) {
	

	while ($bill=mysqli_fetch_array($get_bill)) {

    echo '<tr>
    <td>'.$i++.'</td>
    <td>'.$bill['name'].'</td>
    <td><input type="number" value="'.$bill['qty'].'" class="form-control" onkeyup="update_qty('.$bill['id'].',this.value,'.$proc_id.','.$user_id.')" ></td>
    <td><input type="number" value="'.$bill['freq'].'" class="form-control" onkeyup="update_freq('.$bill['id'].',this.value,'.$proc_id.','.$user_id.')" ></td>
    <td><input type="number" value="'.$bill['duration'].'" class="form-control" onkeyup="update_duration('.$bill['id'].',this.value,'.$proc_id.','.$user_id.')" ></td>
    <td>'.number_format(($bill['qty']*$bill['freq'])*$bill['duration']).' '.$bill['units'].'</td>
    <td><button class="btn btn-default" type="button" style="color:red;" onclick="del_rx('.$bill['id'].',this.value,'.$proc_id.','.$user_id.')"><i class="fa fa-trash"></i></button></td>
    </tr>';
  }
  
}else{
  echo '<tr><td colspan="7"><div class="alert alert-warning">'.mysqli_error($conn). 'No results Found</div></td></tr>';
}
