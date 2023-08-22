<?php
	// SESSION START
    session_start();
    
	// INCLUDE DBConnec.php ONCE
    include_once "php-includes/DBConnec.php";
	// INCLUDE functions.php ONCE
    include_once "php-includes/functions.php";

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
        <link rel="stylesheet" href="css/IndexStyles.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        <title>Carrus Home</title>
    </head>

    <body>
       
        <!-- HEADER NAVBAR -->
        <?php
			// INCLUDE Header.php ONCE
            include_once 'Header.php';
        ?>
        <!-- END OF HEADER NAVBAR -->


        <!-- HERO IMAGE -->

        <div style="padding-left: 0; padding-right: 0; overflow-x: hidden;" class="container-fluid">
            <div class="row extra-margin">
                <div class="col">
                
                    <div class="jumbotron jumbotron-fluid mt-1 module" id="module" style="background-image: url(images/BlueFiat.png); background-size: cover; min-height: 400px;">
                   
                        <div class="col text-light">
                            
                            <div style="padding-top: 5%;" class="container">

                            <?php
								// CALL GetFirstName passing database connection to get first name
                                $firstname = GetFirstName($conn);
								
								// IF session is set and logged in, display first name in hero image - McGrath (2018, p. 174). 
                                if (isset($_SESSION["email"]))
                                {                
                                    echo '<h1 class="display-4"> Welcome, <br>' . $firstname . '</h1>';
                                }
								// else if not logged in display Welcome
                                else
                                {
                                    echo "<h1 class='display-4'>Welcome,</h1>";
                                }
                                
                            ?>
                            
                            <?php
								// IF not logged in, display sign-up button - McGrath (2018, p. 174). 
                                if (!isset($_SESSION["email"]))
                                {
									// Echo sign-up message
                                    echo "<h1 class='display-4' data-toggle='tooltop' data-placement='top' title='SignUp'>New Here? Sign Up For Free!</a></h1>";
									// DISPLAY sign-up button
                                    echo "<a class='btn btn-primary btn-lg' href='SignUp.php' role='button'>Sign Up</a>";
                                }
                            ?>
                           
                            </div>
                        
                        </div>
                                        
                    </div>  
                                
                </div>
                
            </div>
            
        </div>

        <!-- END OF HERO IMAGE -->


        <!-- BUY CAR BLOCK -->
        
        <div style="background-image: linear-gradient(-90deg, #47e6fd, #47abfd);" class="container-fluid mt-n4">

            <div class="row">
                         
                <div class="col-lg-6 mt-5 text-center text-white">
                    <br>
                    <h1>Looking for a new car?</h1>

                    <br>

                    <h2>Browse our range of new and used cars</h2>

                    <br>

                    <?php
					// IF session active and logged in - McGrath (2018, p. 174). 
                    if (isset($_SESSION["email"]))
                    {                
						// DISPLAY Browse.php button
                        echo '
                        
                            <h3>Visit our browsing page to choose the right car for you!</h3>

                            <br><br>

                            <a class="btn btn-light text-dark btn-lg" href="Browse.php" role="button">View The Range</a>

                        ';
                    }
					// ELSE
                    else
                    {
						// DISPLAY sign-in button
                        echo '
                        
                            <h3>Sign in to start!</h3>
                            <br>
                            <a class="btn btn-light text-dark btn-lg" href="SignIn.php" role="button">Sign In</a>

                        ';
                    }
                    ?>

                </div>

                <div class="col-lg-6 mb-2">

                    <img class="pt-2 rounded-circle img-fluid float-right" style="" src="images/serjan-midili-8iZdhhP5bwg-unsplash.jpg" alt="">

                </div>

            </div>
                                
        </div>

        <!-- END OF BUY CAR BLOCK -->


        <!-- SEARCH BLOCK -->

        <div class="container-fluid text-center mt-3">

            <div class="row row-sm">

                <div class="col-sm-3"></div>

                <div class="col-sm-6 col-xs-4 mb-3 pr-4 rounded">

                    <div class="card text-center ml-1 mr-1 bg-light">

                    <img class="img-fluid w-30 mx-auto mt-2" src="images/CarrusBlue.png" alt="">

                        <h3 class="mt-2 pl-2 pr-2">Know what car you want?</h3>
                        <h4 class="mt-1">Find it here!</h4>

                        <div class="input-group mt-2 pl-2 pr-2">
                            <input type="search" class="form-control rounded text-center" placeholder="Search by Manufacturer/Model/Variant" aria-label="Search" aria-describedby="search-addon" />
                        </div>
                    
                        <div class="card-body">

                        <?php
							// IF session active and logged in - McGrath (2018, p. 174).  
                            if (isset($_SESSION["email"]))
                            {              
								// DISPLAY browse.php button
                                echo '<a href="Browse.php" type="button" class="btn btn-lg btn-primary">Find My Car</a>';
                            }
							// ELSE
                            else
                            {
								// DISPLAY SignIn.php button
                                echo '<a href="SignIn.php" type="button" class="btn btn-lg btn-primary">Sign in to browse</a>';
                            }
                        ?>

                        </div>

                    </div>
                    
                </div>

                <div class="col-sm-3"></div>

            </div>

        </div>

        <!-- END OF SEARCH BLOCK -->


        <!-- SELL CAR BLOCK -->

        <div style="background-image: linear-gradient(-90deg, #47e6fd, #47abfd);" class="container-fluid bg-secondary rounded ">
             
             <div class="row">
                         
                <div class="col-lg-6 mb-2">

                    <img class="pt-2 rounded-circle img-fluid float-left" style="" src="images/erik-odiin-DH_IAgZkJP4-unsplash.jpg" alt="">

                </div>

                <div class="col-md-6 mt-5 text-center text-white">
                    <br>
                    <h1>Looking to sell your car?</h1>

                    <br>

                    <h2>Follow our simple process to start selling</h2>

                    <br>
                
                    <?php
					// IF session active and logged in - McGrath (2018, p. 174). 
                    if (isset($_SESSION["email"]))
                    {                
						// DISPLAY Sell.php button
                        echo '
                        
                            <h3>Visit the selling page to start!</h3>

                            <a class="btn btn-light text-dark btn-lg" href="Sell.php" role="button">Start Selling</a>

                        ';
                    }
                    else
                    {
						// DISPLAY SignIn.php button
                        echo '
                        
                            <h3>Sign in to start!</h3>
                            <br>

                            <a class="btn btn-light text-dark btn-lg" href="SignIn.php" role="button">Sign In</a>

                        ';
                    }
                    ?>

                    

                </div>
                  
            </div>

        </div>

        <!-- END OF SELL BLOCK -->


        <!-- ELECTRIC CAR BLOCK -->

        <div style="background-image: linear-gradient(-90deg, #47e6fd, #47abfd);" class="container-fluid bg-secondary rounded mt-2">
           
           <div class="row">
                        
               <div class="col-lg-6 mt-4 text-center text-white">
                   <br>
                   <h1>Looking to help the environment?</h1>

                   <br>

                   <h2>We now have a range of new and used electric vehicles</h2>

                   <br>

                   <?php
				   	// IF session active and logged in - McGrath (2018, p. 174). 
                    if (isset($_SESSION["email"]))
                    {                
						// DISPLAY Browse.php button
                        echo '
                        
                            <h3>Click below to learn more</h3>

                            <br><br>

                            <a class="btn btn-light btn-lg text-dark" href="Browse.php" role="button">Electric Vehicle Range</a>

                        ';
                    }
                    else
                    {
						// DISPLAY SignIn.php button
                        echo '
                        
                            <h3>Sign in to start!</h3>
                            <br>

                            <a class="btn btn-light text-dark btn-lg" href="SignIn.php" role="button">Sign In</a>

                        ';
                    }
                    ?>

                   

                   

               </div>

               <div class="col-lg-6 mb-2">

                   <img class="pt-2 rounded-circle img-fluid float-right" style="" src="images/ernest-ojeh-aEytUoE1Tkc-unsplash.jpg" alt="">

               </div>

           </div>
                               
       </div>

       <!-- END OF ELECTRIC BLOCK -->


        <!-- 3 INFO CONTAINERS -->

        <div class="container">
        <hr/>

            <div class="row">

                <div class="col-sm-4 col-xs-4 mb-2 rounded">
                    <div class="card text-center ml-2 mr-2 bg-light">
                        <img class="card-img-top" src="" alt="">
                        
                        <div class="mt-3">
                            <h3>Trusted</h3>
                            <h5>Our service ensures a safe and simple process</h5>
                        </div>

                        <div class="card-body">
                            <a href="About.php" class="btn btn-info btn-lg">Learn More</a>        
                        </div>
                    </div>
                    <hr/>
                </div>
            
                
                <div class="col-sm-4 col-xs-4 mb-2 rounded">
                    <div class="card text-center ml-2 mr-2 bg-light">
                        <img class="card-img-top" src="" alt="">
                        
                        <div class="mt-3">
                            <h3>Simple</h3>
                            <h5>Our simple system means a simple process</h5>
                        </div>

                        <div class="card-body">
                            <a href="About.php" class="btn btn-info btn-lg">Learn More</a>        
                        </div>
                    </div>
                    <hr/>

                </div>

                <div class="col-sm-4 col-xs-4 mb-2 rounded">
                    <div class="card text-center ml-2 mr-2 bg-light">
                        <img class="card-img-top" src="" alt="">
                        
                        <div class="mt-3">
                            <h3>Ease of Use</h3>
                            <h5>Our easy guide makes it easy to get the deal you want</h5>
                        </div>

                        <div class="card-body">
                            <a href="About.php" class="btn btn-info btn-lg">Learn More</a>        
                        </div>
                    </div>
                    <hr/>

                </div>

            </div> 

 
        </div>

        <!-- END OF 3 INFO CONTAINERS -->

        <!-- FOOTER -->

        <?php
            include_once 'footer.php';
        ?>

        <!-- END OF FOOTER -->
    </body>       
</html>
    
