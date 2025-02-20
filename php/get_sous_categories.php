<?php
// Database connection
$host = 'localhost';  // Change this to your database host
$db = 'g_bar'; // Your database name
$user = 'root';   // Your database username
$pass = ''; // Your database password
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

// Get category ID from request
$categorie_id = isset($_GET['cuisine_categorie_id']) ? (int)$_GET['cuisine_categorie_id'] : 0;

// Fetch sous-categories for the given category
$sql = "SELECT id, name FROM sous_categorie WHERE cuisine_categorie_id = :cuisine_categorie_id ORDER BY name ASC";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':cuisine_categorie_id', $categorie_id, PDO::PARAM_INT);
$stmt->execute();

// Fetch results
$sous_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($sous_categories);
?>
