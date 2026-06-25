<?php
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['type']) || !isset($data['name'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input"]);
    exit;
}

$type = $data['type'];
$table = ($type === 'pro') ? 'contacts_pro' : 'contacts_perso';

try {
    if ($type === 'pro') {
        $stmt = $pdo->prepare("INSERT INTO contacts_pro (user_id, name, company, phone, email, position, is_favorite) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $user_id,
            $data['name'],
            $data['company'] ?? null,
            $data['phone'] ?? null,
            $data['email'] ?? null,
            $data['position'] ?? null,
            isset($data['is_favorite']) && $data['is_favorite'] ? 1 : 0
        ]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO contacts_perso (user_id, name, phone, email, address, is_favorite) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $user_id,
            $data['name'],
            $data['phone'] ?? null,
            $data['email'] ?? null,
            $data['address'] ?? null, // Assuming address field for perso
            isset($data['is_favorite']) && $data['is_favorite'] ? 1 : 0
        ]);
    }
    
    echo json_encode(["id" => $pdo->lastInsertId(), "message" => "Contact created"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
