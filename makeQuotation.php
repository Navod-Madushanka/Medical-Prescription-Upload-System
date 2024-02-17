<?php
// requiring files
require_once('MySQL.php');
require_once('mail.php');

// Read the JSON data from the request body
$postData = file_get_contents("php://input");

// send Emails function
function sendingEmail($prescrption){
    $useremailQuary = "SELECT user.email FROM user INNER JOIN prescription ON user.id = prescription.user_id WHERE prescription.id = '$prescrption'";
    $result = MySQL::search($useremailQuary);
    if($result && $result->num_rows == 1){
        $row = $result->fetch_assoc();
        $email = $row["email"];

        $toEmail = $email;
        $subject = 'Your Quotation';
        $body = 'Your Quotation is ready. Please check our website for details.';
        
        sendEmail($toEmail, $subject, $body);
    }
}

// Check if data was received
if ($postData !== false) {
    // Parse the JSON data into a PHP array
    $quotationData = json_decode($postData, true);

    // Check if JSON data was successfully parsed
    if ($quotationData !== null) {

        $id = md5(uniqid());
        $prescriptionId = $quotationData['id'];

        $quotationQuary = "INSERT INTO `quotation` (`id`, `prescription_id`) VALUES ('$id', '$prescriptionId')";
        MySQL::iud($quotationQuary);
        // Process the data as needed
        foreach ($quotationData['data'] as $row) {
            $drug = $row[0]; // Drug name
            $quantity = $row[1]; // Quantity
            $price = $row[2]; // Price
            
            $drugQuary = "INSERT INTO `drug` (`quotation_id`, `name`, `qty`, `price`) VALUES('$id', '$drug', '$quantity','$price')";
            MySQL::iud($drugQuary);
        }
        // call sendingEmail function
        sendingEmail($prescriptionId);

        // Send a response
        $response = ['success' => true, 'message' => 'Data successfully'];
        echo json_encode($response);
    } else {
        // JSON data could not be parsed
        $response = ['success' => false, 'message' => 'Failed to parse JSON data'];
        echo json_encode($response);
    }
} else {
    // No data received
    $response = ['success' => false, 'message' => 'No data received'];
    echo json_encode($response);
}
?>