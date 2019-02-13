<?php
    session_start();

    //Start Database
        $IP = "localhost";
        $user = "root";
        $pass = "batman";
        $db = "registration";
        $con = mysqli_connect($IP, $user, $pass, $db);

        // Check connection
        if ( mysqli_connect_errno() ) {
            echo "<div>";
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            echo "</div>";
        }

    // Pretty much kicks out a user once they revisit this page and is logged in
    if( $_SESSION["name"] )
    {
        echo "You are already logged in, ".$_SESSION['name']."! <br> I'm Loggin you out M.R ..";
        unset( $_SESSION );
        session_destroy();
        exit("");
    }

    $loggedIn = false;
    $userName = $_POST["name"] or "";
    $userPass = $_POST["pass"] or "";

    if ($userName && $userPass )
    {
        // User Entered fields
        $query = "SELECT name FROM Clients WHERE name = '$userName' AND password = '$userPass'";// AND password = $userPass";

        $result = mysqli_query( $con, $query);
        $row = mysqli_fetch_array($result);

        if(!$row){
            echo "<div>";
            echo "No existing user or wrong password.";
            echo "</div>";
        }
        else
            $loggedIn = true;
    }

    if ( !$loggedIn )
    {
        echo "
            <form action='logmein.php' method='post'>
                Name: <input type='text' name='name' value='$userName'><br>
                Password: <input type='password' name='pass' value='$userPass'><br>
                <input type='submit' value='log in'>
            </form>
        ";
    }
    else{
        echo "<div>";
        echo "You have been logged in as $userName!";
        echo "</div>";
        $_SESSION["name"] = $userName;
    }
    
    
   ?>
