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
            margin-left: 250px;
            padding: 20px;
        }

        /* Style for form table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td, table th {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
            width: 50%; /* Set both columns to have equal width */
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>

<!-- Navbar -->
<?php require 'header.php'; ?>

<!-- Sidebar -->
<div class="sidebar">
    <a href="register_doctor.php" <?php if (basename($_SERVER['PHP_SELF']) == 'register_doctor.php') echo 'class="active"'; ?>>Register
        Doctor</a>
    <a href="remove_doctor.php" <?php if (basename($_SERVER['PHP_SELF']) == 'remove_doctor.php') echo 'class="active"'; ?>>Remove
        Doctor</a>
    <a href="monthly_doctor_report.php" <?php if (basename($_SERVER['PHP_SELF']) == 'monthly_doctor_report.php') echo 'class="active"'; ?>>Monthly
        Doctor Report</a>
    <a href="disease_wise_registration.php" <?php if (basename($_SERVER['PHP_SELF']) == 'disease_wise_registration.php') echo 'class="active"'; ?>>Disease
        Registration</a>
    <a href="logout.php" <?php if (basename($_SERVER['PHP_SELF']) == 'logout.php') echo 'class="active"'; ?>>Logout</a>
</div>

<!-- Page content -->
<div class="content">
    <h1 style="font-size: 40px; color: darkblue;">Remove Doctor</h1>
    <form id="removeDoctorForm" action="process_remove_doctor.php" method="POST" onsubmit="return submitForm()">
        <table>
            <tr>
                <td><label for="doctor_id">Doctor ID:</label></td>
                <td><input type="text" id="doctor_id" name="doctor_id" required></td>
            </tr>
            <tr>
                <td><label for="doctor_id_confirm">Confirm Doctor ID:</label></td>
                <td><input type="text" id="doctor_id_confirm" name="doctor_id_confirm" required></td>
            </tr>
            <tr>
                <td><label for="username_confirm">Username:</label></td>
                <td><input type="text" id="username_confirm" name="username_confirm" required></td>
            </tr>
            <tr>
                <td><label for="username_confirm_2">Confirm Username:</label></td>
                <td><input type="text" id="username_confirm_2" name="username_confirm_2" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><button type="submit">Remove Doctor</button></td>
            </tr>
        </table>
    </form>
</div>

<script>
    function submitForm() {
        // Alert should be shown before form submission
        alert("De-registration successful! ");
        return true; // Allow form submission to proceed
    }
</script>

</body>
</html>
