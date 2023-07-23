<?php
class AuthController
{
    public function showLoginForm()
    {
        // Include the login view from the client folder
        include 'client/views/login.php';
    }

    public function showRegistrationForm()
    {
        // Include the registration view from the client folder
        include 'client/views/register.php';
    }

    // Implement login and registration logic here
}
