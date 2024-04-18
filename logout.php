<?php
require 'db_connection.php';
session_start();
session_destroy();
header("Location: index.php");
exit();
?>
