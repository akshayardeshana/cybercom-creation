<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'blogapp');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $prefix = mysqli_real_escape_string($db, $_POST['prefix']);

  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $mno = mysqli_real_escape_string($db, $_POST['mno']);

  $password = mysqli_real_escape_string($db, $_POST['password']);
  $cpassword = mysqli_real_escape_string($db, $_POST['cpassword']);
  $information = mysqli_real_escape_string($db, $_POST['information']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fname)) {
    array_push($errors, "First name is required");
  }
  if (empty($lname)) {
    array_push($errors, "Last name is required");
  }
  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($mno)) {
    array_push($errors, "Mobile number is required");
  }
  if (empty($password)) {
    array_push($errors, "password is required");
  }

  if (empty($cpassword)) {
    array_push($errors, "cPassword is required");
  }
  if ($password != $cpassword) {
    array_push($errors, "The two passwords do not match");
  }
  if (empty($information)) {
    array_push($errors, "Information is required");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $passwordhash = md5($password); //encrypt the password before saving in the database

    $query = "INSERT INTO user (prefix,fname,lname,mobile,email,passwordhash,information,created) 
  			  VALUES('$prefix','$fname','$lname','$mno','$email', '$passwordhash','$information',NOW())";
    mysqli_query($db, $query);
    $_SESSION['email'] = $email;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
  }
}


// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
    array_push($errors, "email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $passwordhash1 = md5($password);
    $query = "SELECT * FROM user WHERE email='$email' AND passwordhash='$passwordhash1'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['email'] = $email;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    } else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}
