<?php
	// SESSION START
    session_start();

	// McGrath (2018, p. 174).
	// McGrath, M. (2018). PHP & MySQL in easy steps. 2nd Edition. Warwickshire. In Easy Steps.
?>

<!DOCTYPE html>
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
        
        <title>Carrus Sign In</title>
    </head>
    
    <body>

        <?php
			// INCLUDE Header.php ONCE
            include_once 'Header.php';
        ?>


        <div style="margin-top: 10px;" class="container-fluid text-center">
            <div class="row">
                <div class="col">

                    <img src="images/CarrusBlue.png" alt="">
                    <hr/>
                
                    <h1>Sign In</h1>
                </div>
            </div>

                    <br>

                    <?php
						// IF error message returned in URL is set - McGrath (2018, p. 174).
                        if (isset($_GET["errormsg"]))
                        {
							// IF error message is emptyInp
                            if ($_GET["errormsg"] == "emptyInp")
                            {
								// DISPLAY empty field error
                                echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Empty Fields!</div>";
                            }
							
							// IF error message is incorrEmail
                            if ($_GET["errormsg"] == "incorrEmail")
                            {
								// DISPLAY invalid email error
                                echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Invalid Email!</div>";
                            }

							// IF error is invPass
                            if ($_GET["errormsg"] == "invPass")
                            {
								// DISPLAY unknown email or password error
                                echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Unknown Email or Password!</div>";
                            }

							// IF error is incorrUser
                            if ($_GET["errormsg"] == "incorrUser")
                            {
								// DISPLAY invalid username error
                                echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Invalid Username!</div>";
                            }

							// IF error is locked
                            if ($_GET["errormsg"] == "locked")
                            {
								// DISPLAY too many login attempts error
                                echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Account Locked: Too many invalid attempts! Please try again later.</div>";
                            }
                        }
                    ?>

                    <div class="row">
                        <div class="col"></div>

                        <div class="col-sm-4 col-md-4">
                            <form method="POST" action="php-includes/SignIn-ext.php" name="signinform">
                                <hr/>
                                <div class="form-group">
                                    <input class="form-control form-control-lg text-center" type="text" name="email" id="email" placeholder="Email">
                                    <small id="emailhelp" class="form-text text-muted">Your email address.</small>
                                </div>

                                <div class="form-group">
                                    <input class="form-control form-control-lg text-center" type="password" name="pass" id="pass" placeholder="Password">
                                    <small id="passwordhelp" class="form-text text-muted">Your password.</small>
                                </div>
                                <hr/>

                                <h2 style="font-size: 18px;">Dont have an account? <a style="font-size: 18px; text-decoration: none;" href="SignUp.php">Signup here</a></h2>
                                <button class="btn btn-primary btn-lg" type="submit" name="submit" value="signin" data-toggle="tooltip" data-placement="top" title="Sign In">Sign In</button>


                            </form>
                        </div>

                        <div class="col"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
   