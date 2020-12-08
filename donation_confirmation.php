
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
	exit;
} 
?>

<!DOCTYPE html>

<html lang="en" class="html">
<head>
	<meta charset="UTF-8" />
	<title> Movember </title>
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
	  background-image: url("mustache.jpg");
	  min-height: 100%;
	  image-rendering: auto;
	}
	
	.bar .button {
	  padding: 16px;
	}

	mark {
  background-color: black;
  color: white;
  font-size: 50pt;
  font-weight: bold;
  padding:5px; 
}
	</style>
<body>
	<!-- <div class="sidenav">
	<ul>
		<li> <a href="homepage.html" class="active"> Homepage </a></li>
		<li> <a href="aboutus.html"> About Us</a></li>
		<li> <a href="login.php"> Log-in or Register</a></li>	
		<li> <a href="donation.html"> Donate Today</a></li>
		<li> <a href="profile.php"> Your Profile</a></li>
	</div> -->


	<div class="top">
		<div class="bar white card" id="myNavbar">
		  <a href="homepage.html" class="bar-item button wide">MOVEMBER</a>
		  <!-- Right-sided navbar links -->
		  <div class="right hide-small">
			<!-- <a href="about" class="bar-item button">ABOUT</a> -->
			<a href="donation.html" class="bar-item button"><i class="fa fa-user"></i> Donate Now</a>
			<a href="profile.php" class="bar-item button"><i class="fa fa-th"></i> Profile</a>
			<a href="logout.php" class="bar-item button"><i class="fa fa-usd"></i> Sign Out</a>
			<!-- <a href="#contact" class="bar-item button"><i class="fa fa-envelope"></i> CONTACT</a> -->
		  </div>
		</div>
	</div>

		  <header class="bgimg-1 display-container" id="home">
			<div class="display-middle text-black" style="padding:48px">
			  <span class="large"><mark>Thank you.</mark></span><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			  <span class="large">You just helped change the face of men's health!</span>
			</div> 
		  </header>

<!-- <section>
	<h1 class="h1"> Movember </h1>
	<p> Welcome to the Movember . Thank you for taking the time to learn about the Foundation. You can find the latest information with the charity and log in to track your donations on the website.</p>
</section>

<section>
	<h2 class="h2"> Our Mission </h2>
	<p>
		Movember fundraisers are a global community of fired up Mo Bros and Mo Sisters – aka rock stars making a difference in mental health and suicide prevention, prostate cancer and testicular cancer.

		Sign up and join the Movember community in having fun doing good.
	</p>
	
</section> -->

<!-- <br>
<br>
<br>
<br>
<footer class="footer">
	<address>
	BC Children's Hospital Foundation &copy; <br>
	<a href="mailto:clement_chow@sfu.ca"> Email us </a> <br>
	<a href="tel:604.875.2444"> 604.875.2444 </a> <br>
	8888 University Drive <br>
	</address>
</footer> -->
</body>
</html>