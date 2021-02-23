<?php include("layouts/header.php");
include("db.php"); 
 session_start();
if(isset($_SESSION['user_email'])){
     $user_email=$_SESSION['user_email'];
     $user_id = $_SESSION['u_id'];
     $user_role=$_SESSION['role'];
     $user_question=$_SESSION['no_of_question'];
     $user__level=$_SESSION['level'];
}
 
 ?>
  <body class="hold-transition login-page">
<div class="login-box" style="width: 50%;">
<div class="card">
    <div class="card-body ">
        <section class="content">
        <div class="card-header">
 <?php
 if(isset($_SESSION['new_question_id'])){
   $new_question_id=$_SESSION['new_question_id'];
 $mysql_get_user_test_details="SELECT question.role,user_login.role,question.q_id,question.question,question.option_1,
 question.option_2,question.option_3,question.option_4
FROM 
user_login INNER JOIN question ON question.role=user_login.role";
$result_question_details=mysqli_query($conn,$mysql_get_user_test_details);
if(mysqli_num_rows($result_question_details)>0){
$row_fetch_question=mysqli_fetch_assoc($result_question_details);
$question_id=$row_fetch_question['q_id']; 
$question=$row_fetch_question['question'];
$option1=$row_fetch_question['option_1'];
$option2=$row_fetch_question['option_2'];
$option3=$row_fetch_question['option_3'];
$option4=$row_fetch_question['option_4'];

?>
          <h3 class="card-title">Question: <?php echo $question;?></h3>
        </div>
        <div class="card-body">
          <form name="" action="user_test_result_submit.php?question_id=<?php echo $new_question_id;?>" method="POST">
            <input type="hidden" name="question_id" value="<?php echo $question_id;?>">
          <input type="radio" name="option" value="<?php echo $option1;?>">
           <?php echo htmlspecialchars($option1);?><br>
           <input type="radio" name="option" value="<?php echo $option2;?>">
           <?php echo htmlspecialchars($option2);?><br>
           <input type="radio" name="option" value="<?php echo $option3;?>">
           <?php echo htmlspecialchars($option3);?><br>
           <input type="radio" name="option" value="<?php echo $option4;?>">
           <?php echo htmlspecialchars($option4);?><br>
          <button type="submit" class="btn btn-primary" name="select_question_data">Submit</button>
        </form>
         <?php }}?>
        </div>
 <div>
 </div>
  </section>
 </div>
  </div>
</div>
<!-- /.login-box -->
<?php #include("layouts/footer.php");?>
<!-- jQuery -->
<?php include("layouts/scripts.php");?>

</body>
</html>
