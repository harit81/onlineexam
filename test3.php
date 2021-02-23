<?php
include('db.php');
$get_all_question="SELECT * FROM question WHERE role='10' AND level='1'";
$result_all_question=mysqli_query($conn,$get_all_question);
if(mysqli_num_rows($result_all_question)>0){
	while($row_fetch_all_question=mysqli_fetch_assoc($result_all_question)){
		echo $row_fetch_all_question['question'];
	}
}

?>