<?php
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$user_id = $_SESSION['user_id'];

if (!isset($_FILES['file']) || !isset($_POST['type'])) {
    http_response_code(400);
    echo json_encode(["error" => "File and type required"]);
    exit;
}

$type = $_POST['type'];
$file = $_FILES['file']['tmp_name'];

if (($handle = fopen($file, "r")) !== FALSE) {
    fgetcsv($handle); // Skip header

    try {
        if ($type === 'pro') {
            $stmt = $pdo->prepare("INSERT INTO contacts_pro (user_id, name, company, phone, email, position, is_favorite) VALUES (?, ?, ?, ?, ?, ?, 0)");
        } else {
            $stmt = $pdo->prepare("INSERT INTO contacts_perso (user_id, name, phone, email, address, is_favorite) VALUES (?, ?, ?, ?, ?, 0)");
        }
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $name = $data[0] ?? '';
            
            if ($name) {
                if ($type === 'pro') {
                    // Name, Company, Phone, Email, Position
                    $company = $data[1] ?? '';
                    $phone = $data[2] ?? '';
                    $email = $data[3] ?? '';
                    $position = $data[4] ?? '';
                    $stmt->execute([$user_id, $name, $company, $phone, $email, $position]);
                } else {
                    // Name, Phone, Email, Address
                    $phone = $data[1] ?? '';
                    $email = $data[2] ?? '';
                    $address = $data[3] ?? '';
                    $stmt->execute([$user_id, $name, $phone, $email, $address]);
                }
            }
        }
        fclose($handle);
        echo json_encode(["message" => "Import successful"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    http_response_code(500);
    echo json_encode(["error" => "Could not open file"]);
}
?>
