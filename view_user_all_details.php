<?php include("layouts/header.php");
include("db.php");
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php
if(isset($_GET['u_id'])){  
$user_id=$_GET['u_id'];  
$mysql_user_generated_data="SELECT * FROM user_login WHERE u_id='$user_id'";
$result_user_generated_data=mysqli_query($conn,$mysql_user_generated_data);
$row_fetch_user_generated_data=mysqli_fetch_assoc($result_user_generated_data);
 $user_id=$row_fetch_user_generated_data['u_id'];
 $user_name=$row_fetch_user_generated_data['user_name'];
 $user_password=$row_fetch_user_generated_data['password'];
 $user_email=$row_fetch_user_generated_data['user_email'];
 $user_role=$row_fetch_user_generated_data['role'];
 $created_by=$row_fetch_user_generated_data['created_by'];
 $user_no_of_question=$row_fetch_user_generated_data['no_of_question'];
 $user_level=$row_fetch_user_generated_data['level'];
 $user_qualification=$row_fetch_user_generated_data['qualification'];
 $user_marks=$row_fetch_user_generated_data['marks'];
 $user_phone=$row_fetch_user_generated_data['phone'];
 $user_form_status=$row_fetch_user_generated_data['status'];
 $user_exam_status=$row_fetch_user_generated_data['exam_status'];
 $user_register_date=$row_fetch_user_generated_data['date'];
 $final_status=$row_fetch_user_generated_data['final_status'];
 $mysql_get_role_of_user_creater="SELECT role_name FROM role WHERE role_id='$created_by'";
 $result_of_user_creater=mysqli_query($conn,$mysql_get_role_of_user_creater);
 $row_fetch_of_user_creater=mysqli_fetch_assoc($result_of_user_creater);
 $name_of_admin_role=$row_fetch_of_user_creater['role_name'];
 /*correct answer submit by admin*/
 if(isset($_POST['correct_answer_submit'])){
   $user_id=$_POST['user_id'];
   $question_id=$_POST['question_id'];
   $answer=$_POST['correct_answer'];
  $mysql_text_correct_answer="UPDATE test_question_ans SET correct_answer='$answer' WHERE user_id='$user_id' AND question_id='$question_id'";
 if(mysqli_query($conn,$mysql_text_correct_answer)){
header("Location: view_user_all_details.php?u_id=$user_id");
 }
 }
 if(isset($_POST['submit_user_status_1'])){
 $user_exam_status=1;
  $user_id;
 $user_final_status="UPDATE user_login SET final_status='$user_exam_status' WHERE u_id='$user_id'";
 mysqli_query($conn,$user_final_status);
 header("Location: view_user_all_details.php?u_id=$user_id");
 }
if(isset($_POST['submit_user_status_2'])){
  $user_exam_status=2;
   $user_final_status="UPDATE user_login SET final_status='$user_exam_status' WHERE u_id='$user_id'";
 mysqli_query($conn,$user_final_status);
 header("Location: view_user_all_details.php?u_id=$user_id");
 }
}  ?>

  <!-- Navbar -->
