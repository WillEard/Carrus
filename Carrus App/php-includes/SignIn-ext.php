<?php
	// SESSION START
    session_start();

	// SET Date time to Europe/Lodon - PHP is UTC by default
	date_default_timezone_set('Europe/London');


    // IF 'submit' button is pressed
    if(isset($_POST["submit"]))
    {
        // SET 'email' to data entered from email field
        $email = $_POST['email'];
    
        // SET 'pass' to data entered from password field
        $pass = $_POST['pass'];

        // SELECT ALL from 'user_accounts' table 
        $query = "SELECT * FROM user_accounts WHERE Email = 'Email' AND 'pass' ='$password'";

        // SET Username entered from session as the username to use
        $_SESSION['Username'] = $username;

        // REQUIRE / USE 'DBConnec.php' only once
        require_once "DBConnec.php";

        // REQUIRE / USE 'DBConnec.php' only once
        require_once "functions.php";

        // IF RETURN boolean from 'emptyEmailOnSignIn' method is NOT FALSE
        if (emptyEmailOnSignIn($email) != false) 
        {
            // DISPLAY empty input error
            header("location: ../SignIn.php?errormsg=emptyInp");
            // EXIT script
            exit();
        }

        // IF RETURN boolean from 'emptyPassOnSignIn' method is NOT FALSE
        if (emptyPassOnSignIn($pass) != false)
        {
            // DISPLAY empty input error
            header("location: ../SignIn.php?errormsg=emptyInp");
            // EXIT script
            exit();
        }

        // CALL 'SignInUser' method - passing through connection, username, email and password
        SignInUser($conn, $username, $email, $pass);
		
		// SET ServerEmail to database email
		$ServerEmail = "Carrus@earw1-19.wbs.uni.worc.ac.uk";
		// SET data to system date/time
		$date = date('l jS \of F Y h:i:s A');
		// SET subject to Login
		$subject = "Login";
		// SET message to logged in message and date
		$message = "You logged in at: ".$date;
		
		// FROM = users email
		$From = $email;
		
		// SEND EMAIL TO NOTIFY LOGIN
		mail($ServerEmail, $subject, $message, $From);
    }
    else
    {
        // CALL 'SignIn.php' file to refresh page
        header("location: ../SignIn.php");
        // EXIT script
        exit();
    }
?>