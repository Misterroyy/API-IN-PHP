<?php
require 'config/db-conn.php';


require_once 'config/db-conn.php';

 
class CustomerList
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function get()
    {
        // Replace this with your actual query to fetch customer data from the database
        $select = "SELECT * FROM"
        $tableName = "tableName";
        $result = mysqli_query($this->conn, $query);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }
}
 
 function getCustomerList() {
    global $conn;

    $query = "SELECT * FROM crm_products";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Product list is found successfully',
                'data' => $res
            ];

            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Product Cart Is Empty',
            ];
            header("HTTP/1.0 500 Product Cart Is Empty");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

function getProductById($id) {
    global $conn;

    $query = "SELECT * FROM crm_products WHERE id = $id";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_assoc($query_run);

            $data = [
                'status' => 200,
                'message' => 'Product found successfully',
                'data' => $res
            ];

            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Product not found',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

function updateProduct($id, $data) {
    global $conn;

    $setColumn = array();
    foreach ($data as $key => $value) {
        $setColumn[] = " {$key} = '{$value}'";
        
    }

    $sql = "UPDATE crm_products SET " . implode(', ', $setColumn) . " WHERE id = $id";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $data = [
            'status' => 200,
            'message' => 'Product updated successfully',
        ];

        header("HTTP/1.0 200 OK");
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];

        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}


function error422($message){
 $data = [
    'status' => 405,
    'message' => $message,
   ];
  header("HTTP/1.0 405 Unprocessable Entity");
  echo json_encode($data);
  exit();
 
}

function addvalue($productvalue) {
    global $conn;

    $category_id = mysqli_real_escape_string($conn, $productvalue['category_id']);
    $name = mysqli_real_escape_string($conn, $productvalue['name']);
    $small_description = mysqli_real_escape_string($conn, $productvalue['small_description']);
    $long_description = mysqli_real_escape_string($conn, $productvalue['long_description']);
    $price = mysqli_real_escape_string($conn, $productvalue['price']);
    $offerprice = mysqli_real_escape_string($conn, $productvalue['offerprice']);
    $tax = mysqli_real_escape_string($conn, $productvalue['tax']);
    $qty = mysqli_real_escape_string($conn, $productvalue['qty']);
    $image = mysqli_real_escape_string($conn, $productvalue['image']);
    $status = mysqli_real_escape_string($conn, $productvalue['status']);
   
    if(empty(trim($category_id))){

      return error422('category_id Not Found') ;
    }elseif(empty(trim($name))){

      return error422('Enter Your Name') ;

    }elseif(empty(trim($small_description))){

      return error422('Enter Your small_description') ;

    }
    elseif(empty(trim($long_description))){

        return error422('Enter Your long_description') ;

    }
    elseif(empty(trim($price))){

        return error422('Enter Your long_description') ;


    }
    elseif(empty(trim($offerprice))){
 
        return error422('Enter Your offerprice') ;
    }
    elseif(empty(trim($tax))){

        return error422('Enter Your tax') ;

    }
    elseif(empty(trim($qty))){

        return error422('Enter Your qty') ;

    }
    elseif(empty(trim($image))){

        return error422('Upload Your image') ;

    }
    elseif(empty(trim($status))){
        return error422('Enter Your status') ;


    }
    

    else {
        $query = "INSERT INTO crm_products (category_id, name, small_description, long_description, price, offerprice, tax, qty, image, status) VALUES ('$category_id', '$name', '$small_description', '$long_description', '$price', '$offerprice', '$tax', '$qty', '$image', '$status')";
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            if ($result) {
                $data = [
                    'status' => 201,
                    'message' => 'product inserted successfully ',
                ];
                header("HTTP/1.0 201 inserted");
                echo json_encode($data);
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internal Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
                echo json_encode($data);
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

function deleteUser($id) {
    global $conn;

    $sql = "DELETE FROM crm_products WHERE id = $id";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $data = [
            'status' => 200,
            'message' => 'User deleted successfully',
        ];

        header("HTTP/1.0 200 OK");
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];

        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}


 
?>
