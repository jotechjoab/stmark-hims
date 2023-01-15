<?php include 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>St. Marks Surgery | Visit Details</title>

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
            <h1>Visit Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Visit Details</li>
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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Visit Details</h3>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Visit Date</th>
                    <th>Visite Notes</th>
                    <th>Visit Status</th>
                    <th>Pay Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                 <?php 
                 
                  $get_resulst=mysqli_query($conn,"SELECT p.fname,p.lname,p.mname,v.date_visited,v.visit_status,v.pay_status,v.id,v.visit_note FROM patient_details p,visits v WHERE v.patient_id=p.id ORDER BY v.created_at DESC");

                  if (mysqli_num_rows($get_resulst)>0) {
                    $i=1;
                    while ($row=mysqli_fetch_array($get_resulst)) {

                  
                  $visit_status="";

                  if ($row['visit_status']=="Completed") {
                    $visit_status='';
                  }else if($row['visit_status']=="Billed"){

                  }else{
                    $visit_status='<a class="dropdown-item" href="seepatient.php?visit_id='.$row['id'].'">See Patient</a>';
                  }
 
                      echo '
                        <tr>
                    <td>'.$i++.'</td>
                    <td>'.$row['fname'].' '.$row['mname'].' '.$row['lname'].'</td>
                    <td>'.$row['date_visited'].'</td>
                    <td>'.$row['visit_note'].'</td>
                    <td>'.$row['visit_status'].'</td>
                    <td>'.$row['pay_status'].'</td>
                    <td>
                    <div class="btn-group">
                    <button type="button" class="btn btn-success btn-flat">Action</button>
                    <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      '.$visit_status.'
                      <a class="dropdown-item" href="visit_report.php?visit_id='.$row['id'].'">Visit Report </a>
                      <div class="dropdown-divider"></div>
                      <!--<a class="dropdown-item" href="#">Delete Record</a>-->
                    </div>
                   </div>
                  </td>
                      </tr>

                      ';
                    }
                  }

                 ?>   
                 
                  </tbody>
                  <tfoot>
                  <tr>
                   <th>#</th>
                    <th>Name</th>
                    <th>Visit Date</th>
                    <th>Visite Notes</th>
                    <th>Visit Status</th>
                    <th>Pay Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>



   <div class="modal fade" id="modal-visits" >
        <div class="modal-dialog" >
          <div class="modal-content" style="width: 900px;">
            <div class="modal-header">
              <h4 class="modal-title">Create New Visit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
               <form method="POST" action="createvisit.php">
              <div class="row">
               
                  <div class="form-group col-md-12" >
                    Patient Name
                    <input type="text" name="name" class="form-control" placeholder="Patient Name " readonly="" id="pname">
                  </div>
                  <div class="form-group col-md-12" >
                    Visit Notes 
                    <textarea type="text" name="visit_notes" class="form-control" placeholder="Visit Notes"></textarea>
                  
                  </div>
                  <div class="form-group col-md-12" >
                    Visit Date
                    <input type="date" name="visit_date" class="form-control" placeholder="Visit Date" required="">
                  </div>
                  <div class="form-group col-md-12" >
                   Visit Status
                   <select class="form-control" name="visit_status">
                     <option selected="" disabled="">Select Status</option>
                     <option>Scheduled</option>
                     <option>Confirmed</option>
                   </select>
                  </div>
                 
                    <input type="hidden" name="user_id" value="<?php echo $userdetails['id'];?>">
                    <input type="hidden" name="patient_id" id="patient_id">
                 
                <div class="form-group col-md-6" >
                  <br>
                    <button type="submit" class="btn btn-primary">Create Visit</button>
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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

  function newvisit(id,name){
      $("#modal-visits").modal("show");
      $("#pname").val(name);
      $("#patient_id").val(id);
  }
</script>
</body>
</html>
