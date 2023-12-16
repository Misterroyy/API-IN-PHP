<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'function.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "GET") {
    // Assuming $conn is your database connection
    $customerList = new CustomerList($conn);
    $data = $customerList->get();

    echo json_encode($data);
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod.' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>


 