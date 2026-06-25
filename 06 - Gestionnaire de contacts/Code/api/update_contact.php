<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

if (!isset($data['id']) || !isset($data['type']) || !isset($data['name'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
    exit;
}

$id = $data['id'];
$type = $data['type'];
$name = $data['name'];
$phone = $data['phone'] ?? null;
$email = $data['email'] ?? null;
$address = $data['address'] ?? null;
$company = $data['company'] ?? null;
$position = $data['position'] ?? null;
$is_favorite = isset($data['is_favorite']) && $data['is_favorite'] ? 1 : 0;

try {
    $table = $type === 'pro' ? 'contacts_pro' : 'contacts_perso';
    
    if ($type === 'pro') {
        $stmt = $pdo->prepare("UPDATE $table SET name = ?, phone = ?, email = ?, address = ?, company = ?, position = ?, is_favorite = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$name, $phone, $email, $address, $company, $position, $is_favorite, $id, $_SESSION['user_id']]);
    } else {
        $stmt = $pdo->prepare("UPDATE $table SET name = ?, phone = ?, email = ?, address = ?, is_favorite = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$name, $phone, $email, $address, $is_favorite, $id, $_SESSION['user_id']]);
    }

    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "Contact updated successfully"]);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Contact not found or no changes made"]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>
