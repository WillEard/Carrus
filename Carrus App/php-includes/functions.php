<?php
	// REQUIRE DBConnec.php ONCE
    require_once "DBConnec.php";
	
	// SET timezone to Europe/London
	date_default_timezone_set("Europe/London");

	// McGrath (2018, p. 179). 
	// McGrath, M. (2018). PHP & MySQL in easy steps. 2nd Edition. Warwickshire. In Easy Steps.

/*
-- SIGN UP FUNCTIONS
*/
// FUNCTION 'emptyOnSignup' - Checks if any fields are empty when user hits submit
function emptyOnSignup($firstName, $surname, $email, $phone, $pass)
{
	// DECLARE Variable
    $rslt;
    
	// IF any variables are empty
    if (empty($firstName) || empty($surname) || empty($email) || empty($phone) || empty($pass))
    {
		// SET to TRUE
        $rslt = true;
    }
    else
    {
		// SET to FALSE
        $rslt = false;
    }

	// RETURN result
    return $rslt;   
}

// FUNCTION 'invalidEmail' - checks if the email entered is valid and contains correct characters
function invalidEmail($email)
{
    $rslt;
    
	// IF email variable is not a valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
		// SET to true
        $rslt = true;
    }
    else
    {
		// SET to FALSE
        $rslt = false;
    }

	// RETURN result
    return $rslt;   
}

// FUNCTION 'usernameAlreadyExist' - checks if username entered already exists
function UsernameAlreadyExist($conn, $username)
{
	// SQL query - SELECT ALL from user_accounts WHERE username is name passed through
    $sql = "SELECT * FROM user_accounts WHERE Username = ?;";

	// INITIALISE sql statement
    $stmt = mysqli_stmt_init($conn);

	// IF SQL statement returns FALSE
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
		// REDIRECT to SignUp.php with error
        //header("location: ../SignUp.php?errormsg=statementFailure");
		
		header("location: https://google.com/");

		
		// EXIT SCRIPT
        exit();
    }

	// BIND variables in parameters - 's' = STRING
    mysqli_stmt_bind_param($stmt, "s", $username);
	
	// EXECUTE SQL statememtn
    mysqli_stmt_execute($stmt);

	// GET RESULT from SQL statememt
    $rsltInfo = mysqli_stmt_get_result($stmt);

	// IF a row returns from statememnt - McGrath (2018, p. 179). 
    if ($row = mysqli_fetch_assoc($rsltInfo))
    {
		// RETURN row
        return $row;
    }
    else
    {
		// SET result to FALSE
        $rslt = false;
		
		// RETURN result
        return $rslt;
    }

	// CLOSE STATEMENT
    mysqli_stmt_close($stmt);
}

// FUNCTION 'emailAlreadyExist' - checks if the email entered already exists
function emailAlreadyExist($conn, $email)
{
	// SQL statememnt - SELECT ALL from user_accounts table where EMAIL = email passed through
    $sql = "SELECT * FROM user_accounts WHERE Email = ?;";

	// INITIALISE SQLI statement 
    $stmt = mysqli_stmt_init($conn);

	// IF returns FALSE
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
		// REDIRECT to SignUp.php with statementFailure
        //header("location: ../SignUp.php?errormsg=statementFailure");
				header("location: https://google.com/");

		
		// EXIT SCRIPT
        exit();
    }
	
	// BIND PARAMETERS with STRING    
    mysqli_stmt_bind_param($stmt, "s", $email);
	
	// EXECUTE query
    mysqli_stmt_execute($stmt);

	// GET RESULT
    $rsltInfo = mysqli_stmt_get_result($stmt);

	// IF ROW EXISTS - McGrath (2018, p. 179). 
    if($row = mysqli_fetch_assoc($rsltInfo))
    {
		// RETURN row
        return $row;
    }
    else
    {
		// result = FALSE
        $rslt = false;
		
		// RETURN result
        return $rslt;
    }

	// CLOSE STATEMENT
    mysqli_stmt_close($stmt);
}

