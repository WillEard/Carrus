<?php
	// SESSION START
    session_start();
	
	// REQUIRE DBConnec.php ONCE
    require_once "DBConnec.php";
	// REQUIRE functions.php ONCE
    require_once "functions.php";

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="css/HeaderStyles.css">
        <link rel="stylesheet" href="css/SignUp-In-styles.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container container-fluid text-center mt-5">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" src="../images/CarrusBlue.png" alt="Logo"><br><br>
                    <hr/>
                    <h1>Processing Order</h1>

                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Please wait..</span>
                    </div>
                    <h2>Please Wait..</h2>

                    <meta http-equiv="refresh" content="5; url= ../php-includes/PurchaseComplete.php" />

                
                </div>
            </div>
        </div>
        



