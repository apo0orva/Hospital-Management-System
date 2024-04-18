<?php
// Check if form values are received
if(isset($_POST['doctor_first_name']) && isset($_POST['doctor_last_name']) && isset($_POST['speciality']) && isset($_POST['gender'])) {
    // Extract form values
    $doctor_first_name = $_POST['doctor_first_name'];
    $doctor_last_name = $_POST['doctor_last_name'];
    $speciality = $_POST['speciality'];
    $gender = $_POST['gender'];

    // Include database connection
    require_once "db_connection.php";

    // Fetch the last 'did' doctor id from the doctor table
    $query = "SELECT MAX(did) as max_did FROM doctor";
    $result = mysqli_query($conn, $query);
    if($result) {
        $row = mysqli_fetch_assoc($result);
        $next_did = $row['max_did'] + 1;
    } else {
        // Error in fetching max did
        die("Error: " . mysqli_error($conn));
    }

    // Concatenate first name and last name to form doctor name
    $doctor_name = $doctor_first_name . ' ' . $doctor_last_name;

    // Generate a random password
    $password = generateRandomPassword();

    // Insert data into doctor table
    $insert_query = "INSERT INTO doctor (did, dname, speciality, gender) VALUES ('$next_did', '$doctor_name', '$speciality', '$gender')";
    $insert_result = mysqli_query($conn, $insert_query);
    if($insert_result) {
        // Insert data into login table
        $username = "doc_" . $next_did; // Generate a username
        $role = 3; // Set the role of the doctor to 3

        $insert_login_query = "INSERT INTO login (username, password, role, id) VALUES ('$username', '$password', '$role', '$next_did')";
        $insert_login_result = mysqli_query($conn, $insert_login_query);
        if($insert_login_result) {
            // Create and prompt download for the .txt file
            $file_name = "credentials_" . $username . ".txt";
            $file_content = "Username: " . $username . "\nPassword: " . $password;
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            echo $file_content;
            exit();
        } else {
            // Error in inserting data into login table
            die("Error: " . mysqli_error($conn));
        }
    } else {
        // Error in inserting data into doctor table
        die("Error: " . mysqli_error($conn));
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Redirect to registration page if form values are not received
    header("Location: register_doctor.php");
    exit();
}

// Function to generate a random password
function generateRandomPassword() {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = "";
    for ($i = 0; $i < 8; $i++) {
        $password .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $password;
}
?>
