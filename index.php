<?php include("layouts/header.php"); ?>
<?php
include 'db.php';
$role = $level = $exam_type = $question = $ans1 = $ans2 = $ans3 = $ans4 = $answer = "";
$roleerror = $levelerror = $exam_typeerror = $questionerror = $ans1error = $ans2error = $ans3error = $ans4error = $answererror = "";
if (isset($_POST['question_details'])) {
    $role = $_POST['role'];
    $level = $_POST['level'];
    $exam_type = $_POST['exam_type'];
    $question = $_POST['question'];
    $ans1 = $_POST['ans1'];
    $ans2 = $_POST['ans2'];
    $ans3 = $_POST['ans3'];
    $ans4 = $_POST['ans4'];
    $answer = $_POST['answer'];
    if (empty($role)) {
        $roleerror = "please select role";
    }
    if (empty($level)) {
        $levelerror = "please select level";
    }
    if (empty($exam_type)) {
        $questionerror = "please select exam mode";
    }
     if (empty($question)) {
        $questionerror = "please enter question";
    }
    
    if($exam_type==1){
       if (empty($ans1)) {
        $ans1error = "please enter option 1";
    }
    if (empty($ans2)) {
        $ans2error = "please enter option 2";
    }
    if (empty($ans3)) {
        $ans3error = "please enter option 3";
    }
    if (empty($ans4)) {
        $ans4error = "please enter option 4";
    }
    if (empty($answer)) {
        $answererror = "please enter correct option";
    }}
  
    if (empty($roleerror) && empty($levelerror) && empty($exam_typeerror) && empty($exam_typeerror) &&
            empty($ans1error) && empty($ans2error) && empty($ans3error) && empty($ans4error) && empty($answererror)) {
        $mysql_insert_in_question = "insert into question(role,level,exam_option,question,option_1,option_2,option_3,option_4,answer)"
                . "values('$role','$level','$exam_type','$question','$ans1','$ans2','$ans3','$ans4','$answer')";
                if(mysqli_query($conn,$mysql_insert_in_question)) {
                  echo "<script>alert('Question has been added successfully');</script>";
                  echo "<script>window.open('view_question.php','_self');</script>";

    }}}

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
            <h1 class="m-0 text-dark">Add Question</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Question</li>
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
                <h3 class="card-title">Add Question</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               <form method="POST" action="" name="f1">
                <div class="card-body">
                  <div class="form-group">
                   <!--  <label for="exampleInputEmail1">Role</label> -->
                  <div class="form-group">
                        <label>Select Role</label>
                        <select class="custom-select" name="role">
                          <option value="">Select Role</option>
                          <?php
                $mysql_get_role_data = "SELECT * FROM role";
                $result_get_role_data = mysqli_query($conn, $mysql_get_role_data);
                if (mysqli_num_rows($result_get_role_data) > 0) {
                    while ($row_get_role_data = mysqli_fetch_assoc($result_get_role_data)) {
                        ?>
                        <option value="<?php echo $row_get_role_data['role_id'];?>"><?php echo $row_get_role_data['role_name']; ?></option>
                        <?php
                    }
                }
                ?>
  </select>
                      </div>
                      <span class="text-danger"><?php echo $roleerror; ?></span>
                  </div>
                   <div class="form-group">
                        <label>Select Level of Test</label>
                        <select class="custom-select" name="level">
                           <option value="0">Select Level </option>
                          <option value="1">Easy</option>
                          <option value="2">Medium</option>
                          <option value="3">Hard</option>
                        </select>
                      </div>
                       <span class="text-danger"><?php echo $levelerror; ?></span>
                  <div class="form-group">
                        <label>Select Exam mode</label>
                        <select class="custom-select" name="exam_type">
                           <option value="">Select Exam mode</option>
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
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="question" value="<?php echo $question;?>"></textarea>
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
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="ans1" value="<?php echo $ans1;?>"></textarea>
                      </div>
                    </div>
                  </div>
                   <span class="text-danger"><?php echo $ans1error; ?></span>
                   <div class="form-group">
                      <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Option 2</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="ans2" value="<?php echo $ans2;?>"></textarea>
                      </div>
                    </div>
                  </div>
                   <span class="text-danger"><?php echo $ans2error; ?></span>
                   <div class="form-group">
                      <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Option 3</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="ans3" value="<?php echo $ans3;?>"></textarea>
                      </div>
                    </div>
                  </div>
                   <span class="text-danger"><?php echo $ans3error; ?></span>
                   <div class="form-group">
                      <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Option 4</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="ans4" value="<?php echo $ans4;?>"></textarea>
                      </div>
                    </div>
                  </div>
                   <span class="text-danger"><?php echo $ans4error; ?></span>                  
                     <div class="form-group">
                        <label>Select Correct Answer</label>
                        <select class="custom-select" name="answer" value="<?php echo $answer;?>">
                           <option value="">Select Correct Answer</option>
                          <option value="1">Option 1</option>
                          <option value="2">Option 2</option>
                          <option value="3">Option 3</option>
                          <option value="4">Option 4</option>
                        </select>
                      </div>
                       <span class="text-danger"><?php echo $answererror; ?></span>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="question_details">Submit</button>
                </div>
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