// FUNCTION to check if phone number already exists
function PhoneNoAlreadyExist($conn, $phone)
{	
	// PREPARE SQL statement - SELECT ALL from user_accounts where phone number is same as value passed
	$sql = "SELECT * FROM user_accounts WHERE PhoneNo = ?;";

	// INITIALISE connection to database
    $stmt = mysqli_stmt_init($conn);

	// IF prepare returns FALSE
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
		// REDIECT to SignUp.php with error
        header("location: ../SignUp.php?errormsg=statementFailure");
				//header("location: https://google.com/");

		// EXIT SCRIPT
        exit();
    }
        
	// BIND PARAMETERS passing INTEGER
    mysqli_stmt_bind_param($stmt, "i", $phone);
	
	// EXECUTE query
    mysqli_stmt_execute($stmt);

	// GET result from query
    $rsltInfo = mysqli_stmt_get_result($stmt);

	// IF a row returns from query - McGrath (2018, p. 179). 
    if($row = mysqli_fetch_assoc($rsltInfo))
    {
		// RETURN ROW
        return $row;
    }
    else
    {
		// SET to FALSE
        $rslt = false;
		// RETURN result
        return $rslt;
    }

	// CLOSE CONNECTION
    mysqli_stmt_close($stmt);
	
}

// FUNCTION 'SignUpUser' - Inserts the users information into the database and initialises their account
function SignUpUser($conn, $firstName, $surname, $username, $email, $phone, $pass)
{
	// PREPARE SQL statement - INSERT data into user_accounts table
    $sql = "INSERT INTO user_accounts (FirstName, Surname, Username, Email, PhoneNo, Pass) VALUES (?, ?, ?, ?, ?, ?);";

	// INITIALISE query
    $stmt = mysqli_stmt_init($conn);

	// IF returns FALSE
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
		// REDIRECT to signup.php with error
        header("location: ../SignUp.php?errormsg=statementFailure");
		
		// EXIT SCRIPT
        exit();
    }

	// HASH Password
    $EncryptPass = password_hash($pass, PASSWORD_DEFAULT); 
        
	// BIND PARAMETERS together - strings and integers
    mysqli_stmt_bind_param($stmt, "ssssis", $firstName, $surname, $username, $email, $phone, $EncryptPass);
	
	// EXECUTE query
    mysqli_stmt_execute($stmt);
	
	// CLOSE query
    mysqli_stmt_close($stmt);

	// REDIRECT to SignIn.php
    header("location: ../SignIn.php");
	
	// EXIT SCRIPT
    exit();
}


/*
-- SIGN IN FUNCTIONS
*/
// FUNCTION 'emptyEmailOnSignIn' - Checks if email field is empty when user hits submit
function emptyEmailOnSignIn($email)
{
	// 
    $rslt;
    
	// IF EMPTY
    if (empty($email))
    {
		// SET to TRUE
        $rslt = true;
    }
    else
    {
		// SET to FALSE
        $rslt = false;
    }

	// RETURN result
    return $rslt;   
}

// FUNCTION 'emptyUserOnSignIn' - Checks if username field is empty when user hits submit
function emptyUserOnSignIn($username)
{
    $rslt;

	// IF EMPTY
    if (empty($username))
    {
		// SET to TRUE
        $rslt = true;
    }
    else
    {
		// SET to FALSE
        $rslt = false;
    }

	// RETURN result
    return $rslt;
}

// FUNCTION 'emptyPassOnSignIn' - Checks if password field is empty when user hits submit
function emptyPassOnSignIn($pass)
{
    $rslt;

	// IF EMPTY
    if (empty($pass))
    {
		// SET to TRUE
        $rslt = true;
    }
    else
    {
		// SET to FALSE
        $rslt = false;
    }

	// RETURN result
    return $rslt;
}

