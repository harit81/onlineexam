<?php include("layouts/header.php");
include("db.php"); 
session_start();
if(isset($_SESSION['user_email'])){
  $user_email=$_SESSION['user_email'];
  $user_id = $_SESSION['u_id'];
  $user_no_of_question=$_SESSION['no_of_question'];
}else{
  header("Location: login.php");
}
?>
<?php
$status_of_checkbox = "";
$status_of_checkbox_error ="";
if(isset($_POST['user_login_checkbox'])){
 if(isset($_POST['status'])){
  $status_of_checkbox=2;
 }else{
   $status_of_checkbox=0;
   $status_of_checkbox_error="Please Accept Terms and Conditions.";
 }
  if(empty($status_of_checkbox_error)){
  $mysql_update_in_user_login = "UPDATE user_login SET status='$status_of_checkbox' WHERE u_id='$user_id'";
    if(mysqli_query($conn,$mysql_update_in_user_login)){
      $_SESSION['session_question']='0';
         echo "<script>alert('Your test start now!');</script>";
                  echo "<script>window.open('single_page_question.php','newwindow','width=1920 height=1080');</script>";
    }
  
  }

}
?>
<body class="hold-transition sidebar-mini" style="background-color: #E9ECEF;">
<div class="wrapper">
      <div class="container-fluid" style="max-width: 60%;">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info" style="margin-top: 15%;">
              <div class="card-header">
                <h3 class="card-title">Terms and Conditions</h3>
              </div>
               <div class="card-body">
               <div class="form-group">
  <ul>
<li>Number of question : <b><?php echo $user_no_of_question;?></li></b>
<li>Question displayed per page: <b>1</b></li>
<li>Must be finished in one sitting.</li>
<li>For Multiple Choice Questions,each question has four options, and the candidate has to click the appropriate option.</li>
<li>The examinee can move to Previous, Next and unanswered questions by clicking on the buttons with respective labels displayed on screen throughout the test.</li>
<li>The answers can be changed at any time during the test and are saved on click submit.</li>
<b>Important: Do not click the “End Test” button unless you want to leave early.</b>
</ul>
</div></div>
                  
                  <form role="form" action="" method="POST">
                <div class="card-body">
                  <div class="form-group">
                   <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" 
                    name="status" value="2">
                    <label class="form-check-label" for="exampleCheck1">I accept the <b>Terms and Conditions</b></label>
                  </div>
                   <span class="text-danger"><?php echo $status_of_checkbox_error; ?></span>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="user_login_checkbox" style="float: right;">Submit</button>
                </div>
              </form>
            </div>
             </div>
           </div>
         </div>
<?php include("layouts/scripts.php"); ?>
</body>
</html>
