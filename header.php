<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <style>
        /* Set margin and padding of the body to zero */
        body {
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex;
            align-items: center; /* Center items vertically */
            padding: 10px;
        }

        .navbar h1 {
            margin: 0;
            padding: 10px;
            color: white;
            font-size: 28px;
        }

        .navbar img {
            height: 70px; /* Resize the logo to fit the height of the header */
            margin-right: 10px; /* Adjust the spacing between logo and text */
        }

        .logo-container {
            display: flex;
            align-items: center; /* Align items vertically */
        }

        .username {
            color: white;
            margin-left: auto; /* Push the username to the right */
            padding: 0 20px;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div class="logo-container">
        <img src="logo.png" alt="Logo">
        <h1>HOSPITAL MANAGEMENT SYSTEM</h1>
    </div>
    <?php
    // Display username if logged in and not on login/index page
    if(isset($_SESSION['login_username']) && basename($_SERVER['PHP_SELF']) != 'index.php') {
        echo "<div class='username'>Welcome, {$_SESSION['login_username']}!</div>";
    }
    ?>
</div>
</body>
</html>
