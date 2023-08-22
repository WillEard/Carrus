<?php
	// SESSION START
    session_start();

	// INCLUDE DBConnec.php ONCE
    include_once "DBConnec.php";
	// INCLUDE functions.php ONCE
    include_once "functions.php";

	// McGrath (2018, p. 68).
	// McGrath, M. (2018). PHP & MySQL in easy steps. 2nd Edition. Warwickshire. In Easy Steps.
?>

<?php
	// IF data is SET when submit form button pressed
    if (isset($_POST["submit"]))
    {
		/// SET VARIABLES To html 'ID' tag values
        $street = $_POST['Street'];

        $houseName = $_POST['HouseName'];

        $postcode = $_POST['Postcode'];

        $city = $_POST['City'];

        $fullName = $_POST['FullName'];

        $cardNum = $_POST['CardNum'];

        $security = $_POST['Security'];

        $expiry = $_POST['Expiry'];

        $carID = $_POST['carid'];

        $reg = $_POST['reg'];
		///
        
		// IF returns TRUE
        if (EmptyStreetOnPayment($street) != false)
        {
			// REDIRECT to Purchase.php emptyInp
            header("location: ../Purchase.php?errormsg=emptyInp");
			// EXIT SCRIPT
            exit();
        }

		// IF returns TRUE
        if (EmptyHouseNumOnPayment($houseName) != false)
        {
			// REDIRECT to Purchase.php emptyInp
            header("location: ../Purchase.php?errormsg=emptyInp");
			// EXIT SCRIPT
            exit();
        }

		// IF returns TRUE
        if (EmptyPostcodeOnPayment($postcode) != false)
        {
			// REDIRECT to Purchase.php emptyInp
            header("location: ../Purchase.php?errormsg=emptyInp");
			// EXIT SCRIPT
            exit();
        }

		// IF returns TRUE
        if (EmptyCityOnPayment($city) != false)
        {
			// REDIRECT to Purchase.php emptyInp
            header("location: ../Purchase.php?errormsg=emptyInp");
			// EXIT SCRIPT
            exit();
        }

		// IF returns TRUE
        if (EmptyNameOnPayment($fullName) != false)
        {
			// REDIRECT to Purchase.php emptyInp
            header("location: ../Purchase.php?errormsg=emptyInp");
            exit();
        }

		// IF returns TRUE
        if (EmptyCardNumberOnPayment($cardNum) != false)
        {
			// REDIRECT to Purchase.php emptyInp
            header("location: ../Purchase.php?errormsg=emptyInp");
			// EXIT SCRIPT
            exit();
        }

		// IF returns TRUE
        if (EmptySecurityOnPayment($security) != false)
        {
			// REDIRECT to Purchase.php emptyInp
            header("location: ../Purchase.php?errormsg=emptyInp");
			// EXIT SCRIPT
            exit();
        }

		// IF returns TRUE
        if (EmptyExpiryOnPayment($expiry) != false)
        {
			// REDIRECT to Purchase.php emptyInp
            header("location: ../Purchase.php?errormsg=emptyInp");
			// EXIT SCRIPT
            exit();
        }
		
		// IF returns TRUE - McGrath (2018, p. 68).
		if (!is_numeric($cardNum))
		{
			// REDIRECT to Purchase.php emptyInp
			header("location: ../Purchase.php?errormsg=CardNumNotNumeric");
			// EXIT SCRIPT
            exit();
		}
		
		// IF returns TRUE - McGrath (2018, p. 68).
		if (!is_numeric($security))
		{
			// REDIRECT to Purchase.php emptyInp
			header("location: ../Purchase.php?errormsg=SecurityNotNumeric");
			// EXIT SCRIPT
            exit();
		}
		
		// IF returns TRUE - McGrath (2018, p. 68).
		if (!is_numeric($expiry))
		{
			// REDIRECT to Purchase.php emptyInp
			header("location: ../Purchase.php?errormsg=ExpiryNotNumeric");
			// EXIT SCRIPT
            exit();
		}

        // CALL 'CompletePayment' method passing DB connection and data passed through form
        CompletePayment($conn, $carID, $reg, $street, $houseName, $postcode, $city, $fullName, $cardNum, $security, $expiry);

        // DOES NOT WORK DUE TO FOREIGN KEY CONSTRAINTS
        DeleteFromBuyList($conn, $carID);
    }
    else
    {	// REDIRECT to Purchase.php
        header("location: ../Purchase.php");
        exit();
    }