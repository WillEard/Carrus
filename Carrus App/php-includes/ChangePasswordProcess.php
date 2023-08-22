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
		<title> Carrus Password </title>
    </head>
    
    <body class="bg"> 

        <style>
            .bg
            {
                background-image: url('../images/lucho-renolfi-9pW_u2wynx0-unsplash.jpg');
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>

        <div class="container container-fluid text-center mt-4">

            <div class="row">

                <div class="col">

                    <img class="img-fluid" src="../images/CarrusBlue.png" alt="Logo"><br><br>
                    <hr/>
                    <h1 class="text-light">Change Password</h1>
                    <br>
                </div>
            </div>

            <?php

                // IF Submit has been clicked AND information is set
                if (isset($_POST["submit"]))
                {
                    // SET currentPass to currentpass data passed through
                    $currentPass = $_POST['currentpass'];
            
                    // SET newPass to newpass data passed through
                    $newPass = $_POST['newpass'];

                    // GET INFORMATION FROM user_accounts table to get old password hash
                    $query = "SELECT * FROM user_accounts WHERE Email = '" .$_SESSION['email']."'";

                    // PROCESS query inserting previous query into MYSQL database
                    $result = mysqli_query($conn, $query);

                    // WHILE a matching row is found, GET data from row - McGrath (2018, p. 179).
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        // GET old has from Pass column
                        $oldHash = $row["Pass"];
						// SET user to UserID column value
                        $user = $row["UserID"];
                    }

					// IF current password entered is the same as new password entered
                    if ($currentPass == $newPass)
                    {
						// DISPLAY new password same as old password error
                        echo '<div class="col-md-4 mx-auto alert alert-danger text-center" role="alert">Error: New password cannot be current password!</div>';
                    }
					// ELSE IF password length is LESS or EQUAL to 10 characters
                    else if (strlen($newPass) <= 10)
                    {
						// DISPLAY New password must be longer than 10 characters
                        echo '<div class="col-md-4 mx-auto alert alert-danger text-center" role="alert">Error: New Password must be greater than 10 characters in length!</div>';
                    }
					// ELSE
                    else

                    // IF entered current password hash mathces current then proceed
                    if (password_verify($currentPass, $oldHash))
                    {
                      	// HASH new password
                        $EncryptPass = password_hash($newPass, PASSWORD_DEFAULT);
                        
						// PREPARE SQL statement - UPDATE user_accounts table to SET password column to new hashed password
                        $sql = "UPDATE user_accounts SET Pass = '$EncryptPass' WHERE UserID = $user";

						// EXECUTE SQL query - IF query is TRUE
                        if (mysqli_query($conn, $sql))
                        {
							// SET success to TRUE
                            $sucess = true;
							// DISPLAY Success
                            echo '<div class="col-md-4 mx-auto alert alert-success text-center" role="alert">Success: Password updated successfully!</div>';
                        }
                        else
                        {
							// SET success to false
                            $sucess = false;
							// DISPLAY Internal error
                            echo '<div class="col-md-3 mx-auto alert alert-danger text-center" role="alert">Error: Internal Error. Please try again!</div>';
                        }
                    }
                    // ELSE Incorrect current password has been entered
                    else
                    {
						// DISPLAY incorrect password
                        echo '<div class="col-md-3 mx-auto alert alert-danger text-center" role="alert">Error: Incorrect Password!</div>';
                    }
                    
					// CLOSE CONNECTION
                    $conn->close();
                }
                else
                {

                }
            ?>

            <div class="row">

                <div class="col"></div>

                <div class="col-sm-4 col-md-4">
                    
                    <form method="POST" action="" name="changepasswordform">

                        <div class="form-group">
                            <input class="form-control form-control-md text-center" type="password" name="currentpass" id="currentpass" placeholder="Current Password" required>
                            <small id="currentpasshelp" class="form-text text-light">Your current password.</small>
                        </div>

                        <br>

                        <div class="form-group">
                            <input class="form-control form-control-md text-center" type="password" name="newpass" id="newpass" placeholder="New Password" required>
                            <small id="newpasshelp" class="form-text text-light">Your new password.</small>
                        </div>

                        <br>
                        <?php
                            if ($sucess)
                            {
                                echo '<a href="../Profile.php" class="btn btn-light btn-lg" type="submit" name="submit" value="signin">Back to Profile</a>';
                            }
                            else
                            {
                                echo '<button class="btn btn-light btn-lg" type="submit" name="submit" value="signin">Submit</button>';
                            }
                        ?>

                    </form>
                    <br><br><br>

                    <h3 class="text-light">Never share your password with anyone.</h3>
                </div>
                

                <div class="col"></div>

            </div>

    </div>

