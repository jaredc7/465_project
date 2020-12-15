<?php
// Initialize the session

session_start();
 

// Check if the user is logged in, if not then redirect him to login page

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
	exit;

}
require_once "config.php";

mysqli_select_db($db);

$error = "";
$id = $_SESSION["id"];

$sql_payment = "SELECT * FROM paymentinfo WHERE UserID = '".$id."' ORDER BY infonum DESC limit 1" ;

$results_payment = mysqli_query($db,$sql_payment);

$row_payment = mysqli_fetch_assoc($results_payment);

$numrows_expire = mysqli_num_rows($results_payment);

if ($numrows_expire == 0 ){
	
	$creditname   = "";
	$creditcard   = "";
	$month        = "";
	$year         = "";

} elseif($row_payment['expire_year'] <= date('y') && $row_payment['expire_month'] <= date('m') ) {

	$error        = "Please update your credit card information, our records indicate that it may no longer be valid. Thanks!";
	$creditname   = $row_payment['creditcardname'];
	$creditcard   = $row_payment['creditcard'];

	$creditcard_hash   	= $row_payment['creditcard'];
	$creditcard_decrypt = my_decrypt($creditcard_hash,$key);

	$month        = $row_payment['expire_month'];
	$year         = $row_payment['expire_year'];

} else{

$error = "";
$creditname   	= $row_payment['creditcardname'];
$creditcard 		= $row_payment['creditcard'];

$creditcard_hash   	= $row_payment['creditcard'];
$creditcard_decrypt = my_decrypt($creditcard_hash,$key);

$month        = $row_payment['expire_month'];
$year         = $row_payment['expire_year'];

} 

$infonum	  = $row_payment['infonum'];
$valid_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST" ){
	
	// $creditnumber = $_POST['creditnumber'];

	$creditnumber_unhash = $_POST['creditnumber'];
	$creditnumber = my_encrypt($creditnumber_unhash, $key);

	$creditname   = $_POST['creditname'];
	$year 		  =	$_POST['year'];
	$month 		  =	$_POST['month'];
	
	$amount 	  = $_POST['amount'];
	$email 		  = $_POST['email'];
	$address      = $_POST['address'];

	$sql_info   = "INSERT INTO paymentinfo (creditcard,creditcardname,expire_month,expire_year,UserID,address) VALUES ('".$creditnumber."','".$creditname."', '".$month."','".$year."','".$id."','".$address."') ";
	
	mysqli_query($db,$sql_info);

	// if (mysqli_query($db, $sql_info) ) {
	// 	echo "New record created successfully";
	//   } else {
	// 	echo "Error: " . $sql_info . " <br>" . mysqli_error($db);
	//   }
	
	$sql_payment = "SELECT * FROM paymentinfo WHERE UserID = '".$id."' ORDER BY infonum DESC limit 1" ;

	$results_payment = mysqli_query($db,$sql_payment);

	$row_payment  = mysqli_fetch_assoc($results_payment);

	$infonum	  = $row_payment['infonum'];

	$sql_donate = "INSERT INTO donations (donation_date,amount_cad,email,UserID,infonum)  VALUES (CURDATE(),'".$amount."','".$email."','".$id."','".$infonum."')";

	mysqli_query($db,$sql_donate);

		//   if (mysqli_query($db,$sql_donate)) {
		// 	echo "New record created successfully";
		//   } else {
		// 	echo "Error:". $sql_donate ." <br>" . mysqli_error($db);
		//   }
		
	header("location: donation_confirmation.php");
		
	mysqli_close($db);

	} 

?>


<!DOCTYPE html>

