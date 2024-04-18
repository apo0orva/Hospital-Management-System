<!-- For DB connection -->
<?php
// Define database credentials as variables
global $conn,$servername,$dbname,$username,$password;
$servername = 'localhost';
$password = 'pass123';
$dbname = 'hospital';
$username = 'apo0orva';
$conn = new mysqli($servername, $username, $password, $dbname);
?>