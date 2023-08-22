<?php
// FILE: DBConnec.php
// PURPOSE: Getting a connection from the server to the database
// AUTHOR: William Eardley
// STUDENT: 19009492

// Variables to store data for database connection
$db_host = "172.16.11.22:3306"; // LINK Database Host to LocalHost
$db_user = "earw1_19_earw1_Carrus";      // LINK 
$db_pass = "George159!";          // LINK 
$db_name = "earw1_19_Carrus";    // LINK 

global $conn;

// CONNECT TO SQL DATBASE - passing host, username, password and database name
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// IF connection fails
if (!$conn)
{
	// DISPLAY connection failed message
    die("Connection Failed: " . mysqli_connect_error());
}

// RETURN CONNECTION
return $conn;
?>

