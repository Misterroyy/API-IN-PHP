<?php

class Token
{
    static function generateBearerToken($payload, $key)
    {
        // Payload
        $payload_encode = base64_encode(json_encode($payload));

        // Signature
        $signature = hash_hmac('SHA256', $payload_encode, $key);
        $signature_encode = base64_encode($signature);

        return  $payload_encode . '.' . $signature_encode;
    }

    static function verifyBearerToken($token, $key)
    {
        // Token parts
        $token_parts = explode('.', $token);

        // Verify signature
        $signature = base64_encode(hash_hmac('SHA256', $token_parts[0], $key));

        if ($signature !== $token_parts[1]) {
            return false;
        }

        // Get payload
        $payload = json_decode(base64_decode($token_parts[0]), true);
        return $payload;
    }
}

// Example Usage
$secretKey = "your_secret_key";
$payloadData = ['user_id' => 123, 'role' => 'admin'];

// Generate Bearer Token
$bearerToken = Token::generateBearerToken($payloadData, $secretKey);
echo "Bearer Token: $bearerToken\n";

// // Verify Bearer Token
// $verifiedPayload = Token::verifyBearerToken($bearerToken, $secretKey);

// if ($verifiedPayload !== false) {
//     echo "Token verified successfully!\n";
//     print_r($verifiedPayload);
// } else {
//     echo "Token verification failed!\n";
// }
?>
