<?php
// add_stock.php
header('Content-Type: application/json');

try {
    require_once 'database.php';

    
   // $category = $_POST['category'];
   //var_dump($_POST); // To see the incoming POST data
    //exit;
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

   
    if (empty($name) || empty($quantity) || empty($price)) {
        throw new Exception("All fields are required");
    }

    if (!is_numeric($quantity) || !is_numeric($price)) {
        throw new Exception("Invalid quantity or price");
    }

   
    $stmt = $conn->prepare("INSERT INTO gestion_stock_boisson (nom_boisson, quantite_stock, prix_achat) VALUES (?, ?, ?)");
    
      //  $stmt = $conn->prepare("INSERT INTO gestion_stock_kitchen (nom_produit, quantite_disponible, cout_achat) VALUES (?, ?, ?)");
    

    $stmt->execute([$name, $quantity, $price]);


    echo json_encode([
        'success' => true,
        'message' => 'Stock added successfully'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>