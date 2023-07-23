<?php
// login.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'partials/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user credentials from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user credentials and check against the database
    // Here, you should use secure password hashing and validation. 
    // For simplicity, we'll use plaintext password matching (not recommended for production).

    // Establish a connection to the database (replace 'your_db_host', 'your_db_user', 'your_db_password', and 'your_db_name' with your actual database credentials)

    
    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query to retrieve user data based on email
    $stmt = $conn->prepare("SELECT user_id, name, email, password, user_type FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($user_id, $name, $db_email, $db_password, $user_type);

    // Fetch the result (assuming email is unique)
    if ($stmt->fetch()) {
        // Verify the password
        $enteredPassword = $_POST['password'];

        if (password_verify($enteredPassword, $db_password)) {
            // Password matches, store user data in session and redirect to the appropriate dashboard
            $_SESSION['user_id'] = $user_id;
            $_SESSION['name'] = $name;
            $_SESSION['user_type'] = $user_type;

            if ($user_type === 'admin') {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: client_dashboard.php');
            }
            exit; // Important! Make sure to add an exit statement after the header to prevent further execution of the script
        } else {
            // Incorrect password, display an error message
            echo "Invalid email or password. Please try again.";
        }
    } else {
        // User not found, display an error message
        echo "Invalid email or password. Please try again.";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    <p>No have an account? <a href="register">Register</a></p>

    </form>
</body>
</html>
