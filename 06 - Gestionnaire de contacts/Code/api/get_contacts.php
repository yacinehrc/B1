<?php
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    // Fetch Pro Contacts
    $stmtPro = $pdo->prepare("SELECT *, 'pro' as type FROM contacts_pro WHERE user_id = ? ORDER BY created_at DESC");
    $stmtPro->execute([$user_id]);
    $proContacts = $stmtPro->fetchAll(PDO::FETCH_ASSOC);

    // Fetch Perso Contacts
    $stmtPerso = $pdo->prepare("SELECT *, 'perso' as type FROM contacts_perso WHERE user_id = ? ORDER BY created_at DESC");
    $stmtPerso->execute([$user_id]);
    $persoContacts = $stmtPerso->fetchAll(PDO::FETCH_ASSOC);

    // Merge Results
    $contacts = array_merge($proContacts, $persoContacts);
    
    foreach ($contacts as &$contact) {
        $contact['is_favorite'] = (bool)$contact['is_favorite'];
    }
    
    echo json_encode($contacts);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