// FUNCTION 'SignInUser' ' Signs in the user
function SignInUser($conn, $username, $email, $pass)
{
    // DECLARE variable 'loginAttempts' to track login attempts
    $loginAttempts = 0;

	// GET return from emailAlreadyExist
    $emailExist = emailAlreadyExist($conn, $email);
    
	// IF FALSE
    if($emailExist == false)
    {
		// REDIRECT to SignIn.php with error
        header("location: ../SignIn.php?errormsg=incorrEmail");
		
		// EXIT SCRIPT
        exit();
    }

	// Check Pass column to get password hash
    $passHSHD = $emailExist["Pass"];

	// COMPARE hash to password entered
    $chkHSHDPass = password_verify($pass, $passHSHD);
    
	// IF passwords DO NOT MATCH
    if ($chkHSHDPass === false)
    {   
		// REDIRECT to SignIn.php with error
        header("location: ../SignIn.php?errormsg=invPass");
		
		// EXIT SCRIPT
        exit();
    }
	// ELSE IF passwords DO MATCH
    else if ($chkHSHDPass === true)
    {
		// START SESSION
        session_start();

		// SET Session Email to current email
        $_SESSION["email"] = $emailExist["Email"];
		
		// REDIRECT to index.php
        header("location: ../index.php");
		
		// EXIT SCRIPT
        exit();
    }
}


/*
-- GET ACCOUNT DETAILS FUNCTIONS
*/

function GetUsername($conn)
{      
    // 4EACH. (2014). Select from session username. [online] Available at: https://stackoverflow.com/questions/22596183/select-from-session-username (Accessed: 05 April 2022).
	// 4EACH. (2014). 
	// PREPARE query - SELECT Username from user_accounts WHERE email = session email
    $query  = "SELECT Username FROM user_accounts WHERE Email = '" .$_SESSION['email']."'";

	// PROCESS query
    $result = mysqli_query($conn, $query);

	// WHILE a row is found with data from query - McGrath (2018, p. 179). 
    while ($row = mysqli_fetch_assoc($result)) 
    {
		// SET username to Username column value
        $username = $row["Username"]; 
    }

	// RETURN username
    return $username;                   
}

function GetFirstName($conn)
{
	// 4EACH. (2014). Select from session username. [online] Available at: https://stackoverflow.com/questions/22596183/select-from-session-username (Accessed: 05 April 2022).
	// 4EACH. (2014). 
    $query = "SELECT FirstName FROM user_accounts WHERE Email = '" .$_SESSION['email']."'";

	// PROCESS query
    $result = mysqli_query($conn, $query);

	// WHILE row found with data from query - McGrath (2018, p. 179). 
    while ($row = mysqli_fetch_assoc($result))
    {
		// SET firstname to FirstName column data
        $firstname = $row["FirstName"];
    }

	// RETURN firstname
    return $firstname;
}

function GetSurname($conn)
{
    // 4EACH. (2014). Select from session username. [online] Available at: https://stackoverflow.com/questions/22596183/select-from-session-username (Accessed: 05 April 2022).
	// 4EACH. (2014). 
	// PREAPRE QUERY - SELECT Surname FROM user_accounts where the email is the session email
    $query = "SELECT Surname FROM user_accounts WHERE Email = '" .$_SESSION['email']."'";

	// PROCESS query - returns TRUE or FALSE
    $result = mysqli_query($conn, $query);

	// WHILE a row with matching data is found - McGrath (2018, p. 179). 
    while ($row = mysqli_fetch_assoc($result))
    {
		// SET surname to Surname column value
        $surname = $row["Surname"];
    }

	// RETURN surname
    return $surname;
}

// FUNCTION GetEmail
function GetEmail($conn)
{
}


/*
-- ACCOUNT PASSWORD FUNCTIONS
*/

function GetPassword($conn, $getpass)
{
	// 4EACH. (2014). Select from session username. [online] Available at: https://stackoverflow.com/questions/22596183/select-from-session-username (Accessed: 05 April 2022).
	// 4EACH. (2014). 
    $query = "SELECT Pass FROM user_accounts WHERE Email = '" .$_SESSION['email']."'";

	// PROCESS query
    $result = mysqli_query($conn, $query);

	// WHILE row returned with data from query - McGrath (2018, p. 179). 
    while ($row = mysqli_fetch_assoc($result))
    {
		// SET getpass to Pass column value
        $getpass = $row["Pass"];
    }

    // CALL password_verify PHP method to dehash password and compare hashed password with inputted password
    $chkHSHDPass = password_verify($getpass, $chkHSHDPass);

    // IF PASSWORD DOES NOT MATCH SEND ERROR
    if ($chkHSHDPass === false)
    {
        // SET check to fail
        $check = "fail";
		// RETURN check
        return $check;
		// EXIT SCRIPT
        exit();
    }
    // ELSE IF PASSWORD DOES MATCH
    else if ($chkHSHDPass === true)
    {
		// SET check to success
        $check = "success";
		// RETURN check
        return $check;
		// EXIT SCRIPT
        exit();
    }
}