<?php include("layouts/top_nav.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<?php include("layouts/sidebar.php"); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
            
              <div class="card-body">
                <div class="justify-content-between align-items-center border-bottom mb-3">
                  <p class="d-flex flex-column">
                    <p><h3 class="card-title"><b>User Details</b></h3></p><br><hr>
                    <p><b>Created By :</b><?php echo $name_of_admin_role; ?></p>
                    <p><b>Email :</b><?php echo $user_email;?></p>
                    <p><b>Name :</b><?php echo htmlspecialchars($user_name);?></p>
                    <p><b>Password :</b><?php echo htmlspecialchars($user_password);?></p>
                    <?php 
                     $mysql_get_role_of_user="SELECT role_name FROM role WHERE role_id='$user_role'";
                     $result_of_user=mysqli_query($conn,$mysql_get_role_of_user);
                     $row_fetch_of_user=mysqli_fetch_assoc($result_of_user);
                     $name_of_user_role=$row_fetch_of_user['role_name'];
                      /*GET no of question attempt by user*/
                     $sum_of_question_attempt_by_user="SELECT COUNT(question_id) FROM test_question_ans WHERE user_id='$user_id'";
                     $mysql_result_of_question_attempt_by_user=mysqli_query($conn,$sum_of_question_attempt_by_user);
                     $row_fetch_of_question_attempt_by_user=mysqli_fetch_assoc($mysql_result_of_question_attempt_by_user);
                     $no_of_question_attempt_by_user=$row_fetch_of_question_attempt_by_user['COUNT(question_id)'];
                    ?>

                    <p><b>Role :</b><?php echo $name_of_user_role;?></p>
                    <p><b>Level :</b><?php if($user_level==1){echo 'Easy';}elseif($user_level==2){echo 'Medium';}else{ echo 'Hard';}?></p>
                  </p><hr>
                   <p><h3 class="card-title"><b>Qualification Details Filled By User</b></h3></p><br>
                   <hr>
                   <p><b>Qualification :</b><?php echo $user_qualification; ?></p>
                    <p><b>Qualification Marks :</b><?php echo $user_marks.' %';?></p>
                      <p><b>Phone :</b><?php echo $user_phone;?></p>
                       <p><b>Register Date :</b><?php echo $user_register_date;?></p>
                </div>
                                  <!-- /.d-flex -->
              </div>
            </div>

              <div class="card">
              <div class="card-header border-0">
                   <p><h3 class="card-title"><b>Exam Question and Answer</b></h3></p><br>
                   
            <?php
            $mysql_user_exam_data="SELECT * FROM test_question_ans WHERE user_id='$user_id'";
            $query_execute=mysqli_query($conn,$mysql_user_exam_data);
            if(mysqli_num_rows($query_execute)>0){
              $i=0;
              while ($row_fetch_user_exam_data=mysqli_fetch_assoc($query_execute)) {
                $i++;
            $question_id=$row_fetch_user_exam_data['question_id'];
            $answer_given_by_user=$row_fetch_user_exam_data['answer'];//answer form test_question_ans table
            $correct_answer_by_admin=$row_fetch_user_exam_data['correct_answer'];
           // $final_status=$row_fetch_user_exam_data['final_status'];
            $mysql_get_question_title="SELECT * FROM question WHERE q_id='$question_id'";
            $result_of_guestion_title=mysqli_query($conn,$mysql_get_question_title);
            $row_fetch_of_question_title=mysqli_fetch_assoc($result_of_guestion_title);
            $question_title=htmlspecialchars($row_fetch_of_question_title['question']);
            $option_1=htmlspecialchars($row_fetch_of_question_title['option_1']);
            $option_2=htmlspecialchars($row_fetch_of_question_title['option_2']);
             $option_3=htmlspecialchars($row_fetch_of_question_title['option_3']);
             $option_4=htmlspecialchars($row_fetch_of_question_title['option_4']);
             $answer=htmlspecialchars($row_fetch_of_question_title['answer']);//answer from question table
               ?>   
                <hr><h6><p><?php echo '<b>'.$i.')'.$question_title.'</b>';?></p></h6>
                  <?php
                  if(!empty($option_1)){
                  ?>
                  <?php if($answer_given_by_user=='1'){
                        if($answer_given_by_user==$answer){
                          correct_answer_update();
                          ?>
                          <span class="text-success"><strong>a)<?php echo $option_1; ?></strong></span>
                  <?php 
                        }else{
                          wrong_answer_update();
                          ?>
                          <span class="text-danger"><strong>a)<?php echo $option_1; ?></strong></span>
                  <?php
                        }
                        }else{
                        if($answer=='1'){
                        ?>
                        <span class="text-success"><strong>a)<?php echo $option_1; ?></strong></span>
                  <?php
                        }else{
                        echo 'a)'.$option_1; 
                        }         
                        } 
                  ?><br>
                   <?php if($answer_given_by_user=='2'){
                        if($answer_given_by_user==$answer){
                          correct_answer_update();
                          ?>
                          <span class="text-success"><strong>b)<?php echo $option_2; ?></strong></span>
                        <?php   
                  }else{
                    wrong_answer_update();
                    ?>
                     <span class="text-danger"><strong>b)<?php echo $option_2; ?></strong></span>

                    <?php
                  }}else{  if($answer=='2'){
                    ?>
                     <span class="text-success"><strong>b)<?php echo $option_2; ?></strong></span>
                    <?php
                  }else{
                   echo 'b)'.$option_2; 
                  }     
                  }?><br>
                   <?php if($answer_given_by_user=='3'){
                        if($answer_given_by_user==$answer){
                          correct_answer_update();
                          ?>
                          <span class="text-success"><strong>c)<?php echo $option_3; ?></strong></span>
                        <?php   
                  }else{
                    wrong_answer_update();
                    ?>
                     <span class="text-danger"><strong>c)<?php echo $option_3; ?></strong></span>
                    <?php
                  }}else{
                if($answer=='3'){
                    ?>
                     <span class="text-success"><strong>c)<?php echo $option_3; ?></strong></span>
                    <?php
                  }else{
                   echo 'c)'.$option_3; 
                  }   
                  }?><br>
                    <?php if($answer_given_by_user=='4'){
                        if($answer_given_by_user==$answer){
                          correct_answer_update();
                          ?>
                          <span class="text-success"><strong>d)<?php echo $option_4; ?></strong></span>
                        <?php   
                  }else{
                    wrong_answer_update();
                    ?>
                     <span class="text-danger"><strong>d)<?php echo $option_4; ?></strong></span>
                    <?php
                  }}else{
                          if($answer=='4'){
                    ?>
                     <span class="text-success"><strong>d)<?php echo $option_4; ?></strong></span>
                    <?php
                  }else{
                   echo 'd)'.$option_4; 
                  }      
                  }?><br>
                  <?php
                }else{
                  ?>
                  <?php
                  if(isset($_GET['u_id'])){
                     $user_id=$_GET['u_id'];
                    if($correct_answer_by_admin==0){ 
                  ?>
                   <p><b>Answer:</b><?php echo $answer_given_by_user;?></p>
                  <form method="POST" action="" name="f2">
                    <input type="hidden" name="question_id" value="<?php echo $question_id;?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                    <input type="radio" name="correct_answer" value="1">Correct Answer
                    <input type="radio" name="correct_answer" value="2">Wrong Answer<br>
                    <div class="btn-group">
          <button type="submit" class="btn btn-primary float-left mt-3" name="correct_answer_submit">Submit</button>
        </div>
                  </form> 
                  <?php
                 }elseif($correct_answer_by_admin==1){
                  ?>
                  <b>Answer:<span class="text-success"><?php echo $answer_given_by_user; ?></span></b>
                  <?php
                 }else{
                  ?>
                  <b>Answer:<span class="text-danger"><?php echo $answer_given_by_user; ?></span></b>
                  <?php
                 }}}
                  if(!empty($option_1)){
                  ?>        
          <?php } }}
          ?>
 <div class="card-tools">
                 <p></p>
                </div><br><br>
                <div class="btn-group">
          <a href="view_user_by_role.php"><button type="submit" class="btn btn-primary">Back</button></a>
        </div>
              </div>
              <div class="card-body table-responsive p-0">
             </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0" style="margin-top: 3%;">
                <h3 class="card-title"><b>Exam Result Details</b></h3>
              <br>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <tbody>
                    <tr>
                    <td>
                    Exam Status
                    </td>
                    <td><?php 
                   if($user_exam_status==0){echo 'Pending';}else{echo'Result Pending';}
                    ?></td>
                  </tr>
                  <?php
                 $no_of_question_display=$user_no_of_question;   
                  /*correct answer start*/
               $get_total_of_correct_answer="SELECT COUNT(correct_answer) FROM test_question_ans WHERE user_id='$user_id' AND correct_answer=1";
                                    $result_total_of_correct_answer=mysqli_query($conn,$get_total_of_correct_answer);
                                    $row_total_of_correct_answer=mysqli_fetch_assoc($result_total_of_correct_answer);
                                    $correct_answer_display= $row_total_of_correct_answer['COUNT(correct_answer)'];
                             /*pending answer start*/ 
                              $get_total_of_pending_answer="SELECT COUNT(correct_answer) FROM test_question_ans WHERE user_id='$user_id' AND correct_answer=0";
                                    $result_total_of_pending_answer=mysqli_query($conn,$get_total_of_pending_answer);
                                    $row_total_of_pending_answer=mysqli_fetch_assoc($result_total_of_pending_answer);
                                   $pending_answer_display= $row_total_of_pending_answer['COUNT(correct_answer)']; 
                 $get_total_of_wrong_answer="SELECT COUNT(correct_answer) FROM test_question_ans WHERE user_id='$user_id' AND correct_answer=2";
                                    $result_total_of_wrong_answer=mysqli_query($conn,$get_total_of_wrong_answer);
                                    $row_total_of_wrong_answer=mysqli_fetch_assoc($result_total_of_wrong_answer);
                                   $wrong_display= $row_total_of_wrong_answer['COUNT(correct_answer)']; 
                  ?>
                  <tr>
                    <td>
                      Total No of Question
                    </td>
                    <td><?php echo $no_of_question_display;?></td>
                  </tr>
                   <tr>
                    <td>
                     Correct Answer
                    </td>
                    <td><?php echo $correct_answer_display;
                        ?></td>
                  </tr>
                   <tr>
                    <td>
                      Wrong Answer
                    </td>
                    <td><?php 
                   echo  $wrong_display;
                    ?></td>
                </tr>
                 <tr>
                    <td>
                       Not Attempt 
                    </td>
                    <td><?php 
                   echo  $not_attempt=$no_of_question_display-$no_of_question_attempt_by_user;
                    ?></td>
                  </tr>
                 <tr>
                    <td>
                      Pending Answer
                    </td>
                    <td><?php 
                  echo $pending_answer_display
                    ?></td>
                  </tr>
                  <tr>
                    <td>
                      Status  
                    </td>
                    <td><?php                 
                    if($final_status==0){
                      echo 'Result Pending';
                    }elseif ($final_status==1) {
                      echo "Shortlisted";
                    }else{
                      echo "Rejected";
                    }
                    ?></td>
                  </tr>
                  <tr>
                    <td>
                      <?php
                      if($pending_answer_display==0){
                      ?>
                      <form action="" method="POST">
                  <button type="submit" class="btn btn-primary float-left" name="submit_user_status_1">Shortlisted</button>  
                    </td>
                    <td>
                      <button type="submit" class="btn btn-primary float-right" name="submit_user_status_2">Rejected</button>
                    </form>
                    <?php
                  }?>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                   <p><h3 class="card-title"><b>Question Not Attempt</b></h3></p><br><hr>
              <?php
              $get_all_question_in_user_id="SELECT * FROM user_login WHERE u_id='$user_id'";
