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
    $quantite = $_POST['quantite'];


    // Validate input
    if (empty($name) || empty($quantite)) {
        throw new Exception("All fields are required");
    }

    if (!is_numeric($quantite)) {
        throw new Exception("Quantite invalide");
    }



    // Prepare update query
    $stmt = $conn->prepare("UPDATE equipements SET name = ?, quantite = ? WHERE id = ?");
    $stmt->execute([$name, $quantite, $id]);

    echo json_encode([
        'success' => true,
        'message' => 'Equipement mis a jour avec success'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
