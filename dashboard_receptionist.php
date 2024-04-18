<?php
    require "check_login_receptionist.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Receptionist - HMS</title>
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
<?php include 'header.php'; ?>

<!-- Sidebar -->
<div class="sidebar">
    <a href="register_patient.php" <?php if(basename($_SERVER['PHP_SELF']) == 'register_patient') echo 'class="active"'; ?>>Register Patient</a>
    <a href="search_patient.php" <?php if(basename($_SERVER['PHP_SELF']) == 'search_patient.php.php') echo 'class="active"'; ?>>Search Patient</a>
    <a href="check_appointment.php" <?php if(basename($_SERVER['PHP_SELF']) == 'check_appointment.php') echo 'class="active"'; ?>>Check Appointments</a>
    <a href="logout.php" <?php if(basename($_SERVER['PHP_SELF']) == 'logout.php') echo 'class="active"'; ?>>Logout</a>
</div>

<!-- Page content -->
<div class="content" style="margin-top: 80px;">
    <h2>Welcome to Receptionist Dashboard</h2>
    <p>Please select an option from the menu on the left.</p>
</div>

</body>
</html>
