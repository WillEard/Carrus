<?php
	// SESSION START
    session_start();

	// INCLUDE DBConnec.php ONCE
    include_once "php-includes/DBConnec.php";
	// INCLUDE functions.php ONCE
    include_once "php-includes/functions.php";

	// McGrath (2018, p. 179).
	// McGrath, M. (2018). PHP & MySQL in easy steps. 2nd Edition. Warwickshire. In Easy Steps.
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="css/HeaderStyles.css">
        <link rel="stylesheet" href="css/profile-styles.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Carrus Profile</title>

        <script>
			// AJAX TESTING FROM AjaxTest.txt file to change text
            $(document).ready(function(){
                $("#btn").click(function() { 
                    $("#test").load("AjaxTest.txt");
                });
            });
        </script>
    </head>

    <body>
       
        <?php
			// INCLUDE Header.php ONCE
            include_once 'Header.php';
        ?>

        <div class="container-fluid" style="overflow-x: hidden;">
            
            <div style="margin-top: 10px;" class="row extra_margin">
                
                <div class="col-md-4">

                    <div class="text-center">
                        <h2>Profile</h2>
                    <hr/>
                        <img class="img-fluid" src="https://via.placeholder.com/250" alt="Profile Image"><br><br>

                        <div class="file btn btn-md btn-primary col-md-6">Change Profile Picture
							<input style="opacity: 0; position: absolute;" type="file" name="file"/> 
						</div> 

                        <hr/>

                        <a class="btn btn-success btn-lg" href="Sell.php" role="button">List Vehicle For Sale</a>

                        <hr/>

                        <h3>Rating</h3>
                        <style>
                            .checked {
                                color : yellow;
                                font-size : 20px;
                            }
                            .unchecked {
                                font-size : 20px;
                            }
                        </style>
                            <span class = "fa fa-star checked"></span>
                            <span class = "fa fa-star checked"></span>
                            <span class = "fa fa-star checked"></span>
                            <span class = "fa fa-star checked"></span>
                            <span class = "fa fa-star checked"></span>

                        <br>

                    
                        <hr/>

                    
                    </div>

                </div>

                <div class="col-md-8">
                    
                    <h2 class="text-center">Account Information</h2>
                    
                    <hr/>

                    <form>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label>First Name:</label>
                                <?php
									// CALL GetFirstName with datbase connection to get first name
                                   $firstname = GetFirstName($conn);
									// ECHO first name inside readonly input
                                   echo "<input type='text' class='form-control' placeholder=' $firstname ' readonly>";
                                ?>
                                <small id="firstnamesmalltext" class="form-text text-muted">First name associated with your account</small>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="">Surname:</label>
                                <?php
									// CALL GetSurname to get surname
                                   $surname = GetSurname($conn);
									// ECHO surname inside readonly input
                                   echo" <input type='text' class='form-control' placeholder=' $surname ' readonly>";
                                ?>
                                <small id="surnamesmalltext" class="form-text text-muted">Surname associated with your account</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="">Username:</label>
                                <?php
									// CALL GetUsername to get username
                                   $username = GetUsername($conn);
									// ECHO username inside readonly input
                                   echo" <input type='text' class='form-control' placeholder=' $username ' readonly>";
                                ?>
                                <small id="usernamesmalltext" class="form-text text-muted">The name that other users will see</small>
                            </div>
                            <hr/>
                            <div class="form-group col-md-5">
                                <label>Email Address:</label>
                                <?php
									// ECHO active session email
                                    echo "<input type='email' class='form-control' placeholder='$_SESSION[email]' readonly>";
                                ?>
                                <small id="emailsmalltext" class="form-text text-muted">The email address associated with your account</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label>Change Password:</label>
                                <button type="button" class="btn btn-md btn-warning col-md-12" data-toggle="modal" data-target="#PasswordModal">Change Password</button>
                                <small id="passwordsmalltext" class="form-text text-muted">Change the account password</small>

                                <div class="modal fade" id="PasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="text-center mx-auto">Warning</h5>
                                            <h6 class="text-center text-danger">This can only be done once every 24 Hours.</h6>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button onclick="window.location.href='php-includes/ChangePasswordProcess.php';" type="button" class="btn btn-warning">Change Password</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <hr/>

                            </div>
                        
                            <div class="form-group col-md-5">
                                <label for="">Delete Account:</label>
                                <button type="button" class="btn btn-md btn-danger col-md-12" data-toggle="modal" data-target="#DeleteModal">Terminate Account</button>
                                <small id="deleteaccountsmalltext" class="form-text text-muted">Permanently delete your account and all data</small>

                                <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Terminate Account</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="text-center mx-auto">Are you sure you want to delete your account?</h5>
                                            <h6 class="text-center text-danger">All data will be permanently lost.</h6>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button onclick="window.location.href='php-includes/DeleteProcessLoading.php';" type="button" class="btn btn-danger">Delete Account</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>  

                                <hr/>


                            </div>

                        </div>
                        <h1 class="text-left">Recent Orders</h1>


                    </form>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"> 
                    </div>
                    <div class="col-sm-4"> </div>

                    <div class="row">
                        
                    <?php
                            // PREPARE SQL query - SELECT UserID from user_accounts table where the email is the same as session
                            $sql = "SELECT UserID FROM user_accounts WHERE Email = '" .$_SESSION['email']."'";
						
							// EXECUTE query passing database connection and query
                            $result = mysqli_query($conn, $sql);

                            // WHILE there is a row returned from query - McGrath (2018, p. 179). 
                            while ($row = mysqli_fetch_assoc($result)) 
                            {
								// SET userID to data from UserID column
                                $userid = $row["UserID"]; 
                            }

                            // PREAPRE SQL query - SELECT Registration and OrderID values from Orders table where UserID is userid passed through
                            $sql = "SELECT Registration, OrderID FROM Orders WHERE UserID = '$userid'";
						
							// EXECUTE query passing database connection and query
                            $result = mysqli_query($conn, $sql);

						// IF number of rows returned is greater than 0
                        if ($result->num_rows > 0)
                        {
							// WHILE there is a row returned - McGrath (2018, p. 179). 
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                // SET orderID to value from OrderID column
                                $orderiD = " " . $row["OrderID"];
								// SET reg to value from Registration column
                                $reg = " " . $row["Registration"];
                                
								// ECHO any active orders on user's account
                                echo '

                                    <div class="col-sm-5 mb-3 rounded">

                                        <div class="card text-center bg-light">
            
                                            <h4 class="mt-2">'.$reg.'</h4>
                                            <h5 class="">Order: # '.$orderiD.'</h5>
            
                                            <div class="card-body">
                                                <form action="php-includes/CancelOrder.php" method="post">

                                                    <input hidden type="text" class="form-control text-center" name="orderid" id="orderid" aria-describedby="carid" value='.$orderiD.'>
                                                    <button type="submit" name="submit" class="btn btn-info btn-dark btn-block mt-n3">Cancel Order</button>    

                                                </form>    
                                            </div>
                                        </div>

                                    </div>

                                    ';
                            }

                        }
						// ELSE
                        else
                        {
							// ECHO 'You have no orders' message
                            echo '
                                <div class="col-sm-10 text-center mt-3 mb-5 border border-info rounded ml-1 mr-1">
                                    <h1 class="text-muted"> You currently have no orders. </h1>
                                </div>
                                
                            ';
                        }
                            ?>
                            
                    </div>
                    <!--
                    <div id="test">
                        <p>Testing AJAX.</p>
                    </div>
                    <button class="btn btn-primary" id="btn">AJAX Click</button>
					-->
                </div>

            </div>
        
        </div

        <?php
			// INCLUDE footer.php ONCE
            include_once 'footer.php';
        ?>

      

