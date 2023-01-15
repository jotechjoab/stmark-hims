<?php include 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>St. Marks Surgery   | Visit Report</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <!-- Navbar -->
 <?php include 'nav.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<?php 
include 'aside.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Visit Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Visit Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           <?php 
            if (isset($_GET['msg'])) {
              echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$_GET['msg'].'</div>';
            }

             if (isset($_GET['err'])) {
              echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$_GET['err'].'</div>';
            }


           ?>



              <div class="invoice p-3 mb-3">
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

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="print_visit_report.php?visit_id=<?php echo $visit_id; ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right" onclick="submitpayment(<?php echo $bill_id.','.$pat['balance'].','.$userdetails['id'];?>)"><i class="far fa-envelope"></i> Send To Patient
                    Payment
                  </button>
                  
                </div>
              </div>
            </div>
           



        <div class="modal fade" id="modal-default" >
        <div class="modal-dialog modal-xl" >
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Clear Bill</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
               <form method="POST" action="submitpayment.php">
              <div class="row">
               
                  <div class="form-group col-md-6" >
                    Amount To Pay 
                    <input type="text" name="amount_to_pay" id="amount_to_pay" class="form-control" placeholder="Amount to Pay  " readonly="">
                  </div>
                  <div class="form-group col-md-6" >
                    Cash Tendered
                    <input type="number" name="cash_tendered" id="cash_tendered" class="form-control" placeholder="Cash Tendered" required="" onkeyup="entercash()">
                  </div>
                  <div class="form-group col-md-6" >
                    Change to Client  
                    <input type="number" name="change" id="change" class="form-control" placeholder="Change to Client  " readonly="">
                  </div>
                  <div class="form-group col-md-6" >
                    Remaining Balance 
                    <input type="number" name="balance" id="balance" class="form-control" placeholder=" Remaining Balance " readonly="" >
                  </div>
                  <input type="hidden" name="user_id" id="user_id">
                  <input type="hidden" name="bill_id" id="bill_id">
                <div class="form-group col-md-12" style="text-align: center;">
                  <br>
                    <button type="submit" id="submit" class="btn btn-primary">Recieve Payment</button>
                  </div>
                </div>
            </form>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'footer.php'; ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  function submitpayment(id,amount_to_pay,user_id){
      $("#modal-default").modal("show");
      $("#bill_id").val(id);
      $("#amount_to_pay").val(amount_to_pay);
      $("#user_id").val(user_id);

  }


  function entercash(){
    let change= 0
    let cash = $("#cash_tendered").val();
    let balance =0;
    let amount =  $("#amount_to_pay").val();

    change=cash-amount;
    if (change<0) {
      // $("#submit").attr("disabled", true);
       $("#change").val(0);
    }else
    {
      $("#change").val(change);
      //$("#submit").attr("disabled", false);
    }

    balance=amount-cash;
    if (balance<0) {
      $("#balance").val(0);
    }else{
      $("#balance").val(balance);
    }


  }
</script>
</body>
</html>
