<?php
// CALL session_start method
session_start();

// IF submit button has been clicked
if (isset($_POST["submit"]))
{
    // SET firstName variable as the string inputted from firstName field
    $firstName = $_POST['firstname'];
    // SET surname variable as the string inputted from surname field
    $surname = $_POST['surname'];
    // SET username variable as the string inputted from username field
    $username = $_POST['username'];
    // SET email variable as the string inputted from email field
    $email = $_POST['email'];
    // SET phone variable as the integer inputted from phone number field
    $phone = $_POST['phoneno'];
    // SET pass variable as the protected password inputted from password field
    $pass = $_POST['pass'];

    // USE 'DBConnec'.php ONCE
    require_once "DBConnec.php";
    // USE 'functions'.php ONCE
    require_once "functions.php";
    
    // IF email inputted already exists and is NOT false, display 'emailInUse' error message
    if (emailAlreadyExist($conn, $email) !== false)
    {
        // HEADER to signup page with error message
        header("location: ../SignUp.php?errormsg=emailInUse");

        // EXIT SCRIPT
        exit();
    }

	// IF returns TRUE
    if (UsernameAlreadyExist($conn, $username) !== false)
    {
        // HEADER to signup page with error message
        header("location: ../SignUp.php?errormsg=usernameInUse");
        
        // EXIT SCRIPT
        exit();
    }

	// IF returns TRUE
    if (PhoneNoAlreadyExist($conn, $phone) !== false)
    {
        // HEADER to signup page with error message
        header("location: ../SignUp.php?errormsg=phoneInUse");
        
        // EXIT SCRIPT
        exit();
    }

    // IF any fields are empty on SUBMIT
    if (emptyOnSignup($firstName, $surname, $username, $email, $phone, $pass) !== false)
    {
        // HEADER to signup page with error message
        header("location: ../SignUp.php?errormsg=emptyInp");

        // EXIT SCRIPT
        exit();
    }
    
    // IF password length is less or equal to 10 characters in length
    if (strlen($pass) <= 10)
    {
        // HEADER to Signup page with error message
        header("location: ../SignUp.php?errormsg=InvPass");

        // EXIT SCRIPT
        exit();
    }

    // IF email is invalid
    if (invalidEmail($email) !== false)
    {
        // HEADER to signup page with error message
        header("location: ../SignUp.php?errormsg=invInp");

        // EXIT SCRIPT
        exit();
    }

    // CALL SignUpUser method passing through inputted parameters - creates users account
    SignUpUser($conn, $firstName, $surname, $username, $email, $phone, $pass);
}
else
{
    // HEADER to signup page
    header("location: ../SignUp.php");
    
    // EXIT IF Statement
    exit();
}

?>


