<?php include 'session.php'; ?>
<?php 
$proc_id= $_GET['proc_id'];
$user_id=$userdetails['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>St. Marks Surgery | Procedure Details</title>

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
            <h1>Procedure Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Procedure Details</li>
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

                       <div class="btn-group float-right" >
                    <button type="button" class="btn btn-warning btn-flat">Post Operative Care</button>
                    <button type="button" class="btn btn-warning btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default">Post Operative Instrunctions</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-drugsfludes">Drugs & Fluids </a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-drugsfludes">Record Vitals </a>
                    </div>
                   </div>
                    <div class="btn-group float-right" >
                    <button type="button" class="btn btn-success btn-flat">Anesthesia</button>
                    <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default">Anaethesia Report</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-anesth_vitals">Record Vitals </a>
                    </div>
                   </div>
                    <div class="btn-group float-right" >
                    <button type="button" class="btn btn-primary btn-flat">Action</button>
                    <button type="button" class="btn btn-primary btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                       <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-scanrequest">Upload Concent Form</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default">Post Operative Instructions</a>
                      
      
                    </div>
                   </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table  class="table table-bordered table-striped">
                  <thead>
                    <?php 

                    $patient_name="";
                    $pat_id='';
                 
                  $get_resulst=mysqli_query($conn,"SELECT v.id as visit_id,d.id,p.fname,p.mname,p.lname,p.dob,p.address,p.nok,p.sex,p.nok_phone,d.diagnosis,t.name as procedures,d.surge_on,d.status FROM theatre_assignments d,theatre_procedures t,patient_details p ,visits v WHERE (p.id=v.patient_id AND d.visit_id=v.id) AND d.proceedure_id=t.id AND d.id='$proc_id'");

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
                    <td>Next Of Kin
                      <br><strong>
                      <?php echo ''.$row['nok'].'';?></strong></td>
                    <td>Next Of Kin Contact 
                      <br><strong>
                      <?php echo ''.$row['nok_phone'].'';?></strong></td>
                    <td>Gender
                      <br><strong>
                      <?php echo ''.$row['sex'].'';?></strong></td>
                  </tr>
                  </thead>
               
                
                </table>



  
              </div>
              <!-- /.card-body -->
            </div>



                   <div class="card">
              <div class="card-header">
                <h3 class="card-title">Operation Notes</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table  class="table table-bordered table-striped">
                  <thead>
      
                  
                  <tr>
                    <td>Diagnosis
                      <br><strong>
                      <?php echo ''.$row['diagnosis']; ?></strong>
                    </td>
                    <td>Procedure
                      <br><strong>
                      <?php echo ''.$row['procedures'].'';?></strong>
                    </td>
                    <td>Surge On
                      <br><strong>
                      <?php echo $row['surge_on']; ?></strong>
                    </td>
                  </tr>
                  <tr>                    
                    <td>Doctors
                      <?php  $get_docs=mysqli_query($conn,"SELECT name FROM users WHERE id IN(SELECT surgions FROM theatre_assignments WHERE id='$proc_id')"); ?>
                      <br><strong>
                      <?php while($docs=mysqli_fetch_array($get_docs)){
                        echo $docs['name'].', ';
                      }?></strong></td>
                    <td>Nurses
                      <?php  $get_nur=mysqli_query($conn,"SELECT name FROM users WHERE id IN(SELECT nurses FROM theatre_assignments WHERE id='$proc_id')"); ?>
                      <br><strong>
                      <?php while($nur=mysqli_fetch_array($get_nur)){
                        echo $nur['name'].', ';
                      }?></strong></td>
                    <td>Procedure Status
                      <br><strong>
                      <?php echo ''.$row['status'].'';?></strong></td>
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
             
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Prescription</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Anesthesia details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Post Operative Care</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Post Operative Instructions</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-home1">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                   <table class="table table-bordered">
                    <thead>
                    <tr>     
                    <th>#</th>
                    <th>Medication</th>
                    <th>Qty</th>
                    <th>Frequency</th>
                    <th>Duration(Days)</th>
                    <th>Total</th>
                    <th>Created At</th>
                    <th>Created By</th>
                    </tr>
                    </thead>
                    <tbody >

                      <?php 

   $get_bill=mysqli_query($conn,"SELECT t.id,s.name as items,s.units,t.qty,t.freq,t.duration,u.name,t.created_at FROM drugs_fluid t,medications_list s,users u WHERE (t.proc_id='$proc_id' AND t.item=s.id) AND t.created_by=u.id");
$i=1;
$total_bill=0;
if (mysqli_num_rows($get_bill)>0) {
  

  while ($bill=mysqli_fetch_array($get_bill)) {

    echo '<tr>
    <td>'.$i++.'</td>
    <td>'.$bill['items'].'</td>
    <td>'.$bill['qty'].'</td>
    <td>'.$bill['freq'].'</td>
    <td>'.$bill['duration'].'</td>
    <td>'.number_format(($bill['qty']*$bill['freq'])*$bill['duration']).' '.$bill['units'].'</td>
    <td>'.$bill['created_at'].'</td>
    <td>'.$bill['name'].'</td>
    </tr>';
  }
  
}else{
  echo '<tr><td colspan="7"><div class="alert alert-warning">'.mysqli_error($conn). 'No results Found</div></td></tr>';
}

                      ?>
                    </tbody>
                  </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                     Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                     Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                     Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
  
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
               <form method="POST" action="addanesthesia_report.php">
              <div class="row">
               
                  <div class="form-group col-md-12" >
                   Patient  Name
                    <input type="text" name="name" class="form-control" placeholder="Patient Name " required="" readonly value="<?php echo $patient_name; ?>">
                  </div>
                  <h6>Pre-Operative Assessment</h6><br>
                  <div class="row">
                    <div class="form-group col-md-3" >
                   BP
                    <div class="input-group mb-3">
                  <input type="text" class="form-control" name="bp">
                  <div class="input-group-append">
                    <span class="input-group-text" >mm/Hg</span>
                  </div>
                </div>
                  </div>
                      <div class="form-group col-md-3" >
                   PR
                    <div class="input-group mb-3">
                  <input type="text" class="form-control" name="pr">
                  <div class="input-group-append">
                    <span class="input-group-text" >BPM</span>
                  </div>
                </div>

                  </div>
                      <div class="form-group col-md-3" >
                   SpO<sub>2</sub>
                    <div class="input-group mb-3">
                  <input type="text" class="form-control" name="spo2">
                  <div class="input-group-append">
                    <span class="input-group-text" >%</span>
                  </div>
                </div>
                  </div>
                      <div class="form-group col-md-3" >
                   ASA Class
                    <div class="input-group mb-3">
                  <input type="text" class="form-control" name="asa_class">
                  <div class="input-group-append">
                    <span class="input-group-text" ></span>
                  </div>
                </div>
                  </div>
                </div>
                <h6>Anesthetics</h6>
                 <div class="row">
                    <div class="form-group col-md-4" >
                   Lignocaine
                    <div class="input-group mb-3">
                  <input type="text" class="form-control" name="lignocaine">
                </div>
                  </div>
                      <div class="form-group col-md-4" >
                  Adrenaline
                    <div class="input-group mb-3">
                  <input type="text" class="form-control" name="adrenaline">
                
                </div>

                  </div>
                      <div class="form-group col-md-4" >
                  Bupivacaine
                    <div class="input-group mb-3">
                  <input type="text" class="form-control" name="bupivacaine">
                </div>
                  </div>
                  
                    <div class="form-group col-md-12" >
                    Regional Block
                    <input type="text" name="regional_block" class="form-control" placeholder="Regional Block">
                  </div>
                   <div class="form-group col-md-12" >
                    General Anesthesia
                    <input type="text" name="general_anesthesia" class="form-control" placeholder="General Anesthesia">
                  </div>
                  <div class="form-group col-md-12" >
                  Post Operative Instrunction
                  <textarea class="form-control" name="post_op_inst" placeholder="Post Operative Instructions"></textarea>
                  </div>

                  
                  <div class="form-group col-md-12" >
                    Proceedure Date
                    <input type="date" class="form-control" name="proc_date">
                  </div>

                 
            
                  
                    <input type="hidden" name="user_id" value="<?php echo $userdetails['id'];?>">
                     <input type="hidden" name="pat_id" value="<?php echo $pat_id;?>">
                      <input type="hidden" name="proc_id" value="<?php echo $proc_id;?>">
                 
                <div class="form-group col-md-12" style="text-align: center;" >
                  <br>
                    <button type="submit" class="btn btn-primary">Save Anesthesia Report</button>
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



        <div class="modal fade" id="modal-drugsfludes" >
        <div class="modal-dialog modal-lg" >
          <div class="modal-content" >
            <div class="modal-header">
              <h4 class="modal-title">Prescribe Medicine here R<sub>x</sub></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
                  <form method="POST" action="save_proc_rx.php">
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
                <div class="col-md-4 form-group"> <br><button class="btn btn-primary btn-lg" onclick="addmedication(<?php echo $proc_id.','.$user_id; ?>)" type="button">Add Medication</button></div></div>
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

   $get_bill=mysqli_query($conn,"SELECT t.id,s.name,s.units,t.qty,t.freq,t.duration FROM temp_med_theatre t,medications_list s WHERE (t.created_by='$user_id' AND t.proc_id='$proc_id') AND t.item_id=s.id");
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

                      ?>
                    </tbody>
                  </table>
                  
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
              
                <input type="hidden" name="proc_id" value="<?php echo $proc_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $userdetails['id']; ?>">
                <input type="hidden" name="patient_id" value="<?php echo $row['pid']; ?>">
                <input type="hidden" name="last_visit_date" value="<?php echo $row['date_visited']; ?>">
              <button class="btn btn-success">Save Details</button>

          


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



         <div class="modal fade" id="modal-anesth_vitals" >
        <div class="modal-dialog modal-lg" >
          <div class="modal-content" >
            <div class="modal-header">
              <h4 class="modal-title">Anesthesia Vitals</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
               <form method="POST" action="addnewanesth_vitals.php">
              <div class="row">
               
                  <div class="form-group col-md-12" >
                   Patient  Name
                    <input type="text" name="name" class="form-control" placeholder="Patient Name " required="" readonly value="<?php echo $patient_name; ?>">
                  </div>
                 
                       <div class="form-group col-md-12">
                  <label>Select  Vital</label>
                  <select class="form-control"  style="width: 100%;" name="vital" >
                    <?php
                    $getscan=mysqli_query($conn,"SELECT * FROM vitals_list");
                    while($scan=mysqli_fetch_array($getscan)){
                      echo '<option value="'.$scan['id'].'" onclick="set_v_unit(\''.$scan['units'].'\')">'.$scan['name'].'</option>';
                    }

                     ?>
                    
                  </select>
                   </div>
                   <div class="form-group col-md-12" >
                   Value
                    <div class="input-group mb-3">
                  <input type="text" class="form-control" name="value">
                  <div class="input-group-append">
                    <span class="input-group-text" id="anesth_v_units"></span>
                  </div>
                </div>
                  </div>
                    <div class="form-group col-md-6" >
                   Date 
                  <input type="date" name="rec_date" class="form-control">
                  </div>

                  <div class="form-group col-md-6" >
                   Time
                  <input type="time" name="rec_time" class="form-control">
                  </div>

                 
                  
                    <input type="hidden" name="user_id" value="<?php echo $userdetails['id'];?>">
                     <input type="hidden" name="pat_id" value="<?php echo $pat_id;?>">
                      <input type="hidden" name="proc_id" value="<?php echo $proc_id;?>">
                 
                <div class="form-group col-md-12" style="text-align: center;" >
                  <br>
                    <button type="submit" class="btn btn-primary">Save Vital</button>
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

  function addmedication(proc_id,user_id){

      var service=$("#services").val();

       $.post("add_proc_rx.php", {proc_id: proc_id,user: user_id,service: service}, function(result){
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

  function set_v_unit(units){
    $('#anesth_v_units').html(units)
  }

</script>
</body>
</html>
