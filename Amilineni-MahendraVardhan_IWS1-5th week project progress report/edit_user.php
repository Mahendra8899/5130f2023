<?php

require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all necessary data is set
    if (isset($_POST['id'], $_POST['username'], $_POST['email'], $_POST['phone'], $_POST['full_name'])) {
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, phone = ?, full_name = ? WHERE id = ?");
        $stmt->execute([
            $_POST['username'], 
            $_POST['email'], 
            $_POST['phone'], 
            $_POST['full_name'], 
            $_POST['id']
        ]);

        // You can customize this response as needed
        echo json_encode(["message" => "User updated successfully"]);
    } else {
        // Handle error - missing data
        http_response_code(400); // Bad request
        echo json_encode(["error" => "Missing data for user update"]);
    }
    } else {
        // Handle error - incorrect request method
        http_response_code(405); // Method not allowed
        echo json_encode(["error" => "Invalid request method"]);
    }
?>
