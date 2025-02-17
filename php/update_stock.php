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

            $stmt = $conn->prepare("UPDATE gestion_stock_boisson SET nom_boisson = ?, quantite_stock = ?, prix_achat = ?, picture= ? WHERE id = ?");
            $stmt->execute([$name, $quantity, $price, $fileName, $id]);
        
        } else {
            throw new Exception("File upload failed.");
        }
    }else{
        // Prepare update query
    $stmt = $conn->prepare("UPDATE gestion_stock_boisson SET nom_boisson = ?, quantite_stock = ?, prix_achat = ? WHERE id = ?");
    $stmt->execute([$name, $quantity, $price, $id]);
    }

    

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
