<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: profile.php");
	exit;

}

// Include config file
require_once "config.php";

$error = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username =$_POST['username'];
    $password =$_POST['password'];

    mysqli_select_db($db);

    $sql = "SELECT fname,lname,UserID,Username,Pass,email,address FROM USERS WHERE Username = '".$username."' ";
    $results = mysqli_query($db,$sql);
    $numrows = mysqli_num_rows($results);
	$row = mysqli_fetch_assoc($results);

 // Check if username exists, if yes then verify password
    if($numrows == 1 && password_verify($password,$row["Pass"])){

    // Password is correct, so start a new session
        session_start();

    // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["id"]       = $row['UserID'];
        $_SESSION["username"] = $username;
	    $_SESSION["fname"]    = $row["fname"];
		$_SESSION["lname"]    = $row["lname"];
		$_SESSION["email"]	  = $row["email"];
		$_SESSION["address"]  = $row["address"];

	// Redirect user to welcome page
		if($username == "Admin"){

		header("location: admin_profile.php");

		}else{
		
			header("location: profile.php");
	
		}
	}
	else {

      $error = "Sorry your username/password was incorrect";

    }
    // Close connection
    mysqli_close($db);
}

?>
<!DOCTYPE html>

<html lang="en" class="html">
<head>
	<meta charset="UTF-8" />
	<title> Movember Log In</title>
    <link rel="stylesheet" href="style1.css" />
	<!-- <script src="script.js"></script> -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet" />
	</head>

<style>
	body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
	
	body, html {
	  height: 100%;
	  line-height: 1.8;
	}
	
	/* Full height image header */
	.bgimg-1 {
	  background-position: center;
	  background-size: cover;
	  background-image: url("white.jpg");
	  min-height: 100%;
	}
	
	.bar .button {
	  padding: 16px;
	}
	</style>
	<body>
		<!-- <body>
			<div class="sidenav">
				<ul>
					<li> <a href="homepage.html"> Homepage </a></li>
					<li> <a href="aboutus.html"> About Us</a></li>
					<li> <a href="login.html" class="active"> Log-in or Register</a></li>
					<li> <a href="donation.html"> Donate Today</a></li>
					<li> <a href="profile.php"> Your Profile</a></li>

				</ul>
			</div> -->
<div class="top">
<div class="bar white card" id="myNavbar">
		  <a href="homepage.html" class="bar-item button wide">MOVEMBER	  
		  </a>
		  <!-- Right-sided navbar links -->
		  <div class="right hide-small">
			<!-- <a href="about" class="bar-item button">ABOUT</a> -->
			<a href="donation.html" class="bar-item button"><i class="fa fa-user"></i> Donate Now</a>
			<a href="profile.php" class="bar-item button"><i class="fa fa-th"></i> Profile</a>
			<a href="login.php" class="bar-item button"><i class="fa fa-usd"></i> Log In</a>
			<!-- <a href="#contact" class="bar-item button"><i class="fa fa-envelope"></i> CONTACT</a> -->
		  </div>
		</div>
	</div>
<div class = "bgimg-1 display-container ">
<div class="light-grey display-middle " style="padding:48px" id="login">
  <h3 class="center">Welcome Back</h3>
  <p class="center large">Login Below</p>
  <p class="center large">If you do not yet have an accout, click on Register!</p>
  <div style="margin-top:5px">
    <!-- <p><i class="fa fa-map-marker fa-fw xxlarge margin-right"></i> Chicago, US</p>
    <p><i class="fa fa-phone fa-fw xxlarge margin-right"></i> Phone: +00 151515</p>
    <p><i class="fa fa-envelope fa-fw xxlarge margin-right"> </i> Email: mail@mail.com</p> -->
	
	<?php echo $error;?>
	<br>
	<form name = "login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit ="return validateForm()">
					Username:
					<br>
					<input type="text" name="username" />
					<br>
					<br>
					Password:
					<br>
					<input type="password" name="password"/>
					
					<br>
					<br>
        <button class="button black" type="submit">
          Login
		</button>
		<br>
		<br>
		Click to <a href="register.php">Register</a>
      </p>
    </form>
    <!-- Image of location/map
    <img src="/w3images/map.jpg" class="image greyscale" style="width:100%;margin-top:48px"> -->
  </div>
</div>
</div>




<!-- 
			<section>
				<h1 class="h1"> Welcome Back </h1>
				<p> Fill in your username and password to log in. If you have not yet made an account, click on the "Register an Account" link on the side. </p>

			</section>

			<section>
				<form name = "login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit ="return validateForm()">
					<?php echo $error;?>
					<br>
					<br>
					Username:
					<br>
					<input type="text" name="username" />
					<br>
					<br>
					Password:
					<br>
					<input type="password" name="password"/>
					<br>
					<br>
					<input type="submit"/> 
					<br>
					<br>
					Click Here to <a href="register.php">Register</a>
					</form>
		
			</section> -->

			<!-- <br>
			<br>
			<br>
			<br> -->
			<!-- <footer class="footer">
				<address>
					BC Children's Hospital Foundation &copy; <br>
					<a href="mailto:clement_chow@sfu.ca"> Email us </a> <br>
					<a href="tel:604.875.2444"> 604.875.2444 </a> <br>
					8888 University Drive <br>
				</address>
			</footer> -->
		</body>


		<script type="text/javascript">function validateForm() {
				var user = document.forms["login"]["username"].value;
				var pass = document.forms["login"]["password"].value;
				if (user == "" || pass == "") {
					alert("Please enter password and/or username!");
					return false;
				}
			}
			}</script>


</html>