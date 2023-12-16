<?php 
header("Access-Control-Allow-Origin: *");
$requestMethod = $_SERVER["REQUEST_METHOD"];
require 'function.php'; 

if($requestMethod == "GET"){
    $id = $_GET['id'];

    if (empty($id)) {
        // Return an error message
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array("message" => "Please enter product ID"));
        exit(); // Stop the script
    }

    $product = getProductById($id);
    echo $product;
}
else{
   $data = [
    'status' => 405,
    'message' => $requestMethod.' Method Not Allowed',
   ];
  header("HTTP/1.0 405 Method Not Allowed");
  echo json_encode($data);
}

?>
 