$result_all_question_in_user_id=mysqli_query($conn,$get_all_question_in_user_id);
$row_fetch_all_question_in_user_id=mysqli_fetch_assoc($result_all_question_in_user_id);
$question_id_in_user_data=$row_fetch_all_question_in_user_id['question_id'];
$a=explode(',',$question_id_in_user_data);
$get_question_attempt_by_user="SELECT * FROM test_question_ans WHERE user_id='$user_id'";
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
 $j=0;
foreach ($question_not_attempt_by_user_question as $key => $value) {
$value;
$get_all_question="SELECT * FROM question WHERE q_id='$value'";
$result_all_question=mysqli_query($conn,$get_all_question);
if(mysqli_num_rows($result_all_question)>0){
 
  while($row_fetch_all_question=mysqli_fetch_assoc($result_all_question)){
    $j++;
    $option_1_not_attempt=$row_fetch_all_question['option_1'];
    $option_2_not_attempt=$row_fetch_all_question['option_2'];
    $option_3_not_attempt=$row_fetch_all_question['option_3'];
    $option_4_not_attempt=$row_fetch_all_question['option_4'];
    ?>
    <h6><p><b><?php echo $j.')';?><?php echo $row_fetch_all_question['question']; ?></b></p></h6>
              
                 
                 <p><?php if(!empty($option_1_not_attempt)){
                  echo  'a)'.htmlspecialchars($option_1_not_attempt).'<br>';
                  echo  'b)'.htmlspecialchars($option_2_not_attempt).'<br>';
                  echo  'c)'.htmlspecialchars($option_3_not_attempt).'<br>';
                  echo  'd)'.htmlspecialchars($option_4_not_attempt).'<br>';
                 }?></p><hr>
               
               <?php
}

}

  
}

}$count_of_second_array=count($second_array);
if($count_of_second_array==0){
  $j=0;
foreach ($a as $key => $value_1) {
$value_1;
$get_all_question="SELECT * FROM question WHERE q_id='$value_1'";
$result_all_question=mysqli_query($conn,$get_all_question);
if(mysqli_num_rows($result_all_question)>0){
while($row_fetch_all_question=mysqli_fetch_assoc($result_all_question)){
  $j++;
$row_fetch_all_question['question'];
 $option_1_not_attempt=$row_fetch_all_question['option_1'];
    $option_2_not_attempt=$row_fetch_all_question['option_2'];
    $option_3_not_attempt=$row_fetch_all_question['option_3'];
    $option_4_not_attempt=$row_fetch_all_question['option_4'];
    ?>
    <h6><p><b><?php echo $j.')';?><?php echo $row_fetch_all_question['question']; ?></b></p></h6>
     <p ><?php if(!empty($option_1_not_attempt)){
                  echo  'a)'.htmlspecialchars($option_1_not_attempt).'<br>';
                  echo  'b)'.htmlspecialchars($option_2_not_attempt).'<br>';
                  echo  'c)'.htmlspecialchars($option_3_not_attempt).'<br>';
                  echo  'd)'.htmlspecialchars($option_4_not_attempt).'<br>';
                 }?></p><hr>
    <?php
}
} 
} 
}?>
</div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("layouts/footer.php"); ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<?php include("layouts/scripts.php"); ?>
</body>
</html>
<?php
function correct_answer_update(){
  include('db.php');
  global $user_id;
  global $question_id;
   $mysql_check_answer_exists="SELECT * FROM test_question_ans WHERE correct_answer='1' AND user_id='$user_id' AND question_id='$question_id'";
$mysql_check_answer_exists_query=mysqli_query($conn,$mysql_check_answer_exists);
                          if(mysqli_num_rows($mysql_check_answer_exists_query)==0){
 $mysql_correct_answer_by_user="UPDATE test_question_ans SET correct_answer='1' WHERE user_id='$user_id' AND question_id='$question_id'";
mysqli_query($conn,$mysql_correct_answer_by_user);
                          }else{
$mysql_correct_answer_by_user_update="UPDATE test_question_ans SET correct_answer='1' WHERE user_id='$user_id' AND question_id='$question_id'";
                            mysqli_query($conn,$mysql_correct_answer_by_user_update);
                          }

}
function wrong_answer_update(){
  include('db.php');
  global $user_id;
  global $question_id;
  $mysql_check_answer_exists="SELECT * FROM test_question_ans WHERE correct_answer='1' AND user_id='$user_id' AND question_id='$question_id'";
$mysql_check_answer_exists_query=mysqli_query($conn,$mysql_check_answer_exists);
                          if(mysqli_num_rows($mysql_check_answer_exists_query)==0){
 $mysql_correct_answer_by_user="UPDATE test_question_ans SET correct_answer='2' WHERE user_id='$user_id' AND question_id='$question_id'";
mysqli_query($conn,$mysql_correct_answer_by_user);
                          }else{
$mysql_correct_answer_by_user_update="UPDATE test_question_ans SET correct_answer='2' WHERE user_id='$user_id' AND question_id='$question_id'";
                            mysqli_query($conn,$mysql_correct_answer_by_user_update);
                          }  
}
?>