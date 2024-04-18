<?php
require "check_login_doctor.php";
// Check if diagnosis error is set
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Doctor - HMS</title>
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
            display: flex; /* Use flexbox layout */
        }

        /* Left half */
        .left-half {
            flex: 1; /* Take up half of the available space */
            padding-right: 20px; /* Add some spacing between columns */
        }

        /* Right half */
        .right-half {
            flex: 1; /* Take up half of the available space */
            display: none; /* Initially hide the right half */
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

        /* Hide alert message initially */
        .alert {
            display: none;
        }

        /* Style for error message */
        .error-message {
            color: red;
        }
    </style>

</head>
<body>

<!-- Navbar -->
<?php include 'header.php'; ?>

<!-- Sidebar -->
<div class="sidebar">
    <a href="diagnose_patient.php" <?php if(basename($_SERVER['PHP_SELF']) == 'diagnose_patient.php') echo 'class="active"'; ?>>Diagnose Patient</a>
    <a href="logout.php" <?php if(basename($_SERVER['PHP_SELF']) == 'logout.php') echo 'class="active"'; ?>>Logout</a>
</div>

<!-- Page content -->
<div class="content">
    <div class="left-half">
        <h1 style="font-size: 40px; color: darkblue;">Diagnose Patient</h1>

        <!-- Form to accept patient ID -->
        <form action="process_diagnose_patient.php" method="POST" id="patient_search_form" onsubmit="savePatientId()">
            <label for="patient_id">Enter Patient ID:</label>
            <input type="text" id="patient_id" name="patient_id" >
            <button type="submit">Search</button>
        </form>

        <!-- Placeholder for patient information -->
        <?php
        // Check if there are any patient details returned by process_diagnose_patient.php
        if(isset($_SESSION['patient_details']) && !empty($_SESSION['patient_details'])) {
            echo $_SESSION['patient_details'];
            unset($_SESSION['patient_details']); // Clear the session variable after displaying patient details
            ?>
            <!-- Display the right half (diagnosis form) after patient search -->
            <style>
                .right-half {
                    display: block !important; /* Show the right half */
                }
            </style>
            <?php
        } else {
            // Initial load or search not performed, hide the right half
            ?>
            <!-- Hide the right half if search not performed -->
            <style>
                .right-half {
                    display: none;
                }
            </style>
            <?php

            // Display alert message if no patient found
            if(isset($_SESSION['no_patient_found']) && $_SESSION['no_patient_found']) {
                ?>
                <div class="alert">
                    No patient found.
                </div>
                <?php
                unset($_SESSION['no_patient_found']); // Clear the session variable after displaying the message
            }
        }
        ?>
    </div>

    <div class="right-half">
        <br>
        <!-- Form for diagnosing patient -->
        <form action="process_diagnose_patient_2.php" method="POST" onsubmit="return validateForm()">

            <h2>Diagnosis Form</h2>
            <table>
                <tr>
                    <td><label for="symptoms">Enter symptoms of patient:</label></td>
                    <td><input type="text" id="symptoms" name="symptoms" required></td>
                </tr>
                <tr>
                    <td><label for="disease">Enter disease of patient:</label></td>
                    <td><input type="text" id="disease" name="disease" required></td>
                </tr>
                <tr>
                    <td><label for="diagnosis">Enter diagnosis done or suggested:</label></td>
                    <td><input type="text" id="diagnosis" name="diagnosis" required></td>
                </tr>
                <tr>
                    <td><label for="medicines">Enter medicines prescribed:</label></td>
                    <td><input type="text" id="medicines" name="medicines" required></td>
                </tr>
                <tr>
                    <td><label for="admit_date">Enter ADMIT date:</label></td>
                    <td><input type="date" id="admit_date" name="admit_date"></td>
                </tr>
                <tr>
                    <td><label for="discharge_date">Enter DISCHARGE date:</label></td>
                    <td><input type="date" id="discharge_date" name="discharge_date"></td>
                </tr>
                <tr>
                    <td><label for="appointment_date">Enter next APPOINTMENT date:</label></td>
                    <td><input type="date" id="appointment_date" name="appointment_date" ></td>
                </tr>
                <tr>
                    <td><label for="status">Status - Cured | Infected</label></td>
                    <td>
                        <select id="status" name="status">
                            <option value="C">Cured</option>
                            <option value="I">Infected</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <!-- Include the patient_id field as a hidden input -->
            <input type="hidden" name="patient_id" value="<?php echo isset($_POST['patient_id']) ? $_POST['patient_id'] : ''; ?>">
            <!-- Remove the admitted field from the form -->
            <input type="hidden" id="admitted" name="admitted" value="<?php echo !empty($_POST['admit_date']) ? 'Y' : 'N'; ?>">
            <button type="submit">Submit Diagnose</button>
        </form>
    </div>

</div>
<div class="error-message" id="error-message"></div>
<?php
if (isset($_SESSION['diagnosis_error'])) {
    echo "<div class='error-message'>{$_SESSION['diagnosis_error']}</div>";
    unset($_SESSION['diagnosis_error']); // Clear the error message after displaying it
}
?>

<script>
    function validateForm() {
        var admitDate = document.getElementById('admit_date').value;
        var dischargeDate = document.getElementById('discharge_date').value;
        var appointmentDate = document.getElementById('appointment_date').value;
        var status = document.getElementById('status').value;

        if (
            (status === 'C' && admitDate !== '' && appointmentDate !== '') ||
            (admitDate !== '' && dischargeDate === '' && status === 'I') ||
            (dischargeDate !== '' && status === 'C') ||
            (admitDate === '' && dischargeDate === '' && appointmentDate === '' && status === 'C')
        ) {
            // All conditions are met, form is valid
            alert('Data registered successfully.');
            return true;
        } else {
            // Display error message using alert
            alert('Invalid input. Please check Diagnose form.');
            return false; // Prevent form submission
        }
    }

</script>

</body>
</html>
