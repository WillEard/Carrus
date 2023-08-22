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
                    <h1>Deleting Account</h1>
                    
                    <br>

                    <?php
                    // CALL DeleteAccount passing database connection and deletereturn value
                    $deletereturn = DeleteAccount($conn, $deletereturn);

					// IF deletereturn is success
                    if ($deletereturn = "success")
                    {
						// DISPLAY Success
                        echo "<div class='col-md-5 mx-auto alert alert-success' role='alert'>Success: Your account has been successfully deleted!</div>";
                    }
					//	ELSE IF deletereturn is fail
                    else if ($deletereturn = "fail")
                    {
						// DISPLAY internal error
                        echo "<div class='col-md-5 mx-auto alert alert-danger' role='alert'>Error: Internal Error!</div>";
                    }

                    ?>

                    <br>
                    <a href="SignOut-ext.php" class="btn btn-primary" role="button">Return Home</a>
                    <hr/>
                
                </div>
            </div>
        </div>
        



