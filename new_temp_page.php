<?php include("layouts/header.php");
include("db.php"); 
session_start();
if(isset($_SESSION['user_email'])){
  $user_email=$_SESSION['user_email'];
  $user_id = $_SESSION['u_id'];
}else{
  header("Location: login.php");
}
?>
<?php
$qualification_detail = $marks = $phone ="";
$qualification_detail_error =  $marks_error = $phone_error ="";
if(isset($_POST['user_login'])){


  $qualification_detail=$_POST['qualification_detail'];
  $marks=$_POST['marks'];
  $phone=$_POST['phone'];
 
  if(empty($qualification_detail)){
    $qualification_detail_error = "enter qualification detail.";
  }
  if(empty($marks)){
    $marks_error = "enter marks.";
  }
  if(empty($phone)){
    $phone_error = "enter phone no.";
  }
  if(empty($qualification_detail_error)&&empty($marks_error)&&empty($phone_error)){
  $mysql_update_in_user_login = "UPDATE user_login SET qualification='$qualification_detail',marks='$marks',phone='$phone'  WHERE u_id='$user_id'";
    if(mysqli_query($conn,$mysql_update_in_user_login)){
         echo "<script>alert('Qualification Details has been added successfully');</script>";
                  echo "<script>window.open('try.php','_self');</script>";
    }
  
  }

}

?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
<?php  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  

  <!-- Content Wrapper. Contains page content -->
 
    <!-- Content Header (Page header) -->
   
    <!-- /.content-header -->

    <!-- Main content Start Here-->
 <div class="row">
                  <div class="col-12 col-md-12">
                    
                    <nav class="navbar navbar-expand navbar-primary navbar-dark">
                      <!-- Left navbar links -->
                      <ul class="navbar-nav">
                       
                        <li class="nav-item d-none d-sm-inline-block">
                          <a href="#" class="nav-link"><?php echo $_SESSION['user_email'];?></a>
                        </li>
                        <?php
if(isset($_SESSION['user_email'])){

?>
                        <li class="nav-item d-none d-sm-inline-block">
                          <a href="logout.php" class="nav-link">Logout</a>
                        </li>
<?php }?>                        
                      </ul>

                      <!-- SEARCH FORM -->
                     
                    </nav>
                  </div>
                
                    </nav>
                  </div>
                </div>  


    
    <!-- /.content End Here -->
  </div>
  <!-- /.content-wrapper -->


        
    <!-- /.content-header -->

    <!-- Main content Start Here-->

      <div class="container-fluid" style="max-width: 60%;">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info" style="margin-top: 100px;">
              <div class="card-header">
                <h3 class="card-title">Enter Your Qualification Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Qualification Detail</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter qualification" name="qualification_detail" value="<?php echo $qualification_detail;?>">
                  </div>
                   <span class="text-danger"><?php echo $qualification_detail_error; ?></span>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Marks(%)</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="60%" min="1" name="marks" value="<?php echo $marks;?>">
                  </div>
                   <span class="text-danger"><?php echo $marks_error; ?></span>
                 <div class="form-group">
                    <label for="exampleInputPassword1">Phone No</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="9876543210" name="phone" value="<?php echo $phone;?>">
                  </div>
                   <span class="text-danger"><?php echo $phone_error; ?></span>
                      
                 
               
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="user_login">Submit</button>
                </div>
              </form>
            </div>
             </div>
            <!-- /.card -->

            <!-- Form Element sizes -->
       
   


    
    <!-- /.content End Here -->

  <!-- /.content-wrapper -->

 
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<?php include("layouts/scripts.php"); ?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

</body>
</html>
