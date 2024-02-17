<?php
// requiring files
require_once('sanitizer.php');
require_once('encryption.php');
require_once('MySQL.php');

// accessing json data
$postData = file_get_contents("php://input");
$registrationData = json_decode($postData, true);


// accessing user data and sanitizing
$name = Sanitizer::sanitizeInput($registrationData['name']);
$email = Sanitizer::sanitizeInput($registrationData['email']);
$address = Sanitizer::sanitizeInput($registrationData['address']);
$contact = Sanitizer::sanitizeInput($registrationData['contact']);
$dob = Sanitizer::sanitizeInput($registrationData['dob']);
$password = Sanitizer::sanitizeInput($registrationData['password']);

// validations
$errors = array();

if(empty($name)){
    $errors['name'] = "Name is required";
}elseif(!preg_match("/^[a-zA-Z ]*$/", $name)){
    $errors['name'] = "Only letters and white space allowed";
}

if (empty($email)) {
    $errors['email'] = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format";
}

if (empty($address)) {
    $errors['address'] = "Address is required";
}

if (empty($contact)) {
    $errors['contact'] = "Contact number is required";
} elseif (!preg_match("/^[0-9]*$/", $contact)) {
    $errors['contact'] = "Only numbers allowed";
}

if (empty($dob)) {
    $errors['dob'] = "Date of Birth is required";
}

if (empty($password)) {
    $errors['password'] = "Password is required";
} elseif (strlen($password) < 8) {
    $errors['password'] = "Password must be at least 8 characters long";
}


// error handling and user registration
if (empty($errors)) {
    $id = md5(uniqid());
    $newPassword = Encryption::encrypt($password);

    $query = "INSERT INTO user (`id`,`name`, `email`, `address`, `contact`, `dob`, `password`) VALUES ('$id','$name', '$email', '$address', '$contact', '$dob', '$newPassword')";
    MySQL::iud($query);

    header('Content-Type: application/json');
    echo json_encode($errors);
} else {
    header('Content-Type: application/json');
    echo json_encode($errors);
}

?>