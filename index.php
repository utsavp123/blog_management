<?php
session_start();

// Include config.php and other necessary files here

// Handle routing based on the requested URL
if ($_SERVER['REQUEST_URI'] === '/login') {
    require 'client/controllers/AuthController.php';
    $authController = new AuthController();
    $authController->showLoginForm();
} elseif ($_SERVER['REQUEST_URI'] === '/register') {
    require 'client/controllers/AuthController.php';
    $authController = new AuthController();
    $authController->showRegistrationForm();
} elseif ($_SERVER['REQUEST_URI'] === '/dashboard') {
    require 'client/controllers/ClientController.php';
    $clientController = new ClientController();
    $clientController->dashboard();
} elseif ($_SERVER['REQUEST_URI'] === '/admin') {
    require 'admin/index.php'; // Handle admin dashboard here
} else {
    // Handle 404 page not found
    http_response_code(404);
    echo "Page not found.";
}
