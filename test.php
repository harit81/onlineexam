  <?php
  include("db.php");
  		$enter_no_of_question=5;
		$mysql_get_question_id="SELECT * FROM question WHERE role='10' AND level='1' LIMIT $enter_no_of_question";
    		$result_question_id=mysqli_query($conn,$mysql_get_question_id);
    		if(mysqli_num_rows($result_question_id)>0){
    			$new_array=array();
      		while($row_fetch_question_id=mysqli_fetch_assoc($result_question_id)){
   			echo  		'<br>question_id:'.$id_of_question = $row_fetch_question_id['q_id'];
			array_push($new_array, $id_of_question);
     		}
     		shuffle($new_array);
     	    $question_id_for_user=implode(',',$new_array);
     	    echo '<br>'.$question_id_for_user;
    }	
  ?>






   <!--   $new_array=array();
      $a=1;     
      for ($i=$a; $i<=$no_of_question; $i++){
        shuffle($new_array);
        array_push($new_array, $i);
      }
      $arraytostring=implode(',',$new_array);
      $arraytostring; -->