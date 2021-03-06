<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: profile.php");
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
	  background-image: url("mustache.png");
	  min-height: 100%;
	}
	
	.bar .button {
	  padding: 16px;
	}
	</style>
<body>
	<div class="top">
		<div class="bar white card" id="myNavbar">
		  <a href="homepage_loggedin.php" class="bar-item button wide">MOVEMBER
			  
		  </a>
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
<!-- <div class="sidenav">
	<ul>
		<li> <a href="homepage.html"> Homepage </a></li>
		<li> <a href="aboutus.html"> About Us</a></li>
		<li> <a href="login.html"> Log-in or Register</a></li>	
		<li> <a href="donation.html" class="active"> Donate Today</a></li>
		<li> <a href="profile.php"> Your Profile</a></li>	
		
	</ul>
</div> -->


<header class="bgimg-1 display-container " id="home">
	<div class="display-middle text-white" style="padding:48px">
	  <span class="jumbo hide-small">Support the Children Today</span><br>
	  <span class="">Already a member? Click the "Log-in to Donate" button below to start your donation.</span><br>
	  <span class="">If you are new to BC Children's Hospital Foundation or would like to donate as a guest, follow the "Continue as Guest" button below.</span> 
		
	  <!-- <button class="button" id="button1login" onclick="location.href='donationloggedin.php'"><span>Log-in to Donate </span></button>
	  <div class="divider"></div>
	  <button class="button" onclick= "location.href='donationguest.php'" ><span>Continue as Guest </span></button> -->
	

	  <p><a href="donationloggedin.php" class="button white padding-large large margin-top opacity hover-opacity-off">Log-in to Donate Now</a></p>
	  <p><a href="donationguest.php"    class="button white padding-large large margin-top opacity hover-opacity-off">Continue as a Guest</a></p>
	</div> 
  </header>




<!-- <section>
		<h1 class="h1"> Support the Children Today </h1>
		<p> Already a member? Click the "Log-in to Donate" button below to start your donation. <br> <br>
			If you are new to BC Children's Hospital Foundation or would like to donate as a guest, follow the "Continue as Guest" button below.</p>
</section>

<section>
<button class="button" id="button1login" onclick="location.href='donationloggedin.php'"><span>Log-in to Donate </span></button>
<div class="divider"></div>
<button class="button" onclick= "location.href='donationguest.php'" ><span>Continue as Guest </span></button>
</section> -->


<br>
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
</footer>
</body>
</html>