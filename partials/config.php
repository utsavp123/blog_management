<?php
// Database configuration
$host = "localhost";        // Change this to your database host
$username = "root";    // Change this to your database username
$password = "";    // Change this to your database password
$dbname = "blog_management";      // Change this to your database name

// Create a database connection using MySQLi
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set the default timezone (optional)
date_default_timezone_set('UTC');
