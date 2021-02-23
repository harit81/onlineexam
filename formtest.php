 <?php

if(isset($_POST['correct_answer_submit'])){
	echo $_POST['correct_answer'];
}
 ?>
 <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
                    <input type="radio" name="correct_answer" value="1">Correct Answer
                    <input type="radio" name="correct_answer" value="2">Wrong Answer<br>
                    <div class="btn-group">
          <button type="submit" class="btn btn-primary float-left mt-3" name="correct_answer_submit">Submit</button>
        </div>
                  </form> 

<?php
function sofa_get_uri() {
    $host = $_SERVER['SERVER_NAME'];
    $self = $_SERVER["REQUEST_URI"];
    $query = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
    $ref = !empty($query) ? "http://$host$self?$query" : "http://$host$self";
    return $ref;
}echo sofa_get_uri();
SELECT COUNT(correct_answer) FROM test_question_ans WHERE user_id=8 AND correct_answer=2

SELECT question.q_id,question.answer,test_question_ans.question_id,test_question_ans.answer,test_question_ans.user_id
FROM 
question INNER JOIN test_question_ans ON  question.q_id=test_question_ans.question_id WHERE test_question_ans.user_id=4

?>