<?php
include("layouts/header.php");
include("db.php"); 
 session_start();
if(isset($_SESSION['user_email'])){
   	  $user_email=$_SESSION['user_email'];
      $user_id = $_SESSION['u_id'];
	  // $user_role=$_SESSION['role'];
	  // $user_question=$_SESSION['no_of_question'];
 	 //  $user_level=$_SESSION['level'];
   //    $new_question=$_SESSION['new_question_id'];
      $mysql_pre_question="SELECT * FROM test_question_ans WHERE user_id='$user_id' ORDER BY exam_id DESC LIMIT 1";
      $result_pre_question=mysqli_query($conn,$mysql_pre_question);
      $row_fetch=mysqli_fetch_assoc($result_pre_question);
      $question_id = $row_fetch['question_id'];
      $answer = $row_fetch['answer'];
      $mysql_get_question_data="SELECT * FROM question WHERE q_id='$question_id'";
      $result_get_question_data=mysqli_query($conn,$mysql_get_question_data);
      $row_fetch_question_data=mysqli_fetch_assoc($result_get_question_data);
      $question_title=$row_fetch_question_data['question'];
      $option_1_title=$row_fetch_question_data['option_1'];
      $option_2_title=$row_fetch_question_data['option_2'];
      $option_3_title=$row_fetch_question_data['option_3'];	
      $option_4_title=$row_fetch_question_data['option_4'];	
      echo  $question_title;?>
      <input type="radio" name="option" value="<?php echo  $option_1_title;?>">
      <?php echo  $option_1_title; if($option_1_title==$answer){
      			echo "checked";
      }?><br>
       <input type="radio" name="option" value="<?php echo  $option_2_title;?>">
      <?php echo  $option_2_title;?><br>
       <input type="radio" name="option" value="<?php echo  $option_3_title;?>">
      <?php echo  $option_3_title;?><br>
       <input type="radio" name="option" value="<?php echo  $option_4_title;?>">
      <?php echo  $option_4_title;?><br>
      <?php
// echo  $question_title.'<br>';      
// echo  $option_1_title.'<br>';
// echo  $option_2_title.'<br>';
// echo  $option_3_title.'<br>';
// echo  $option_4_title.'<br>'; 
// echo  $answer.'<br>';  
if($answer==$option_1_title){
	echo " match";
}   else{
	echo "not match";
} 

}

 ?>