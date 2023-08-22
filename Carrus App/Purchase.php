<?php
	// SESSION START
    session_start();

	// INCLUDE DBConnec.php ONCE
    include_once 'php-includes/DBConnec.php';
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
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="css/HeaderStyles.css">
        <link rel="stylesheet" href="css/SignUp-In-styles.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
        
        <title>Carrus Purchase</title>
    </head>
    
    <body>

    <?php
		// INCLUDE Header.php ONCE
        include_once 'Header.php';
    ?>

   
    <div class="container-fluid">

        <?php
        	// IF data is SET and submit button has been clicked
            if (isset($_POST["submit"]))
            {
				// SET CarID to 'carid' html id passed through the form
                $carID = $_POST['carid'];

				// SET registration to 'reg' html id passed through the form
                $registration = $_POST['reg'];

				// SET PRICE TO 'price' html id passed through the form
                $price = $_POST["price"];
               
            }
    
        ?>

        <div class="row">
            <div class="col text-center">
                <div>
                    <h1>Payment Information</h1>
                    <h4 class="text-danger">NOTE: PROTOTYPE - DO NOT USE REAL LEGITIMATE INFORMATION</h4>
                    <hr/>
                    <?php
                        echo '<h1 class="mt-n3">Your vehicle cost is: £ '. number_format($price, 2) .'</h1>';
                    ?>
                </div>  
            </div>
        </div>

        <?php
			// IF error message is set in URL - McGrath (2018, p. 174).
            if (isset($_GET["errormsg"]))
            {
				// IF message is emptyInp
                if ($_GET["errormsg"] == "emptyInp")
                {
					// DISPLAY empty fields error
                    echo "<div class='col-md-2 mx-auto alert alert-danger text-center' role='alert'>Error: Empty Fields!</div>";
                }
				
				// IF message is CardNotNumeric
				if ($_GET["errormsg"] == "CardNumNotNumeric")
                {
					// DISPLAY Card details need to be numeric error
                    echo "<div class='col-md-2 mx-auto alert alert-danger text-center' role='alert'>Error: Card details have to be numeric!!</div>";
                }
				
				// IF message is SecurityNotNumeric
				if ($_GET["errormsg"] == "SecurityNotNumeric")
                {
					// DISPLAY CVC Numeric error
                    echo "<div class='col-md-2 mx-auto alert alert-danger text-center' role='alert'>Error: CVC code has to be numeric!!</div>";
                }
				
				// IF message is ExpiryNotNumeric
				if ($_GET["errormsg"] == "ExpiryNotNumeric")
                {
					// DISPLAY expiry has to be numeric error
                    echo "<div class='col-md-2 mx-auto alert alert-danger text-center' role='alert'>Error: Expiry date has to be numeric!!</div>";
                }
				
				// IF message is statementFailure
                if ($_GET["errormsg"] == "statementFailure")
                {
					// DISPLAY internal error
                    echo "<div class='col-md-2 mx-auto alert alert-danger' role='alert'>Error: Internal Error! Please try again.</div>";
                }

				// IF message is noerror
                if ($_GET["errormsg"] == "noerror")
                {
					// DISPLAY success
                    echo "<div class='col-md-4 mx-auto alert alert-success' role='alert'>Success! Your payment has successfully been processed.</div>";
                }
            }
        ?>


        <div class="row mt-3">
            <div class="col-sm-3"></div>

            <div class="col-sm-3">

                <form method="POST" action="php-includes/PurchaseProcess.php" name="purchaseform">
                    <?php
					// PREPARE HIDDEN Form to pass data into PurchaseProcess.php file
                        echo '
                            <input hidden type="text" class="form-control text-center" name="carid" id="carid" aria-describedby="carid" value='.$carID.'>
                            <input hidden type="text" class="form-control text-center" name="reg" id="reg" aria-describedby="reg" value='.$registration.'>
                        ';
                    ?>
                    

                    <div class="form-group text-center">
                        <h3>Address Information</h3>
                        <label for="FullAddress">Street Name</label>
                        <input type="text" class="form-control text-center" id="Street" name="Street" aria-describedby="inputaddress" minlength="5" maxlength="64" placeholder="Street Name" required>
                        <small id="address" class="form-text text-muted">Enter your street name.</small>
                    </div>

                    <div class="form-group text-center">
                        <label for="InputCardNum">House Name/Number</label>
                        <input type="text" class="form-control text-center" id="HouseName" name="HouseName" aria-describedby="houseNum" maxlength="64" placeholder="57 / Smith House" required>
                        <small id="InputCardNum" class="form-text text-muted">Enter your house name or number.</small>
                    </div>

                    <div class="form-group text-center">
                        <label for="InputPostcode">Post Code</label>
                        <input type="text" class="form-control text-center" id="Postcode" name="Postcode" aria-describedby="postcode" minlength="6" maxlength="7" placeholder="XXX-XXX" required>
                        <small id="postcode" class="form-text text-muted">Enter your postcode. e.g. ABC123</small>
                    </div>

                    <div class="form-group text-center">
                        <label for="InputCity">Town/City</label>
                        <input type="text" class="form-control text-center" id="City" name="City" aria-describedby="city" minlength="5" maxlength="64" placeholder="City" required>
                        <small id="city" class="form-text text-muted">Enter your Town/City.</small>
                    </div>
                    <hr/>

            </div>

                <div class="col-sm-3">

                    <div class="form-group text-center">
                        <h3>Payment Information</h3>
                        <label for="InputFullName">Full Name</label>
                        <input type="text" class="form-control text-center" id="FullName" name="FullName" aria-describedby="namehelp" minlength="5" maxlength="64" placeholder="Full Name" required>
                        <small id="namehelp" class="form-text text-muted">Enter your full name as shown on the front of your card.</small>
                    </div>

                    <div class="form-group text-center">
                        <label for="InputCardNum">Full Card Number</label>
                        <input pattern=".{16,16}" type="text" class="form-control text-center" id="CardNum" name="CardNum" aria-describedby="Cardhelp" minlength="16" maxlength="16" placeholder="XXXX-XXXX-XXXX-XXXX" required>
                        <small id="InputCardNum" class="form-text text-muted">Enter the full 16-Digit number on the front of your card.</small>
                    </div>

                    <div class="form-group text-center">
                        <label for="InputCVC">CVC/CVV Number</label>
                        <input pattern=".{3,3}" type="text" class="form-control text-center" id="Security" name="Security" aria-describedby="cvchelp" minlength="3" maxlength="3" placeholder="CVC/CVV" required>
                        <small id="cvchelp" class="form-text text-muted">Enter the CVC/CVV security code on the back of your card.</small>
                    </div>

                    <div class="form-group text-center">
                        <label for="InputExpiry">Expiry Date</label>
                        <input pattern=".{4,4}" type="text" class="form-control text-center" id="ExpiryDate" name="Expiry" aria-describedby="expiry" minlength="4" maxlength="4" placeholder="XX-XX" required>
                        <small id="expiry" class="form-text text-muted">Enter the expiry date shown on the back of your card.</small>
                    </div>
                    <hr/>

            </div>
            
            <div class="col-sm-3"></div>
            <div class="col-sm-3"></div>

        </div>

        <div class="row">
            <div class="col text-center">
                <div>
                    <button type="submit" name="submit" class="btn btn-success btn-lg">Pay Now</button>
                    <hr/>
                </div>
            </div>
        </div>

        </form>

    </div>

    <?php
        include_once 'footer.php';
    ?>

