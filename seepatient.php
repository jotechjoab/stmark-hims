<?php include 'session.php'; ?>
<?php 
$visit_id= $_GET['visit_id'];
$user_id=$userdetails['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>St. Marks Surgery | See Patient</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
    <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
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
            <h1>See Patient</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">See Patient</li>
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
                <h3 class="card-title">Patient Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table  class="table table-bordered table-striped">
                  <thead>
                    <?php 

                    $patient_name="";
                    $pat_id='';
                 
                  $get_resulst=mysqli_query($conn,"SELECT p.id as pid,p.fname,p.lname,p.mname,v.date_visited,v.visit_status,v.pay_status,v.id,v.visit_note,p.address,p.dob FROM patient_details p,visits v WHERE v.patient_id=p.id AND v.id='$visit_id'");

                 $row=mysqli_fetch_array($get_resulst);
                 $birthDate = explode("-", $row['dob']);
                    //  print_r($birthDate);
  //get age from date or birthdate
  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
    ? ((date("Y") - $birthDate[0]) - 1)
    : (date("Y") - $birthDate[0]));

              $patient_name=$row['fname'].' '.$row['mname'].' '.$row['lname'];
              $pat_id=$row['pid'];
 
?>
                  
                  <tr>
                    <td>Name
                      <br><strong>
                      <?php echo ''.$row['fname'].' '.$row['mname'].' '.$row['lname'].''; ?></strong>
                    </td>
                    <td>Address
                      <br><strong>
                      <?php echo ''.$row['address'].'';?></strong>
                    </td>
                    <td>Age
                      <br><strong>
                      <?php echo $age; ?></strong>
                    </td>
                  </tr>
                  <tr>                    
                    <td>Visit Notes
                      <br><strong>
                      <?php echo ''.$row['visit_note'].'';?></strong></td>
                    <td>Visit date
                      <br><strong>
                      <?php echo ''.$row['date_visited'].'';?></strong></td>
                    <td>Visit Status
                      <br><strong>
                      <?php echo ''.$row['visit_status'].'';?></strong></td>
                  </tr>
                  </thead>
               
                
                </table>



  
              </div>
              <!-- /.card-body -->
            </div>
            
            <!-- /.card -->

      <div class="card">
              <div class="card-header">
                <h3 class="card-title">Treatment Details</h3>
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-default">Add to Theatre List</button>
                  <div class="btn-group float-right" >
                    <button type="button" class="btn btn-success btn-flat">Investigations</button>
                    <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-labrequest">Lab Request</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-scanrequest">Radiology Request</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" onclick="del_patient('.$row['id'].')">Delete Record</a>
                    </div>
                   </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="POST" action="updatevist.php">
                  <div class="row">
                <div class="form-group col-md-8">
                  <label>Prescribe Medicine here R<sub>x</sub></label>
                  <select class="select2" multiple="multiple" data-placeholder="Select Medicine For The Patient " style="width: 100%;" name="services[]" id="services">
                    <?php
                    $get_services=mysqli_query($conn,"SELECT * FROM medications_list");
                    while($serv=mysqli_fetch_array($get_services)){
                      echo '<option value="'.$serv['id'].'">'.$serv['name'].'</option>';
                    }

                     ?>
                    
                  </select>
                </div>
                <div class="col-md-4 form-group"> <br><button class="btn btn-primary btn-lg" onclick="addmedication(<?php echo $visit_id.','.$user_id; ?>)" type="button">Add Medication</button></div></div>
                <div class="row">
                  <table class="table table-bordered">
                    <thead>
                    <tr>     
                    <th>#</th>
                    <th>Medication</th>
                    <th>Qty</th>
                    <th>Frequency</th>
                    <th>Duration(Days)</th>
                    <th>Total</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="bill_details">

                      <?php 

   $get_bill=mysqli_query($conn,"SELECT t.id,s.name,s.units,t.qty,t.freq,t.duration FROM temp_medication t,medications_list s WHERE (t.created_by='$user_id' AND t.visit_id='$visit_id') AND t.item_id=s.id");
