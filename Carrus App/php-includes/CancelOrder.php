<?php
	// SESSION START
    session_start();

	// INCLUDE DBConnec.php ONCE
    include_once "DBConnec.php";
    
?>

<?php
	// IF data set from submit form is passed through
    if (isset($_POST["submit"]))
    {
		// SET orderid to 'orderid' html id tag 
        $orderid = $_POST['orderid'];

		// PREPARE SQL query - DELETE From Orders table where OrderID column is the same as 'orderid'
        $query = "DELETE FROM Orders WHERE OrderID = '$orderid'";

		// EXECUTE SQL query - passing database connection and query
        $result = mysqli_query($conn, $query);
	
		// IF result is TRUE
        if ($result)
        {
			// REDIRECT to Profile.php with no error
            header("location: ../Profile.php?errormsg=noerror");
			
			// EXIT SCRIPT
            exit();
        }
        else
        {
			// REDIRECT to Profile.php with statementFailure
            header("location: ../Profile.php?errormsg=statementFailure");
			
			// EXIT SCRIPT
            exit();
        }

    }
    else
    {
		// REDIRECT to Profile.php
        header("location: ../Profile.php");
		
		// EXIT SCRIPT
        exit();
        
    }


?>