<?php
include("layouts/header.php");
include("db.php");

$option_empty_error=""; 
$result_answer=0;
session_start();
if(isset($_SESSION['user_email'])){
if(isset($_GET['page'])){
$page=$_GET['page'];
$_SESSION['session_question']=$page-1;
	 $user_id=$_SESSION['u_id'];
	$mysql_get_previous_question_answer="SELECT * FROM test_question_ans WHERE user_id='$user_id' AND question_id='$page' LIMIT 1";
	$result_get_previous_question_answer=mysqli_query($conn,$mysql_get_previous_question_answer);
	$row_fetch_get_previous_question_answer=mysqli_fetch_assoc($result_get_previous_question_answer);
	$result_answer=$row_fetch_get_previous_question_answer['answer'];
   
}
if(isset($_POST['submit']))
{
  $question_id=$_POST['question_id'];
  $user_id=$_SESSION['u_id'];
  $answer=htmlspecialchars($_POST['option']);
  if(empty($_POST['option'])){
    $option_empty_error="Please select answer.";
  }
  else{
    $mysql_check_question_exists_in_user_table_or_not="SELECT * FROM test_question_ans WHERE user_id='$user_id' AND question_id='$question_id'";
     $result_check_question_exists_in_user_table_or_not=mysqli_query($conn,$mysql_check_question_exists_in_user_table_or_not);
     if(mysqli_num_rows($result_check_question_exists_in_user_table_or_not)==0){
      $mysql_insert_in_answer_table="INSERT INTO test_question_ans(user_id,question_id,answer)VALUES('$user_id',$question_id,'$answer')"; 
    if(mysqli_query($conn,$mysql_insert_in_answer_table)){
      $_SESSION['session_question']+=1;
    }}else{
     $mysql_update_in_answer_table="UPDATE test_question_ans SET answer='$answer' WHERE user_id='$user_id' AND question_id='$question_id'";
   if(mysqli_query($conn,$mysql_update_in_answer_table)){
    $_SESSION['session_question']+=1;
   }

    }
  }
 //  echo  'question_id:'.$question_id=$_POST['question_id'];
 //   echo 'user_id'.$user_id=$_SESSION['u_id'];
 //   echo $answer=htmlspecialchars($_POST['option']);
 //  echo '<br>'.$mysql_check_question_exists_in_user_table_or_not="SELECT * FROM test_question_ans WHERE user_id='$user_id' AND question_id='$question_id'";
 //   $result_check_question_exists_in_user_table_or_not=mysqli_query($conn,$mysql_check_question_exists_in_user_table_or_not);
 //   if(mysqli_num_rows($result_check_question_exists_in_user_table_or_not)==0){   
	// if(empty($_POST['option'])){
	// 	$option_empty_error="Please select answer.";
	// }else{
 //    if(!empty($result_answer)){  
	//  $mysql_insert_in_answer_table="INSERT INTO test_question_ans(user_id,question_id,answer)VALUES('$user_id',$question_id,'$answer')"; 
	//  if(mysqli_query($conn,$mysql_insert_in_answer_table)){
 //  $_SESSION['session_question']+=1;
	//  }}
 //   }
	//  }else{
 //   $mysql_update_in_answer_table="UPDATE test_question_ans SET answer='$answer' WHERE user_id='$user_id' AND question_id='$question_id'";
 //   if(mysqli_query($conn,$mysql_update_in_answer_table)){
 //    $_SESSION['session_question']+=1;
 //   }}

}
if(isset($_POST['final_submit']))
{
   $question_id=$_POST['question_id'];
   $user_id=$_SESSION['u_id'];
  $answer=htmlspecialchars($_POST['option']);
  if(!empty($_POST['option'])){
	 $mysql_insert_in_answer_table="INSERT INTO test_question_ans(user_id,question_id,answer)VALUES('$user_id',$question_id,'$answer')"; 
	 if(mysqli_query($conn,$mysql_insert_in_answer_table)){
	 $mysql_update_user_exam_status="UPDATE user_login SET exam_status='1' WHERE u_id='$user_id'";	
	 if(mysqli_query($conn,$mysql_update_user_exam_status)){
   }
  }
 }else{
   $mysql_update_user_exam_status="UPDATE user_login SET exam_status='1' WHERE u_id='$user_id'";  
   if(mysqli_query($conn,$mysql_update_user_exam_status)){
   }
 }
   unset($_SESSION['session_question']);
   unset($_SESSION['user_email']);
   unset($_SESSION['user_id']);
   unset($_SESSION['role']);
   unset($_SESSION['no_of_question']);
   unset($_SESSION['level']);
   unset($_SESSION['session_question']);
   header("Location: login.php");
}
if(isset($_SESSION['user_email'])){
   	 $user_email=$_SESSION['user_email'];
     $user_id = $_SESSION['u_id'];
	   $user_role=$_SESSION['role'];
	   $user_question=$_SESSION['no_of_question'];
	   $user_level=$_SESSION['level'];
     $session_question=$_SESSION['session_question'];
     $user_question_id=$_SESSION['question_id'];
     $user_question_id_new=explode(',', $user_question_id);
     $user_question_id_only_this_user=$user_question_id_new[$session_question];


}
 ?>
 <?php
 $mysql_get_all_question="SELECT * FROM question WHERE role='$user_role' AND level='$user_level'  AND q_id='$user_question_id_only_this_user'";
 $result_get_all_question=mysqli_query($conn,$mysql_get_all_question);
 $row_fetch_get_all_question=mysqli_fetch_assoc($result_get_all_question);
 $question_id=$row_fetch_get_all_question['q_id'];
 $question_title=$row_fetch_get_all_question['question'];
 $option1_title=$row_fetch_get_all_question['option_1'];
 $option2_title=$row_fetch_get_all_question['option_2'];
 $option3_title=$row_fetch_get_all_question['option_3'];
 $option4_title=$row_fetch_get_all_question['option_4'];

 /*Fetch answer data if exists*/
  $mysql_answer_question_data="SELECT * FROM test_question_ans WHERE user_id='$user_id' AND question_id='$user_question_id_only_this_user'";
 $result_answer_question_data=mysqli_query($conn,$mysql_answer_question_data);
 $row_answer_question_data=mysqli_fetch_assoc($result_answer_question_data);
 $question_id_answer=$row_answer_question_data['question_id'];
 $answer_question_data=$row_answer_question_data['answer'];
?> 

  <body class="hold-transition login-page">
    <?php #echo $_SESSION['session_question']; ?>
<div class="login-box" style="width: 50%;">
<div class="card">
    <div class="card-body ">
        <section class="content" onselectstart='return false;'>
        <div class="card-header">
        	<span class="text-danger"><?php echo $GLOBALS['option_empty_error']; ?></span>
          <h3 class="card-title">Question: <?php echo $question_title;?></h3>
        </div>
        <div class="card-body">
        	<form name="" action="" method="POST">
            <input type="hidden" name="question_id" value="<?php echo $question_id;?>">
            <?php
            if(empty($option1_title)){
              ?>
              <div class="form-group">
                      <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Answer</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Ans..." name="option"  ><?php if(empty($answer_question_data)){ }else{echo $answer_question_data;}?></textarea>
                      </div>
                    </div>
                  </div>  
                  <span class="text-danger"><?php #echo $questionerror; ?></span>
            <?php
          }else{
            ?>
          
        	<input type="radio" name="option" value="1" <?php if($answer_question_data=='1') { echo 'checked'; }?>>

           <?php echo htmlspecialchars($option1_title);?><br>
           <input type="radio" name="option" value="2" <?php if($answer_question_data=='2') { echo 'checked'; }?>>
           <?php echo htmlspecialchars($option2_title);?><br>
           <input type="radio" name="option" value="3" <?php if($answer_question_data=='3') { echo 'checked'; }?>>
           <?php echo htmlspecialchars($option3_title);?><br>
           <input type="radio" name="option" value="4" <?php if($answer_question_data=='4') { echo 'checked'; }?>>
           <?php echo htmlspecialchars($option4_title);?><br>
          
            <?php
             }
          if($session_question+1!=$user_question)
          {
          ?>
          <div class="btn-group">
          <button type="submit" class="btn btn-primary float-left mt-3" name="submit">Submit</button>
        </div>
         <?php }
         else{
         	?>
          <div class="btn-group">
         	<button type="submit" onclick="return confirm('Do you went to submit your Test answer and logout?')" class="btn btn-primary float-left mt-3" name="final_submit">Final Submit</button>
         	</div>
          <?php
         } ?>
         <div style="margin-top: 5%;">
          <?php
                    
               $user_question_count=count($user_question_id_new);
               
                
                for($i=0;$i<$user_question;$i++){
                  
                 $mysql_check_question="SELECT * FROM test_question_ans WHERE user_id='$user_id' AND question_id='$user_question_id_new[$i]'";  
                 $result_check_question=mysqli_query($conn,$mysql_check_question);
                $row_check_question=mysqli_fetch_assoc($result_check_question);
                if(mysqli_num_rows($result_check_question)==1){ 
                              ?>              
                  <a href="single_page_question_2.php?page=<?php echo $i+1;?>">
                                      <button type="button" class="btn btn-success" name="page_submit"><?php echo $i+1;?></button></a>
                   <?php
                  }else{
                    ?>
                    <a href="single_page_question_2.php?page=<?php echo $i+1;?>">
                                      <button type="button" class="btn btn-default" name="page_submit"><?php echo $i+1;?></button></a>
                    <?php
                  }}
                                          ?>
                       
                      </div>
         
         </form>
        
        </div>
 <div>
 </div>
  </section>
 </div>

  </div>

</div>
<!-- /.login-box -->

<!-- jQuery -->
<?php include("layouts/scripts.php");?>

</body>
</html>
<?php
}else{
  header('Location: login.php');
}
?>