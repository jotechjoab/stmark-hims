<?php
include 'conn.php';

$user_id=$_POST['user'];
$visit_id=$_POST['visit_id'];
$qty=$_POST['qty'];
$id=$_POST['id'];

$ye=0;


		
$update_temp=mysqli_query($conn,"DELETE FROM temp_bill  WHERE id='$id'");




$get_bill=mysqli_query($conn,"SELECT t.id,s.name,t.cost,t.qty FROM temp_bill t,services s WHERE (t.created_by='$user_id' AND t.visit_id='$visit_id') AND t.item_id=s.id");
$i=1;
$total_bill=0;
if (mysqli_num_rows($get_bill)>0) {
	

	while ($bill=mysqli_fetch_array($get_bill)) {

		$total_bill+=($bill['cost']*$bill['qty']);
		echo '<tr>
		<td>'.$i++.'</td>
		<td>'.$bill['name'].'</td>
		<td><input type="text " value="'.$bill['qty'].'" class="form-control" onkeyup="update_bill('.$bill['id'].',this.value,'.$visit_id.','.$user_id.')" ></td>
		<td>'.number_format($bill['cost']).'</td>
		<td>'.number_format($bill['cost']*$bill['qty']).'</td>
		<td><button class="btn btn-default" type="button" style="color:red;" onclick="del_bill('.$bill['id'].',this.value,'.$visit_id.','.$user_id.')"><i class="fa fa-trash"></i></button></td>
		</tr>';
	}
	echo '<tr>
			<th colspan="4">Total Bill</th>
			<th colspan="2">'.number_format($total_bill).'</th>
		</tr>';
}