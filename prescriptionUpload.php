<?php
session_start();

// requiring files
require_once('sanitizer.php');
require_once('encryption.php');
require_once('MySQL.php');

// Accessing other prescription details
$note = Sanitizer::sanitizeInput($_POST['note']);
$qty = Sanitizer::sanitizeInput($_POST['qty']);
$deliveryAddress = Sanitizer::sanitizeInput($_POST['deliveryAddress']);

// Validation
$errors = array();

if (strlen($note) > 255) {
    $errors['note'] = "Character count exceed.";
}

if (!is_numeric($qty) || $qty < 1) {
    $errors['qty'] = 'Quantity must be a positive integer';
}
if (strlen($deliveryAddress) < 5 || strlen($deliveryAddress) > 255) {
    $errors['deliveryAddress'] = 'Delivery address must be between 5 and 255 characters';
}

function dateCalculator(){
    $currentDateTime = new DateTime('now', new DateTimeZone("Asia/Colombo"));
    $currentDateTime->modify('+2 hours');
    $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
    return $formattedDateTime;
}

function uploadImages($prescriptionId) {
    $error = false;
    $uploadDir = "prescriptionImages/{$prescriptionId}/";

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Accessing uploaded files
    foreach ($_FILES as $inputName => $fileData) {
        if ($fileData['error'] === UPLOAD_ERR_OK) {
            $tempFilePath = $fileData['tmp_name'];
            // Generate a unique filename with a prefix
            $uniqueFilename = uniqid() . '_' . basename($fileData['name']);
            $destination = $uploadDir . $uniqueFilename;
            // Move the file to the target directory
            if (move_uploaded_file($tempFilePath, $destination)) {
                // Insert the file path into the database
                $query = "INSERT INTO images (`prescription_id`, `image_path`) VALUES ('$prescriptionId', '$destination')";
                MySQL::iud($query);
            } else {
                $error = true;
            }
        } else {
            echo "Error uploading file $inputName.";
            $error = true;
        }
    }

    return $error;
}

// error handling and prescription Uploading
if (empty($errors)) {

    $id = md5(uniqid());
    $userId = $_SESSION['userId'];
    $deliveryTime = dateCalculator();

    $query = "INSERT INTO prescription (`id`, `user_id`, `Note`, `delivery_address`, `delivery_time`, `qty`) 
    VALUES ('$id', '$userId', '$note', '$deliveryAddress', '$deliveryTime', $qty)";

    MySQL::iud($query);

    if(uploadImages($id)){
        $errors['image_uplead_error'] = 'Image Uploading Failed';
    }

    header('Content-Type: application/json');
    echo json_encode($errors);
} else {
    header('Content-Type: application/json');
    echo json_encode($errors);
}


?>