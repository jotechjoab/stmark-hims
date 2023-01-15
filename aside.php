  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">St. Marks Surgery</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $userdetails['name']; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="home.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
           
          </li>
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
               Patient Details
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="patients.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Patients</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="visits.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Visits</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="bookings.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Patients On Schedule</p>
                </a>
              </li>
              
            </ul>
          </li>

                <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
               Investigations
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="labrequests.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lab Requests</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="radiologyrequest.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Radiology Requests</p>
                </a>
              </li>  
            </ul>
          </li>
                <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-heartbeat"></i>
              <p>
               Theatre
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pendingtheatrelist.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Theatre List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="payments.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Confirmed Theatre List </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="payments_report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Proceedures</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="bills_report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Theatre  Report</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
               Accounts
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="bills.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bills</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="payments.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="payments_report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payments Report</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="bills_report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bills Report</p>
                </a>
              </li>
              
            </ul>
          </li>
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>
               Settings
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="services.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Services</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="service_category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Service Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="theatre_proceedure_list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Theatre Proceedure List</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="medication_list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Medication List</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="vitals_list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vitals List</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="partners.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Partners</p>
                </a>
              </li>
          
              
            </ul>
          </li>
          
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>