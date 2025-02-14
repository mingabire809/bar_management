<?php
header('Content-Type: application/json');

try {
    require_once 'database.php'; // Ensure database connection

    // Validate request method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method");
    }

    // Get input data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Validate input
    if (empty($id) || empty($name) || empty($quantity) || empty($price)) {
        throw new Exception("All fields are required");
    }

    if (!is_numeric($quantity) || !is_numeric($price)) {
        throw new Exception("Invalid quantity or price");
    }

    // Prepare update query
    $stmt = $conn->prepare("UPDATE gestion_stock_boisson SET nom_boisson = ?, quantite_stock = ?, prix_achat = ? WHERE id = ?");
    $stmt->execute([$name, $quantity, $price, $id]);

    echo json_encode([
        'success' => true,
        'message' => 'Stock updated successfully'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
