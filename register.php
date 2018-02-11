<?php
ob_start();
session_start(); // start a new session or continues the previous

if( isset($_SESSION['user'])!="" ){
  header("Location: home.php"); // redirects to home.php
}
include_once 'dbconnect.php';

$error = false;

if ( isset($_POST['btn-signup']) ) {

 // sanitize user input to prevent sql injection
$first_name = trim($_POST['first_name']);
$first_name = strip_tags($first_name);
$first_name = htmlspecialchars($first_name);

$last_name = trim($_POST['last_name']);
$last_name = strip_tags($last_name);
$last_name = htmlspecialchars($last_name);

$gender = trim($_POST['gender']);
$gender = strip_tags($gender);
$gender = htmlspecialchars($gender);


$birthdate = trim($_POST['birthdate']);
$birthdate = strip_tags($birthdate);
$birthdate = htmlspecialchars($birthdate);

$user_email = trim($_POST['user_email']);
$user_email = strip_tags($user_email);
$user_email = htmlspecialchars($user_email);

$user_pass = trim($_POST['user_pass']);
$user_pass = strip_tags($user_pass);
$user_pass = htmlspecialchars($user_pass);

// basic name validation
if (empty($first_name)) {
  $error = true;
  $nameError = "Please enter your full name.";
} else if (strlen($first_name) < 3) {
  $error = true;
  $nameError = "Name must have atleat 3 characters.";
} else if (!preg_match("/^[a-zA-Z ]+$/",$first_name)) {
  $error = true;
  $nameError = "Name must contain alphabets and space.";
}

//basic email validation
if ( !filter_var($user_email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address.";
} else {
// check whether the email exist or not
  $query = "SELECT user_email FROM users WHERE user_email='$email'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);

  if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
  }
}
// password validation
if (empty($user_pass)){
  $error = true;
  $passError = "Please enter password.";
} else if(strlen($user_pass) < 6) {
  $error = true;
  $passError = "Password must have atleast 6 characters.";
}

// password encrypt using SHA256();
$password = hash('sha256', $user_pass);

 // if there's no error, continue to signup
if( !$error ) {
  $query = "INSERT INTO users (first_name ,last_name ,gender ,birthdate ,user_email ,user_pass) VALUES('$first_name','$last_name','$gender' ,'$birthdate' ,'$user_email' ,'$user_pass') ";
  $res = mysqli_query($conn, $query);

    if ($res) {
      $errTyp = "success";
      $errMSG = "Successfully registered, you may login now";
      unset($first_name);
      unset($user_email);
      unset($user_pass);

    header("location: index.php");
    exit;

    } else {
      $errTyp = "danger";
      $errMSG = "Something went wrong, try again later...";
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Big Library | Sign Up</title>
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>
<style>
body {
  background: #f2f2f2;
}

.navbar {
  background: #1a1a1a;
  height: 90px;
}

#logo {
  font-size: 30px;
}

a {
  color: black;
  text-decoration: none;
}

a:hover {
  color: red;
  text-decoration: none;
}

.jumbotron {
  background: linear-gradient(rgba(26, 26, 26, 0.3),rgba(26, 26, 26, 0.3)),url("img/registerpic.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  height: 400px;
}
        
form{
  color: #1a1a1a;
  background-color: #fff;
  width: 80%;
  padding: 35px;
  margin: 0 auto;
  margin-top: 100px;
  margin-bottom: 100px;
  border: 2px solid black;
  border-radius: 10px;
}

.btn{
  background-color: #1a1a1a;
  color: white;
}

.footer h4 {
  color:  white;
  background-color: #1a1a1a;
  margin-bottom: 0;
  padding: 30px 0;
} 
</style>
<body>
<!-- Start of Navigation Section -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <div><a class="navbar-brand" href="home.php" id="logo">Big Library</a></div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button> 
</nav>
<!-- End of Navigation Section -->

<!-- Start of Jumbotron Section -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="text-center"></h1>
    </div>
</div>
<!-- End of Jumbotron Section -->

<!-- Start of Form Section -->
<div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
      <h2 class="text-center">Sign Up</h2>
        <hr />
  <?php
    if ( isset($errMSG) ) {
  ?>
      <div class="alert">
        <?php echo $errMSG; ?>
      </div>
  <?php
  }
  ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="first_name">First name</label>
            <input type="text" class="form-control" id="validationCustom01" placeholder="First Name" name="first_name" value="<?php echo $first_name ?>" required />
            <span class="text-danger"><?php echo $nameError; ?></span>
        </div>
        <div class="form-group col-md-6">
            <label for="last_name">Last name</label>
            <input type="text" class="form-control" id="validationCustom02" placeholder="Last Name" name="last_name" value="<?php echo $last_name ?>" />
        </div>
         <div class="form-group col-md-6">
            <label for="gender">Gender</label>
              <select class="custom-select" name="gender" value="<?php echo $gender ?>" />
                <option selected value="male">Male</option>
                <option selected value="female">Female</option>
                <option selected value="others">Other</option>
              </select>
        </div>

        <div class="form-group col-md-6">
            <label for="birthday">Birthdate</label>
            <input type="date" class="form-control" id="validationCustom03" name="birthdate" value="<?php echo $birthdate ?>" />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="emailAddress">Email</label>
            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="user_email" required value="<?php echo $user_email ?>" />
            <span class="text-danger"><?php echo $emailError; ?></span>
        </div>
        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="user_pass" maxlength="15" required />
            <span class="text-danger"><?php echo $passError; ?></span>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-lg" name="btn-signup">Sign Up</button>
    </div>
  </form>
</div>
<!-- End of Form Section -->

<!-- Start of Footer Section -->
<div class="footer">
    <h4 class="text-center">Kosic Tanja CoderReview 10</h4>
</div>
<!-- End of Footer Section -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php ob_end_flush(); ?>