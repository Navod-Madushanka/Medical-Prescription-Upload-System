<?php

// requiring files
require_once('MySQL.php');

$id = $_GET['id'];

$query = "SELECT `image_path` FROM `images` WHERE `prescription_id` = '$id'";
$result = MySQL::search($query);

// Check if there are any results
$imagePaths = [];

if ($result) {
    // Iterate through the result set and collect image paths
    foreach ($result as $row) {
        $imagePaths[] = $row['image_path'];
    }
}

// Encode the image paths array as JSON
$response = json_encode($imagePaths);

// Set the Content-Type header to JSON
header('Content-Type: application/json');

// Output the JSON response
echo $response;

?>