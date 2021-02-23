<?php
include('db.php');
if(isset($_POST['correct_answer_submit'])){
 echo  $user_id=$_POST['user_id'];
 echo  $question_id=$_POST['question_id'];
 echo  $answer=$_POST['correct_answer'];
 echo $mysql_text_correct_answer="UPDATE test_question_ans SET correct_answer='$answer' WHERE user_id='$user_id' AND question_id='$question_id'";
 if(mysqli_query($conn,$mysql_text_correct_answer)){
 	echo "updated";
 }
 }
?>