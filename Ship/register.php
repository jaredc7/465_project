<?php

session_start();

$error = "";

if(!isset($_SESSION["register"]) && $_SESSION["register"] !== true){

    $_SESSION = array();
    $error_donation = "";

} else{
  $error_donation= "Thank you for your gift! Finish registering to complete your donation.";
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

    require_once "config.php";

    mysqli_select_db($db);
    
    $username     = $_POST["username"];
    $sql_username = "SELECT * FROM Users WHERE Username = '".$username."' ";


    $result_username  = mysqli_query($db,$sql_username);
    $username_row_num = mysqli_num_rows($result_username);

    // Checks if username is taken 
    if($username_row_num == 0 ){

        $email      = $_POST["email"];    
        $address    = $_POST["address"];  
        $fname      = $_POST["fname"] ;   
        $lname      = $_POST["lname"] ;   
        $password   = $_POST["password"] ; 
        $dob        = $_POST["DOB"] ; 
    
        $password_hash = password_hash($password,PASSWORD_DEFAULT);
    
        $sql_user = "INSERT INTO Users (DOB,Username,Pass,Email,fname,lname,address) VALUES ('".$dob."','".$username."','".$password_hash."','".$email."','".$fname."','".$lname."','".$address."')";
    
        mysqli_query($db,$sql_user);
        

	    // if (mysqli_query($db, $sql_user) ) {
			// echo "New record created successfully";
		  // } else {
			// echo "Error: " . $sql_user . "  <br>" . mysqli_error($db);
		  // }

        $creditnumber = my_encrypt($_SESSION["creditnumber"],$key);
        $creditname   = $_SESSION["creditname"];
        $year 		    =	$_SESSION["year"];
        $month 		    =	$_SESSION["month"];
        $amount 	    = $_SESSION["amount"];
        
        $sql_info     = "INSERT INTO paymentinfo (creditcard,creditcardname,expire_month,expire_year,UserID,address) VALUES ('".$creditnumber."','".$creditname."', '".$month."','".$year."','0','".$address."') ";
       
        mysqli_query($db,$sql_info);


        $sql_infonum  = "SELECT * FROM paymentinfo ORDER BY infonum DESC LIMIT 1";

        $result_infonum = mysqli_query($db,$sql_infonum);
        $row_infonum = mysqli_fetch_array($result_infonum);  
        $info_num = $row_infonum['infonum'];
        // $info_num       = mysqli_num_rows($result_infonum);
        
        $sql_id = "SELECT * FROM Users ORDER BY UserID DESC LIMIT 1";
        $result = mysqli_query($db,$sql_id);
        
        $row    = mysqli_fetch_array($result);
        $id     = $row['UserID'];
       
        $sql_donate = "INSERT INTO donations (donation_date,amount_cad,email,UserID,infonum)  VALUES (CURDATE(),'".$amount."','".$email."','".$id."','".$info_num."')";

        mysqli_query($db,$sql_donate);

      // if (mysqli_query($db, $sql_donate) ) {
			// echo "New record created successfully";
		  // } else {
			// echo "Error: " . $sql_donate . "  <br>" . mysqli_error($db);
		  // }
    
      $_SESSION = array();

      session_destroy();

      header("location: registrationconfirmation.html");

      
    } else{

        $error = "Sorry that username is already taken!";

    }

    mysqli_close($db);

   
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
		  <a href="index.html" class="bar-item button wide">MOVEMBER	  
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
<div class="light-grey display-middle " style="padding:48px" id="contact">

<h4> <?php echo $error_donation ?> </h4>

  <h3 class="center">Registration</h3>
  <p class="center large">To complete your registration, please fill in your information below.</p>
  <div style="margin-top:48px">
    <!-- <p><i class="fa fa-map-marker fa-fw xxlarge margin-right"></i> Chicago, US</p>
    <p><i class="fa fa-phone fa-fw xxlarge margin-right"></i> Phone: +00 151515</p>
    <p><i class="fa fa-envelope fa-fw xxlarge margin-right"> </i> Email: mail@mail.com</p> -->
  <form name = "register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit ="return validateForm()">
      <table border="0">
        <tr bgcolor=#D3D3D3>
        </tr>
        <tr>
       <td> <?php echo $error;?></td>
        </tr>
        <tr>
          <td>First Name</td> 
          <td align="center"><input type="text" name="fname" value = "<?php echo htmlspecialchars($_SESSION["fname"]); ?>"/> </td> 
        </tr>
        <tr>
          <td>Last Name</td>
          <td align="center"><input type="text" name="lname" value = "<?php echo htmlspecialchars($_SESSION["lname"]); ?>" /> </td> 
        </tr>
        
        <tr>
          <td>Username</td>
          <td align="center"><input type="text" name="username" /> </td> 
        </tr>
        <tr>
          <td>Email</td>
          <td align="center"><input type="text" name="email" value = "<?php echo htmlspecialchars($_SESSION["email"]); ?>" /> </td>
        </tr>
        <tr>
        <tr>
          <td>Address</td>
          <td align="center"><input type="text" name="address" value = "<?php echo htmlspecialchars($_SESSION["address"]); ?>" /></td>
        </tr>
        <tr>
          <td>Birthday</td>
          <td align="center"><input type="date" name="DOB" placeholder="YYYY-MM-DD" pattern="(?:19|20)\[0-9\]{2}-(?:(?:0\[1-9\]|1\[0-2\])/(?:0\[1-9\]|1\[0-9\]|2\[0-9\])|(?:(?!02)(?:0\[1-9\]|1\[0-2\])/(?:30))|(?:(?:0\[13578\]|1\[02\])-31))" 
required/></td>
        </tr>
        <tr>
          <td >Password</td>
          <td align="center"><input type="password" name="password" placeholder = "Enter your password" id = "pass"/></td>
        </tr>
        <tr>
          <td >Re-enter Your Password</td>
          <td align="center"><input type="password" name="repassword" placeholder = "Re-enter your password"id = "pass"/></td>
        </tr>
      </table>
        <button class="button black" type="submit">Register</button>
    </form>
    <!-- Image of location/map
    <img src="/w3images/map.jpg" class="image greyscale" style="width:100%;margin-top:48px"> -->
  </div>
</div>
</div>


<!-- 
<section class="page1">
<h2> Registration </h2>
    <form name = "register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit ="return validateForm()">
      <table border="0">
        <tr bgcolor=#D3D3D3>
        </tr>

        <tr>
        <td> To complete your registration, please fill in your information below. <br>
        <?php echo $error?></td>

       
        </tr>
        <tr>
          <td>First Name</td>
          <td align="center"><input type="text" name="fname" <?php echo htmlspecialchars($_SESSION["fname"]); ?>/></td> 
        </tr>
        <tr>
          <td>Last Name</td>
          <td align="center"><input type="text" name="lname" <?php echo htmlspecialchars($_SESSION["fname"]); ?>/> </td> 
        </tr>
        
        <tr>
          <td>Username</td>
          <td align="center"><input type="text" name="username" /> </td> 
        </tr>
        <tr>
          <td>Email</td>
          <td align="center"><input type="text" name="email" value = "<?php echo htmlspecialchars($_SESSION["email"]); ?>" /></td>
        </tr>
        <tr>
        <tr>
          <td>Address</td>
          <td align="center"><input type="text" name="address" value = "<?php echo htmlspecialchars($_SESSION["address"]); ?>" /></td>
        </tr>
        <tr>
          <td>Birthday</td>
          <td align="center"><input type="numeric" name="DOB" placeholder = "YYYY-MM-DD" /></td>
        </tr>
        <tr>
          <td >Password</td>
          <td align="center"><input type="password" name="password" placeholder = "Enter your password" id = "pass"/></td>
        </tr>
        <tr>
          <td >Re-enter Your Password</td>
          <td align="center"><input type="password" name="repassword" placeholder = "Re-enter your password"id = "pass"/></td>
        </tr>
      </table>
      <button type="submit">Register</button>
	  
    </form>
</section>
<div class=footer>
	
</div> -->
</body>

<script type = "text/javascript">
	
	function validateForm(){
		
		var user = document.forms["register"]["username"].value;
		var pass = document.forms["register"]["password"].value;
        var repass = document.forms["register"]["repassword"].value;
        var email = document.forms["register"]["email"].value;
		
    if (user == "" || pass == "" || repass == "" || email == ""){
			alert("Please complete your registration!");
			return false;
		}
    else if (pass != repass){
      alert("Your password's do not match!");
      return false;
    }
    
    
	}
	
	</script>

</html>

