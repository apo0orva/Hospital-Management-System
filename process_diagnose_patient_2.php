<?php
// Start the session
session_start();

// Include database connection configuration
require_once "db_connection.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables to store form data
    $symptoms = $_POST["symptoms"];
    $disease = $_POST["disease"];
    $diagnosis = $_POST["diagnosis"];
    $medicines = $_POST["medicines"];
    $admit_date = $_POST["admit_date"];
    $discharge_date = $_POST["discharge_date"];
    $appointment_date = $_POST["appointment_date"];
    $status = $_POST["status"];

    // Get patient ID from session or wherever it's stored
    $patient_id = isset($_SESSION["patient_id"]) ? $_SESSION["patient_id"] : null;

    // Access doctor ID from session
    $doctor_id = isset($_SESSION['doctor_id']) ? $_SESSION['doctor_id'] : null;

    if ($patient_id && $doctor_id) {
        // Initialize variable to store the query
        $query = "";

        // Check conditions
        if (($status === 'C' && !empty($admit_date) && !empty($appointment_date)) ||
            (!empty($admit_date) && empty($discharge_date) && $status === 'I') ||
            (!empty($discharge_date) && $status === 'C') ||
            (empty($admit_date) && empty($discharge_date) && empty($appointment_date) && $status === 'C')) {

            // Convert date values to SQL format or set to NULL if empty
            $admit_date_sql = !empty($admit_date) ? "'" . date('Y-m-d H:i:s', strtotime($admit_date)) . "'" : "NULL";
            $discharge_date_sql = !empty($discharge_date) ? "'" . date('Y-m-d H:i:s', strtotime($discharge_date)) . "'" : "NULL";
            $appointment_date_sql = !empty($appointment_date) ? "'" . date('Y-m-d H:i:s', strtotime($appointment_date)) . "'" : "NULL";

            // Set admitted to 'Y' if admit date is given, otherwise 'N'
            $admitted = !empty($admit_date) ? 'Y' : 'N';

            // Construct the table name with patient ID
            $table_name = "d_pat_" . $patient_id;

            // Construct the query
            $query = "INSERT INTO $table_name (entry_dates, symptoms, disease, diagnosis, medicines, admitted, admit_date, discharge_date, appointment_date) VALUES (CURRENT_TIMESTAMP, '$symptoms', '$disease', '$diagnosis', '$medicines', '$admitted', $admit_date_sql, $discharge_date_sql, $appointment_date_sql);";

            // Execute the query
            if ($conn->query($query) === TRUE) {
                $_SESSION['diagnosis_success'] = "Diagnosis recorded successfully.";
            } else {
                $_SESSION['diagnosis_error'] = "Error: " . $conn->error;
            }

            // Insert record into d_patient table
            $insert_patient_query = "INSERT INTO d_patient (pid, did, disease, admitted, status) VALUES ('$patient_id', '$doctor_id', '$disease', '$admitted', '$status')";
            if ($conn->query($insert_patient_query) === TRUE) {
                $_SESSION['diagnosis_success'] .= " Patient record updated successfully.";
            } else {
                $_SESSION['diagnosis_error'] .= " Error updating patient record: " . $conn->error;
            }
        } else {
            $_SESSION['diagnosis_error'] = "Conditions for data entry not met.";
        }

        // Redirect back to diagnose_patient.php after processing
        header("Location: diagnose_patient.php");
        exit; // Stop further execution
    } else {
        $_SESSION['diagnosis_error'] = "Patient ID or Doctor ID not found.";
        // Redirect back to diagnose_patient.php
        header("Location: diagnose_patient.php");
        exit; // Stop further execution
    }
} else {
    // If the form was not submitted via POST, redirect back to diagnose_patient.php
    header("Location: diagnose_patient.php");
    exit; // Stop further execution
}

// Close connection
$conn->close();
?>