/*
-- DELETE ACCOUNT FUNCTIONS
*/

function DeleteAccount($conn, $deletereturn)
{
	// 4EACH. (2014). Select from session username. [online] Available at: https://stackoverflow.com/questions/22596183/select-from-session-username (Accessed: 05 April 2022).
	// 4EACH. (2014). 
    // GET UserID to use for DELETING
    $query = "SELECT UserID FROM user_accounts WHERE Email = '" .$_SESSION['email']."'";

	// PREPARE SQL query
    $result = mysqli_query($conn, $query);

	// WHILE row containing data from query is found - McGrath (2018, p. 179). 
    while ($row = mysqli_fetch_assoc($result))
    {
		// SET userid to UserID column value
        $userid = $row["UserID"];
    }

    
	// REF - TutorialRepublic. (2022). PHP MySQL DELETE Query. [online] Available at: https://www.tutorialrepublic.com/php-tutorial/php-mysql-delete-query.php (Accessed: 05 April 2022).
	// (TutorialRepublic, 2022).

    // DELETE FROM Orders where UserID = useriD from session
    $query = "DELETE FROM Orders WHERE UserID = '$userid'";

	// PROCESS query
    $result = mysqli_query($conn, $query);

	// IF query returns TRUE
    if(mysqli_query($conn, $query))
    {

        // DELETE User and all information from user_accounts, Vehicles and PaymentInformation to completely erase user data.
        $query = "DELETE FROM user_accounts WHERE UserID = '$userid'";

		// PROCESS query
        $result = mysqli_query($conn, $query);

		// IF query returns TRUE
        if (mysqli_query($conn, $query))
        {			
			// SET deletereturn to Success
            $deletereturn = "success";
			
			// RETURN deletereturn
            return $deletereturn;
        }
        else
        {			
			// SET deletereturn to Fail
            $deletereturn = "fail";
			// RETURN deletereturn
            return $deletereturn;
        }


        $deletereturn = "success";

    } 
	// ELSE FAIL
    else
    {	// SET deletereturn to fail
        $deletereturn = "fail";
    }

	// RETURN deletereturn
    return $deletereturn;
	
	// EXIT SCRIPT
    exit();

	// CLOSE CONNECTION
    $conn->close();
}


/*
-- PAYMENT FUNCTIONS
*/

// FUNCTION EmptyStreetOnPayment
function EmptyStreetOnPayment($street)
{
    $result;

	// IF EMPTY
    if (empty($street))
    {
		// SET TO TRUE
        $result = true;
    }
    else
    {
		// SET TO FALSE
        $result = false;
    }

	// RETURN RESULT
    return $result; 
}

// FUNCTION EmptyHouseOnPayment
function EmptyHouseNumOnPayment($houseName)
{
    $result;

	// IF EMPTY
    if (empty($houseName))
    {
		// SET TO TRUE
        $result = true;
    }
    else
    {
		// SET TO FALSE
        $result = false;
    }

	// RETURN RESULT
    return $result; 
}

// FUNCTION EmptyPostcodeOnPayment
function EmptyPostcodeOnPayment($postcode)
{
    $result;

	// IF EMPTY
    if (empty($postcode))
    {
		//SET TO TRUE
        $result = true;
    }
    else
    {
		// SET TO FALSE
        $result = false;
    }

	// RETURN RESULT
    return $result; 
}

// FUNCTION EmptyCityOnPayment
function EmptyCityOnPayment($city)
{
    $result;

	// IF EMPTY
    if (empty($city))
    {
		// SET TO TRUE
        $result = true;
    }
    else
    {
		// SET TO FALSE
        $result = false;
    }

	// RETURN RESULT
    return $result; 
}

// FUNCTION EmptyNameOnPayment
function EmptyNameOnPayment($fullName)
{
    $result;

	// IF EMPTY
    if (empty($fullName))
    {
		// SET TO TRUE
        $result = true;
    }
    else
    {
		// SET TO FALSE
        $result = false;
    }

	// RETURN RESULT
    return $result; 
}