$i=1;
$total_bill=0;
if (mysqli_num_rows($get_bill)>0) {
  

  while ($bill=mysqli_fetch_array($get_bill)) {

    echo '<tr>
    <td>'.$i++.'</td>
    <td>'.$bill['name'].'</td>
    <td><input type="number" value="'.$bill['qty'].'" class="form-control" onkeyup="update_qty('.$bill['id'].',this.value,'.$visit_id.','.$user_id.')" ></td>
    <td><input type="number" value="'.$bill['freq'].'" class="form-control" onkeyup="update_freq('.$bill['id'].',this.value,'.$visit_id.','.$user_id.')" ></td>
    <td><input type="number" value="'.$bill['duration'].'" class="form-control" onkeyup="update_duration('.$bill['id'].',this.value,'.$visit_id.','.$user_id.')" ></td>
    <td>'.number_format(($bill['qty']*$bill['freq'])*$bill['duration']).' '.$bill['units'].'</td>
    <td><button class="btn btn-default" type="button" style="color:red;" onclick="del_rx('.$bill['id'].',this.value,'.$visit_id.','.$user_id.')"><i class="fa fa-trash"></i></button></td>
    </tr>';
  }
  
}else{
  echo '<tr><td colspan="7"><div class="alert alert-warning">'.mysqli_error($conn). 'No results Found</div></td></tr>';
}

                      ?>
                    </tbody>
                  </table>
                  
                </div>

                <div class="form-group col-md-12">
                  <label>Clinical Notes </label>
                  <textarea class="form-control" placeholder="Clinical Notes " name="clinical_notes" id="clinical_notes"></textarea>
                </div>

                <div class="row">
                 <div class="form-group col-md-6">
                  <label>Next Visit date </label>
                  <input type="date" name="next_visit_date" class="form-control">
                </div>
               <!--   <div class="form-group col-md-6">
                  <label>Visit Status </label>
                   <select class="form-control" name="visit_status">
                     <option selected="" disabled="">Select Status</option>
                     <option>Billed</option>
                     <option>Completed</option>
                     <option>Cancled</option>
                   </select>
                </div> -->
              </div>
                <input type="hidden" name="visit_id" value="<?php echo $visit_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $userdetails['id']; ?>">
                <input type="hidden" name="patient_id" value="<?php echo $row['pid']; ?>">
                <input type="hidden" name="last_visit_date" value="<?php echo $row['date_visited']; ?>">
              <button class="btn btn-success">Save Details</button>

          


          </form>
  
              </div>
              <!-- /.card-body -->
            </div>






         <div class="modal fade" id="modal-default" >
        <div class="modal-dialog modal-lg" >
          <div class="modal-content" >
            <div class="modal-header">
              <h4 class="modal-title">Add Patient to Theatre List</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
               <form method="POST" action="addtotheatrelist.php">
              <div class="row">
               
                  <div class="form-group col-md-12" >
                   Patient  Name
                    <input type="text" name="name" class="form-control" placeholder="Patient Name " required="" readonly value="<?php echo $patient_name; ?>">
                  </div>
                    <div class="form-group col-md-12" >
                    Diagnosis
                    <textarea type="text" name="diagnosis" class="form-control" placeholder="Diagnosis"></textarea>
                  </div>
                  <div class="form-group col-md-12" >
                  <label>Select Procedure</label>
                  <select class="form-control" style="width: 100%;" name="procedure" id="procedure">
                    <option selected disabled value=""> Select Procedure</option>
                    <?php
                    $get_services=mysqli_query($conn,"SELECT * FROM theatre_procedures");
                    while($serv=mysqli_fetch_array($get_services)){
                      echo '<option value="'.$serv['id'].'">'.$serv['name'].'</option>';
                    }

                     ?>
                    
                  </select>
                  </div>

                  <div class="form-group col-md-6">
                  <label>Select Doctor(s) </label>
                  <select class="select2" multiple="multiple" data-placeholder="Select Doctor(s)" style="width: 100%;" name="doctors[]" id="doctors">
                    <?php
                    $getdoc=mysqli_query($conn,"SELECT * FROM users WHERE role='Doctor'");
                    while($doc=mysqli_fetch_array($getdoc)){
                      echo '<option value="'.$doc['id'].'">'.$doc['name'].'</option>';
                    }

                     ?>
                    
                  </select>
                   </div>
                       <div class="form-group col-md-6">
                  <label>Select Nurse(s) </label>
                  <select class="select2" multiple="multiple" data-placeholder="Select Nurse(s)" style="width: 100%;" name="nurses[]" id="nurses">
                    <?php
                    $getnur=mysqli_query($conn,"SELECT * FROM users WHERE role='Nurse'");
                    while($nur=mysqli_fetch_array($getnur)){
                      echo '<option value="'.$nur['id'].'">'.$nur['name'].'</option>';
                    }

                     ?>
                    
                  </select>
                   </div>
                  <div class="form-group col-md-6" >
                    Proceedure Date
                    <input type="date" class="form-control" name="proc_date">
                  </div>

                   <div class="form-group col-md-6" >
                    Procedure Status
                    <select class="form-control" name="status" >
                      <option selected disabled>Select Status</option>
                      <option>Pending</option>
                      <option>Scheduled</option>
                      <option>Confirmed</option>
                    </select>
                  </div>
            
                  
                    <input type="hidden" name="user_id" value="<?php echo $userdetails['id'];?>">
                     <input type="hidden" name="pat_id" value="<?php echo $pat_id;?>">
                      <input type="hidden" name="visit_id" value="<?php echo $visit_id;?>">
                 
                <div class="form-group col-md-12" style="text-align: center;" >
                  <br>
                    <button type="submit" class="btn btn-primary">Save Service</button>
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



        <div class="modal fade" id="modal-labrequest" >
        <div class="modal-dialog modal-lg" >
          <div class="modal-content" >
            <div class="modal-header">
              <h4 class="modal-title">Lab requrest</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
               <form method="POST" action="newrequest.php">
              <div class="row">
               
                  <div class="form-group col-md-12" >
                   Patient  Name
                    <input type="text" name="name" class="form-control" placeholder="Patient Name " required="" readonly value="<?php echo $patient_name;?>">
                  </div>
                 
                       <div class="form-group col-md-12">
                  <label>Select Lab Test(s) </label>
                  <select class="select2" multiple="multiple" data-placeholder="Select Lab test(s)" style="width: 100%;" name="tests[]" id="tests">
                    <?php
                    $getlab=mysqli_query($conn,"SELECT * FROM services WHERE category_id='1'");
                    while($lab=mysqli_fetch_array($getlab)){
                      echo '<option value="'.$lab['id'].'">'.$lab['name'].'</option>';
                    }

                     ?>
                    
                  </select>
                   </div>

                      <div class="form-group col-md-12" >
                  <label>Select Service Providing Partner</label>
                  <select class="form-control" style="width: 100%;" name="provider" id="provider">
                    <option selected disabled value=""> Select Service Providing Partner</option>
                    <?php
                    $get_prov=mysqli_query($conn,"SELECT * FROM partners where category='1'");
                    while($prov=mysqli_fetch_array($get_prov)){
                      echo '<option value="'.$prov['id'].'">'.$prov['name'].'</option>';
                    }

                     ?>
                    
                  </select>
                  </div>


                      <div class="form-group col-md-12" >
                    Request Notes 
                    <textarea type="text" name="requestnotes" id="labnotes" class="form-control" ></textarea>
                  </div>
                 
                  
                    <input type="hidden" name="user_id" value="<?php echo $userdetails['id'];?>">
                     <input type="hidden" name="pat_id" value="<?php echo $pat_id;?>">
                      <input type="hidden" name="visit_id" value="<?php echo $visit_id;?>">
                 
                <div class="form-group col-md-12" style="text-align: center;" >
                  <br>
                    <button type="submit" class="btn btn-primary">Save Lab Request</button>
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



         <div class="modal fade" id="modal-scanrequest" >
        <div class="modal-dialog modal-lg" >
          <div class="modal-content" >
            <div class="modal-header">
              <h4 class="modal-title">Radiology requrest</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
               <form method="POST" action="newrequest.php">
              <div class="row">
               
                  <div class="form-group col-md-12" >
                   Patient  Name
                    <input type="text" name="name" class="form-control" placeholder="Patient Name " required="" readonly value="<?php echo $patient_name; ?>">
                  </div>
                 
                       <div class="form-group col-md-12">
                  <label>Select  Procedure(s) </label>
                  <select class="select2" multiple="multiple" data-placeholder="Select Procedure(s)" style="width: 100%;" name="procedure[]" id="procedure">
                    <?php
                    $getscan=mysqli_query($conn,"SELECT * FROM services WHERE category_id='2'");
                    while($scan=mysqli_fetch_array($getscan)){
                      echo '<option value="'.$scan['id'].'">'.$scan['name'].'</option>';
                    }

                     ?>
                    
                  </select>
                   </div>

                      <div class="form-group col-md-12" >
                  <label>Select Service Providing Partner</label>
                  <select class="form-control" style="width: 100%;" name="provider" id="provider">
                    <option selected disabled value=""> Select Service Providing Partner</option>
                    <?php
                    $get_prov=mysqli_query($conn,"SELECT * FROM partners where category='2'");
                    while($prov=mysqli_fetch_array($get_prov)){
                      echo '<option value="'.$prov['id'].'">'.$prov['name'].'</option>';
                    }

                     ?>
                    
                  </select>
                  </div>


                      <div class="form-group col-md-12" >
                    Request Notes 
                    <textarea type="text" name="requestnotes" id="scannotes" class="form-control" placeholder="Request Notes"></textarea>
                  </div>
                 
                  
                    <input type="hidden" name="user_id" value="<?php echo $userdetails['id'];?>">
                     <input type="hidden" name="pat_id" value="<?php echo $pat_id;?>">
                      <input type="hidden" name="visit_id" value="<?php echo $visit_id;?>">
                 
                <div class="form-group col-md-12" style="text-align: center;" >
                  <br>
                    <button type="submit" class="btn btn-primary">Save Radiology Request</button>
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
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
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


   //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    // Summernote
    $('#scannotes').summernote()
    $('#labnotes').summernote()
    $('#clinical_notes').summernote()




  function newvisit(id,name){
      $("#modal-visits").modal("show");
      $("#pname").val(name);
      $("#patient_id").val(id);
  }

  function addmedication(visit,user_id){

      var service=$("#services").val();

       $.post("getrx.php", {visit_id: visit,user: user_id,service: service}, function(result){
    $("#bill_details").html(result);
  });

  }


  function update_qty(id,qty,visit,user_id){
 $.post("updaterxqty.php", {id: id,qty: qty,visit_id:visit,user:user_id}, function(result){
    $("#bill_details").html(result);
  });
  }

   function update_freq(id,freq,visit,user_id){
 $.post("updaterxfreq.php", {id: id,freq: freq,visit_id:visit,user:user_id}, function(result){
    $("#bill_details").html(result);
  });
  }

    function update_duration(id,dur,visit,user_id){
 $.post("updaterxduration.php", {id: id,dur: dur,visit_id:visit,user:user_id}, function(result){
    $("#bill_details").html(result);
  });
  }

  function del_rx(id,qty,visit,user_id){
    let r = confirm("Are You sure want to remove this item from them list?");
    if (r==true) {
 $.post("delrx.php", {id: id,qty: qty,visit_id:visit,user:user_id}, function(result){
    $("#bill_details").html(result);
  });}
  }

</script>
</body>
</html>
