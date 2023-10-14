<?php
session_start();
require '../../../includes/conn.php';

if (isset($_POST['submit'])) {

  $stud_no    = mysqli_real_escape_string($db, $_POST['stud_no']);
  $firstname    = mysqli_real_escape_string($db, $_POST['firstname']);
  $middlename    = mysqli_real_escape_string($db, $_POST['middlename']);
  $lastname    = mysqli_real_escape_string($db, $_POST['lastname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $username    = mysqli_real_escape_string($db, $_POST['username']);
  $password    = mysqli_real_escape_string($db, $_POST['password']);
  $confirm_pass = mysqli_real_escape_string($db, $_POST['confirm_pass']);


  if ($password == $confirm_pass) {
    $hashedPwd = password_hash($confirm_pass, PASSWORD_DEFAULT);
    $insertStudent = mysqli_query($db, "INSERT INTO tbl_student (stud_no, firstname, middlename, lastname, email, username, password) VALUES ('$stud_no','$firstname','$middlename' , '$lastname', '$email', '$username', '$hashedPwd')") or die(mysqli_error($db));

    $_SESSION['studAdded'] = 'Student Successfully Added';
    header("location: ../../student/add_student.php");
  } else {
    $_SESSION['notMatch'] = 'Password does not match';
    header("location: ../../student/add_student.php");
  }
}