// FUNCTION EmptyCardNumberOnPayment
function EmptyCardNumberOnPayment($cardNum)
{
    $result;

	// IF EMPTY
    if (empty($cardNum))
    {
		// SET TO TRUE
        $result = true;
    }
    else
    {
		// SET TO FALSE
        $result = false;
    }

	// RETURN RESULT
    return $result; 
}

// FUNCTION EmptySecurityOnPayment
function EmptySecurityOnPayment($security)
{
    $result;

	// IF EMPTY
    if (empty($security))
    {
		// SET TO TRUE
        $result = true;
    }
    else
    {
		// SET TO FALSE
        $result = false;
    }

	// RETURN RESULT
    return $result; 
}

// FUNCTION EmptyExpiryOnPayment
function EmptyExpiryOnPayment($expiry)
{
    $result;

	// IF EMPTY
    if (empty($expiry))
    {
		// SET TO TRUE
        $result = true;
    }
    else
    {
		// SET TO FALSE
        $result = false;
    }

	// RETURN RESULT
    return $result; 
}

// FUNCTION CompletePayment
function CompletePayment($conn, $carID, $reg, $street, $houseName, $postcode, $city, $fullName, $cardNum, $security, $expiry)
{
	// 4EACH. (2014). Select from session username. [online] Available at: https://stackoverflow.com/questions/22596183/select-from-session-username (Accessed: 05 April 2022).
	// 4EACH. (2014). 
    // GET UserID
    $query1 = "SELECT UserID FROM user_accounts WHERE Email = '" .$_SESSION['email']."'";

	// PREPARE SQL query
    $result = mysqli_query($conn, $query1);

	// WHILE row returned from query - McGrath (2018, p. 179). 
    while ($row = mysqli_fetch_assoc($result))
    {
		// SET userid to UserID column value
        $userid = $row["UserID"];
    }

	// REF - Dode, D. (2021). PHP Code: Insert Data Into MySQL Database From Form. [online] Available at: https://www.tutsmake.com/php-code-insert-data-into-mysql-database-from-form/ (Accessed: 10 April 2022).
	// (Dode, 2021). 
    $sql = "INSERT INTO Orders (UserID,CarID,Registration) VALUES ('$userid','$carID','$reg');";
    
	// PROCESS query
    if (mysqli_query($conn, $sql)) 
    {
		// CALL EncryptPayment - passing all values
        EncryptPayment($conn, $userid, $street, $houseName, $postcode, $city, $fullName, $cardNum, $security, $expiry);
    } 
    else 
    {
		// REDIRECT to Purchase.php with error 
       header("location: ../Purchase.php?errormsg=statementFailure");

    }

	// CLOSE CONNECTION
    mysqli_close($conn);
    
	// REDIRECT to PurchaseProcessLoading.php
    header("location: ../php-includes/PurchaseProcessLoading.php");

	// EXIT SCRIPT
    exit();     
}

// FUNCTION EncryptPayment
function EncryptPayment($conn, $userid, $street, $houseName, $postcode, $city, $fullName, $cardNum, $security, $expiry)
{
	/// HASH ALL VALUES FOR ADDRESS AND BANK INFO
    $EncryptStreet = password_hash($street, PASSWORD_DEFAULT);
    $EncryptHouse = password_hash($houseName, PASSWORD_DEFAULT);
    $EncryptPost = password_hash($postcode, PASSWORD_DEFAULT);
    $EncryptCity = password_hash($city, PASSWORD_DEFAULT);
    $EncryptName = password_hash($fullName, PASSWORD_DEFAULT);
    $EncryptCard = password_hash($cardNum, PASSWORD_DEFAULT);
    $EncryptSecure = password_hash($security, PASSWORD_DEFAULT);
    $EncryptExp = password_hash($expiry, PASSWORD_DEFAULT);
	///

	// REF - Dode, D. (2021). PHP Code: Insert Data Into MySQL Database From Form. [online] Available at: https://www.tutsmake.com/php-code-insert-data-into-mysql-database-from-form/ (Accessed: 10 April 2022).
	// (Dode, 2021).
    $sql = "INSERT INTO PaymentInformation (UserID, Street, HouseName, PostCode, City, FullName, CardNum, CVC, Expiry) VALUES ('$userid', '$EncryptStreet', '$EncryptHouse', '$EncryptPost', '$EncryptCity', '$EncryptName', '$EncryptCard', '$EncryptSecure', '$EncryptExp');";

	// IF query RETURNS TRUE
    if (mysqli_query($conn, $sql))
    {
		// REDIRECT to Purchase.php with no error
       	header("location: ../php-includes/PurchaseProcessLoading.php");

		// EXIT SCRIPT
        exit();
    }
    else
    {
		// REDIRECT to Purchase.php with error
        header ("location: ../Purchase.php?errormsg=statementFailure");

		// EXIT SCRIPT
        exit();
    }
}

