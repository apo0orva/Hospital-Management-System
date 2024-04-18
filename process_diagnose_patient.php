<?php
// Start the session
session_start();

// Include database connection configuration
require_once "db_connection.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the patient ID
    $patient_id = $_POST["patient_id"];

    // Prepare and execute query to fetch patient details
    $sql = "SELECT * FROM patient WHERE pid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if patient exists
    if ($result->num_rows > 0) {
        // Patient found, set the flag to true
        $patient_found = true;

        // Fetch patient details
        $row = $result->fetch_assoc();

        // Generate patient details markup
        $patient_details = "<h2>Patient Details</h2>";
        $patient_details .= "<table>";
        foreach ($row as $key => $value) {
            $patient_details .= "<tr><td><strong>" . ucwords(str_replace("_", " ", $key)) . ":</strong></td><td>$value</td></tr>";
        }
        $patient_details .= "</table>";

        // Store patient details in session variable
        $_SESSION['patient_details'] = $patient_details;

        // Save patient ID in session
        $_SESSION['patient_id'] = $patient_id;

        // Redirect to the diagnosis form
        header("Location: process_diagnose_patient_2.php");
        exit();
    } else {
        // If patient not found, set session variable
        $_SESSION['no_patient_found'] = true;
    }
}

// Close statement
$stmt->close();

// Close connection
$conn->close();

// Redirect back to diagnose_patient.php after processing
header("Location: diagnose_patient.php");

// Display alert message if no patient found
if (isset($_SESSION['no_patient_found']) && $_SESSION['no_patient_found']) {
    echo "<script>alert('No patient found.');</script>";
    unset($_SESSION['no_patient_found']); // Clear the session variable after displaying the message
}

exit;
?>
