<?php
session_start();

// Redirect if user is already logged in
if (isset($_SESSION['login_username'])) {
    if ($_SESSION['role'] == 1) {
        header("Location: dashboard_management.php");
        exit();
    } elseif ($_SESSION['role'] == 2) {
        header("Location: dashboard_receptionist.php");
        exit();
    } elseif ($_SESSION['role'] == 3) {
        header("Location: dashboard_doctor.php");
        exit();
    }
}

// Include database credentials and establish connection
include 'db_connection.php'; // Include file containing database credentials
include 'sql_queries.php'; // Include file containing queries
$conn = new mysqli($servername, $username, $password, $dbname); // Establish connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: Incorrect DB Credentials!");
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_username = $_POST['login_username'];
    $login_password = $_POST['login_password'];

    // Check if username and password are not empty
    if (!empty($login_username) && !empty($login_password)) {
        // Define the logic for checking username and password
        $query = GET_USERNAME_PASSWORD;
        $query_ob = $conn->query($query);
        $result = $query_ob->fetch_all(MYSQLI_ASSOC);

        foreach ($result as $i) {
            if ($i["username"] == $login_username && $i["password"] == $login_password) {
                $_SESSION['login_username'] = $login_username; // Set session variable for logged-in user
                $_SESSION['role'] = $i["role"]; // Set session variable for user role
                $role = $i["role"];
                if ($role == 1) {
                    header("Location: dashboard_management.php");
                    exit();
                } elseif ($role == 2) {
                    header("Location: dashboard_receptionist.php");
                    exit();
                } elseif ($role == 3) {
                    $_SESSION['doctor_id'] = $i['id']; // Set session variable for doctor ID
                    header("Location: dashboard_doctor.php");
                    exit();
                }
            }
        }
        // If the loop completes without redirecting, it means login failed
        $error = 'Incorrect username or password. Please try again.';
    } else {
        // Display error message if username or password is empty
        $error = 'Enter both username and password.';
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - HMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>User Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="login_username">Username:</label>
        <input type="text" id="login_username" name="login_username">

        <label for="login_password">Password:</label>
        <input type="password" id="login_password" name="login_password">

        <input type="submit" value="Login">
    </form>

    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
</div>

</body>
</html>
