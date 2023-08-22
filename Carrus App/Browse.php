<?php
	// START SESSION
    session_start();

	// INCLUDE DBConnec.php ONCE
    include_once "php-includes/DBConnec.php";
	// INCLUDE functions.php ONCE
    include_once "php-includes/functions.php";
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
        <link rel="stylesheet" href="css/ProductBrowse-styles.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        <title>Carrus Browse</title>
    </head>

    <body>

    <style>
        .card-img-top
        {
            object-fit: cover;
        }
    </style>
        
        <?php
			// INCLUDE Header.php ONCE
            include_once 'Header.php';
        ?>

        <script>
			// SCRIPT to handle filtering for when user searches for a vehicle name/model
			// w3schools. (2022). jQuery Filters. [online] Available at: https://www.w3schools.com/jquery/jquery_filters.asp (Accessed: 10 April 2022).
			// FUNCTION FOR FILTERING VEHICLE WORDS
            $(document).ready(function()
			{
				// TARGET 'myInput' id inside HTML tag. 
            	$("#myInput").on("keyup", function() 
				{
					// Take value inputted and convert to lower case
                	var value = $(this).val().toLowerCase();
					// Filter to show div and button html tags
                	$("#myTable div").filter(function() 
					{
                		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                	});
            	});
            });
        </script>
    
        <div class="container-fluid mt-5">
        
            <div class="row">
                <div class="col text-center">
                    <h2>Search for your dream car here!</h2>
                    <p>Search by Manufacturer, Model or Variant.</p> 
                    <div class="col-5 mx-auto">
                        <input class="form-control text-center card-header " id="myInput" type="text" placeholder="Search..">
                        <br>
                    </div> 
                    <hr/>
            </div>

            </div>

        <div class="row ml-3 mr-3" id="myTable">

            <?php
				// IF errormsg value is set in URL - McGrath (2018, p. 174). 
                if (isset($_GET["errormsg"]))
                {
					// IF errormsg returned is 'areadyOrdered' (Not Fully Implemented)
                    if ($_GET["errormsg"] == "alreadyOrdered")
                    {
						// DISPLAY 'Vehicle has already been ordered!' message
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Vehicle has already been ordered!</div>";
                    }

					// IF error returned is 'statementFailure'
                    if ($_GET["errormsg"] == "statementFailure")
                    {
						// DISPLAY internal error message
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Internal Error! Please try again.</div>";
                    }
                }
            ?>

            <?php
				// DECLARE variable SET to an SQL query - Select ALL from Vehicles table
                $query = "SELECT * FROM Vehicles";
				// EXECUTE query - passing database connetion and previous SQL statement
                $result = mysqli_query($conn, $query);
      
				// IF number of rows returned is greater than 0 - If there are results
                if ($result->num_rows > 0) 
                {
                    
                    // REF - Grepper. (2020). php mysql read all rows Code Answer. [online] Available at: https://www.codegrepper.com/code-examples/php/php+mysql+read+all+rows (Accessed: 8 April 2022).
					// WHILE iterating through each result returned from number of rows
                    while($row = $result->fetch_assoc()) 
                    {
                        // GET DATA FROM Vehicles TABLE AND STORE INTO VARIABLES FOR EACH RECORD / LOOP
                        // GET Car ID to get data from specific row
                        $carID = " " . $row["CarID"];

                        // GET UserID to get the seller's username
                        $userID = " " . $row["UserID"];

                        // GET ALL information from each column
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
                        
						// ECHO entire div box passing through data gathered from each row
                        echo '
                        
                            <div class="col-md-4" id="myTable">
                                <div class="card mb-4 box-shadow" >
                                    <img class="card-img-top" alt="Thumbnail [100%x225]" style="width: 100%; display: block;" src="images/car-3849577_640.png" data-holder-rendered="true">
                            
                                    <div class="card-body">
                                        <?php
                                            
                                            echo "
                                            <h4 class="card-title"></h4>
                                            <span class="card-title float-right">' . $reg . '</span>
                                            <h5 class="card-title">' . $manuf . '</h5>


                                            <span class="float-right ml-5"><h5> £ ' . number_format($price, 2) . '</h5></span>
                                        

                                            <p class="card-text">' . $model . '<span> 
                                            </span>' . $variant . '</p> 
                                        
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge badge-pill badge-warning mt-2">Used</span>
                                        <?php
                            
                                            echo "<small class="text-muted ml-5">Mileage: ' . number_format($miles) . '</small>
                                        
                                        </div>
                                    </div>
                                    <div class="card-header text-center">Key Features</div>
									
                                        <ul class="list-group list-group-flush">
										<li class="list-group-item">
										    <form action="VehicleDetailed.php" method="post">

											<div class="form-group">

                                                 <input hidden type="text" id="carid" name="carid" value='.$carID.'>
                                                 <input hidden type="text" id="userid" name="userid" value='.$userID.'>
												 
                                            </div>
										<button type="submit" name="submit" class="btn btn-info btn-lg btn-block">Buy This 
										Car</button> </li> 
										    </form>

                                            
                                            <li class="list-group-item"> Fuel Type: '. $fueltype .'</li>
                                    
                                            <li class="list-group-item"> Transmission: '. $transmission .'</li>

                                                
                                                
                                                
                                        </ul>
                                </div>
                            </div>
                        
                        ';

                    }
                } 
				// ELSE echo message to user
                else 
                {
					// ECHO 'No vehicles available' message
                   echo '
                   
                        <div class="col-sm-3"></div>

                        <div class="col-sm-6">
                            <h1 class="text-center"> Uh Oh! It looks like there arent any vehicles available right now. <br><br>Try again later. </h1>
                        </div>

                        <div class="col-sm-3"></div>

                   ';
                }
            ?>

        </div>
    </div>
	<br><br><br><br><br><br>

		
        <?php
			// INCLUDE 'footer.php' ONCE
            include_once 'footer.php';
        ?>

        

            


