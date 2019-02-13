<?php
//Page for validating the form
?>
<html>
<body>
<?php
	$username= "";
	$email = "";
	$errors = array(); 	

$db = mysqli_connect('localhost','root','batman','registration');
if (isset($_POST['register']))
{
	$username = $db->real_escape_string($_POST['username']);
	$username = $db->real_escape_string($_POST['username']);
	$email = $db->real_escape_string($_POST['email']);
	$password_1 = $db->real_escape_string($_POST['password_1']);
	$password_2 = $db->real_escape_string($_POST['password_2']);
	/*echo $username;
	echo $email;
	echo $password_1;
	echo $password_2;*/
	if(empty($username)) {
		array_push($errors , "Username is required");
	
	}
	
	if(empty($email)) {
		array_push($errors , "Email is required");
	
	}
	if(empty($password_1)) {
		array_push($errors , "Password is required");
	
	}
	if($password_1 != $password_2) {
		array_push($errors , "Passwords don't match");
	
	}

	if(count($errors)==0)
	
	{
		$password = md5($password_1);
		$sql= "INSERT INTO users (username,email,password) VALUES ('$username','$email','$password')";
		mysqli_query($db,$sql);
		//<script>alert('You are registered successfully !');</script>
		header("location: login.php");
		
	}

}

	
?>
</body>
</html>
