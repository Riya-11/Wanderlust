<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
$package=$_SESSION['package'];
$sport=$_SESSION['sport'];
$date=$_SESSION['date'];
$uprem="Ultra Premium";
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center;
        background:url('final.jpg'); }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo $_SESSION['username']; ?></b>. Welcome to the Club.</h1>
    </div>
    <center>
    	
    	<?php
    	
    	
    	echo "Payment Details:<br><br><br>";
			switch ($package) {
    			case "Budget":
    			    echo "You have chosen Budget Package.Your bill costs 1,50,000 INR";
    			    break;
    			case "Premium":
    			    echo "You have chosen Premium Package.Your bill costs 4,50,000 INR";
    			    break;
    			case "Flagship":
    			    echo "You have chosen Flagship Package.Your bill costs 8,50,000 INR";
    			    break;
    			 case "Elite":
    			    echo "You have chosen Elite Package.Your bill costs 10,50,000 INR";
    			    break;
}
echo "<br><br>We hope that you have a great experience of $sport with us :)";
    	echo "<br><br>The journey starts at $date. Stay Prepared- we will keep updating you with the latest details:)";

?>
<br><br>
<?php
	
	


?>
    </center>
    <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
</body>
</html>
