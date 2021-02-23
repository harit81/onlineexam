<?php include("layouts/header.php");
include('function_rand.php');
include('db.php'); ?>
<?php
$user_email =  $level_of_user = $no_of_question = $role = "";
$user_email_error  = $level_of_user_error = $no_of_question_error ="";
if(isset($_POST['user_detail_update'])){
  $user_email=$_POST['user_email'];
  $level_of_user=$_POST['level_of_user'];
  $no_of_question=$_POST['no_of_question'];
  $role=$_POST['role'];
  if(empty($user_email)){
    $user_email_error = "enter user email.";
  }
  if(empty($level_of_user)){
    $level_of_user_error = "enter level of user.";
  }
  if(empty($no_of_question)){
    $no_of_question_error = "enter no of question.";
  }
    $mysql_get_no_of_question="SELECT COUNT(question) FROM question WHERE role='$role' AND level='$level_of_user'";
    $result_no_of_question=mysqli_query($conn,$mysql_get_no_of_question);
    $row_fetch_no_of_question=mysqli_fetch_assoc($result_no_of_question);
    $count_of_question=$row_fetch_no_of_question['COUNT(question)'];
      if($count_of_question>=$no_of_question){
      if(empty($user_email_error)&&empty($level_of_user_error)&&empty($no_of_question_error)){
      $user_id=$_GET['u_id'];
      $mysql_update_in_user_login = "UPDATE  user_login SET user_email='$user_email',role='$role',level='$level_of_user',no_of_question='$no_of_question' WHERE u_id='$user_id'";
      if(mysqli_query($conn,$mysql_update_in_user_login)){
      echo "<script>alert('User data has been updated successfully');</script>";
      echo "<script>window.open('view_user_by_role.php','_self');</script>";
      }
  }}else{
        echo "<script>alert('Please select correct level and no of question.');</script>";

       
  }
}
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
<?php include("layouts/top_nav.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<?php include("layouts/sidebar.php"); ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Interviewee Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Interviewee Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content Start Here-->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Interviewee Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
<?php
if(isset($_GET['u_id'])){
  $user_id=$_GET['u_id'];
  $mysql_get_user_data="SELECT * FROM user_login WHERE u_id='$user_id'";
  $result_get_user_data=mysqli_query($conn,$mysql_get_user_data);
  $row_get_user_data=mysqli_fetch_assoc($result_get_user_data);
  $user_current_email = $row_get_user_data['user_email'];
  $user_current_role = $row_get_user_data['role'];
  $mysql_get_user_role="SELECT * FROM role WHERE role_id='$user_current_role'";
  $result_role_data=mysqli_query($conn,$mysql_get_user_role);
  $row_role_date=mysqli_fetch_assoc($result_role_data);
  $user_current_level = $row_get_user_data['level'];
  $user_no_of_question = $row_get_user_data['no_of_question'];
  $user_current_role = $row_get_user_data['role'];
  $mysql_get_role_data = "SELECT * FROM role WHERE role_id='$user_current_role'";
  $result_get_role_data = mysqli_query($conn, $mysql_get_role_data);
  $row_get_role_data = mysqli_fetch_assoc($result_get_role_data);
  $role_name_of_admin = $row_get_role_data['role_name'];
  $current_role=$row_get_user_data['role'];
}
?>              
             <form role="form" method="POST" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="user_email" value="<?php echo $user_current_email;?>">
                  </div>
                   <span class="text-danger"><?php echo $user_email_error; ?></span>
                
                      <!-- select -->
                      <div class="form-group">
                        <label>Select Role</label>
                        <select class="custom-select" name="role">
                          <option value="<?php echo $current_role; ?>"><?php echo $role_name_of_admin;?></option>  
                            <?php
                $mysql_get_role_data = "SELECT * FROM role";
                $result_get_role_data = mysqli_query($conn, $mysql_get_role_data);
                if (mysqli_num_rows($result_get_role_data) > 0) {
                    while ($row_get_role_data = mysqli_fetch_assoc($result_get_role_data)) {
                        ?>
                        <option value="<?php echo $row_get_role_data['role_id'];?>"><?php echo $row_get_role_data['role_name']; ?></option>
                        <?php
                    }
                }  ?>
  </select>
                      </div>
                    <!--   <span class="text-danger"><?php echo $roleerror; ?></span> -->
                       <div class="form-group">
                        <label>Select Level of Interviewee</label>
                        <select class="form-control" name="level_of_user">
                           <option value="<?php echo $user_current_level;?>"><?php if($user_current_level==1){echo 'Easy';}elseif($user_current_level==2){echo 'Medium';}else{
                            echo "Hard";
                           }?></option>
                          <option value="1">Easy</option>
                          <option value="2">Medium</option>
                          <option value="3">Hard</option>
                        </select>
                      </div>
                         <span class="text-danger"><?php echo $level_of_user_error; ?></span>
                      <div class="form-group">
                        <label>Select no of Question</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter No of Question" name="no_of_question" min="1" value="<?php echo $user_no_of_question;?>">
                 </div>
                  <span class="text-danger"><?php echo $no_of_question_error; ?></span>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="user_detail_update">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            <!-- Form Element sizes -->
       
    </section>    


    
    <!-- /.content End Here -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("layouts/footer.php"); ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<?php include("layouts/scripts.php"); ?>
</body>
</html>