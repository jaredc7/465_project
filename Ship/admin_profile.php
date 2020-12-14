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
	<title> Movember Admin Profile </title>
    <link rel="stylesheet" href="style1.css" />
	<script src="jquery-3.2.1.min.js"></script>
	<script src="jquery.dataTables.min.js"></script>	
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
    


.grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto;
  grid-gap: 10px;
  padding: 10px;
}

.grid-container > div {
  text-align: left;
  font-size: 30px;
}

    </style>
    
<body>
<!-- <div class="sidenav">
	<ul>
		<li> <a href="homepage.html"> Homepage </a></li>
		<li> <a href="aboutus.html"> About Us</a></li>
		<li> <a href="donationloggedin.php"> Donate Today</a></li>
		<li> <a href="profile.php" class="active"> Your Profile</a></li>
        <li> <a href="logout.php"> Sign Out</a></li>
	</ul>
</div> -->

<div class="top">
<div class="bar white card" id="myNavbar">
		  <a href="admin_profile.php" class="bar-item button wide">MOVEMBER	  
		  </a>
		  <!-- Right-sided navbar links -->
		  <div class="right hide-small">
			<!-- <a href="about" class="bar-item button">ABOUT</a> -->
			<!-- <a href="donationloggedin.php" class="bar-item button"><i class="fa fa-user"></i> Donate Now</a> -->
      <a href="admin_profile.php" class="active bar-item button"><i class="fa fa-th"></i> Donation Information </a>
      <a href="admin_userinfo.php" class="active bar-item button"><i class="fa fa-th"></i> Donor Information</a>

			<a href="logout.php" class="bar-item button"><i class="fa fa-usd"></i> Sign Out</a>
			<!-- <a href="#contact" class="bar-item button"><i class="fa fa-envelope"></i> CONTACT</a> -->
		  </div>
		</div>
	</div>


<div class = "bgimg-1 display-container">
<div class="jumbo text-black" style= "padding:60px 0 0 10px;">Welcome Back, <?php echo htmlspecialchars($_SESSION["fname"]); ?> </div><br>

<div class ="grid-container ">
<div class ="light-grey large" >
    <h2 class="h2"> Recent Activity </h2>
    <table id="myTable" cellspacing="20" >
<?php 

require_once ("config.php");

mysqli_select_db($db);

$sql = "SELECT  * FROM donations d LEFT JOIN Users u on d.UserID = u.UserID  ";

// Attempt select query execution
if($result = mysqli_query($db, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<thead>";
            echo "<tr>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Email</th>";
                echo "<th>Donation Date</th>";
                echo "<th>Amount</th>";
                echo "<th>Receipt Number</th>";
            echo "</tr>";
            echo "</thead><tbody>";
        while($row = mysqli_fetch_array($result)){

       

                echo "<tr>";
                echo "<td>" . $row['fname'] . "</td>";
                echo "<td>" . $row['lname'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['donation_date'] . "</td>";
                echo "<td>$" . $row['amount_cad'] . "</td>";
                echo "<td>" . $row['donationid'] . "</td>";           					 
            echo "</tr>";
          
        }
        echo "</tbody></table>";


        // Free result set
        mysqli_free_result($result);
    } else{
        echo "<h3> No Donations Yet! </h3>";
    }
} 

// Close connection
// mysqli_close($db);
?>
</div>

<br>

<div class = "light-grey center">

<?php 

require_once ("config.php");

mysqli_select_db($db);


echo "<br>";

$sql = "SELECT count(distinct(UserID)) as contri, count(*) as donation_total, sum(amount_cad) as donation_sum FROM donations";
$sql_anon = "SELECT count(*) as contri, count(*) as donation_total, sum(amount_cad) as donation_sum FROM donations WHERE UserID = '0'";


$result  = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result);

$result_anon = mysqli_query($db,$sql_anon);
$row_anon = mysqli_fetch_array($result_anon);

echo "<div class ='border-bottom'> Donation Statistics </div> ";

echo "<strong><h2>Number of Gifts</h2></strong>"; 
echo $row['donation_total'];

echo "<br><strong><h2>Total Amount Given</h2></strong>";

echo '$';
echo $row['donation_sum'];


echo "<br><h2><strong>Number of Registered Donors (Given)</h2></strong>";

echo $row['contri'];

echo "<br><h2><strong>Number of Anonymous Donors (Given)</h2></strong>";

echo $row_anon['contri'];

mysqli_close($db)


?>
</div>

</div>




<script> $(document).ready(function() {
$('#myTable').DataTable(); });
</script>
<!-- <br>
<br>
<br>
<br> -->

</body>


<!-- <footer class="footer">
	<address>
	BC Children's Hospital Foundation &copy; <br>
	<a href="mailto:clement_chow@sfu.ca"> Email us </a> <br>
	<a href="tel:604.875.2444"> 604.875.2444 </a> <br>
	8888 University Drive <br>
	</address>
</footer> -->
</html>





