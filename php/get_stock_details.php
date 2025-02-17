<?php
header('Content-Type: application/json');

try {
    require_once 'database.php'; // Ensure this file connects to your database

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("Stock ID is required");
    }

    $stockId = $_GET['id'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id, nom_boisson, quantite_stock, prix_achat, picture FROM gestion_stock_boisson WHERE id = ?");
    $stmt->execute([$stockId]);

    $stock = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$stock) {
        throw new Exception("Stock item not found");
    }

    echo json_encode([
        'success' => true,
        'data' => $stock
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
