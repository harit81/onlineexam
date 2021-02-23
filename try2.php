<?php include("layouts/header.php");
include("db.php");
session_start();
if(isset($_SESSION['user_email'])){
   $user_email=$_SESSION['user_email'];
  $user_id = $_SESSION['u_id'];

 $user_role=$_SESSION['role'];
$user_question=$_SESSION['no_of_question'];
   $user__level=$_SESSION['level'];
   $mysql_no_of_question_total="select user_login.role,COUNT(question.role),user_login.level,question.level
FROM 
question INNER JOIN user_login ON question.role=user_login.role WHERE user_login.u_id='$user_id'";
$result_of_total_question=mysqli_query($conn,$mysql_no_of_question_total);
$row_of_total_question=mysqli_fetch_assoc($result_of_total_question);
$total_no_of_question=$row_of_total_question['COUNT(question.role)'];
}
 ?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
<?php #include("layouts/top_nav.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<?php #include("layouts/sidebar.php"); ?>
  

  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
           <!--  <h1 class="m-0 text-dark">Question</h1> -->
           <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item">Question 1 of <?php echo $total_no_of_question;?></li>
             <!--  <li class="breadcrumb-item active">Logout</li> -->
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?php echo $user_email?></a></li>
              <li class="breadcrumb-item active">Logout</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   <!--  </div> -->
    <!-- /.content-header -->

    <!-- Main content Start Here-->


<?php #include("user_test_page.php");?>
    
    <!-- /.content End Here -->
  </div>
  <!-- /.content-wrapper -->

  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<?php include("layouts/scripts.php"); ?>
</body>
</html>
<style type="text/css">
  body{
    background-color: #E9ECEF;
  }
</style>