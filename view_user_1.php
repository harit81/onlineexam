<?php
include("db.php");
$first_q_id=0;
$mysql_all_q="SELECT * FROM question WHERE role='10' AND level='1'";
$result_all_q=mysqli_query($conn,$mysql_all_q);
if(mysqli_num_rows($result_all_q)>0){
  while($row_f=mysqli_fetch_assoc($result_all_q)){
     $row_f['q_id'];
    $row_f['question'];
    $first_q_id=$row_f['q_id'];
  }}
    $mysql_ans="SELECT * FROM test_question_ans WHERE user_id='14'";
    $resultans=mysqli_query($conn,$mysql_ans);
if(mysqli_num_rows($resultans)>0){
  while($row_f2=mysqli_fetch_assoc($resultans)){
    $row_f2['question_id'];
   $second_q_id=$row_f2['question_id'];
   if($first_q_id==$second_q_id){

   }else{
    // echo "<br>".$first_q_id;
     echo "<br>".$second_q_id;
   }
  }
}

?>