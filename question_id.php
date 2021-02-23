<?php
include("db.php");
session_start();
$current_question_id=$_SESSION['question_id'];
echo $new_question_id=$current_question_id+1;
$_SESSION['new_question_id']=$new_question_id;
 header("Location: user_test_page.php");

?>