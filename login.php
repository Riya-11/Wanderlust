<?php
session_start();// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$contact=$credit="";
$contact_err=$credit_err="";
$package=$package_err="";
$sport=$sport_err="";
$date=$date_err="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = md5($_POST['password']);
        //$password=$hashed_pass;
    }
    if(empty(trim($_POST['contact']))){
        $contact_err = 'Please enter your contact no.';
    } else{
        $contact = trim($_POST['contact']);
    }
    if(empty(trim($_POST['credit']))){
        $credit_err = 'Please enter your Credit Card Number.';
    } else{
        $credit = trim($_POST['credit']);
    }
    if(empty(trim($_POST['package']))){
    	$package_err='Please select a package.';
    }else{
        $package = trim($_POST['package']);
    }
    if(empty(trim($_POST['sport']))){
    	$sport_err='Please enter the sport.';
    }else{
        $sport = trim($_POST['sport']);
    }
    if(empty(trim($_POST['date']))){
    	$date_err='Please select the date of your journey.';
    }else{
        $date = trim($_POST['date']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err) && empty($contact_err) && empty($credit_err) && empty($package_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = '$username'";
         $result = mysqli_query($link, $sql);	
        $sql="SELECT password FROM users WHERE username = '$username'";
        $result2 = mysqli_query($link, $sql);
        $row2=mysqli_fetch_assoc($result2);
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if($password==$row2['password']){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            /*if($re == "on"){ //remember me checked
                setcookie("username",$username,time() + (86400  * 10));
                header("location: welcome.php");
            }*/
            				//else{
                            $_SESSION['username'] = $username;   
                            $_SESSION['package'] = $package;
                            $_SESSION['sport'] = $sport;   
                            $_SESSION['date'] = $date;    
                            header("location: welcome.php");
                        	//}
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'You are not registered !!<br><p>Don\'t have an account? <a href="1.php">Sign up now</a>.</p>';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"-->
    <style type="text/css">
        @font-face{ font-family: abc;
			src:url('HoneyScript-SemiBold.ttf');}
        body{ font-size: 29px; background:url('form1.jpg');background-repeat:no-repeat;color:white;}
        .wrapper{ width: 350px; padding: 20px; }
       	td{
        	padding:10px;
        };
        
    </style>
</head>
<body>
<center>
    <div class="wrapper">
        <h2>Join the Club</h2>
        <p>Fill in your credentials to begin the journey!</p>
        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
        <table>
        <tr>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <td><label>Username:<sup>*</sup></label></td>
                <td><input type="text" name="username"class="form-control" value='<?php echo $username; ?>' style="height:40px;font-size:'25px'"></td>
                <td ><span class="help-block"><?php echo $username_err; ?></span></td>
            </div>  
        </tr>  
        <tr>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
              <td>  <label>Password:         <sup>*</sup></label></td>
               <td><input type="password" name="password" style="height:40px;font-size:'20px'" class="form-control" ></td>
                <td><span class="help-block"><?php echo $password_err; ?></span></td>
            </div>
            </div>
        </tr>
       <tr>
             <div class="form-group <?php echo (!empty($sport_err)) ? 'has-error' : ''; ?>">
               <td> <label>Select your sport:<sup>*</sup></label></td>
                <td><select name="sport" id="pack" style="height:40px;font-size:'20px'">
                	<option value="">--Select--</option>
                	<option value="Paragliding">Paragliding</option>
                	<option value="Kayaking">Kayaking</option>
                	<option value="ScubaDiving">Scuba Diving</option>
                	<option value="MountainBiking">Mountain Biking</option>
                	<option value="Surfing">Surfing</option>
                	<option value="Trekking">Trekking</option>
                	<option value="Skiing">Skiing</option>
                	<option value="BungeeJumping">Bungee Jumping</option>
                </select>
                </td>
                <td><span class="help-block"><?php echo $sport_err; ?></span></td>
            </div>
            </tr>
            
        <tr>    
            <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
               <td> <label>Date of Journey:<sup>*</sup></label></td>
                <td><input type="date" name="date" class="form-control" value="<?php echo $date; ?>" size="30"  maxlength="10" style="height:40px;font-size:'20px'"></td>
                <td><span class="help-block"><?php echo $date_err; ?></span></td>
            </div>
            </div>    
         </tr>
        <tr>    
            <div class="form-group <?php echo (!empty($contact_err)) ? 'has-error' : ''; ?>">
               <td> <label>Contact No.:<sup>*</sup></label></td>
                <td><input type="number" name="contact" class="form-control" value="<?php echo $contact; ?>" size="30"  maxlength="10" style="height:40px;font-size:'20px'"></td>
                <td><span class="help-block"><?php echo $contact_err; ?></span></td>
            </div>
            </div>    
         </tr>
         <tr>
            <div class="form-group <?php echo (!empty($credit_err)) ? 'has-error' : ''; ?>">
               <td> <label>Credit Card Number:     <sup>*</sup></label></td>
                <td><input type="number" name="credit" class="form-control" size="30" maxlength="15" style="height:40px;font-size:'20px'"></td>
                <td><span class="help-block"><?php echo $credit_err; ?></span></td>
            </div>
          </tr>
          <tr>
             <div class="form-group <?php echo (!empty($package_err)) ? 'has-error' : ''; ?>">
               <td> <label>Select your package type:<sup>*</sup></label></td>
                <td><select name="package" id="pack" style="height:40px;font-size:'20px'">
                	<option value="">--Select--</option>
                	<option value="Budget">Budget</option>
                	<option value="Premium">Premium</option>
                	<option value="Flagship">Flagship</option>
                	<option value="Elite">Elite</option>
                </select>
                </td>
                <td><span class="help-block"><?php echo $package_err; ?></span></td>
            </div>
            </tr>
            <!--<input type="number" id="price">-->
            <tr>
            <td></td>
            <td>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" style="background-color:pink;border-radius:10%;height:50px;width:90px;font-size:'20px'">
            </div>
            </td>
            </tr>
         </table>   
        </form>
    </div>
    <!--script>
    	e=document.getElementById('pack').value;
    	if(e =="Premium"){
    		document.getElementById('price').innerHTML = 1,50,000;
    	}
    	if(e == "Ultra"){
    		document.getElementById('price').value = 2,50,000;
    	}
    </script-->   
    </center> 
</body>
</html>
