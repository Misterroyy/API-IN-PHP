<?php 
function check_credentials($email, $password)
{
    require 'config/db-conn.php';
    include 'token.php';
  
    const KEY = 'fnzvjfn';
    // Escape user input
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM crm_users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        return false;
    }

    $user = $result->fetch_assoc();

    return true;
}
$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        // Return an error message
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array("message" => "Please enter email and password"));
        exit(); // Stop the script
    }

    if (check_credentials($email, $password)) {
        $token = generate::generateBearerToken(KEY);

        // Send the JWT token back to the client
        header('Content-Type: application/json');
        echo json_encode(array("token" => $token));
    } else {
        // Return an error message
        header('HTTP/1.0 401 Unauthorized');
        echo json_encode(array("message" => "Invalid email or password"));
    }
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}



?>