<?php
header('Content-Type: application/json');

try {
    $pdo = new PDO('mysql:host=localhost;dbname=g_bar', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method");
    }

    $id = $_POST['id'];
    $nom_ingredient = $_POST['nom_ingredient'];
    $prix_achat = $_POST['prix_achat'];
    $cuisine_categorie_id = $_POST['cuisine_categorie_id'];
    $sous_categorie_id = $_POST['sous_categorie_id'];
    $disponible = isset($_POST['disponible']) ? (int)$_POST['disponible'] : 0;

    if (empty($id) || empty($nom_ingredient) || empty($prix_achat) || empty($cuisine_categorie_id) || empty($sous_categorie_id)) {
        throw new Exception("All fields except 'disponible' are required");
    }

    if (!is_numeric($prix_achat)) {
        throw new Exception("Invalid price value");
    }

    // Handle file upload
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        error_log(print_r($_FILES, true));

        $upload_dir = __DIR__ . "/../pictures/"; // Make sure the "pictures" directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $fileTmpPath = $_FILES['picture']['tmp_name'];
        $fileName = time() . '_' . $_FILES['picture']['name'];
        $filePath = $upload_dir . $fileName;

        if (move_uploaded_file($fileTmpPath, $filePath)) {
            // Update the picture in the database
            $stmt = $pdo->prepare("UPDATE gestion_stock_kitchen SET nom_ingredient = ?, prix_achat = ?, cuisine_categorie_id = ?, sous_categorie_id = ?, disponible = ?, picture = ? WHERE id = ?");
            $stmt->execute([$nom_ingredient, $prix_achat, $cuisine_categorie_id, $sous_categorie_id, $disponible, $fileName, $id]);
        } else {
            throw new Exception("File upload failed.");
        }
    } else {
        // Update without changing the picture
        $stmt = $pdo->prepare("UPDATE gestion_stock_kitchen SET nom_ingredient = ?, prix_achat = ?, cuisine_categorie_id = ?, sous_categorie_id = ?, disponible = ? WHERE id = ?");
        $stmt->execute([$nom_ingredient, $prix_achat, $cuisine_categorie_id, $sous_categorie_id, $disponible, $id]);
    }

    echo json_encode(['success' => true, 'message' => 'Stock updated successfully']);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

?>