// FUNCTION DeleteFromBuyList
function DeleteFromBuyList($conn, $carID)
{
    //$query = "DELETE FROM Vehicles WHERE CarID = '$carID'";

    //$result = mysqli_query($conn, $query);
}


/*
-- SELL VEHICLE FUNCTIONS
*/

// FUNCTION EmptyRegOnSell
function EmptyRegOnSell($reg)
{
    $rslt;

	// IF EMPTY
    if (empty($reg))
    {
		// SET TO TRUE
        $rslt = true;
    }
    else
    {
		// SET TO FALSE
        $rslt = false;
    }

	// RETURN RESULT
    return $rslt;
}

// FUNCTION EmptyManufOnSell
function EmptyManufOnSell($manuf)
{
    $rslt;

	// IF EMPTY
    if (empty($manuf))
    {
		// SET TO TRUE
        $rslt = true;
    }
    else
    {
		// SET TO FALSE
        $rslt = false;
    }

	// RETURN RESULT
    return $rslt;
}

// FUNCTION EmptyModelOnSell
function EmptyModelOnSell($model)
{
    $rslt;

	// IF EMPTY
    if (empty($model))
    {
		// SET TO TRUE
        $rslt = true;
    }
    else
    {
		// SET TO FALSE
        $rslt = false;
    }

	// RETURN RESULT
    return $rslt;
}

// FUNCTION EmptyVariantOnSell
function EmptyVariantOnSell($variant)
{
    $rslt;

	// IF EMPTY
    if (empty($variant))
    {
		// SET TO TRUE
        $rslt = true;
    }
    else
    {
		// SET TO FALSE
        $rslt = false;
    }

	// RETURN RESULT
    return $rslt;
}

// FUNCTION EmptyTransOnSell
function EmptyTransOnSell($transm)
{
    $rslt;

	// IF EMPTY
    if (empty($transm))
    {
		// SET TO TRUE
        $rslt = true;
    }
    else
    {
		// SET TO FALSE
        $rslt = false;
    }

	// RETURN RESULT
    return $rslt;
}

// FUNCTION EmptyFuelOnSell
function EmptyFuelOnSell($fuel)
{
    $rslt;

	// IF EMPTY
    if (empty($fuel))
    {
		// SET TO TRUE
        $rslt = true;
    }
    else
    {
		// SET TO FALSE
        $rslt = false;
    }

	// RETURN RESULT
    return $rslt;
}

// FUNCTION EmptyEngineOnSell
function EmptyEngineOnSell($enginesize)
{
    $rslt;

	// IF EMPTY
    if (empty($enginesize))
    {
		// SET TO TRUE
        $rslt = true;
    }
    else
    {
		// SET TO FALSE
        $rslt = false;
    }

	// RETURN RESULT
    return $rslt;
}

// FUNCTION EmptyAgeOnSell
function EmptyAgeOnSell($age)
{
    $rslt;

	// IF EMPTY
    if (empty($age))
    {
		// SET TO TRUE
        $rslt = true;
    }
    else
    {
		// SET TO FALSE
        $rslt = false;
    }

	// RETURN RESULT
    return $rslt;
}

// FUNCTION EmptyMilesOnSell
function EmptyMilesOnSell($mileage)
{
    $rslt;

	// IF EMPTY
    if (empty($mileage))
    {
		// SET TO TRUE
        $rslt = true;
    }
    else
    {
		// SET TO FALSE
        $rslt = false;
    }

	// RETURN FALSE
    return $rslt;
}

