<?php include("layouts/header.php");
include("db.php"); ?>
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
            <h1 class="m-0 text-dark">View Question</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Question</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content Start Here-->


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div> -->
              <!-- /.card-header -->
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
                    $role_id_of_admin = $row_get_role_data['role_id'];
                        ?>
                        <option value="<?php echo $row_get_role_data['role_id'];?>"><?php echo $row_get_role_data['role_name']; ?></option>
                        <?php
                    }
                }
                ?>
  </select>
                      </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="select_question_data">Submit</button>
                </div>
              </form>         
              <div class="card-body">
                 <?php
 if(isset($_POST['select_question_data'])){
        $role_id_of_admin=$_POST['role'];
                $mysql_select_question_data = "SELECT * FROM question WHERE role = '$role_id_of_admin'";
                $result_select_question_data = mysqli_query($conn, $mysql_select_question_data);
                if(mysqli_num_rows($result_select_question_data) != 0){
 ?> 
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>S_No.</th>
                    <th>Level</th>
                    <th>Exam Mode</th>
                    <th>Question</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                     <?php
                   if(isset($_POST['select_question_data'])){
                if (mysqli_num_rows($result_select_question_data) > 0) {
                  $i=0;
                    while ($row_select_question_data = mysqli_fetch_assoc($result_select_question_data)) {
                      $i++;
                     $level_of_exam = $row_select_question_data['level'];
                     $type_of_exam = $row_select_question_data['exam_option'];
                        ?>
                         <tr>
                         <td><?php echo $i;?></td>
                    <td><?php if($level_of_exam==1){echo 'Easy';}elseif ($level_of_exam==2){echo 'Medium';} else{ echo "Hard";}?></td>
                    <td><?php if($type_of_exam==1){echo "Optional";}else{echo "Written";} ?></td>
                    <td><?php echo $row_select_question_data['question'];?></td>

                    <td><a href="edit_question.php?question_id=<?php echo $row_select_question_data['q_id'];?>">Edit</a></td>
                    <td><a href="view_question.php?question_delete_id=<?php echo $row_select_question_data['q_id'];?>">Delete</a></td> 
                     </tr>
                        <?php
                    }
                }
           }
                ?>
                  
                 
                    </tbody>
                  <tfoot>
                  <tr>
                     <th>S_No.</th>
                    <th>Level</th>
                    <th>Exam Mode</th>
                    <th>Question</th>
                
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </tfoot>
                </table><?php }}
                  if(isset($_POST['select_question_data'])){
                     if(mysqli_num_rows($result_select_question_data) == 0){
                       echo "Search Result : 0";
                     }
                  }?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

        
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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
<?php
if(isset($_GET['question_delete_id'])){
  $delete_question_id=$_GET['question_delete_id'];
  $mysql_detele_question="DELETE FROM question WHERE q_id='$delete_question_id'";
  if(mysqli_query($conn,$mysql_detele_question)){
    header("Location: view_question.php");
  }
}
?>