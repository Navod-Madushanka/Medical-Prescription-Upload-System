<?php 

// requiring files
require_once('MySQL.php');

$postData = file_get_contents("php://input");
$updateData = json_decode($postData, true);

$action = $updateData["action"];
$prescriptionId = $updateData["prescription"];

$quary = "UPDATE prescription SET status_id = '$action' WHERE id = '$prescriptionId'";
MySQL::iud($quary);

$message['message'] = "Notified the pharmacy Successfully";

header('Content-Type: application/json');
echo json_encode($message);

?>