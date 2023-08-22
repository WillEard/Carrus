<?php
    // SESSION START
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
        <link rel="stylesheet" href="css/IndexStyles.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        <title>Carrus Contact</title>
    </head>

    <body style="overflow-x: hidden;">

    <?php
		// INCLUDE Header.php ONCE
        include_once 'Header.php';
    ?>

    <div class="container-fluid">

        <div class="row mt-4">   
            <div class="col text-center">
                <h1>Contact</h1>
                <hr/>
            </div>
        </div>

        <?php
			// IF error message is set in URL - McGrath (2018, p. 174). 
            if (isset($_GET["errormsg"]))
            {
				// IF message is emptySub
                if ($_GET["errormsg"] == "emptySub")
                {
					// DISPLAY empty subject error
                    echo "<div class='col-md-2 mx-auto alert alert-danger text-center' role='alert'>Error: Empty Subject!</div>";
                }
	
				// IF message is emptyMsg
                if ($_GET["errormsg"] == "emptyMsg")
                {
					// DISPLAY empty message error
                    echo "<div class='col-md-2 mx-auto alert alert-danger text-center' role='alert'>Error: Empty Message!</div>";
                }

				// IF message is Success
                if ($_GET["errormsg"] == "Success")
                {
					// DISPLAY success
                    echo "<div class='col-md-2 mx-auto alert alert-success text-center' role='alert'>Success! Your contact query has been sucessfully sent.</div>";
                }
				
				// IF message is InternalError
				if ($_GET["errormsg"] == "InternalError")
                {
					// DISPLAY Internal error
                    echo "<div class='col-md-2 mx-auto alert alert-danger text-center' role='alert'>Error: Internal Error!</div>";
                }
            }
        ?>

        <?php
			// CALL GetUsername passing database connection to get username
            $username = GetUsername($conn);
	
			// SET email to active session email
            $email = $_SESSION['email'];
        ?>

        <div class="row mt-3">
            <div class="col-sm-4"></div>

                <div class="col-sm-4 text-center">

                    <form action="php-includes/ContactProcess.php" method="post" name="contactform">

                        <div class="form-group">
                            <input style="text-align: center;" type="text" class="form-control" id="Username" name="Username" placeholder="<?php echo $username; ?>" readonly>
                            <small id="Name" class="form-text text-muted">Your Username.</small>
                        </div>

                        <div class="form-group">
                            <input style="text-align: center;" type="text" class="form-control" id="Subject" name="Subject" placeholder="Subject / Order #">
                            <small id="Subject" class="form-text text-muted">The subject of contacting.</small>
                        </div>

                        <div class="form-group">
                            <input style="text-align: center;" type="text" class="form-control" id="Email" name="Email" value="<?php echo $email; ?>" readonly>
                            <small id="Email" class="form-text text-muted">Your email address.</small>
                        </div>

                        <div class="form-group">
                            <input style="height: 75px;" type="text" class="form-control text-center" id="Message" name="Message" placeholder="Your Message">
                            <small id="Message" class="form-text text-muted">Your message to contact.</small>
                        </div>
                        <hr/>

                        <button type="submit" name="submit" value="contact" class="btn btn-primary btn-lg">Submit</button>
                    </form>

                </div>
            </div>

            <div class="col-sm-4"></div>
        </div>

    </div>
    <br><br>
    <?php
        include_once 'footer.php';
    ?>

  
