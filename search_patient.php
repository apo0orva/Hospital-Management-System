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
            margin: 0;
            padding: 0;
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

        /* Style for search results frame */
        #searchResultsFrame {
            border: 1px solid #dddddd;
            height: 300px;
            width: 75%; /* Set your desired width */
            overflow-y: auto;
            margin-top: 20px;
            margin-left: calc(15% + 100px); /* Adjust the value accordingly */
            margin-right: auto;
        }

        /* Style for search results */
        #searchResults {
            padding: 8px;
        }

    </style>
</head>
<body>

<!-- Navbar -->
<?php include 'header.php'; ?>

<!-- Sidebar -->
<div class="sidebar">
    <a href="register_patient.php" <?php if(basename($_SERVER['PHP_SELF']) == 'register_patient.php') echo 'class="active"'; ?>>Register Patient</a>
    <a href="search_patient.php" <?php if(basename($_SERVER['PHP_SELF']) == 'search_patient.php') echo 'class="active"'; ?>>Search Patient</a>
    <a href="check_appointment.php" <?php if(basename($_SERVER['PHP_SELF']) == 'check_appointment.php') echo 'class="active"'; ?>>Check Appointments</a>
    <a href="logout.php" <?php if(basename($_SERVER['PHP_SELF']) == 'logout.php') echo 'class="active"'; ?>>Logout</a>
</div>

<div class="content">
    <h1 style="font-size: 40px; color: darkblue;">Search Patient</h1>
    <form id="searchForm" method="POST">
        <table style="border-collapse: collapse; width: 100%;">
            <tr style="background-color: #f2f2f2;">
                <td style="border: 1px solid #dddddd; padding: 8px; width: 50%;"><label for="first_name">First Name:</label></td>
                <td style="border: 1px solid #dddddd; padding: 8px; width: 50%;"><input type="text" id="first_name" name="first_name"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #dddddd; padding: 8px; width: 50%;"><label for="last_name">Last Name:</label></td>
                <td style="border: 1px solid #dddddd; padding: 8px; width: 50%;"><input type="text" id="last_name" name="last_name"></td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <td style="border: 1px solid #dddddd; padding: 8px; width: 50%;"><label for="gender">Gender:</label></td>
                <td style="border: 1px solid #dddddd; padding: 8px; width: 50%;">
                    <select id="gender" name="gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="O">Other</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><button type="button" onclick="searchPatients()">Search</button></td>
            </tr>
        </table>
    </form>
</div>

<div id="searchResultsFrame">
    <div id="searchResults"></div>
</div>

<script>
    function searchPatients() {
        // Get form values
        var firstName = document.getElementById("first_name").value;
        var lastName = document.getElementById("last_name").value;
        var gender = document.getElementById("gender").value;

        // Prepare data to send
        var formData = new FormData();
        formData.append('first_name', firstName);
        formData.append('last_name', lastName);
        formData.append('gender', gender);

        // Send AJAX request to process_search_patient.php
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process_search_patient.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Update the content of the specified div with the response
                document.getElementById("searchResults").innerHTML = xhr.responseText;
            }
        };
        xhr.send(formData);
    }
</script>


</body>
</html>
