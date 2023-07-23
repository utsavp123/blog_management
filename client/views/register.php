<!-- register.php -->
<?php
include_once 'partials/config.php';
// Check if the registration form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Create the SQL query to insert the user data
    $sql = "INSERT INTO users (name, email, password, user_type) VALUES ('$name', '$email', '$hashedPassword', 'client')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header('Location: login');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>
<body>
    <h2>Register</h2>
    <?php
    if (isset($error_message)) {
        echo '<p style="color: red;">' . $error_message . '</p>';
    }
    ?>
    <form action="register" method="post">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
    <p>Already have an account? <a href="login">Login</a></p>
</body>
</html>
