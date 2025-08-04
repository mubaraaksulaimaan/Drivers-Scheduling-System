<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: auth/login.php"); // Redirect to login page
    exit();
}
else{
    header("Location: admin/dashboard.php"); // Redirect to dashboard
    exit();
}
?>
