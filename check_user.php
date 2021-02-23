<?php
include('db.php');
// $user_email='manish@g.com';
// $mysql_check_user_email_exists_or_not="SELECT * FROM user_login WHERE user_email='manish@g.com'";
//     $result_check_user_email_exists_or_not=mysqli_query($conn,$mysql_check_user_email_exists_or_not);
//      echo $email_exists_or_not_count=mysqli_num_rows($result_check_user_email_exists_or_not);
//     if($email_exists_or_not_count!=0){
//        // echo "<script>alert('Email Already exists.');</script>";
//        //     echo "<script>window.open('view_user__1.php','_self');</script>";
//     	echo 'user exists';
//     }
// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';
session_start();
echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>