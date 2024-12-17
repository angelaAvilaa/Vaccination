<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'twilio-php-main\src\Twilio\autoload.php';

    $sid = "*****"; // Your Account SID
    $token = "*******"; // Your Auth Token
    $client = new Twilio\Rest\Client($sid, $token);

    $to = $_POST['to'];
    $message = $_POST['message'];

    try {
        $client->messages->create(
            $to, // Recipient's phone number
            [
                'from' => '*****', // Twilio phone number
                'body' => $message
            ]
        );
        echo json_encode(["status" => "success"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
?>