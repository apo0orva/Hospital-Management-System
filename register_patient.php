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
            top:90px;
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
<?php include 'header.php'; ?>

<!-- Sidebar -->
<div class="sidebar">
    <a href="register_patient.php" <?php if(basename($_SERVER['PHP_SELF']) == 'register_patient') echo 'class="active"'; ?>>Register Patient</a>
    <a href="search_patient.php" <?php if(basename($_SERVER['PHP_SELF']) == 'search_patient.php.php') echo 'class="active"'; ?>>Search Patient</a>
    <a href="check_appointment.php" <?php if(basename($_SERVER['PHP_SELF']) == 'check_appointment.php') echo 'class="active"'; ?>>Check Appointments</a>
    <a href="logout.php" <?php if(basename($_SERVER['PHP_SELF']) == 'logout.php') echo 'class="active"'; ?>>Logout</a>
</div>

<!-- Page content -->
<div class="content">
    <h1 style="font-size: 40px; color: darkblue;">Register Patient</h1>
    <form id="registerPatientForm" action="process_register_patient.php" method="POST" onsubmit="return submitForm()">
        <table>
            <tr>
                <td><label for="first_name">First Name:</label></td>
                <td><input type="text" id="first_name" name="first_name" required></td>
            </tr>
            <tr>
                <td><label for="last_name">Last Name:</label></td>
                <td><input type="text" id="last_name" name="last_name" required></td>
            </tr>
            <tr>
                <td><label for="gender">Gender:</label></td>
                <td>
                    <select id="gender" name="gender" required>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="O">Other</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="blood_group">Blood Group:</label></td>
                <td>
                    <select id="blood_group" name="blood_group" required>
                        <option value="A+ve">A+ve</option>
                        <option value="A-ve">A-ve</option>
                        <option value="B+ve">B+ve</option>
                        <option value="B-ve">B-ve</option>
                        <option value="O+ve">O+ve</option>
                        <option value="O-ve">O-ve</option>
                        <option value="AB+ve">AB+ve</option>
                        <option value="AB-ve">AB-ve</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="city">City:</label></td>
                <td><input type="text" id="city" name="city" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><button type="submit">Register Patient</button></td>
            </tr>

        </table>
    </form>
</div>

<script>
    function submitForm() {
        var form = document.getElementById("registerPatientForm");
        form.submit();
        form.reset();
        alert("Registration successful! \nDownload starting..")
        return false; // Prevent default form submission
    }
</script>

</body>
</html>
