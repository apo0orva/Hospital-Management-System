<?php
    require "check_login_management.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Management - HMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Style for sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 90px;
            left: 0;
            background-color: #333;
            overflow-x: hidden;
            padding-top: 20px;
        }

        /* Style for sidebar links */
        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 20px;
            color: white;
            display: block;
        }

        /* Hover effect for sidebar links */
        .sidebar a:hover {
            background-color: white;
            color: black;
        }

        /* Style for page content */
        .content {
            margin-left: 200px;
            padding: 20px;
            margin-top: 80px;
            text-align: center; /* Center-align the content */
        }
    </style>
</head>
<body>

<!-- Navbar -->
<?php require 'header.php'; ?>

<!-- Sidebar -->
<div class="sidebar">
    <a href="register_doctor.php" <?php if(basename($_SERVER['PHP_SELF']) == 'register_doctor.php') echo 'class="active"'; ?>>Register Doctor</a>
    <a href="remove_doctor.php" <?php if(basename($_SERVER['PHP_SELF']) == 'remove_doctor.php') echo 'class="active"'; ?>>Remove Doctor</a>
    <a href="monthly_doctor_report.php" <?php if(basename($_SERVER['PHP_SELF']) == 'monthly_doctor_report.php') echo 'class="active"'; ?>>Monthly Doctor Report</a>
    <a href="disease_wise_registration.php" <?php if(basename($_SERVER['PHP_SELF']) == 'disease_wise_registration.php') echo 'class="active"'; ?>>Disease Registration</a>
    <a href="logout.php" <?php if(basename($_SERVER['PHP_SELF']) == 'logout.php') echo 'class="active"'; ?>>Logout</a>
</div>

<!-- Page content -->
<div class="content" style="margin-top: 80px;">
    <h2>Welcome to Management Dashboard</h2>
    <p>Please select an option from the menu on the left.</p>
</div>

</body>
</html>
