<?php
	// SESSION START
    session_start();
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
        <link rel="stylesheet" href="css/IndexStyles.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        <title>Carrus About</title>
    </head>

    <body>

        <?php
			// INCLUDE Header.php ONCE
            include_once 'Header.php';
        ?>

        <div class="container-fluid">
           
            <div class="row">
                <div class="col col-sm text-center mt-2">
                    <img class="mt-2 mb-4" src="images/CarrusBlue.png" alt="">

                    <h1>About Us</h1>
                    
                </div>
            </div>

            <div class="row mb-5 mt-2">
                <div class="col col-sm-3"></div>

                <div class="col-sm-6 mb-2 rounded">
                        <div class="card text-center ml-2 mr-2 bg-light border border-info">
                            <img class="card-img-top" src="" alt="">
                            
                            <div class="card-body mt-3">
                                <h5>We provide an easy-to-use service that allows the buying and selling of vehicles to be straight forward and simple!</h5>
                            </div>

                        </div>
                        <hr/>
                    </div>

                <div class="col col-sm-3"></div>
            </div>
            

            <div class="row text-center mt-2">
                    <div class="col-sm-4 col-xs-4 mb-2 rounded">
                        <div class="card text-center ml-2 mr-2 bg-light">
                            <img class="card-img-top" src="" alt="">
                            
                            <div class="card-body mt-3">
                                <h3>Trusted</h3>
                                <h5>Our service ensures that each dealer is 100% trusted to make sure you get the best deal!</h5>
                            </div>

                        </div>
                        <hr/>
                    </div>

                    <div class="col-sm-4 col-xs-4 mb-2 rounded">
                        <div class="card text-center ml-2 mr-2 bg-light">
                            <img class="card-img-top" src="" alt="">
                            
                            <div class="card-body mt-3">
                                <h3>Simple</h3>
                                <h5>Our simple system means a simple process, which means you save time!</h5>
                            </div>

                        </div>
                        <hr/>
                    </div>

                    <div class="col-sm-4 col-xs-4 mb-2 rounded">
                        <div class="card text-center ml-2 mr-2 bg-light">
                            <img class="card-img-top" src="" alt="">
                            
                            <div class="card-body mt-3">
                                <h3>Ease of Use</h3>
                                <h5>Our easy-to-use system means anyone can navigate around without getting lost! </h5>
                            </div>

                        </div>
                        <hr/>
                    </div>
            </div>



            <div class="row mb-1">

                <div class="col text-center">
                    <a type="button" class="btn btn-info btn-lg mr-2" href="index.php">Home</a>

                    <?php
						// IF session active and logged in
                        if (isset($_SESSION["email"]))
                        {                
							// DISPLAY Contact button
                            echo '<a type="button" class="btn btn-info btn-lg mr-2" href="Contact.php">Contact</a>';
                        }
                        else
                        {
							// DISPLAY Sign-in to contact button
                            echo '<a type="button" class="btn btn-info btn-lg mr-2" href="SignIn.php">Sign-in to Contact</a>';
                        }
                    ?>
                    
                <hr/>
                </div>
                
            </div>  

        </div>



        <?php 
			// INCLUDE footer.php ONCE
            include_once 'footer.php';
        ?>

    