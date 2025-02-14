<?php
header('Content-Type: application/json');

try {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=g_bar', 'root', 'password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // Validate request method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method");
    }

    // Get input data
    $id = $_POST['id'];
    $nom_ingredient = $_POST['nom_ingredient'];
    $prix_achat = $_POST['prix_achat'];
    $cuisine_categorie_id = $_POST['cuisine_categorie_id'];
    $sous_categorie_id = $_POST['sous_categorie_id'];
    $disponible = $_POST['disponible'];

    // Validate input
    if (empty($id) || empty($nom_ingredient) || empty($prix_achat) || empty($cuisine_categorie_id) || empty($sous_categorie_id)) {
        throw new Exception("All fields except 'disponible' are required");
    }

    if (!is_numeric($prix_achat)) {
        throw new Exception("Invalid price value");
    }

    // Convert "1" or "0" from dropdown to an integer
    $disponible = ($disponible == '1') ? 1 : 0;

    // Prepare update query
    $stmt = $pdo->prepare("UPDATE gestion_stock_kitchen SET nom_ingredient = ?, prix_achat = ?, cuisine_categorie_id = ?, sous_categorie_id = ?, disponible = ? WHERE id = ?");
    $stmt->execute([$nom_ingredient, $prix_achat, $cuisine_categorie_id, $sous_categorie_id, $disponible, $id]);

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
