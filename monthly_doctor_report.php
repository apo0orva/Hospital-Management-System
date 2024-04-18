<?php
// Include the database connection file
require_once "db_connection.php";

// Start the session
session_start();

// Initialize variables
$doctor_id = "";
$report_data = array();
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get doctor ID from the form
    $doctor_id = $_POST["doctor_id"];

    // Query to fetch report data
    $sql = "SELECT pid, disease, admitted, status FROM d_patient NATURAL JOIN doctor WHERE did=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch result rows as an associative array
    while ($row = $result->fetch_assoc()) {
        $report_data[] = $row;
    }
    $stmt->close();

    // Set message if no data is available
    if (empty($report_data)) {
        $message = "No data available at the moment.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Management - HMS</title>
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

        /* Style for table */
        table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Style for fixed height and scroll bar */
        .fixed-height-table {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<?php require 'header.php'; ?>

<!-- Sidebar -->
<div class="sidebar">
    <a href="register_doctor.php" <?php if (basename($_SERVER['PHP_SELF']) == 'register_doctor.php') echo 'class="active"'; ?>>Register
        Doctor</a>
    <a href="remove_doctor.php" <?php if (basename($_SERVER['PHP_SELF']) == 'remove_doctor.php') echo 'class="active"'; ?>>Remove
        Doctor</a>
    <a href="monthly_doctor_report.php" <?php if (basename($_SERVER['PHP_SELF']) == 'monthly_doctor_report.php') echo 'class="active"'; ?>>Monthly
        Doctor Report</a>
    <a href="disease_wise_registration.php" <?php if (basename($_SERVER['PHP_SELF']) == 'disease_wise_registration.php') echo 'class="active"'; ?>>Disease
        Registration</a>
    <a href="logout.php" <?php if (basename($_SERVER['PHP_SELF']) == 'logout.php') echo 'class="active"'; ?>>Logout</a>
</div>

<!-- Page content -->
<div class="content">
    <h1 style="font-size: 40px; color: darkblue;">MANAGEMENT</h1>
    <!-- Form to enter doctor ID -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="doctor_id">Enter Doctor ID:</label><br>
        <input type="text" id="doctor_id" name="doctor_id" value="<?php echo $doctor_id; ?>"><br><br>
        <!-- Center align the submit button -->
        <button type="submit">Get Report</button>
    </form>

    <!-- Display report in table format with fixed height and scroll bar -->
    <?php if (!empty($report_data)) : ?>
        <h2>Doctor Report</h2>
        <div class="fixed-height-table">
            <table>
                <tr>
                    <th>Patient ID</th>
                    <th>Disease</th>
                    <th>Admitted?</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($report_data as $row) : ?>
                    <tr>
                        <td><?php echo $row['pid']; ?></td>
                        <td><?php echo $row['disease']; ?></td>
                        <td><?php echo $row['admitted']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php elseif (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
</div>

</body>
</html>
