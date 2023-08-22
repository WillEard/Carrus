<?php
	// SESSION START
    session_start();
	// SESSION UNSET
    session_unset();
	// DESTROY SESSION - Logs user out
    session_destroy();

	// REDIRECT to index.php
    header("location: ../index.php");

	// EXIT SCRIPT
    exit();
?>