<?php
	// SESSION START
    session_start();

	// INCLUDE DBConnec.php ONCE
    include_once 'php-includes/DBConnec.php';
	// INCLUDE functions.php ONCE
    include_once 'php-includes/functions.php';

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
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="css/HeaderStyles.css">
        <link rel="stylesheet" href="css/IndexStyles.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        <title>Carrus Vehicle Spec</title>
    </head>

    <body style="overflow-x: hidden;">

    <?php
		// INCLUDE Header.php ONCE
        include_once 'Header.php';
    ?>

    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col text-center">
                <h1>Your Overview</h1>
                <hr/>
            </div>
        </div>

        <?php
			// IF DATA is set when user clicks submit button
            if (isset($_POST["submit"]))
            {
				// DECLARE variable and set to 'carid' html id data passed through
                $carID = $_POST['carid'];

				// DECLARE variable and set to 'userid' html id data passed through
                $userID = $_POST['userid'];

				// DECLARE SQL query - SELECT ALL from Vehicles table where the CarID is the same as the ID passed through
                $query = "SELECT * FROM Vehicles WHERE CarID = '$carID' ";

				// EXECUTE query passing database connection and query
                $result = mysqli_query($conn, $query);

				// WHILE there is a result within a row returned
                while ($row = mysqli_fetch_assoc($result))
                {
                   // GET AND SET ALL information from each column
                    $carID = " " . $row["CarID"];
                    $userID = " " . $row["UserID"];

					$reg = " " . $row["Registration"];
					$manuf = " " . $row["Manufacturer"];
					$model = " " . $row["Model"]; 
					$variant = " " . $row["Variant"];
					$transmission = " " . $row["Transmission"];
					$fueltype = " " . $row["FuelType"];
					$engsize = " " . $row["EngineSize"];
					$age = " ". $row["VehicleAge"];
					$miles = " ". $row["Mileage"];
					$prevOwners = " ". $row["PrevOwners"];
					$price = " ". $row["Price"];
                }
            }
             
        ?>
        
            <div class="row">

                <div class="col-md-6">

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner rounded-lg border">
                            <div class="carousel-item active">
                            <img class="d-block w-100" src="images/car-3849577_640.png" alt="First slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="images/car-3849577_640.png" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="images/car-3849577_640.png" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="mt-3 mb-2 text-center mx-auto">

                        <form action="Purchase.php" method="post">

                            <div class="form-group">

                                <?php
									// ECHO hidden form passing CarID, Registration and price to Purchase.php
                                    echo '
                                        <input hidden type="text" name="carid" id="carid" value='.$carID.'>
                                        <input hidden type="text" name="reg" id="reg" value='.$reg.'>
                                        <input hidden type="text" name="price" id="price" value='.$price.'>
                                    ';
                                ?>
                                <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Purchase This Vehicle</button>
                                
                            </div>
                        </form>


                        <a href="Contact.php" type="button" class="btn btn-danger btn-lg btn-block">Report a Problem</a>
                    </div>
                    

                    <div class="row text-center">
                        

                        <?php
							// DECLARE variable for SQL query - SELECT Username FROM user_accounts table where UserID is the same as UserID passed through
                            $usernameQuery = "SELECT Username FROM user_accounts WHERE UserID = '$userID'";

							// EXECUTE SQL query passing database connection and query
                            $rslt = mysqli_query($conn, $usernameQuery);

							// WHILE there is a row returned from query - McGrath (2018, p. 179).
                            while ($row = mysqli_fetch_assoc($rslt))
                            {
								// SET Username to the data returned from Username table column
                                $userID = " " . $row["Username"];
                            }
                        ?>

                        <div class="form-group col-sm-6 mt-2">
                        <hr/>
                            <?php
                                echo '
                                <small id="user" class="form-text text-muted">Seller</small> 
                                <h3>'.$userID.'</h3><hr/>';

                                echo '
                                <small id="registration" class="form-text text-muted">Registration</small> 
                                <h3>'.$reg.'</h3><hr/>';
                            ?>
                        </div>
                        
                        <div class="form-group col-sm-6 mt-2">
                        <hr/>
                            <?php
                                echo '
                                <small id="price" class="form-text text-muted">Price</small> 
                                <h3>£ '. number_format($price, 2) .'</h3><hr/>';

                                echo '
                                <small id="owners" class="form-text text-muted">Previous Owners</small> 
                                <h3>'.$prevOwners.'</h3><hr/>';
                            ?>
                        </div>

                    </div>

                </div>

                <div class="col-md-6 text-center">

                        <?php
							// ECHO vehicle data 
                            echo '<h3 class="card-header">Vehicle Specification</h3><hr/>';

                            echo '<small id="manuf" class="form-text text-muted">Manufacturer</small> 
                            <h3>'. $manuf . '</h3><hr/>';

                            echo '<small id="model" class="form-text text-muted">Model</small> 
                            <h3>'. $model . '</h3><hr/>';

                            echo '<small id="variant" class="form-text text-muted">Variant</small> 
                            <h3>'. $variant . '</h3><hr/>';

                            echo '<small id="transmission" class="form-text text-muted">Transmission</small> 
                            <h3>'. $transmission . '</h3><hr/>';

                            echo '<small id="fuel" class="form-text text-muted">Fuel Type</small> 
                            <h3>'. $fueltype . '</h3><hr/>';

                            echo '<small id="enginesize" class="form-text text-muted">Engine Size</small> 
                            <h3>'. $engsize/10 . '</h3><hr/>';
               
                            echo '<small id="age" class="form-text text-muted">Year of Registration</small> 
                            <h3>'. $age . '</h3><hr/>';

                            // https://stackoverflow.com/questions/51736792/php-money-format-add-decimal-and-comma-when-needed
                            echo '<small id="miles" class="form-text text-muted">Mileage</small> 
                            <h3>'. number_format($miles) . '</h3><hr/>';
                            
                        ?>

                    
                </div>


            </div>

    </div>



    <?php
        include_once 'footer.php';
    ?>
