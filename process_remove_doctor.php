<?php
// Check if all form inputs are set
if(isset($_POST['doctor_id'], $_POST['doctor_id_confirm'], $_POST['username_confirm'], $_POST['username_confirm_2'])) {
    // Retrieve form inputs
    $doctor_id = $_POST['doctor_id'];
    $doctor_id_confirm = $_POST['doctor_id_confirm'];
    $username_confirm = $_POST['username_confirm'];
    $username_confirm_2 = $_POST['username_confirm_2'];

    // Check if inputs match and confirmed
    if($doctor_id === $doctor_id_confirm && $username_confirm === $username_confirm_2) {
        // Inputs match and confirmed, proceed with removing doctor's access

        // Include database connection
        require "db_connection.php"; // Adjust path as per your file structure

        // Prepare and execute SQL query to delete doctor's access from login table
        $sql = "DELETE FROM login WHERE id = ? AND username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $doctor_id, $username_confirm);

        if($stmt->execute()) {
            // Doctor's access removed successfully

            // Redirect back to remove_doctor.php with success parameter
            header("Location: remove_doctor.php?success=1");
            exit();
        } else {
            // Error in executing SQL query
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close prepared statement
        $stmt->close();

        // Close database connection
        $conn->close();
    } else {
        // Inputs do not match or not confirmed
        echo "Inputs do not match or not confirmed. Please try again.";
    }
} else {
    // Not all form inputs are set
    echo "All form inputs are required.";
}
?>
