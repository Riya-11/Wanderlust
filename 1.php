<?php
	include('server.php');
	
?>
<!DOCTYPE html>
<html>
	<head>
	<style>
		body{
			background-image:url('login.jpg');
			background-repeat:no-repeat;
			color:white;
			font-size:50px;
		}
		td{
			padding:10px;
			
		}
		@font-face{ font-family: abcd;
			src:url('Fine Hand LET.ttf');}
			@font-face{font-family: ab;
			src:url('selima_.otf');}
			.c2{
				font-family:abcd;
				font-size:50px;
			}
			.c1{
				font-family:ab;
			}
		</style>
	</head>
	<body>
	<center>
	<p class="c2">Begin your adventure...</p>
	<p class="c1">We'll take care of the rest..</p>
		<form action="1.php" method="POST">
			<?php include('errors.php');?>
			<table>
				<tr>
					<td><b>Username:</b></td><td><input type="text" name="username" style="height:40px"></td>
				</tr>
				<tr>
					<td><b>Email:</b></td><td><input type="text" name="email" style="height:40px"></td>
				</tr>
				<tr>
					<td><b>Password:</b></td><td><input type="password" name="password_1" style="height:40px"></td>
				</tr>
				<tr>
					<td><b>Confirm Password:</b></td><td><input type="password" name="password_2" style="height:40px"></td>
				</tr>
				<tr>
				<td></td>	
					<td><input type="submit" name="register" style="height:40px;background-color:pink;border-radius:10%" value="Register"></td>>
				</tr>
			</table>
		</form>
		</center>
	</body>
</html>
