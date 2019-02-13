<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 setcookie("username",$username, time() - (86400  * 10));
// Redirect to login page
//echo "<script>alert('You have logged out of your account');</script>";
header("location: login.php");
exit;
?>
