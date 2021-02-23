<?php include("layouts/header.php"); ?>
<?php
include 'db.php';
$role = $level = $exam_type = $question = $option_1 = $option_2 = $option_3 = $option_4 = $answer = "";
$roleerror = $levelerror = $exam_typeerror = $questionerror = $option_1error = $option_2error = $option_3error = $option_4error = $answererror = "";
if (isset($_POST['question_detail_update'])) {
$role=$_POST['role'];
$level= $_POST['level'];
$exam_type= $_POST['exam_type'];
$question= $_POST['question'];
$option_1=htmlspecialchars($_POST['ans1']);
$option_2=htmlspecialchars($_POST['ans2']);
$option_3=htmlspecialchars($_POST['ans3']);
$option_4=htmlspecialchars($_POST['ans4']);
$answer= $_POST['answer'];  
if(empty($role)){
 $roleerror = "please select role";
}
if(empty($level)){
 $levelerror = "please select level";
}
if(empty($exam_type)){
  $exam_typeerror = "please select exam mode";
}
if($exam_type==1){
if(empty($question)){
 $questionerror = "please enter question";
}
if(empty($option_1)){
 $option_1error = "please enter option 1";
}
if(empty($option_2)){
 $option_2error = "please enter option 2";
}
if(empty($option_3)){
 $option_3error = "please enter option 3";
}
if(empty($option_4)){
 $option_4error = "please enter option 4";
}
if(empty($answer)){
$answererror = "please enter correct option";
}}
if(empty($roleerror)&&empty($levelerror)&&empty($exam_typeerror)&&empty($questionerror)
&&empty($option_1error)&&empty($option_2error)&&empty($option_3error)&&empty($option_4error)&&
empty($answererror)){
if(!empty($_GET['question_id'])){
    $question_id = $_GET['question_id'];
    $mysql_update_in_question = "UPDATE question SET role='$role',level='$level',exam_option='$exam_type',question='$question',option_1='$option_1',option_2='$option_2',option_3='$option_3',option_4='$option_4',answer='$answer' WHERE q_id='$question_id'";
                if(mysqli_query($conn,$mysql_update_in_question)) {

                  echo "<script>alert('Question has been updated successfully');</script>";
                  echo "<script>window.open('view_question.php','_self');</script>";
                  // echo 'updated';
                  // header("Location: view_q.php");

             }

}}
}
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
<?php include("layouts/top_nav.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<?php include("layouts/sidebar.php"); ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Question</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Question</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content Start Here-->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Question </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!--PHP CODE OF GET DATA FROM QUESTION TABLE-->
                          <?php 
if(isset($_GET['question_id'])){
  $question_id = $_GET['question_id'];
  $mysql_get_question_data="SELECT * FROM question WHERE q_id='$question_id'";
  $result_get_question_data=mysqli_query($conn,$mysql_get_question_data);
  $row_get_question_data=mysqli_fetch_assoc($result_get_question_data);
  $current_question=$row_get_question_data['question'];
  $current_option1=$row_get_question_data['option_1'];
  $current_option2=$row_get_question_data['option_2'];
  $current_option3=$row_get_question_data['option_3'];
  $current_option4=$row_get_question_data['option_4'];
  $row_get_question_data_fetch_level=$row_get_question_data['level'];
  $row_get_question_data_fetch_exam_type=$row_get_question_data['exam_option'];
  $row_get_question_data_fetch_answer=$row_get_question_data['answer'];
  $role_from_question_table =  $row_get_question_data['role'];
  $mysql_get_role_data = "SELECT * FROM role WHERE role_id='$role_from_question_table'";
  $result_get_role_data = mysqli_query($conn, $mysql_get_role_data);
  $row_get_role_data = mysqli_fetch_assoc($result_get_role_data);
  $role_name_of_admin = $row_get_role_data['role_name'];
  $current_role=$row_get_question_data['role'];
                       
   ?>
              <form method="POST" action="" name="f1" method="POST">
                <div class="card-body">
                  <div class="form-group">
                   <!--  <label for="exampleInputEmail1">Role</label> -->
                  <div class="form-group">
                        <label>Select Role</label>
                        <select class="custom-select" name="role">
                          <option value="<?php echo $current_role; ?>"><?php echo $role_name_of_admin;?></option>  
                            <?php
                $mysql_get_role_data = "SELECT * FROM role";
                $result_get_role_data = mysqli_query($conn, $mysql_get_role_data);
                if (mysqli_num_rows($result_get_role_data) > 0) {
                    while ($row_get_role_data = mysqli_fetch_assoc($result_get_role_data)) {
                        ?>
                        <option value="<?php echo $row_get_role_data['role_id'];?>"><?php echo $row_get_role_data['role_name']; ?></option>
                        <?php
                    }
                }  ?>
  </select>
                      </div>
                      <span class="text-danger"><?php echo $roleerror; ?></span>
                  </div>
               
                   <div class="form-group">
                        <label>Select Level of Test</label>
                        <select class="custom-select" name="level">
                           <option value="<?php echo $row_get_question_data_fetch_level;?>"><?php  if($row_get_question_data_fetch_level==1){echo 'Easy';}elseif ($row_get_question_data_fetch_level==2){echo 'Medium';} else{ echo "Hard";}?></option>
                          <option value="1">Easy</option>
                          <option value="2">Medium</option>
                          <option value="3">Hard</option>
                        </select>
                      </div>
                       <span class="text-danger"><?php echo $levelerror; ?></span>
                  <div class="form-group">
                        <label>Select Exam mode</label>
                        <select class="custom-select" name="exam_type">
                           <option value="<?php echo $row_get_question_data_fetch_exam_type;?>"><?php  if( $row_get_question_data_fetch_exam_type==1){echo "Optional";}else{echo "Written";}?></option>
                          <option value="1">Optional</option>
                          <option value="2">Written</option>
                        </select>
                      </div>
                       <span class="text-danger"><?php echo $exam_typeerror; ?></span>
                       <div class="form-group">
                      <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Question</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="question"  ><?php echo $current_question;?></textarea>
                      </div>
                    </div>
                  </div>  
                  <span class="text-danger"><?php echo $questionerror; ?></span>
                      <div class="form-group">
                      <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Option 1</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="ans1"  
                       ><?php echo $current_option1;?></textarea>
                      </div>
                    </div>
                  </div>
                   <span class="text-danger"><?php echo $option_1error; ?></span>
                   <div class="form-group">
                      <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Option 2</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="ans2"><?php echo $current_option2;?></textarea>
                      </div>
                    </div>
                  </div>
                   <span class="text-danger"><?php echo $option_2error;?></span>
                   <div class="form-group">
                      <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Option 3</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="ans3"><?php echo $current_option3;?></textarea>
                      </div>
                    </div>
                  </div>
                   <span class="text-danger"><?php echo $option_3error; ?></span>
                   <div class="form-group">
                      <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Option 4</label>
                   <textarea class="form-control" rows="3" placeholder="Enter ..." name="ans4"><?php echo $current_option4;?></textarea>
                      </div>
                    </div>
                  </div>
                   <span class="text-danger"><?php echo $option_4error; ?></span>                  
                     <div class="form-group">
                        <label>Select Correct Answer</label>
                        <select class="custom-select" name="answer" value="<?php echo $answer;?>">
                           <option value="<?php echo $row_get_question_data_fetch_answer;?>"><?php 
                           if($row_get_question_data_fetch_answer==1){
                            echo "Option 1";
                           }elseif($row_get_question_data_fetch_answer==2){
                              echo "Option 2";
                           }elseif($row_get_question_data_fetch_answer==3){
                              echo "Option 3";
                           }elseif($row_get_question_data_fetch_answer==4){
                              echo "Option 4";
                           }else{
                            echo "Select";
                           }?></option>
                          <option value="1">Option 1</option>
                          <option value="2">Option 2</option>
                          <option value="3">Option 3</option>
                          <option value="4">Option 4</option>
                        </select>
                      </div>
                       <span class="text-danger"><?php echo $answererror; ?></span>
                <!-- /.card-body -->
<?php }?>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="question_detail_update">Update</button>
                </div>
              </form>
              </form>
            </div>
            <!-- /.card -->

            <!-- Form Element sizes -->
       
    </section>    


    
    <!-- /.content End Here -->
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
