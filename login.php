<?php include("layouts/header.php");
include("db.php"); ?>
<?php
$user_name = $password = "";
$user_name_error = $password_error = $wrong_enter = ""; 

if(isset($_POST['user_login'])){
$user_name=$_POST['user_name'];
$password=$_POST['password'];

if(empty($user_name)){
  $user_name_error="enter user name.";
 }
 if(!empty($user_name)){
 $mysql_get_username="SELECT * FROM user_login WHERE user_name='$user_name'";
  $result_of_get_username=mysqli_query($conn,$mysql_get_username);
  if(mysqli_num_rows($result_of_get_username)==1){
    }else{
    $user_name_error="enter user name not found."; 
  }}
if(empty($password)){
  $password_error="enter password.";
}
if(empty($user_name_error)&&empty($password_error)){
  $mysql_check_login_username_password="SELECT * FROM user_login WHERE user_name='$user_name' AND password='$password'";
  $result_login_username_password=mysqli_query($conn,$mysql_check_login_username_password);
  $row_count_of_login_username_password=mysqli_num_rows($result_login_username_password);
  $row_fetch_login_username_password=mysqli_fetch_assoc($result_login_username_password);
  if($row_count_of_login_username_password==1){
    $user_email=$row_fetch_login_username_password['user_email'];
    $u_id=$row_fetch_login_username_password['u_id'];
    $user_role=$row_fetch_login_username_password['role'];
    $user_no_of_question=$row_fetch_login_username_password['no_of_question'];
    $user_question_id=$row_fetch_login_username_password['question_id'];
    $user_level=$row_fetch_login_username_password['level'];
    $user_status=$row_fetch_login_username_password['status'];
    $user_exam_status=$row_fetch_login_username_password['exam_status'];
    session_start();
    $_SESSION['user_email']=$user_email;
    $_SESSION['u_id']=$u_id;
    $_SESSION['role']=$user_role;
    $_SESSION['no_of_question']=$user_no_of_question;
    $_SESSION['level']=$user_level;
    $_SESSION['question_id']=$user_question_id;

    if($user_exam_status==0){
    if($user_status==0){
      header("Location: user_detail_form.php"); 
    }elseif($user_status==1){
      header("Location: user_term_conditions.php");  
    }else{
       header("Location: single_page_question.php"); 
    }}else{
       echo "<script>alert('You cannot login.');</script>";
       echo "<script>window.open('login.php','_self');</script>";
    }
  }else {
             $wrong_enter="please enter correct user name and password";
        }
}}
?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>LED</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="user_name" value="<?php echo $user_name;?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <span class="text-danger"><?php echo $user_name_error; ?></span>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <span class="text-danger"><?php echo $password_error; ?></span>
        <span class="text-danger"><?php echo $wrong_enter; ?></span>
          <!-- /.col -->
          <div class="input-group mb-3">
            <button type="submit" class="btn btn-primary btn-block" name="user_login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->

<?php include("layouts/scripts.php"); ?>
</body>
</html>