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
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<?php include 'header.php'; ?>

<!-- Sidebar -->
<div class="sidebar">
    <a href="register_patient.php" <?php if (basename($_SERVER['PHP_SELF']) == 'register_patient.php') echo 'class="active"'; ?>>Register
        Patient</a>
    <a href="search_patient.php" <?php if (basename($_SERVER['PHP_SELF']) == 'search_patient.php') echo 'class="active"'; ?>>Search
        Patient</a>
    <a href="check_appointment.php" <?php if (basename($_SERVER['PHP_SELF']) == 'check_appointment.php') echo 'class="active"'; ?>>Check
        Appointments</a>
    <a href="logout.php" <?php if (basename($_SERVER['PHP_SELF']) == 'logout.php') echo 'class="active"'; ?>>Logout</a>
</div>

<!-- Page content -->
<div class="content">
    <h1 style="font-size: 40px; color: darkblue;">Check Appointments</h1>
    <!-- Form to accept patient ID -->
    <form action="process_check_appointments.php" method="post">
        <table>
            <tr>
                <td><label for="patient_id">Enter Patient ID:</label></td>
                <td><input type="text" id="patient_id" name="patient_id"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><button type="submit">Search</button></td>
            </tr>
        </table>
    </form>


    <!-- Section to display appointment details -->
    <div id="appointment_details" style="margin-top: 20px;">

    </div>

</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector("form").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent default form submission
            var form = this;
            var formData = new FormData(form); // Get form data
            formData.append('ajax', true); // Add a flag to indicate AJAX request

            // Send AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open(form.method, form.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    // Update result div with response
                    document.getElementById("appointment_details").innerHTML = xhr.responseText;
                } else {
                    console.error("Request failed: " + xhr.status);
                }
            };
            xhr.onerror = function() {
                console.error("Request failed");
            };
            xhr.send(formData);
        });
    });
</script>

