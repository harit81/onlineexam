<?php
include('db.php');
$get_all_question_in_user_id="SELECT * FROM user_login WHERE u_id='29'";
$result_all_question_in_user_id=mysqli_query($conn,$get_all_question_in_user_id);
$row_fetch_all_question_in_user_id=mysqli_fetch_assoc($result_all_question_in_user_id);
$question_id_in_user_data=$row_fetch_all_question_in_user_id['question_id'];
$a=explode(',',$question_id_in_user_data);
$get_question_attempt_by_user="SELECT * FROM test_question_ans WHERE user_id='29'";
$get_question_attempt_by_user_query=mysqli_query($conn,$get_question_attempt_by_user);
$second_array=array();
if(mysqli_num_rows($get_question_attempt_by_user_query)>0){
while($row_fetch_get_question_attempt_by_user=mysqli_fetch_assoc($get_question_attempt_by_user_query)){
$b=$row_fetch_get_question_attempt_by_user['question_id'];
array_push($second_array,$b);
}
$result=array_diff($a,$second_array);
$result_of_questin_count=count($result);
$question_not_attempt_by_user_question=$result;
foreach ($question_not_attempt_by_user_question as $key => $value) {
$value;
$get_all_question="SELECT * FROM question WHERE q_id='$value'";
$result_all_question=mysqli_query($conn,$get_all_question);
if(mysqli_num_rows($result_all_question)>0){
while($row_fetch_all_question=mysqli_fetch_assoc($result_all_question)){
echo '<br>'.$row_fetch_all_question['question'];
}
}
}
}
$count_of_second_array=count($second_array);
if($count_of_second_array==0){
foreach ($a as $key => $value_1) {
$value_1;
$get_all_question="SELECT * FROM question WHERE q_id='$value_1'";
$result_all_question=mysqli_query($conn,$get_all_question);
if(mysqli_num_rows($result_all_question)>0){
while($row_fetch_all_question=mysqli_fetch_assoc($result_all_question)){
echo '<br>'.$row_fetch_all_question['question'];
}
}	
}	
}
?>