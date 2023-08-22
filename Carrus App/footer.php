<?php
  
?>
<!-- Footer -->
<footer style="background-image: linear-gradient(-90deg, #47e6fd, #47abfd); color: white;!important position: fixed;" class="page-footer red pt-4">

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-3 mt-md-0 mt-2">

        <!-- Content -->
        <a class="navbar-brand" href="#"><img src="images/Carrus.png" alt=""></a>
    
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-6 mb-2">

        <!-- Links -->
        <h5 class="text-uppercase text-center mt-2">Links</h5>
        <ul class="list-unstyled text-center">
      
      <?php
		// IF session active and logged in - McGrath (2018, p. 174). 
        if (isset($_SESSION["email"]))
        {
			// DISPLAY Logged in links
            echo 
            '
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
			// DISPLAY logged out links
            echo 
            '
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

      <div class="col-md-3"> </div>

    </div>

    <div class="row">
        <div class="col text-center mb-2">
          <span class="text-muted">© 2022 Copyright:  Carrus</span>
          <a class="text-light" href="index.php">Carrus</a>
        </div>
    </div>



  </div>


</footer>
