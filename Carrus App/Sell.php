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
        <link rel="stylesheet" href="css/IndexStyles.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        <title>Carrus Sell</title>

    </head>

    <body>

        <?php
			// INCLUDE DBConnec.php ONCE
            include_once 'DBConnec.php';
			// INCLUDE Header.php ONCE
            include_once 'Header.php';
        ?>
    

        <div style="margin-top: 10px;" class="text-center container-fluid">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" src="images/CarrusBlue.png" alt="">
                    <hr/>
                    <h1>Looking to Sell Your Car?</h1>
                    <h2>Fill in the form below to start!</h2>
                </div>
            </div>

            <?php
				//IF error message is passed through URL - McGrath (2018, p. 174).
                if (isset($_GET["errormsg"]))
                {
					// IF message is emptyInp
                    if ($_GET["errormsg"] == "emptyInp")
                    {
						// DISPLAY empty fields error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Empty Fields!</div>";
                    }
					
					// IF message is RegExists
                    if ($_GET["errormsg"] == "RegExists")
                    {
						// DISPLAY Registration already listed error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Registration plate is already listed!</div>";
                    }
					
					// IF message is NegativeEngineSize
					if ($_GET["errormsg"] == "NegativeEngineSize")
                    {
						// DISPLAY engine cannot be negative error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Engine size cannot be negative!</div>";
                    }
					
					// IF message is NegativeYear
					if ($_GET["errormsg"] == "NegativeYear")
                    {
						// DISPLAY Year cannot be negative error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Vehicle year cannot be negative!</div>";
                    }
					
					// IF message is NegativeMileage
					if ($_GET["errormsg"] == "NegativeMileage")
                    {
						// DISPLAY mileage cannot be negative error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Mileage cannot be negative!</div>";
                    }
					
					// IF message is NegativeOwner
					if ($_GET["errormsg"] == "NegativeOwner")
                    {
						// DISPLAY previous owner cannot be negative error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Previous owners cannot be negative!</div>";
                    }
					
					// IF message is NegativePrice
					if ($_GET["errormsg"] == "NegativePrice")
                    {
						// DISPLAY price cannot be negative error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Price cannot be negative!</div>";
                    }
					
					// IF message is EngineSizeNotNumeric
					if ($_GET["errormsg"] == "EngineSizeNotNumeric")
                    {
						// DISPLAY engine size can only have numbers error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Engine size can only contain numbers!</div>";
                    }
					
					// IF message is YearNotNumeric
					if ($_GET["errormsg"] == "YearNotNumeric")
                    {
						// DISPLAY year can only contain numbers error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Vehicle year can only contain numbers!</div>";
                    }
					
					// IF message is MilesNotNumeric
					if ($_GET["errormsg"] == "MilesNotNumeric")
                    {
						// DISPLAY mileage can only contain numbers error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Mileage can only contain numbers!</div>";
                    }
					
					// IF message is MilesThreshold
					if ($_GET["errormsg"] == "MilesThreshold")
                    {
						// DIPLAY maximum miles error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Maximum mileage of 1,000,000!</div>";
                    }
					
					// IF message is OwnerNotNumeric
					if ($_GET["errormsg"] == "OwnerNotNumeric")
                    {
						// DISPLAY previous owner can only contain numbers error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Previous owners can only contain numbers!</div>";
                    }
					
					// IF message is PriceNotNumeric
					if ($_GET["errormsg"] == "PriceNotNumeric")
                    {
						// DISPLAY price can only contain numbers error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Price can only contain numbers!</div>";
                    }

					// IF message is statementFailure
                    if ($_GET["errormsg"] == "statementFailure")
                    {
						// DISPLAY internal error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Internal Error! Please try again.</div>";
                    }

					// IF message is listerror
                    if ($_GET["errormsg"] == "listerror")
                    {
						// DISPLAY listing error
                        echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Unable to list item! Please try again.</div>";
                    }
	
					// IF message is noerror
                    if ($_GET["errormsg"] == "noerror")
                    {
						// DISPLAY success
                        echo "<div class='col-md-2 mx-auto alert alert-success' role='alert'>Success! Your vehicle has been listed for sale.</div>";
                    }
                }
            ?>

            <div class="row">
            <div class="col"></div>

                <div class="col-sm-4 col-md-4">
                    <form method="POST" action="php-includes/SellVehicle.php" name="sellform">
                        <hr/>
                        <div class="form-group">
                            <input style="text-align: center;" type="text" class="form-control" id="Registration" name="Registration" placeholder="Registration" minlength="1" maxlength="7" required>
                            <small id="RegHelp" class="form-text text-muted">The plate on your car, e.g. AB22ABC.</small>
                        </div>

                        <div class="form-group">
                            <input style="text-align: center;" type="text" class="form-control" id="Manufacturer" name="Manufacturer" placeholder="Manufacturer" required>
                            <small id="manufhelp" class="form-text text-muted">Your cars brand, e.g. Volkswagen.</small>
                        </div>

                        <div class="form-group">
                            <input style="text-align: center;" type="text" class="form-control" id="Model" name="Model" placeholder="Model" required>
                            <small id="Modelhelp" class="form-text text-muted">Your cars model, e.g. Golf, A3, 1 Series, Fabia</small>
                        </div>

                        <div class="form-group">
                            <input style="text-align: center;" type="text" class="form-control" id="Variant" name="Variant" placeholder="Variant" required>
                            <small id="Varianthelp" class="form-text text-muted">Your cars variant, e.g. GTI, M Sport, Black Edition. </small>
                        </div>

                        <div class="form-group">
                            <select class="form-control" id="Transmission" name="Transmission" required>
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                            </select>
                            <small id="TransHelp" class="form-text text-muted">Your cars transmission, Manual / Automatic.</small>
                        </div>

                        <div class="form-group">
                            <select class="form-control" id="FuelType" name="FuelType" required>
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Electric">Electric</option>
                            </select>
                            <small id="Fuelhelp" class="form-text text-muted">Your cars fuel type, Petrol / Diesel / Electric.</small>
                        </div>

                        <div class="form-group">
                            <input style="text-align: center;" type="number" class="form-control" id="EngineSize" name="EngineSize" placeholder="Engine Size" required>
                            <small id="Agehelp" class="form-text text-muted">The size of your cars engine, e.g. 1.2L = 12, 4.0L = 40. <span class="text-danger">(00 If Electric)</span>.</small>
                        </div>

                        <div class="form-group">
                            <input style="text-align: center;" type="number" class="form-control" id="VehicleAge" name="VehicleAge" placeholder="Year" required>
                            <small id="Agehelp" class="form-text text-muted">The year your vehicle was registered.</small>
                        </div>

                        <div class="form-group">
                            <input style="text-align: center;" type="number" class="form-control" id="Mileage" name="Mileage" placeholder="Total Mileage" minlength="0" maxlength="1000000" required>
                            <small id="Mileshelp" class="form-text text-muted">How many miles your odometer reads.</small>
                        </div>

                        <div class="form-group">
                            <input style="text-align: center;" type="number" class="form-control" id="PrevOwners" name="PrevOwners" placeholder="Number of previous owners (Including You)" minlength="0" required>
                            <small id="Ownerhelp" class="form-text text-muted">The total number of previous owners that the car has had.</small>
                        </div>

                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="poundsign">£</span>
                            </div>
                            <input style="text-align: center;" id="Price" name="Price" type="number" class="form-control" placeholder="What would you like to sell it for?" aria-label="Price" aria-describedby="poundsign" minlength="1" required>
                        </div>

                        <div class="form-group custom-file">
                            <input type="file" class="custom-file-input" id="Photo" name="Photo" disabled>
                            <label class="custom-file-label" for="customFile">Choose Image</label>
                            <small id="images" class="form-text text-muted">Any images you wish to add of the car. (Currently Unavailable).</small>
                        </div>

                        <hr/>

                        <button type="submit" name="submit" value="sellvehicle" class="btn btn-primary btn-lg">Submit</button>
                    </form>
                    <br>
                </div>

                <div class="col"></div>
            </div>
        </div>


        <?php
            include_once 'footer.php';
        ?>

