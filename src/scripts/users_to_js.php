<?php
// Inclusion du fichier de connexion à la base de données
require_once 'src/templates/connection.inc.php';

// Exemple de requête
try {
    $stmt = $conn->query("SELECT * FROM user");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rows);
} catch (PDOException $e) {
    echo "Erreur de requête : " . $e->getMessage();
}
