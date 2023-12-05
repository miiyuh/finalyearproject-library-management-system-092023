<?php
session_start();

// Clear all session variables
$_SESSION = array();

// Check if session uses cookies
if (ini_get("session.use_cookies")) {
    // Get session cookie parameters
    $params = session_get_cookie_params();

    // Expire the session cookie
    setcookie(
        session_name(),
        '',
        time() - 60 * 60,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Unset a specific session variable
unset($_SESSION['login']);

// Destroy the session
session_destroy();

// Redirect to admin login page
header("location:../adminlogin.php");
exit(); // Ensure that no further code is executed after redirection
?>