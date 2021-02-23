<?php
include('db.php');
$mysql="SELECT question.q_id,question.answer,test_question_ans.question_id
FROM 
question INNER JOIN test_question_ans ON  question.q_id=test_question_ans.question_id WHERE test_question_ans.user_id='10'";
			$result_of_query=mysqli_query($conn,$mysql);
			$question_answer_table=array();
			$question_answer_test=array();
			if(mysqli_num_rows($result_of_query)>0){
			while ($row=mysqli_fetch_assoc($result_of_query)) {
			$answer_from_question_table=$row['answer'];
			echo $q_id=$row['question_id'];
			 array_push($question_answer_table,$answer_from_question_table);
			$mysql1="SELECT * FROM test_question_ans WHERE user_id='4' AND question_id='$q_id'";
			$result_of_query_2=mysqli_query($conn,$mysql1);	
			if(mysqli_num_rows($result_of_query_2)>0){
			while ($row2=mysqli_fetch_assoc($result_of_query_2)) {
			$answer_from_question_ans_table=$row2['answer'];
			array_push($question_answer_test,$answer_from_question_ans_table);
					}
				}
			}
			print_r($question_answer_test);
			echo "<br>";
			print_r($question_answer_table);
			echo "<br>";
foreach($question_answer_table as $key=>$value){
    if($value==$question_answer_test[$key]){
     echo 'match value' .$value;
    }}
}
?>