<html lang="en" class="html">
<head>
	<title> Donation Page </title>
	<link rel="stylesheet" href="style1.css" />
	<script src="script.js"></script>
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
			<!-- <div class="sidenav">
				<ul>
					<li> <a href="homepage.html"> Homepage </a></li>
					<li> <a href="aboutus.html"> About Us</a></li>
					<li> <a href="login.html"> Log-in or Register</a></li>
					<li> <a href="donation.html" class="active"> Donate Today</a></li>
					<li> <a href="profile.php"> Your Profile</a></li>
					<li> <a href="logout.php"> Sign Out</a></li>

				</ul>
			</div> -->


			<div class="top">
		<div class="bar white card" id="myNavbar">
		  <a href="homepage_loggedin.php" class="bar-item button wide">MOVEMBER	  
		  </a>
		  <!-- Right-sided navbar links -->
		  <div class="right hide-small">
			<!-- <a href="about" class="bar-item button">ABOUT</a> -->
			<a href="donationloggedin.php" class="bar-item button"><i class="fa fa-user"></i> Donate Now</a>
			<a href="profile.php" class="active bar-item button"><i class="fa fa-th"></i> Profile</a>
			<a href="logout.php" class="bar-item button"><i class="fa fa-usd"></i> Sign Out</a>
			<!-- <a href="#contact" class="bar-item button"><i class="fa fa-envelope"></i> CONTACT</a> -->
		  </div>
		</div>
	</div>

<br>
<br>
<br>
<br>	<div class = "spacer margin-top"></div>
	<div class = "bgimg-1 display-container " >
	<div class="light-grey display-middle" style="padding:50px;" id="donation">

				<h1 class="h1 padding-top-32"> Support the Mustache </h1>
				<p> Welcome back <?php echo htmlspecialchars($_SESSION["fname"]); ?></b>. Thank you once again for your kindness and caring - Movember Foundation could not fulfill its mission without your support. </p>
				<p> Please fill in the fields below to complete your donation:</p>

				<br><?php echo $error;?>

				<div class="paymentinfo">
					<form name = "donateinfo" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
						
						<h4> My Gift </h4>
						<label> Gift Amount</label><br>
						<input type="number" required name = "amount" placeholder= "$"> <br>

						<h4> My Information </h4>
						<label>First Name</label><br>
						<input type="text" required value = "<?php echo htmlspecialchars($_SESSION["fname"]); ?>"><br>
						<label>Last Name</label><br>
						<input type="text" required value = "<?php echo htmlspecialchars($_SESSION["lname"]); ?>"> <br>
						<label>Email</label><br>
						<input type="text" name = "email" required value = "<?php echo htmlspecialchars($_SESSION["email"]); ?>"><br>

						
						<label> Billing Address</label><br>
						<input type="text" required name ="address" value = "<?php echo htmlspecialchars($_SESSION["address"]); ?>">
						<h4> Payment Information </h4>
						<label>Cardholder Name</label><br>
						<input type="text" required name = "creditname" value = "<?php echo htmlspecialchars($creditname); ?>"> <br>
						<label>Credit Card Number</label><br>
						<input type="number" required name = "creditnumber" value = "<?php echo htmlspecialchars($creditcard_decrypt); ?>"> <br>
						<label>Expiry Date</label><br>
						<?php echo $valid_error ?>
						<span class="expiration" style = '.expiration {border: 1px solid #bbbbbb;}.expiration input {border: 0;}'>    
						<input type="text" name="month" value = "<?php echo htmlspecialchars($month);?>" placeholder="MM" maxlength="2" size="2" /><span> /</span>    
						<input type="text" name="year"  value = "<?php echo htmlspecialchars($year); ?>" placeholder="YY" maxlength="2" size="2" /></span> <br>
						<label>CVV</label><br>
						<input type="number" required> <br><br>

						

						<button class="button black" type="submit"> Donate!</button>
					</form>
</div>
</div>
					<br>
					<br>
					<br>
					<br>
					<!-- <footer class="footer">
						<address>
							BC Children's Hospital Foundation &copy; <br>
							<a href="mailto:clement_chow@sfu.ca"> Email us </a> <br>
							<a href="tel:604.875.2444"> 604.875.2444 </a> <br>
							8888 University Drive <br>
						</address>
					</footer> -->
		</body>
</html>