// FUNCTION EmptyOwnersOnSell
function EmptyOwnersOnSell($owners)
{
    $rslt;

	// IF EMPTY
    if (empty($owners))
    {
		// SET TO TRUE
        $rslt = true;
    }
    else
    {
		// SET TO FALSE
        $rslt = false;
    }

	// RETURN RESULT
    return $rslt;
}

// FUNCTION EmptyPriceOnSell
function EmptyPriceOnSell($price)
{
    $rslt;

	// IF EMPTY
    if (empty($price))
    {
		// SET TO TRUE
        $rslt = true;
    }
    else
    {
		// SET TO FALSE
        $rslt = false;
    }

	// RETURN RESULT
    return $rslt;
}

// FUNCTION RegPlateAlreadyExist
function RegPlateAlreadyExist($conn, $reg)
{
	// PREPARE SQL - SELECT ALL from Vehicles table where Registration = reg passed through
    $sql = "SELECT * FROM Vehicles WHERE Registration = ?;";

	// INTITIALISE STATEMENT
    $stmt = mysqli_stmt_init($conn);

	// IF prepare returns FALSE
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
		// REDIRECT to Sell.php with error
       header("location: ../Sell.php?errormsg=statementFailure");
		

		// EXIT SCRIPT
        exit();
    }
	
	// BIND PARAMETERS for statement
    mysqli_stmt_bind_param($stmt, "s", $reg);
	
	// EXECUTE query
    mysqli_stmt_execute($stmt);
	
	// GET result form query
    $rsltInfo = mysqli_stmt_get_result($stmt);

	// IF row from result exists - McGrath (2018, p. 179). 
    if ($row = mysqli_fetch_assoc($rsltInfo))
    {
		// RETURN ROW
        return $row;
    }
    else
    {
		// SET TO FALSE
        $rslt = false;
		// RETURN RESULT
        return $rslt;
    }

	// CLOSE Connection
    mysqli_stmt_close($stmt);
}

// FUNCTION ListForSale
function ListForSale($conn, $reg, $manuf, $model, $variant, $transm, $fuel, $enginesize, $age, $mileage, $owners, $price)
{
    // 4EACH. (2014). Select from session username. [online] Available at: https://stackoverflow.com/questions/22596183/select-from-session-username (Accessed: 05 April 2022).
	// 4EACH. (2014). 
    // GET UserID to attach to sell order
    $query = "SELECT UserID FROM user_accounts WHERE Email = '" .$_SESSION['email']."'";

	// PROCESS query
    $result = mysqli_query($conn, $query);

	// WHILE row with query result exists - McGrath (2018, p. 179). 
    while ($row = mysqli_fetch_assoc($result))
    {
		// SET userid to UserID column value
        $userid = $row["UserID"];
    }
    

    // REF - https://www.tutsmake.com/php-code-insert-data-into-mysql-database-from-form/
    $sql = "INSERT INTO Vehicles (UserID, Registration,Manufacturer,Model,Variant,Transmission,FuelType,EngineSize,VehicleAge,Mileage,PrevOwners,Price)
    VALUES ('$userid','$reg','$manuf','$model','$variant','$transm','$fuel','$enginesize','$age','$mileage','$owners','$price')";
 
	// PROCESS query - IF TRUE
    if (mysqli_query($conn, $sql)) 
    {
		// REDIRECT to Sell.php with no error
        header("location: ../Sell.php?errormsg=noerror");
		// EXIT SCRIPT
		exit();
    } 
    else 
    {
		// REDIRECT to Sell.php with error
        header("location: ../Sell.php?errormsg=listerror");
		// EXIT SCRIPT
		exit();
    }

	// CLOSE CONNECTION
    mysqli_close($conn);
    
	// REDIRECT to Sell.php
    header("location: ../Sell.php?errormsg=noerror");

	// EXIT SCRIPT
    exit();    
}


/*
-- CONTACT FORM FUNCTIONS
*/

