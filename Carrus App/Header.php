<?
	//McGrath (2018, p. 174). 
	// McGrath, M. (2018). PHP & MySQL in easy steps. 2nd Edition. Warwickshire. In Easy Steps.
?>	
<style>  
	#clock {
		height: 4vh;
		width: 25%;
		color: #FFFF;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 30px;
	}
</style>

<div class="header">
        <div class="menu-bar">
            <nav class="navbar navbar-expand-lg navbar-light">
                
                <a class="navbar-brand" href="index.php"><img src="images/Carrus.png" alt=""></a>

                


                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto list-inline">
                        <li class="nav-item list-inline-item col">

				<div id="clock" class="navbar-brand mt-2"></div>
                <script>    
					// studytonight. (2021). Build a Simple Digital Clock with Javascript. [online] Available at: https://www.studytonight.com/post/build-a-simple-digital-clock-with-javascript (Accessed: 17 April 2022).
					// (studytonight, 2021).
					// FUNCTION currentTime to get time
                    function currentTime() 
                    {	
						// Create Data object called date
                        let date = new Date(); 
						// SET hour to current machine hours
                        let hours = date.getHours();
						// SET minutes to current machine minutes
                        let minutes = date.getMinutes();
						// SET AM or PM time to AM
                        let AMPM = "AM";
                        
						// IF current hours is equal to 0
                        if(hours == 0)
						{
							// SET hours to 12
                            hours = 12;
                        }
						// IF current hours is greater than 12
                        if(hours > 12){
							// SET hours to hours minus 12
                            hours = hours - 12;
							// SET AMPM to 'PM'
                            AMPM = "PM";
                        }
                        
						// SET hours to have a zero infront if less than 10
                        minutes = (minutes < 10) ? "0" + minutes : minutes;
                            
						// Concatenate hours and minutes and AMPM together
                        let time = hours + ":" + minutes + " " + AMPM;
                        
						// GET clock element by ID inside html
                        document.getElementById("clock").innerText = time; 
						// CALL function with a timeout of 1000ms, refresh every second
                        let t = setTimeout(function(){ currentTime() }, 1000);
                    }
            	
					// CALL function
                    currentTime();
					///
                </script>
                            
                            
                        </li>
                        
                            <?php
                        		// IF session active and logged in - McGrath (2018, p. 174). 
                                if (isset($_SESSION["email"]))
                                {
									// DISPLAY Buy, Sell, About, Contact, Logout, Profile links
                                    echo 
                                    '	<li class="nav-item list-inline-item">
											<a class="nav-link" href="DVLACheck.php">DVLA Check</a>
										</li>
                                        <li class="nav-item list-inline-item">
                                            <a class="nav-link" href="index.php">Home</a>
                                        </li>
                                        <li class="nav-item list-inline-item">
                                            <a class="nav-link" href="Browse.php">Buy</a>
                                        </li>
                                        <li class="nav-item list-inline-item">
                                            <a class="nav-link" href="Sell.php">Sell</a>
                                        </li>
                                        <li class="nav-item list-inline-item">
                                            <a class="nav-link" href="About.php">About</a>
                                        </li>
                                        <li class="nav-item list-inline-item">
                                            <a class="nav-link" href="Contact.php">Contact</a>
                                        </li>
                                        <li class="nav-item list-inline-item">
                                            <a class="nav-link" href="php-includes/SignOut-ext.php">Logout</a>
                                        </li>
                                        <li class="nav-item list-inline-item">
                                            <a class="nav-link" href="Profile.php">Profile</a>
                                        </li>
                                    ';
                                }
                                else
                                {
									// DISPLAY Home, About, Sign Up, Sign In links
                                    echo 
                                    '
										<li class="nav-item list-inline-item">
											<a class="nav-link" href="DVLACheck.php">DVLA Check</a>
										</li>
                                        <li class="nav-item list-inline-item">
                                            <a class="nav-link" href="index.php">Home</a>
                                        </li>
                                        <li class="nav-item list-inline-item">
                                            <a class="nav-link" href="About.php">About</a>
                                        </li>
                                        <li class="nav-item list-inline-item">
                                            <a class="nav-link" href="SignUp.php">Sign Up</a>
                                        </li>
                                        <li class="nav-item list-inline-item">
                                            <a class="nav-link" href="SignIn.php">Sign In</a>
                                        </li>
                                    ';
                                }
                            ?> 
                    </ul>
                </div>
            </nav>
        </div>
     </div>