<?php include("layouts/header.php");
include('function_rand.php');
include('db.php'); ?>
<?php
$question_id_for_user=0;
$user_email  = $role = $level_of_user = $no_of_question ="";
$user_email_error = $role_error = $level_of_user_error = $no_of_question_error ="";
$count_of_question;
if(isset($_POST['user_detail_submit'])){
  $user_name = getName($n);
  $password = getPass($p);
  $user_email=$_POST['user_email'];
  $level_of_user=$_POST['level_of_user'];
  $no_of_question=$_POST['no_of_question'];
  $role=$_POST['role'];
  if(empty($user_email)){
    $user_email_error = "enter user email.";
  }
  if(empty($role)){
    $role_error = "select role of interviewee.";
  }
  if(empty($level_of_user)){
    $level_of_user_error = "enter level of user.";
  }
  if(empty($no_of_question)){
    $no_of_question_error = "enter no of question.";
  }else{
    $mysql_get_no_of_question="SELECT COUNT(question) FROM question WHERE role='$role' AND level='$level_of_user'";
    $result_no_of_question=mysqli_query($conn,$mysql_get_no_of_question);
    $row_fetch_no_of_question=mysqli_fetch_assoc($result_no_of_question);
    $count_of_question=$row_fetch_no_of_question['COUNT(question)'];

    $mysql_check_user_email_exists_or_not="SELECT * FROM user_login WHERE user_email='$user_email'";
    $result_check_user_email_exists_or_not=mysqli_query($conn,$mysql_check_user_email_exists_or_not);
     $email_exists_or_not_count=mysqli_num_rows($result_check_user_email_exists_or_not);
     $row_fetch_user_exists=mysqli_fetch_assoc($result_check_user_email_exists_or_not);
     $date=$row_fetch_user_exists['date'];
     $date_format=date('d/m/Y',strtotime($date));
    if($email_exists_or_not_count!=0){
       echo "<script>alert('Email Already exists.Created Date is : $date_format');</script>";
           //echo "<script>window.open('create_user.php','_self');</script>";
      // }else{
    }
    if($count_of_question>=$no_of_question){
    if(empty($user_email_error)&&empty($level_of_user_error)&&empty($no_of_question_error)&&empty($role_error)){
    $mysql_get_question_id="SELECT * FROM question WHERE role='$role' AND level='$level_of_user' LIMIT $no_of_question";
        $result_question_id=mysqli_query($conn,$mysql_get_question_id);
        if(mysqli_num_rows($result_question_id)>0){
          $new_array=array();
          while($row_fetch_question_id=mysqli_fetch_assoc($result_question_id)){
        $id_of_question = $row_fetch_question_id['q_id'];
          array_push($new_array, $id_of_question);
        }
        shuffle($new_array);
          $question_id_for_user=implode(',',$new_array);
         // $question_id_for_user;
    }
      $mysql_insert_in_user_login = "INSERT INTO user_login(user_name,password,user_email,no_of_question,question_id,level,role)"
            . "VALUES('$user_name','$password','$user_email','$no_of_question','$question_id_for_user','$level_of_user','$role')";
    if(mysqli_query($conn,$mysql_insert_in_user_login)){
          echo "<script>alert('User has been added successfully');</script>";
           echo "<script>window.open('view_user_by_role.php','_self');</script>";
    }
  
  }
     }else{
      echo "<script>alert('Please select correct level and no of question.');</script>";

     }
  //}
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
            <h1 class="m-0 text-dark">Add Interviewee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Interviewee</li>
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
                <h3 class="card-title">Add Interviewee</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             <form role="form" method="POST" action="#">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="user_email" value="<?php echo $user_email;?>">
                  </div>
                   <span class="text-danger"><?php echo $user_email_error; ?></span>
                
                      <!-- select -->
                     <div class="form-group">
                        <label>Select Role of Interviewee</label>
                         <select class="custom-select" name="role">
                          <option value="">Select Role</option>
                          <?php
                $mysql_get_role_data = "SELECT * FROM role";
                $result_get_role_data = mysqli_query($conn, $mysql_get_role_data);
                if (mysqli_num_rows($result_get_role_data) > 0) {
                    while ($row_get_role_data = mysqli_fetch_assoc($result_get_role_data)) {
                        ?>
                        <option value="<?php echo $row_get_role_data['role_id'];?>"><?php echo $row_get_role_data['role_name']; ?></option>
                        <?php
                    }
                }
                ?>
  </select>
                      </div>
                         <span class="text-danger"><?php echo $role_error; ?></span>
                      <div class="form-group">
                        <label>Select Level of Interviewee</label>
                        <select class="form-control" name="level_of_user">
                           <option value="0">Select Level</option>
                          <option value="1">Easy</option>
                          <option value="2">Medium</option>
                          <option value="3">Hard</option>
                        </select>
                      </div>
                         <span class="text-danger"><?php echo $level_of_user_error; ?></span>
                      <div class="form-group">
                        <label>Select no of Question</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter No of Question" name="no_of_question" min="1" value="<?php echo $no_of_question;?>">
                        <!-- <input type="hidden" name="role" value="10"> -->
                 </div>
                  <span class="text-danger"><?php echo $no_of_question_error; ?></span>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="user_detail_submit">Submit</button>
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