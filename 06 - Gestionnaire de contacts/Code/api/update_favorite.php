<?php
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || !isset($data['is_favorite']) || !isset($data['type'])) {
    http_response_code(400);
    echo json_encode(["error" => "ID, Type and Status required"]);
    exit;
}

$table = ($data['type'] === 'pro') ? 'contacts_pro' : 'contacts_perso';

try {
    $stmt = $pdo->prepare("UPDATE $table SET is_favorite = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$data['is_favorite'] ? 1 : 0, $data['id'], $user_id]);
    echo json_encode(["message" => "Favorite updated"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
