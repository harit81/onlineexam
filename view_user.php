<?php include("layouts/header.php");
include("db.php"); ?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php include("layouts/top_nav.php"); ?>

<?php include("layouts/sidebar.php"); ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">View Interviewee Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Interviewee</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
 
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            <div class="card-body">
               <table id="example2" class="table table-bordered table-hover" >
                  <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                   <th>Created Date</th>
                   <th>Final Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                     <?php               
                $mysql_select_user_data = "SELECT * FROM user_login ORDER BY u_id DESC";
                $result_select_user_data = mysqli_query($conn, $mysql_select_user_data);
                if (mysqli_num_rows($result_select_user_data) > 0) {
                  $i=0;
                    while ($row_select_user_data = mysqli_fetch_assoc($result_select_user_data)) {
                    $i++;
                    $role_id=$row_select_user_data['role'];
                    $mysql_get_role="SELECT role.role_name
                    FROM role INNER JOIN user_login ON user_login.role=role.role_id WHERE user_login.role='$role_id'";
                    $result_of_role=mysqli_query($conn,$mysql_get_role);
                    $row_select_role_data=mysqli_fetch_assoc($result_of_role);
                    $role_name = $row_select_role_data['role_name'];
                        ?>
                         <tr>
                            <td><?php echo $i;?></td>
                          <td><?php echo htmlspecialchars($row_select_user_data['user_name']);?></td>
                           <td><?php echo htmlspecialchars($row_select_user_data['password']);?></td>
                            <td><?php echo $row_select_user_data['user_email'];?></td>
                       <td><?php echo $role_name;?></td>
                    
                    <td><?php $user_status = $row_select_user_data['status'];if($user_status==0){echo 'Inactive';}else{echo 'Active';}?></td>
                    <td><?php $created_date=$row_select_user_data['date'];
                     echo date('d/m/Y',strtotime($created_date));?></td>
                    <td><?php $final_status=$row_select_user_data['final_status']; 
                     if($final_status==0){
                      ?>
                      <button type="submit" class="btn btn-warning" name="correct_answer_submit">Pending</button>
                      <?php
                    }elseif ($final_status==1) {
                      ?>
                      <button type="submit" class="btn btn-success" name="correct_answer_submit">Shortlisted</button>
                      <?php
                    }else{
                     ?>
                      <button type="submit" class="btn btn-danger" name="correct_answer_submit">Rejected</button>
                      <?php
                    }?></td>
                    <td>
                      <?php
                    if($user_status==0){
                      ?>
                      <a href="edit_user.php?u_id=<?php echo $row_select_user_data['u_id'];?>">
                        <button type="submit" class="btn btn-primary" name="correct_answer_submit">Edit</button></a>
                      <?php }?>
                       <?php
                    if($user_status==0){
                      ?><a href="view_user.php?user_delete_id=<?php echo $row_select_user_data['u_id'];?>"><button type="submit" class="btn btn-danger" name="correct_answer_submit">Delete</button></a><?php }?>
                      <?php
                      if($user_status!=0){
                      ?>
                      <a href="view_user_all_details.php?u_id=<?php echo $row_select_user_data['u_id'];?>"><button type="submit" class="btn btn-dark" name="correct_answer_submit">View</button></a>
                      <?php
                    }else{
                      
                    }
                      ?></td>
                     </tr>
                        <?php
                    }
                }
          
                ?>     
                 </tbody>
                  <tfoot>
                  <tr>
                      <th>S.No.</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Final Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
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
if(isset($_GET['user_delete_id'])){
  $delete_user_id=$_GET['user_delete_id'];
  $mysql_detele_user="DELETE FROM user_login WHERE u_id='$delete_user_id'";
  if(mysqli_query($conn,$mysql_detele_user)){
    header("Location: view_user.php");
  }
}
?>