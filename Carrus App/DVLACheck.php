
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
        <link rel="stylesheet" href="css/SignUp-In-styles.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        <title>Carrus DVLA Registration</title>
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
                    
                
                    <h1>UK DVLA Vehicle Enquiry</h1>
					<hr/>
                </div>
            </div>

                    <br>
	                    <div class="row">
                        	<div class="col"></div>

                        	<div class="col-sm-5 col-md-6">
								<?
									// IF 'submit' has been clicked
									if (isset($_POST["submit"]))
									{
									}
								?>
							
								 <form method="POST" action="#" name="signinform">
									 <h2>Get official information about your vehicle here.</h2>
									<hr/>
									<div class="form-group">
										<input class="form-control form-control-lg text-center" type="text" name="registration" id="registration" placeholder="REGISTRATION" minlength="1" maxlength="7" required>
										<small id="reglabel" class="form-text text-muted">Your Registration Plate.</small>
									</div>

								   <button class="btn btn-success btn-lg" type="submit" name="submit" id="btnGetReg" value="submit" data-toggle="tooltip" data-placement="top" title="Reg">Get Vehicle Information</button>
									 <br>
									
									 <?php
							// IF session is set and logged in, display Contact.php button - McGrath (2018, p. 174).
										if (isset($_SESSION["email"]))
										{                
											echo '<a href="Contact.php" class="btn btn-danger btn-md">Report a Problem</a>';
										}
									 	// ELSE display Signin button
										else
										{
											echo '<a href="SignIn.php" class="btn btn-danger btn-md" type="button" name="signin" id="signin" data-toggle="tooltip" data-placement="top" title="SignIn">Sign-in To Report a Problem</a>';
										}
									 ?>
								</form>
							
							<?php
										  
								// DECLARE variable and SET to 'registration' id tag from form
								$Registration = $_POST["registration"];
								
								// Gov.UK. (No Date). VES API Code Examples. [online] Available at: https://developer-portal.driver-vehicle-licensing.api.gov.uk/apis/vehicle-enquiry-service/code-examples.html#php (Accessed: 19 April 2022).
								/// - (Gov.uk, No Date)
									
									// INITIALISE Curl
									$curl = curl_init();
									
									// DECLARE Array
									curl_setopt_array($curl, array(
									  // SET URL
									  CURLOPT_URL => "https://driver-vehicle-licensing.api.gov.uk/vehicle-enquiry/v1/vehicles",
									  // SET RETURN TO TRUE
									  CURLOPT_RETURNTRANSFER => true,
									  // IF Any specific encoding
									  CURLOPT_ENCODING => "",
									  // SET Maximum redirects before timeout
									  CURLOPT_MAXREDIRS => 10,
									  // SET TIMEOUT to 0
									  CURLOPT_TIMEOUT => 0,
									  CURLOPT_FOLLOWLOCATION => true,
									  // SET HTTP VERSION
									  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									  // POST request for sending data
									  CURLOPT_CUSTOMREQUEST => "POST",
									  // PARAMETERS for posting data - registration entered
									  CURLOPT_POSTFIELDS =>"{\"registrationNumber\": \"$Registration\"}",
									  // USE API Key to access API - API KEY IS HIGHLY SENSITIVE DO NOT EXPOSE
									  CURLOPT_HTTPHEADER => array(
										"x-api-key: PpufY7gVxp7T0FE13AL1w8XBXc2kXpcy2QexHdX7",
										"Content-Type: application/json"
									  ),
									));

									// EXECUTE above commands and store inside variable
									$response = curl_exec($curl);
									
									// CLOSE the statement
									curl_close($curl);
								///	
							
								// GET Error code returned
								$errorCode = (http_response_code());
								// IF error code is 404 - Registration entered is invalid
								if ($errorCode == 404)
								{
									// DISPLAY error
									echo "<div class='col-md-3 mx-auto alert alert-danger' role='alert'>Error: Invalid Registration!</div>";
								}
								
								// DECLARE variable SET to response above
							    $string  = $response;
								
								// BREAK apart string returned splitting apart by commas
								$break = explode(",", $string);
								
								// DECLARE variable to 1st value in break array
								$reg = $break[0];
								// SUBTRACT values from string - 23 first values and 1 last value
								$Registration = substr($reg, 23, -1);
							
								// DECLARE variable to 2nd value in break array
								$co2 = $break[1];
								// SUBTRACT values from string - 15 first values
								$Co2 = substr($co2, 15);
							
								// DECLARE variable to 3rd value in break array
								$engine = $break[2];
								// SUBTRACT values from string - 17 first values
								$Engine = substr($engine, 17);	
							
								// DECLARE variable to 4th value in array
								$export = $break[3];
								// SUBTRACT values from string - 18 first values
								$Export = substr($export, 18);	
							
								// DECLARE variable to 5th value in array
								$fuel = $break[4];
								// SUBTRACT values from string - 12 first values and 1 last value
								$Fuel = substr($fuel, 12, -1);
							
								// DECLARE variable to 6th value in break array
								$motStatus = $break[5];
								// SUBTRACT values from string - 13 first values and 1 last value
								$MOTStatus = substr($motStatus, 13, -1);
							
								// DECLARE variable to 7th value in break array
								$revWeight = $break[6];
								// SUBTRACT values from string - 16 first values
								$RevWeight = substr($revWeight, 16);
							
								// DECLARE variable to 8th value in break array
								$color = $break[7];
								// SUBTRACT values from string - 10 first values and 1 last value
								$Color = substr($color, 10, -1);
							
								// DECLARE variable to 9th value in break array
								$manuf = $break[8];
								// SUBTRACT values from string - 8 first values and 1 last value
								$Manuf = substr($manuf, 8, -1);
							
								// DECLARE variable to 10th value in break array
								$typeApprov = $break[9];
								// SUBTRACT values from string - 16 first values and 1 last value
								$TypeApprov = substr($typeApprov, 16, -1);
							
								// DECLARE variable to 11th value in break array
								$yearOfManuf = $break[10];
								// SUBTRACT values from string - 20 first values
								$YearOfManuf = substr($yearOfManuf, 20);
							
								// DECLARE variable to 12th value in break array
								$taxDue = $break[11];
								// SUBTRACT values from string - 14 first values 1 last value
								$TaxDue = substr($taxDue, 14, -1);
							
								// DECLARE variable to 13th value in break array
								$taxStatus = $break[12];
								// SUBTRACT values from string - 13 first values and 1 last value
								$TaxStatus = substr($taxStatus, 13, -1);
							
								// DECLARE variable to 14th value in break array
								$dateOfLastV5 = $break[13];
								// SUBTRACT values from string - 23 first values and 1 last value
								$DateOfLastV5 = substr($dateOfLastV5, 23, -1);
							
								// DECLARE variable to 15th value in break array
								$motExpire = $break[14];
								// SUBTRACT values from string - 17 first values and 1 last value
								$MOTExpire = substr($motExpire, 17, -1);
							
								// DECLARE variable to 16th value in break array
								$wheelPlan = $break[15];
								// SUBTRACT values from string - 13 first values and 1 last value
								$WheelPlan = substr($wheelPlan, 13, -1);
							
								// DECLARE variable to 17th value in break array
								$firstRegistration = $break[16];
								// SUBTRACT values from string - 28 first values and 2 last value
								$FirstRegistration = substr($firstRegistration, 28, -2);
										
								// ECHO Vehicle information insde form groups
								echo '
                           
                        </div>
							
                        <div class="col"></div>
						
                    </div>
					<hr/>
					<div class="row">
                            <div class="form-group col-md-3">
                                <label>Registration:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$Registration.' readonly>
                                <small class="form-text text-muted">Vehicles Registration Plate</small>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Co2 Emissions:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$Co2.' readonly>
                                <small class="form-text text-muted">Vehicles Co2 output in grams per km</small>
                            </div>
							<div class="form-group col-md-3">
                                <label>Engine Capacity:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$Engine.' readonly>
                                <small class="form-text text-muted">Engine cylinder capacity in cubic centimeters</small>
                            </div>
							<div class="form-group col-md-3">
                                <label>Marked For Export:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$Export.' readonly>
                                <small class="form-text text-muted">If vehicle is marked for export. TRUE or FALSE</small>
                            </div>
                    </div>
					<div class="row">
                            <div class="form-group col-md-3">
                                <label>Fuel Type:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$Fuel.' readonly>
                                <small class="form-text text-muted">Vehicles fuel type</small>
                            </div>
                            <div class="form-group col-md-3">
                                <label>MOT Status:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$MOTStatus.' readonly>
                                <small class="form-text text-muted">If vehicle has a valid MOT</small>
                            </div>
							<div class="form-group col-md-3">
                                <label>MOT Expiry:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$MOTExpire.' readonly>
                                <small class="form-text text-muted">Vehicles MOT expiration date</small>
                            </div>
							<div class="form-group col-md-3">
                                <label>Colour:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$Color.' readonly>
                                <small class="form-text text-muted">Vehicles colour</small>
                            </div>
                    </div>
					<div class="row">
                            <div class="form-group col-md-3">
                                <label>Manufacturer:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$Manuf.' readonly>
                                <small class="form-text text-muted">Vehicles manufacturer</small>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Type Approval:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$TypeApprov.' readonly>
                                <small class="form-text text-muted">Vehicles type approval</small>
                            </div>
							<div class="form-group col-md-3">
                                <label>Year Of Manufacturing:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$YearOfManuf.' readonly>
                                <small class="form-text text-muted">Vehicles year of manufacturing</small>
                            </div>
							<div class="form-group col-md-3">
                                <label>Wheel Plan:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$WheelPlan.' readonly>
                                <small class="form-text text-muted">Vehicles wheel plan with axle rigid</small>
                            </div>
                    </div>
					<div class="row">
                            <div class="form-group col-md-3">
                                <label>Tax Due:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$TaxDue.' readonly>
                                <small class="form-text text-muted">Vehicles tax due date</small>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Tax Status:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$TaxStatus.' readonly>
                                <small class="form-text text-muted">Vehicles tax status</small>
                            </div>
							<div class="form-group col-md-3">
                                <label>Date Of Last V5 Issed:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$DateOfLastV5.' readonly>
                                <small class="form-text text-muted">Vehicles last V5 issued</small>
                            </div>
							<div class="form-group col-md-3">
                                <label>First Registration:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$FirstRegistration.' readonly>
                                <small class="form-text text-muted">Vehicles first registration date</small>
                            </div>
                    </div>
					<div class="row">
                            <div class="form-group col-md-3">
                                <label>Revenue Weight:</label>
                              	<input type="text" class="form-control text-center" placeholder='.$RevWeight.' readonly>
                                <small class="form-text text-muted">Vehicles revenue weight in KG</small>
                            </div>
                    </div>
					<hr/>
			';		
			?>
			
                </div>
			
		</div>
		</div>
		<?php
            include_once 'footer.php';
        ?>
    </body>
	
</html>
   