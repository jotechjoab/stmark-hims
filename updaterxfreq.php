<?php
include 'conn.php';

$user_id=$_POST['user'];
$visit_id=$_POST['visit_id'];
$freq=$_POST['freq'];
$id=$_POST['id'];

$ye=0;


		
$update_temp=mysqli_query($conn,"UPDATE temp_medication SET freq='$freq' WHERE id='$id'");




$get_bill=mysqli_query($conn,"SELECT t.id,s.name,t.freq,t.duration,t.qty,s.units FROM temp_medication t,medications_list s WHERE (t.created_by='$user_id' AND t.visit_id='$visit_id') AND t.item_id=s.id");
$i=1;
$total_bill=0;
if (mysqli_num_rows($get_bill)>0) {
	

	while ($bill=mysqli_fetch_array($get_bill)) {

    echo '<tr>
    <td>'.$i++.'</td>
    <td>'.$bill['name'].'</td>
    <td><input type="number " value="'.$bill['qty'].'" class="form-control" onkeyup="update_qty('.$bill['id'].',this.value,'.$visit_id.','.$user_id.')" ></td>
    <td><input type="number " value="'.$bill['freq'].'" class="form-control" onkeyup="update_freq('.$bill['id'].',this.value,'.$visit_id.','.$user_id.')" ></td>
    <td><input type="number " value="'.$bill['duration'].'" class="form-control" onkeyup="update_duration('.$bill['id'].',this.value,'.$visit_id.','.$user_id.')" ></td>
    <td>'.number_format(($bill['qty']*$bill['freq'])*$bill['duration']).' '.$bill['units'].'</td>
    <td><button class="btn btn-default" type="button" style="color:red;" onclick="del_rx('.$bill['id'].',this.value,'.$visit_id.','.$user_id.')"><i class="fa fa-trash"></i></button></td>
    </tr>';
  }
  
}else{
  echo '<tr><td colspan="7"><div class="alert alert-warning">'.mysqli_error($conn). 'No results Found</div></td></tr>';
}