// FUNCTION EmptySubjectOnContact
function EmptySubjectOnContact($subject)
{
    $result;

	// IF EMPTY
    if (empty($subject))
    {
		// SET TO TRUE
        $result = true;
    }
    else
    {
		// SET TO FALSE
        $result = false;
    }

	// RETURN RESULT
    return $result;
}

function EmptyMessageOnContact($message)
{
    $result;

	// IF EMPTY
    if (empty($message))
    {
		// SET TO TRUE
        $result = true;
    }
    else
    {
		// SET TO FALSE
        $result = false;
    }

	// RETURN RESULT
    return $result;
}

// FUNCTION Contact
function Contact($conn, $username, $subject, $email, $message, $from)
{
}


/*
-- BROWSE VEHICLE FUNCTIONS - FOR TESTING
*/

// FUNCTION VehicleAlreadyOrdered
function VehicleAlreadyOrdered($conn, $reg)
{
	// PREPARE SQL statement - SELECT Registration from Orders table where registration from orders exists
    $sql = "SELECT Registration FROM Orders WHERE EXISTS (SELECT Registration FROM Orders WHERE Orders.Registration = '$reg');";

	// GET result from query PROCESS
    $result = mysqli_query($conn, $sql);

	// IF PROCESS was TRUE
    if($result)
    {
		// SET TO TRUE
        $rslt = true;
    } 
    else 
    {
		// SET TO FALSE
        $rslt = false;
    }

	// RETURN RESULT
    return $rslt;
}

// FUNCTION GetVehicleRows
function GetVehicleRows($conn)
{
	// PREPARE SQL statement - SELECT CarID from Vehicles table
    $sql="SELECT CarID FROM Vehicles";

	// IF RESULT is TRUE
    if ($result=mysqli_query($conn,$sql))
    {
        // Return the number of rows in result set - McGrath (2018, p. 179). 
        $rowcount=mysqli_num_rows($result);

        // Free result set
        mysqli_free_result($result);
    }
}


// FUNCTION GetRegistration - NOT USED
function GetRegistration($conn)
{       
    $conn->close();
}

/*
	DEBUGGING METHODS FOR DATA GATHERING
*/
function GetManufacturer($conn)
{
    $query = "SELECT Manufacturer FROM Vehicles WHERE CarID = '3'";

    $result = mysqli_query($conn, $query);
 
	// McGrath (2018, p. 179). 
    while ($row = mysqli_fetch_assoc($result))
    {
        $man = $row["Manufacturer"];
    }

    return $man;
}

function GetModel($conn)
{

    $query = "SELECT Model FROM Vehicles WHERE CarID = '3'";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result))
    {
        $mod = $row["Model"];
    }

    return $mod;
}

function GetVariant($conn)
{

    $query = "SELECT Variant FROM Vehicles WHERE CarID = '3'";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result))
    {
        $var = $row["Variant"];
    }

    return $var;
}

function GetTransmission($conn)
{

    $query = "SELECT Transmission FROM Vehicles WHERE CarID = '3'";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result))
    {
        $tran = $row["Transmission"];
    }

    return $tran;
}

function GetFuelType($conn)
{

    $query = "SELECT FuelType FROM Vehicles WHERE CarID = '3'";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result))
    {
        $fuel = $row["FuelType"];
    }

    return $fuel;
}

function GetEngineSize($conn)
{

    $query = "SELECT EngineSize FROM Vehicles WHERE CarID = '3'";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result))
    {
        $eng = $row["EngineSize"];
    }

    return $eng;
}

function GetVehicleAge($conn)
{

    $query = "SELECT VehicleAge FROM Vehicles WHERE CarID = '3'";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result))
    {
        $age = $row["VehicleAge"];
    }

    return $age;
}

function GetMileage($conn)
{

    $query = "SELECT Mileage FROM Vehicles WHERE CarID = '3'";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result))
    {
        $mile = $row["Mileage"];
    }

    return $mile;
}

function GetPrevOwners($conn)
{

    $query = "SELECT PrevOwners FROM Vehicles WHERE CarID = '3'";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result))
    {
        $man = $row["PrevOwners"];
    }

    return $man;
}

function GetPriceTag($conn)
{

    $query = "SELECT Price FROM Vehicles WHERE CarID = '3'";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result))
    {
        $price = $row["Price"];
    }

    return $price;
}

