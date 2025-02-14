<?php
// add_kitchen_stock.php
header('Content-Type: application/json');

try {
    $host = 'localhost';  // Change this to your database host
$db = 'g_bar'; // Your database name
$user = 'root';   // Your database username
$pass = 'password'; // Your database password
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    $ingredient_name = $_POST['nom_ingredient'];
   // $ingredient_quantity = $_POST['ingredient_quantity'];
    $ingredient_price = $_POST['prix_achat'];
  //  $ingredient_supply_date = $_POST['ingredient_supply_date'];
    $category = $_POST['cuisine_categorie_id'];
    $sub_category = $_POST['sous_categorie_id'];

    if (empty($ingredient_name) || empty($ingredient_price) || empty($category) || empty($sub_category)) {
        throw new Exception("All fields are required");
    }

    if ( !is_numeric($ingredient_price)) {
        throw new Exception("Quantité ou prix invalide");
    }

    // Prepare the SQL statement to insert data into the gestion_stock_kitchen table
    $stmt = $pdo->prepare("INSERT INTO gestion_stock_kitchen (nom_ingredient, prix_achat, cuisine_categorie_id, sous_categorie_id) VALUES (?, ?, ?, ?)");
    
    // Execute the query with the data
    $stmt->execute([$ingredient_name, $ingredient_price, $category, $sub_category]);

    echo json_encode([
        'success' => true,
        'message' => 'Produit ajouté au stock de cuisine avec succès'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
