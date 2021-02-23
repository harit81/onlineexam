<?php
include('db.php');
 $mysql_get_no_of_question="SELECT COUNT(question) FROM question WHERE role='$role' AND level='$level_of_user'";
    $result_no_of_question=mysqli_query($conn,$mysql_get_no_of_question);
    $row_fetch_no_of_question=mysqli_fetch_assoc($result_no_of_question);
    echo $count_of_question=$row_fetch_no_of_question['COUNT(question)'];
?>