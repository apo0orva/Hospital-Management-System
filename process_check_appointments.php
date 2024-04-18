<?php
// Include the database connection file
require_once "db_connection.php";

// Start the session
session_start();

// Check if the request is made using AJAX
if(isset($_POST['ajax'])) {
    // Get patient ID from session or wherever it's stored
    $patient_id = isset($_POST["patient_id"]) ? $_POST["patient_id"] : null;

    // Initialize variable to store result
    $output = "";

    // Check if patient ID is set and not null and is an integer
    if ($patient_id !== null && ctype_digit($patient_id)) {
        $output .= "Received Patient ID: " . $patient_id . "<br>";

        // Proceed with the query
        $sql = "SELECT * FROM patient WHERE pid = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            $output .= "Prepare statement error: " . $conn->error;
        } else {
            $stmt->bind_param("i", $patient_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if (!$result) {
                $output .= "Execute statement error: " . $stmt->error;
            } else {
                if ($result->num_rows > 0) {
                    // Patient exists, search for appointments
                    $appointmentTable = "d_pat_" . $patient_id;
                    $sql = "SELECT appointment_date FROM $appointmentTable ORDER BY appointment_date DESC LIMIT 1";
                    $appointmentResult = $conn->query($sql);

                    if (!$appointmentResult) {
                        $output .= "Appointment query error: " . $conn->error;
                    } else {
                        if ($appointmentResult->num_rows > 0) {
                            // Retrieve the recent appointment date
                            $row = $appointmentResult->fetch_assoc();
                            $recentAppointment = $row["appointment_date"];
                            $output .= "Recent Appointment Date: " . $recentAppointment;
                        } else {
                            $output .= "No appointments found for the patient.";
                        }
                    }
                } else {
                    $output .= "Patient ID not found.";
                }
            }
        }

        // Close database connection
        $stmt->close();
        $conn->close();

        // Output the result
        echo $output;
    } else {
        // Output message for invalid input
        echo "Invalid Patient ID.";
    }
}
?>
