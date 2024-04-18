<?php
session_start();

// Check if user is not logged in or not management role
if (!isset($_SESSION['login_username']) || $_SESSION['role'] != 3) {
    header("Location: index.php");
    exit();
}

?>