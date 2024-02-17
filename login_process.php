<?php

// requiring files
require_once('sanitizer.php');
require_once('encryption.php');
require_once('MySQL.php');

// accessing json data
$postData = file_get_contents("php://input");
$loginData = json_decode($postData, true);

// Accessing user data and sannitizing
$email = Sanitizer::sanitizeInput($loginData["email"]);
$password = Sanitizer::sanitizeInput($loginData["password"]);

// validations
$errors = array();

if (empty($email)) {
    $errors['email'] = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format";
}

if (empty($password)) {
    $errors['password'] = "Password is required";
} elseif (strlen($password) < 8) {
    $errors['password'] = "Password must be at least 8 characters long";
}

// error handling and user registration
if (empty($errors)) {

    $newPassword = Encryption::encrypt($password);

    $query = "SELECT * FROM user WHERE `email` = '$email' AND `password` = '$newPassword'";
    $result = MySQL::search($query);

    if($result->num_rows == 1) {
        // session creation
        $row = $result->fetch_assoc();
        $userId = $row["id"];

        session_start();
        $_SESSION['userId'] = $userId;

    }else{
        $errors['login'] = "Invalid login details!";
    }

    header('Content-Type: application/json');
    echo json_encode($errors);
} else {
    header('Content-Type: application/json');
    echo json_encode($errors);
}
?>