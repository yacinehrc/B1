<?php
require 'db.php';

// Disable HTML errors
ini_set('html_errors', 0);

echo "\n=== DATABASE INSERT FOR USER 7 ===\n";

try {
    $user_id = 7;
    
    // Insert dummy personal contact
    $stmt = $pdo->prepare("INSERT INTO contacts_perso (user_id, name, phone, email, address, is_favorite) VALUES (?, 'Test Perso Theo', '0600000000', 'theo@perso.com', '123 Rue Theo', 0)");
    $stmt->execute([$user_id]);
    
    echo "Inserted dummy personal contact for user $user_id\n";

    // Verify
    $stmt = $pdo->query("SELECT * FROM contacts_perso WHERE user_id = $user_id");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Contacts Perso Count for User $user_id: " . count($rows) . "\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
echo "=== END TEST ===\n";
?>
