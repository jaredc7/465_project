<?php

$error = "";

$valid_error = "";

require_once "config.php";

$_SESSION = array();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])){
   

    session_start();
    
    $_SESSION["register"]     =  true;
    $_SESSION["email"]        =  $_POST["email"];
    $_SESSION["address"]      =  $_POST["address"];
    $_SESSION["fname"]        =  $_POST["fname"];
    $_SESSION["lname"]        =  $_POST["lname"];
    
    $_SESSION["creditnumber"] =  $_POST["creditnumber"];
    $_SESSION["creditname"]   =  $_POST["creditname"];
    $_SESSION["year"]         =  $_POST["year"];
    $_SESSION["month"]        =  $_POST["month"];
    $_SESSION["amount"]       =  $_POST["amount"];


    header("location: register.php");  

    } elseif ($_SERVER["REQUEST_METHOD"] == "POST"){

        session_start();
        mysqli_select_db($db);

        // Unset all of the session variables
    
        $creditnumber = $_POST["creditnumber"];
        $creditname   = $_POST["creditname"];
        $year 		    =	$_POST["year"];
        $month 		    =	$_POST["month"];
        
        $amount 	    = $_POST["amount"];
        $email 		    = $_POST["email"];
        $address      = $_POST["address"];


        $sql_info   = "INSERT INTO paymentinfo (creditcard,creditcardname,expire_month,expire_year,UserID,address) VALUES ('".$creditnumber."','".$creditname."', '".$month."','".$year."','0','".$address."') ";
        
        mysqli_query($db,$sql_info);
        
        $sql_infonum = "SELECT * FROM paymentinfo where UserID = 0 ORDER BY infonum DESC LIMIT 1";
        $result_infonum = mysqli_query($db,$sql_infonum);
        $row= mysqli_fetch_array($result_infonum);
        $info_num = $row["infonum"];
        $sql_donate = "INSERT INTO Donations (donation_date,amount_cad,email,UserID,infonum)  VALUES (CURDATE(),'".$amount."','".$email."','0','".++$info_num."')";
      
        mysqli_query($db,$sql_donate);

        // if (mysqli_query($db, $sql_info)) {
        //     echo "New record created successfully";
        //     } else {
        //     echo "Error: " . $sql_info . " <br>" . mysqli_error($db);
        //     }

        // if (mysqli_query($db, $sql_donate)) {
        //     echo "New record created successfully";
        //     } else {               
        //     echo "Error:  ". $sql_donate ." <br>" . mysqli_error($db);
        //     }    
            
        header("location: donation_confirmation_guest.php");
            
        mysqli_close($db);
    
        } else{}
 
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
	  image-rendering: auto;
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
		<li> <a href="login.php"> Log-in or Register</a></li>	
		<li> <a href="donation.html" class="active"> Donate Today</a></li>
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
  
<br>
<br>
<br>
    <div class = "bgimg-1 display-container ">
	<div class="light-grey display-middle " style="padding:50px;" id="login">
<section>
		<h1 class="h1"> Support the Mustache Today </h1>
		<p> Thank you once again for your kindness and caring - the Movember Foundation could not fulfill its mission without your support. </p>
		<p> Please fill in the fields below to complete your donation:</p>
</section>

<section>

<div class="paymentinfo">
<form name = "donateinfo" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">


<h4> My Gift </h4>
<label> Gift Amount</label><br>
<input type="text" required name = "amount"> <br><br>

<h4> Payment Information </h4>
<label>Credit Card Number</label><br>
<input type="text" required name = "creditnumber"> <br>
<label>Cardholder Name</label><br>
<input type="text" required name = "creditname"> <br>
<label>Expiry Date</label><br>
<?php echo $valid_error ?>
<span class="expiration" style = '.expiration {border: 1px solid #bbbbbb;}.expiration input {border: 0;}'>    
<input type="text" name="month" value = "<?php echo htmlspecialchars($month);?>" placeholder="MM" maxlength="2" size="3" /><span> /</span>    
<input type="text" name="year"  value = "<?php echo htmlspecialchars($year); ?>" placeholder="YY" maxlength="2" size="3" /></span> <br>
<label>CVV</label><br>
<input type="number" required> <br><br>


<h4> My Information </h4>
<label>First Name</label><br>
<input type="text" required name = "fname"> <br>
<label>Last Name</label><br>
<input type="text" required name = "lname"> <br>
<label>Email</label><br>
<input type="text" required name = "email"> <br>
<label> Billing Address</label><br>
<input type="text" required name = "address"> <br>





<!-- <label>First Name</label><br>
<input type="text" required name = "fname"> <br>
<label>Last Name</label><br>
<input type="text" required name = "lname"> <br>
<label>Email</label><br>
<input type="text" required name = "email"> <br> <br> -->
<input type="checkbox" name = "register" > 
<label>Check this box to register an account</label> <br>
<br><button class="button black" type="submit"> Donate!</button>
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

<!-- <script type = "text/javascript">

</script> -->

</html>

