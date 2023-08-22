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
        
        <title>Carrus Sign Up</title>
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


                        <h1>Sign Up</h1>
                    </div>
                </div>  

                        <br>

                        <?php
							// IF error message is set in URL - McGrath (2018, p. 174).
                            if (isset($_GET["errormsg"]))
                            {
								// IF message is emptyInp
                                if ($_GET["errormsg"] == "emptyInp")
                                {
									//DISPLAY empty fields error
                                    echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Empty Fields!</div>";
                                }
								else
								// IF message is emailInUse
                                if($_GET["errormsg"] == "emailInUse")
                                {
									// DISPLAY email in use error
                                    echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Email already in use!</div>";
                                }
                                else
								// IF message is usernameInUse
								if($_GET["errormsg"] == "usernameInUse")
                                {
									// DISPLAY username in use error
                                    echo "<div class='col-md-3 mx-auto alert alert-danger' role='alert'>Error: Username already in use!</div>";
                                }
                                else
								// IF message is phoneInUse
								if($_GET["errormsg"] == "phoneInUse")
                                {
									// DISPLAY phone number in use error
                                    echo "<div class='col-md-3 mx-auto alert alert-danger' role='alert'>Error: Phone Number already in use!</div>";
                                }
								else
								// IF message is invInp
                                if($_GET["errormsg"] == "invInp")
                                {
									// DISPLAY invalid email error
                                    echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Invalid Email!</div>";
                                } 
                                else
								// IF message is invPass
								if($_GET["errormsg"] == "InvPass")
                                {
									// DISPLAY password must be more than 10 characters error
                                    echo "<div class='col-md-4 mx-auto alert alert-danger' role='alert'>Error: Password must be more than 10 characters in length!</div>";
                                } 
                                else
								// IF there is no error
								if($_GET["errormsg"] == "noerror")
                                {
									// REDIRECT to SignIn.php page
                                    header( 'Location: SignIn.php' );
                                } 
								else
								// ELSE IF error is statementFailure
								if($_GET["errormsg"] == "statementFailure")
                                {
									// DISPLAY internal error 
                                    echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Internal Error!</div>";
                                } 

                            }
                        ?>

                        <div class="row">
                            <div class="col"></div>

                            <div class="col-sm-4 col-md-4">
                                <form method="POST" action="php-includes/Signup-ext.php" name="signupform">
                                <hr/>
                                    <div class="form-group">
                                        <input class="form-control form-control-lg text-center" type="text" name="firstname" id="firstname" placeholder="First Name">
                                        <small id="firstnamehelp" class="form-text text-muted">Your first / middle names.</small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input class="form-control form-control-lg text-center" type="text" name="surname" id="surname" placeholder="Surname">
                                        <small id="surnamehelp" class="form-text text-muted">Your last name.</small>
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control form-control-lg text-center" type="text" name="username" id="username" placeholder="Username">
                                        <small id="usernamehelp" class="form-text text-muted">Create a Username.</small>
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control form-control-lg text-center" type="email" name="email" id="email" placeholder="Email Address">
                                        <small id="emailhelp" class="form-text text-muted">Your email address.</small>
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control form-control-lg text-center" type="tel" minlength="11" maxlength="11" name="phoneno" id="phoneno" placeholder="Phone Number">
                                        <small id="phonenohelp" class="form-text text-muted">Your phone number as a whole.</small>
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control form-control-lg text-center" type="password" name="pass" id="password" placeholder="Password">
                                        <small id="passwordhelp" class="form-text text-muted">Create a password.</small>
                                    </div>
                                    <hr/>

                                    
                                    <h2 style="font-size: 18px;">Already have an account? <a style="font-size: 18px; text-decoration: none;" href="SignIn.php">Login Here </a></h2>
                                    <button class="btn btn-primary btn-lg" type="submit" name="submit" value="signup">Sign Up</button>
                                </form>   
                            </div>

                            <div class="col"></div>
                        </div>
                        </div>
                    </div>
            </div>
