<?php
	// SESSION START
    session_start();
	// REQUIRE DBConnec.php ONCE
    require_once "DBConnec.php";

	// McGrath (2018, p. 68)
	// McGrath, M. (2018). PHP & MySQL in easy steps. 2nd Edition. Warwickshire. In Easy Steps.

	// IF Data is SET on Submit button
    if (isset($_POST["submit"]))
    {	
		/// SET VARIABLES to html 'id' tag values
        $reg = $_POST['Registration'];

        $manuf = $_POST['Manufacturer'];

        $model = $_POST['Model'];

        $variant = $_POST['Variant'];

        $transm = $_POST['Transmission'];

        $fuel = $_POST['FuelType'];

        $enginesize = $_POST['EngineSize'];

        $age = $_POST['VehicleAge'];

        $mileage = $_POST['Mileage'];

        $owners = $_POST['PrevOwners'];

        $price = $_POST['Price'];
		///
        
		// REQUIRE functions.php ONCE
        require_once "functions.php";

		// IF returns TRUE
        if (RegPlateAlreadyExist($conn, $reg) !== false)
        {
            // HEADER to Sell page with error message
            header("location: ../Sell.php?errormsg=RegExists");
			
			// EXIT SCRIPT
            exit();
        }

		// IF returns TRUE
        if (EmptyRegOnSell($reg) != false)
        {
			// HEADER to Sell page with error message
            header("location: ../Sell.php?errormsg=emptyInp");

			// EXIT SCRIPT
            exit();
        }
		
		// IF returns TRUE
        if (EmptyManufOnSell($manuf) != false)
        {
			// HEADER to Sell page with error message
            header("location: ../Sell.php?errormsg=emptyInp");

			// EXIT SCRIPT
            exit();
        }

		// IF returns TRUE
        if (EmptyModelOnSell($model) != false)
        {
			// HEADER to Sell page with error message
            header("location: ../Sell.php?errormsg=emptyInp");

			// EXIT SCRIPT
            exit();
        }

		// IF returns TRUE
        if (EmptyVariantOnSell($variant) != false)
        {
			// HEADER to Sell page with error message
            header("location: ../Sell.php?errormsg=emptyInp");

			// EXIT SCRIPT
            exit();
        }

		// IF returns TRUE
        if (EmptyTransOnSell($transm) != false)
        {
			// HEADER to Sell page with error message
            header("location: ../Sell.php?errormsg=emptyInp");

			// EXIT SCRIPT
            exit();
        }

		// IF returns TRUE
        if (EmptyFuelOnSell($fuel) != false)
        {
			// HEADER to Sell page with error message
            header("location: ../Sell.php?errormsg=emptyInp");

			// EXIT SCRIPT
            exit();
        }

		// IF returns TRUE
        if (EmptyEngineOnSell($enginesize) != false)
        {
			// HEADER to Sell page with error message
            header("location: ../Sell.php?errormsg=emptyInp");
			
			// EXIT SCRIPT
            exit();
        }
		
		// IF enginesize is less than 0
		if ($enginesize < 0)
		{
			// HEADER to Sell page with error message
			header("location: ../Sell.php?errormsg=NegativeEngineSize");
			
			// EXIT SCRIPT
            exit();
		}
		
		// IF returns TRUE
        if (EmptyAgeOnSell($age) != false)
        {
			// HEADER to Sell page with error message
            header("location: ../Sell.php?errormsg=emptyInp");

			// EXIT SCRIPT
            exit();
        }
		
		// IF age is less than 0
		if ($age < 0)
		{
			// HEADER to Sell page with error message
			header("location: ../Sell.php?errormsg=NegativeYear");
			
			// EXIT SCRIPT
            exit();
		}

		// IF returns TRUE
        if (EmptyMilesOnSell($mileage) != false)
        {
			// HEADER to Sell page with error message
            header("location: ../Sell.php?errormsg=emptyInp");

			// EXIT SCRIPT
            exit();
        }
		
		// IF mileage is less than 0
		if ($mileage < 0)
		{
			// HEADER to Sell page with error message
			header("location: ../Sell.php?errormsg=NegativeMileage");
			
			// EXIT SCRIPT
            exit();
		}
		
		// IF mileage is greater than 1,000,000
		if ($mileage > 1000000)
		{
			// HEADER to Sell page with error message
			header("location: ../Sell.php?errormsg=MilesThreshold");
			
			// EXIT SCRIPT
            exit();
		}

		// IF returns TRUE
        if (EmptyOwnersOnSell($owners) != false)
        {
			// HEADER to Sell page with error message
            header("location: ../Sell.php?errormsg=emptyInp");

			// EXIT SCRIPT
            exit();
        }
		
		// IF owners is less than 0
		if ($owners < 0)
		{
			// HEADER to Sell page with error message
			header("location: ../Sell.php?errormsg=NegativeOwner");
			
			// EXIT SCRIPT
            exit();
		}

		// IF returns TRUE
        if (EmptyPriceOnSell($price) != false)
        {
			// HEADER to Sell page with error message
            header("location: ../Sell.php?errormsg=emptyInp");
            exit();
        }
		
		// IF price is less than 0
		if ($price < 0)
		{
			// HEADER to Sell page with error message
			header("location: ../Sell.php?errormsg=NegativePrice");
			
			// EXIT SCRIPT
            exit();
		}
		
		
		// IF is not numeric - McGrath (2018, p. 68)
		if (!is_numeric($enginesize))
		{
			// HEADER to Sell page with error message
			header("location: ../Purchase.php?errormsg=EngineSizeNotNumeric");
			
			// EXIT SCRIPT
            exit();
		}
		
		// IF is not numeric - McGrath (2018, p. 68)
		if (!is_numeric($age))
		{
			// HEADER to Sell page with error message
			header("location: ../Purchase.php?errormsg=YearNotNumeric");
			
			// EXIT SCRIPT
            exit();
		}
		
		
		// IF is not numeric - McGrath (2018, p. 68)
		if (!is_numeric($mileage))
		{
			// HEADER to Sell page with error message
			header("location: ../Purchase.php?errormsg=MilesNotNumeric");
			
			// EXIT SCRIPT
            exit();
		}
		
		
		// IF is not numeric - McGrath (2018, p. 68)
		if (!is_numeric($owners))
		{
			// HEADER to Sell page with error message
			header("location: ../Purchase.php?errormsg=OwnerNotNumeric");
			
			// EXIT SCRIPT
            exit();
		}
		
		// IF is not numeric - McGrath (2018, p. 68)
		if (!is_numeric($price))
		{
			// HEADER to Sell page with error message
			header("location: ../Purchase.php?errormsg=PriceNotNumeric");
			
			// EXIT SCRIPT
            exit();
		}
		
		
		// CALL ListForSale method - passing all variables from $_GET['Submit']
        ListForSale($conn, $reg, $manuf, $model, $variant, $transm, $fuel, $enginesize, $age, $mileage, $owners, $price);
    }
    else
    {
		// HEADER to Sell page
        header("location: ../Sell.php");
		
		// EXIT SCRIPT
        exit();
    }
?>