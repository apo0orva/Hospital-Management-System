<?php
// Check if at least one input is provided
if(isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['gender'])) {
    // Extract form values
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];

    // Include database connection
    require_once "db_connection.php";

    // Construct the query based on provided inputs
    $query = "SELECT * FROM patient WHERE ";
    $conditions = array();
    if(!empty($first_name)) {
        $conditions[] = "pname LIKE '%$first_name%'";
    }
    if(!empty($last_name)) {
        $conditions[] = "pname LIKE '%$last_name%'";
    }
    if(!empty($gender)) {
        $conditions[] = "gender = '$gender'";
    }
    $where_clause = implode(" AND ", $conditions);
    $query .= $where_clause;

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if any results are found
    if(mysqli_num_rows($result) > 0) {
        // Display patient details in a table with adjusted column widths
        echo "<table style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid #dddddd; padding: 8px; width: 10%'>Patient ID</th><th style='border: 1px solid #dddddd; padding: 8px;'>Name</th><th style='border: 1px solid #dddddd; padding: 8px; width: 5%;'>Gender</th><th style='border: 1px solid #dddddd; padding: 8px;'>Address</th><th style='border: 1px solid #dddddd; padding: 8px; width: 80px;'>Blood Group</th><th style='border: 1px solid #dddddd; padding: 8px; width: 120px;'>Registration Date</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>".$row['pid']."</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>".$row['pname']."</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>".$row['gender']."</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>".$row['address']."</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>".$row['blood_group']."</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>".$row['reg_pat_date']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // No results found
        echo "<p>No results found.</p>";
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Redirect to search page if no inputs are provided
    header("Location: search_patient.php");
    exit();
}
?>
