<?php
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || !isset($data['type'])) {
    http_response_code(400);
    echo json_encode(["error" => "ID and Type required"]);
    exit;
}

$table = ($data['type'] === 'pro') ? 'contacts_pro' : 'contacts_perso';

try {
    $stmt = $pdo->prepare("DELETE FROM $table WHERE id = ? AND user_id = ?");
    $stmt->execute([$data['id'], $user_id]);
    echo json_encode(["message" => "Contact deleted"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
