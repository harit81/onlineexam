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

 $mysql_get_role_of_user_creater="SELECT role_name FROM role WHERE role_id='$created_by'";
 $result_of_user_creater=mysqli_query($conn,$mysql_get_role_of_user_creater);
 $row_fetch_of_user_creater=mysqli_fetch_assoc($result_of_user_creater);
 $name_of_admin_role=$row_fetch_of_user_creater['role_name'];
 
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
                  
                    <p><b>No of Question :</b><?php echo $user_no_of_question;?></p>
                     <p><b>Exam Status :</b><?php if($user_exam_status==0){echo 'Pending';}else{echo'Result Pending';};?></p>
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
                   <p><h3 class="card-title"><b>Exam Question and Answer</b></h3></p><br><hr>
                   <h6><p><b>Total No. Question Attempt :</b> 
                      <?php echo $no_of_question_attempt_by_user;?></p></h6>
           <?php
            $mysql_get_question="SELECT * FROM question WHERE role='$user_role' AND level='$user_level'";
            $my_result=mysqli_query($conn,$mysql_get_question);
            if(mysqli_num_rows($my_result)>0){
              while($r_fetch=mysqli_fetch_assoc($my_result)){
                $r_fetch['q_id'];
                echo '<br><b>'.htmlspecialchars($r_fetch['question']).'</b>';
                echo '<br>'.htmlspecialchars($r_fetch['option_1']);
                echo '<br>'.htmlspecialchars($r_fetch['option_2']);
                echo '<br>'.htmlspecialchars($r_fetch['option_3']);
                echo '<br>'.htmlspecialchars($r_fetch['option_4']);
              }
            }
           ?>



            <?php
            $mysql_user_exam_data="SELECT * FROM test_question_ans WHERE user_id='$user_id'";
            $query_execute=mysqli_query($conn,$mysql_user_exam_data);
            if(mysqli_num_rows($query_execute)>0){
              $i=0;
              while ($row_fetch_user_exam_data=mysqli_fetch_assoc($query_execute)) {
                $i++;
            $question_id=$row_fetch_user_exam_data['question_id'];
            $answer_given_by_user=$row_fetch_user_exam_data['answer'];//answer form test_question_ans table
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
                <form>
                  <?php
                  if(!empty($option_1)){
                  ?>
                  <?php if($answer_given_by_user=='1'){
                      if($answer_given_by_user==$answer){

                          ?>
                          <span class="text-success"><strong>a)<?php echo $option_1; ?></strong></span>
                        <?php 

                  
                  }else{
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

                          ?>
                          <span class="text-success"><strong>b)<?php echo $option_2; ?></strong></span>
                        <?php   
                  }else{
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

                          ?>
                          <span class="text-success"><strong>c)<?php echo $option_3; ?></strong></span>
                        <?php   
                  }else{
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

                          ?>
                          <span class="text-success"><strong>d)<?php echo $option_4; ?></strong></span>
                        <?php   
                  }else{
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

                   </form>
                  <?php
                }else{
                  ?>
                  <p><b>Answer:</b><?php echo $answer_given_by_user;?></p>
                  <?php
                }
                  if(!empty($option_1)){
                  ?>

                  <!--  <p><b>Correct Answer:</b><?php #echo $answer;?></p>   -->          
          <?php } }}
          ?>
 <div class="card-tools">
                 <p></p>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                              </div>
            </div>
          </div>



          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Products</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Sales</th>
                    <th>More</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Some Product
                    </td>
                    <td>$13 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        12%
                      </small>
                      12,000 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Another Product
                    </td>
                    <td>$29 USD</td>
                    <td>
                      <small class="text-warning mr-1">
                        <i class="fas fa-arrow-down"></i>
                        0.5%
                      </small>
                      123,234 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Amazing Product
                    </td>
                    <td>$1,230 USD</td>
                    <td>
                      <small class="text-danger mr-1">
                        <i class="fas fa-arrow-down"></i>
                        3%
                      </small>
                      198 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Perfect Item
                      <span class="badge bg-danger">NEW</span>
                    </td>
                    <td>$199 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        63%
                      </small>
                      87 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
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
