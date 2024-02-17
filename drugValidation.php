<?php 

// requiring files
require_once('sanitizer.php');

// accessing json data
$postData = file_get_contents("php://input");
$drugData = json_decode($postData, true);

$drug = Sanitizer::sanitizeInput($drugData['drug']);
$qty = Sanitizer::sanitizeInput($drugData['qty']);
$price = Sanitizer::sanitizeInput($drugData['price']);

// array to store validation errors
$errors = array();

// Validate drug name
if (empty($drug)) {
    $errors['drug'] = 'Drug name is required.';
}

// Validate quantity
if (!is_numeric($qty) || $qty <= 0) {
    $errors['qty'] = 'Quantity must be a positive number.';
}

// Validate price
if (!is_numeric($price) || $price <= 0) {
    $errors['price'] = 'Price must be a positive number.';
}

// Data contains validation result
header('Content-Type: application/json');
echo json_encode($errors);

?>