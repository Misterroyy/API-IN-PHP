<?php
header("Access-Control-Allow-Origin: *");
$requestMethod = $_SERVER["REQUEST_METHOD"];
require 'function.php'; 

if($requestMethod == "POST"){
    $id = $_POST['id'];
    $data = array(
        'category_id' => $_POST['category_id'],
        'name' => $_POST['name'],
        'small_description' => $_POST['small_description'],
        'long_description' => $_POST['long_description'],
        'price' => $_POST['price'],
        'offerprice' => $_POST['offerprice'],
        'tax' => $_POST['tax'],
        'qty' => $_POST['qty'],
        'image' => $_POST['image'],
        'status' => $_POST['status']
    );

    if (empty($id)) {
        // Return an error message
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array("message" => "Please enter product ID"));
        exit(); // Stop the script
    }

    $product = updateProduct($id, $data);
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