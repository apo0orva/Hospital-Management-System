<?php
// Check if form values are received
if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['gender']) && isset($_POST['blood_group']) && isset($_POST['city'])) {
    // Extract form values
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $city = $_POST['city'];

    // Include database connection
    require_once "db_connection.php";

    // Generate patient ID
    $query = "SELECT MAX(pid) AS max_pid FROM patient";
    $result = mysqli_query($conn, $query);
    if($result) {
        $row = mysqli_fetch_assoc($result);
        $next_pid = $row['max_pid'] + 1;
    } else {
        // Error in fetching max pid
        die("Error: " . mysqli_error($conn));
    }

    // Concatenate first name and last name to form patient name
    $pname = $first_name . ' ' . $last_name;

    // Get the current date and time
    $reg_pat_date = date('Y-m-d H:i:s');

    // Insert data into patient table
    $insert_query = "INSERT INTO patient (pid, pname, gender, address, blood_group, reg_pat_date) 
                     VALUES ('$next_pid', '$pname', '$gender', '$city', '$blood_group', '$reg_pat_date')";
    $insert_result = mysqli_query($conn, $insert_query);
    if($insert_result) {
        // Construct the content for the text file
        $content = "Patient ID: $next_pid\n";
        $content .= "Name: $pname\n";
        $content .= "Gender: $gender\n";
        $content .= "Blood Group: $blood_group\n";
        $content .= "City: $city\n";
        $content .= "Registration Date: $reg_pat_date\n";

        // Set the file name
        $file_name = "patient_details_$next_pid.txt";

        // Set headers for file download
        header('Content-Type: text/plain');
        header("Content-Disposition: attachment; filename=\"$file_name\"");

        // Output the content to the file
        echo $content;

        // Create table for the patient
        $table_name = "d_pat_$next_pid";
        $create_table_query = "CREATE TABLE IF NOT EXISTS $table_name (
            entry_dates DATETIME,
            symptoms VARCHAR(100),
            disease VARCHAR(50),
            diagnosis VARCHAR(100),
            medicines VARCHAR(100),
            admitted CHAR(1),
            admit_date DATETIME,
            discharge_date DATETIME,
            appointment_date DATETIME,
            CHECK (admitted IN ('y','Y','n','N'))
        )";
        $create_table_result = mysqli_query($conn, $create_table_query);
        if(!$create_table_result) {
            // Error in creating table
            die("Error: " . mysqli_error($conn));
        }

        // Exit the script
        exit();
    } else {
        // Error in inserting data
        die("Error: " . mysqli_error($conn));
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Redirect to registration page if form values are not received
    header("Location: register_patient.php");
    exit();
}
?>
