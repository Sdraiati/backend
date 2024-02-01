<?php
// Start the session
session_start();

// Check if the user is logged in
if(isset($_SESSION['email'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to a login page or any other page as needed
    redirect("index.php");
    exit();
} else {
    // If the user is not logged in, redirect to a login page or any other page as needed
    redirect("index.php");
    exit();
}
?>
