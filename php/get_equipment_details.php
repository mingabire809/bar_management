<?php
header('Content-Type: application/json');

try {
    require_once 'database.php'; // Ensure this file connects to your database

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("ID de l'employe est necessaire");
    }

    $equipementId = $_GET['id'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id, name, quantite FROM equipements WHERE id = ?");
    $stmt->execute([$equipementId]);

    $equipment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$equipment) {
        throw new Exception("Objet n'existe pas");
    }

    echo json_encode([
        'success' => true,
        'data' => $equipment
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
