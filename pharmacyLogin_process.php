<?php
session_start();

// requiring files
require_once('sanitizer.php');
require_once('encryption.php');

define('ACCESS_EMAIL', 'admin@gmail.com');
define('ACCESS_PASSWORD_HASH', 'c93ccd78b2076528346216b3b2f701e6');

// accessing json data
$postData = file_get_contents("php://input");
$loginData = json_decode($postData, true);

// Accessing user data and sanitizing
$email = isset($loginData["email"]) ? Sanitizer::sanitizeInput($loginData["email"]) : '';
$password = isset($loginData["password"]) ? Sanitizer::sanitizeInput($loginData["password"]) : '';

$errors = array();

// Verify login credentials
if ($email === ACCESS_EMAIL && Encryption::encrypt($password)==ACCESS_PASSWORD_HASH) {
    $_SESSION['admin'] = true;
    header('Content-Type: application/json');
    echo json_encode($errors);
} else {
    $errors['login'] = 'Invalid email or password';
    header('Content-Type: application/json');
    echo json_encode($errors);
}

?>