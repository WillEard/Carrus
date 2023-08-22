<?php
	// SESSION START
    session_start();

	// SET default timezone to Europe/London - PHP uses UTC as standard -1hours
	date_default_timezone_set('Europe/London');

	// INCLUDE DBConnec.php ONCE
    include_once "php-includes/DBConnec.php";
	// INCLUDE functions.php ONCE
    include_once "php-includes/functions.php";
?>

<?php
	// IF Data is set and submit clicked for form
    if (isset($_POST["submit"]))
    {
		// SET username to 'Username' html ID
        $username = $_POST['Username'];

		// SET subject to 'Subject' html ID
        $subject = $_POST['Subject'];

		// SET email to 'Email' html ID
        $email = $_POST['Email'];

		// SET message to 'Message' html ID
        $message = $_POST['Message'];

		// SET from to email
        $from = "From: ".$email;

        // IF subject is NULL/EMPTY
        if (empty($subject))
        {
			// REDIRECT to Contact.php with emptySub error
            header("location: ../Contact.php?errormsg=emptySub");
			// EXIT SCRIPT
            exit();    
        }

		// IF subject is NULL/EMPTY
        if (empty($message))
        {
			// REDIRECT to Contactphp with emptyMsg error
            header("location: ../Contact.php?errormsg=emptyMsg");
			//EXIT SCRIPT
            exit();    
        }
    	
			
		/* FOR DEBUGGING
		echo "Email To: ".$ServerEmail;
		echo "Subject : ".$subject;
		echo "Message : ".$message;
		echo "From: ".$email;
		*/
		
		// SET ServerEmail to database email
		$ServerEmail = "Carrus@earw1-19.wbs.uni.worc.ac.uk";

		// GET DATE and TIME to attach
		$date = date('l jS \of F Y h:i:s A');

		// CONCATENATE message and date together
		$MsgWithDate = $message . " - Date of contact: " . $date;
				
		// CALL 'mail' to send data off as an email
		if (mail($ServerEmail, $subject, $MsgWithDate, $from))
		{
			// REDIRECT to Contact.php with success
			header("location: ../Contact.php?errormsg=Success");
			// EXIT SCRIPT
			exit();
		}
		else
		{
			// REDIRECT to Contact.php with internal error
			header("location: ../Contact.php?errormsg=InternalError");
			// EXIT SCRIPT
			exit();
		}
		
    }
    else
    {
		// REDIRECT to Contact.php
       	header("location: ../Contact.php");
		// EXIT SCRIPT
        exit();
    }

?>