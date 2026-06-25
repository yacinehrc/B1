<?php
require 'db.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'] ?? null;

    if (!$username) {
        // Fetch from DB if not in session (for existing sessions)
        $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $username = $user['username'];
            $_SESSION['username'] = $username; // Update session
        }
    }

    echo json_encode([
        "authenticated" => true, 
        "user_id" => $user_id,
        "username" => $username ?? 'Utilisateur'
    ]);
} else {
    http_response_code(401);
    echo json_encode(["authenticated" => false]);
}
?>
