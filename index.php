<?php
ob_start();
session_start();

require_once 'dbconnect.php';

if ( isset($_SESSION['user'])!="" ) {
	header("Location: home.php");
exit;
}

$error = false;

if( isset($_POST['btn-login']) ) {

// prevent sql injections/ clear user invalid inputs
$user_email = trim($_POST['user_email']);
$user_email = strip_tags($user_email);
$user_email = htmlspecialchars($user_email);

$user_pass = trim($_POST['user_pass']);
$user_pass = strip_tags($user_pass);
$user_pass = htmlspecialchars($user_pass);

// prevent sql injections / clear user invalid inputs
if(empty($user_email)){
	$error = true;
	$emailError = "Please enter your email address.";
} else if ( !filter_var($user_email,FILTER_VALIDATE_EMAIL) ) {
	$error = true;
	$emailError = "Please enter valid email address.";
}

if(empty($user_pass)){
	$error = true;
	$passError = "Please enter your password.";
}


if (!$error) {
	$password =  $user_pass ; // password hashing using SHA256 did not work with sign in if already registerd 

 	$res=mysqli_query($conn, "SELECT user_id, first_name, user_pass FROM users WHERE user_email='$user_email'");
	$row=mysqli_fetch_array($res, MYSQLI_ASSOC);
	$count = mysqli_num_rows($res); 

		if( $count == 1 && $row['user_pass'] == $password ) {
			$_SESSION['user'] = $row['user_id'];
			header("Location: home.php");
		} else {
			$errMSG = "Incorrect Credentials, Try again...";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Big Library | Sign In</title>
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>
<style>
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

body {
  background: #f2f2f2;
}

.btn {
  background: white;
  border: 1px solid #1a1a1a;
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
      <h1 class="text-center"> Welcome to Big Library</h1>
    </div>
</div>
<!-- End of Jumbotron Section -->

<!-- Start of Login Section -->
    <div class="container">
        <h1 class="text-center">Sing In</h1>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
		<hr />
			<?php if (isset($errMSG)) { echo $errMSG; ?> <?php } ?>

			<input type="email" name="user_email" class="form-control" placeholder="Your Email" value="<?php echo $user_email; ?>" maxlength="40" />
				<span class="text-danger"><?php echo $emailError; ?></span>
			<br>
			<input type="password" name="user_pass" class="form-control" placeholder="Your Password" maxlength="15" />
				<span class="text-danger"><?php echo $passError; ?></span>
				<hr />
			<div class="text-center">
			<button type="submit" name="btn-login" class="btn btn-lg center">Sign In</button>
			</div>	
			    <hr />
			<h3 class="text-center"><a href="register.php">Sign Up Here</a></h3>
		</form>      
	</div>
<!-- End of Login Section -->

<!-- Start of Footer Section -->
<div class="footer">
    <h4 class="text-center">Kosic Tanja CoderReview 10</h4>
</div>
<!-- End of Footer Section -->
</body>
</html>


    


