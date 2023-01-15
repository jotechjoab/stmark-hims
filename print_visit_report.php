<?php include 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>St. Marks Surgery | Visit Report Print</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
  <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-tooth"></i> St. Marks Surgery.
                    <small class="float-right">Date: <?php echo date("d/M/Y")?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>St. Marks Surgery</strong><br>
                    Galaxy House ,Ntinda Bukoto<br>
                    Kampala - Uganda<br>
                    Phone: +256  753592577 / +256 772 592 677<br>
                    Email: abalungi@gmail.com
                  </address>
                </div>
             <?php 

                $visit_id=$_GET['visit_id'];
                $get_pat=mysqli_query($conn,"SELECT p.id,p.fname,p.lname,p.mname,p.address,p.phone,p.email,v.id as visit_id,v.visit_note,v.clinical_notes,v.visit_status FROM patient_details p,visits v WHERE (v.patient_id=p.id AND v.id='$visit_id')");
                $pat=mysqli_fetch_array($get_pat);
                 ?>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $pat['fname'].' '.$pat['mname'].' '.$pat['lname'];?></strong><br>
                    <?php echo $pat['address']; ?><br>
                    Phone: <?php echo $pat['phone']; ?><br>
                    Email: <?php echo $pat['email']; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Visit Status.  <?php echo $pat['visit_status']; ?></b><br>
                  <br>
                  <b>Visit ID:</b> <?php echo $pat['visit_id']; ?><br>
                  <b>Patient No.:</b> <?php echo $pat['id']; ?>
                </div>
                <!-- /.col -->
                  <hr>
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <h3>Clinical Details </h3>
                <div class="col-12 table-responsive">
                  Visit Notes : <b><?php echo $pat['visit_note'];  ?> </b><br>
                  <br>
                  Clinical Notes : <b><?php echo $pat['clinical_notes'];  ?> </b><br>
                <br>
              
                <h3>Treatment</h3>
                  <table class="table table-striped">
                    <thead>
                    <tr> <th> #</th>
                      <th>Service</th>
                      <th colspan="2">Description</th>
                      <th>Qty</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                   <?php
                   
                   $get_bill=mysqli_query($conn,"SELECT s.name,s.description,d.cost,d.qty FROM services s,bill_details d,bills b WHERE (s.id=d.item_id AND d.bill_id=b.id) AND b.visit_id='$visit_id'");
                   $i=1;
                   $bill_amount=0;
                   while($bill=mysqli_fetch_array($get_bill)){
                    $bill_amount+=$bill['cost']*$bill['qty'];

                    echo '

                    <tr>
                      <td>'.$i++.'</td>
                      <td>'.$bill['name'].'</td>
                      <td colspan="2">'.$bill['description'].'</td>
                      <td>'.$bill['qty'].'</td>
                      
                    </tr>
                    ';
                   }


                    ?>   
                    
               
                   
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Bill Details </p>
                

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    <b>St. Marks Surgery</b> Pleasant & Comfortable
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Bill Amount:</th>
                        <td>UGX <?php echo number_format($bill_amount); ?></td>
                      </tr>
                      <tr>
                        <?php 
                        $get_b=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM bills where visit_id='$visit_id'"));
                        ?>
                        <th>Amount Paid :</th>
                        <td>UGX <?php echo number_format($get_b['amount_paid']); ?></td>
                      </tr>
                      <tr>
                        <th>Balance:</th>
                        <td>UGX <?php echo number_format($get_b['balance']); ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
