<?php
include 'bd.php';

// Ajouter un contact
if (isset($_POST['add'])) {
    $nom = $_POST['Nom'];
    $telephone = $_POST['Telephone'];
    $mail = $_POST['Mail'];

    $stmt = $conn->prepare("INSERT INTO contact ( Nom, Telephone, Mail) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $nom, $telephone, $mail);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}

// Modifier un contact
if (isset($_POST['edit'])) {
    $id = intval($_POST['IdContact']);
    $nom = $_POST['Nom'];
    $telephone = $_POST['Telephone'];
    $mail = $_POST['Mail'];

    $stmt = $conn->prepare("UPDATE contact SET Nom=?, Telephone=?, Mail=? WHERE IdContact=?");
    $stmt->bind_param("sssi", $nom, $telephone, $mail, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}

// Suppression logique
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("UPDATE contact SET Supprime = 1 WHERE IdContact = $id");

    header("Location: index.php");
    exit;
}

// Restaurer
if (isset($_GET['restore'])) {
    $id = intval($_GET['restore']);
    $conn->query("UPDATE contact SET Supprime = 0 WHERE IdContact = $id");

    header("Location: index.php?tab=corbeille");
    exit;
}

// Suppression physique
if (isset($_GET['delete_physical'])) {
    $id = intval($_GET['delete_physical']);
    $conn->query("DELETE FROM contact WHERE IdContact = $id");

    header("Location: index.php?tab=corbeille");
    exit;
}

// Onglet actif
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'actifs';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Requêtes
if ($tab == 'corbeille') {
    $result = $conn->query("
        SELECT c.*, u.NomUtilisateurs 
        FROM contact c 
        JOIN utilisateurs u ON c.IdUtilisateur = u.IdUtilisateurs 
        WHERE c.Supprime = 1
    ");
} else {
    if ($search != '') {
        $stmt = $conn->prepare("
            SELECT c.*, u.NomUtilisateurs 
            FROM contact c 
            JOIN utilisateurs u ON c.IdUtilisateur = u.IdUtilisateurs 
            WHERE c.Supprime = 0 AND c.Nom LIKE ?
        ");
        $like = "%$search%";
        $stmt->bind_param("s", $like);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query("
            SELECT c.*, u.NomUtilisateurs 
            FROM contact c 
            JOIN utilisateurs u ON c.IdUtilisateur = u.IdUtilisateurs 
            WHERE c.Supprime = 0
        ");
    }
}
?>

<h2>Gestion des contacts</h2>

<a href="index.php?tab=actifs">Contacts Actifs</a> | 
<a href="index.php?tab=corbeille">Corbeille</a>

<?php if ($tab == 'actifs'): ?>

    <?php if (isset($_GET['edit_id'])):
        $id = intval($_GET['edit_id']);
        $editResult = $conn->query("SELECT * FROM contact WHERE IdContact = $id");
        $contact = $editResult->fetch_assoc();
    ?>
        <h3>Modifier le contact</h3>
        <form method="post">
            <input type="hidden" name="IdContact" value="<?= $contact['IdContact'] ?>">
            Nom: <input type="text" name="Nom" value="<?= $contact['Nom'] ?>" required><br>
            Téléphone: <input type="text" name="Telephone" value="<?= $contact['Telephone'] ?>" required><br>
            Mail: <input type="email" name="Mail" value="<?= $contact['Mail'] ?>" required><br>
            <input type="submit" name="edit" value="Modifier">
        </form>
    <?php else: ?>
        <h3>Ajouter un contact</h3>
        <form method="post">
            Nom: <input type="text" name="Nom" required><br>
            Téléphone: <input type="text" name="Telephone" required><br>
            Mail: <input type="email" name="Mail" required><br>
            <input type="submit" name="add" value="Ajouter">
        </form>
    <?php endif; ?>

    <form method="get">
        Rechercher: <input type="text" name="search" value="<?= htmlspecialchars($search) ?>">
        <input type="submit" value="Chercher">
    </form>

<?php endif; ?>

<h3><?= $tab == 'corbeille' ? "Corbeille" : "Liste des contacts actifs" ?></h3>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Téléphone</th>
    <th>Mail</th>
    <th>Utilisateur</th>
    <th>Actions</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['IdContact'] ?></td>
    <td><?= $row['Nom'] ?></td>
    <td><?= $row['Telephone'] ?></td>
    <td><?= $row['Mail'] ?></td>
    <td><?= $row['NomUtilisateurs'] ?></td>
    <td>
        <?php if ($tab == 'corbeille'): ?>
            <a href="?restore=<?= $row['IdContact'] ?>">Restaurer</a> | 
            <a href="?delete_physical=<?= $row['IdContact'] ?>" onclick="return confirm('Supprimer définitivement ?')">Supprimer définitivement</a>
        <?php else: ?>
            <a href="?edit_id=<?= $row['IdContact'] ?>">Modifier</a> |
            <a href="?delete=<?= $row['IdContact'] ?>" onclick="return confirm('Supprimer ce contact ?')">Supprimer</a>
        <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>

</table>
