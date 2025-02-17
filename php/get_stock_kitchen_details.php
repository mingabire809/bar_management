<?php
// Database connection setup as before

$host = 'localhost';  // Change this to your database host
$db = 'g_bar'; // Your database name
$user = 'root';   // Your database username
$pass = 'password'; // Your database password
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die(json_encode([
        'success' => false,
        'message' => 'Invalid ID'
    ]));
}

$sql = "SELECT 
    gsk.id, 
    gsk.nom_ingredient, 
    gsk.prix_achat,
    gsk.picture, 
    cc.id AS cuisine_categorie_id, 
    cc.name AS cuisine_categorie, 
    sc.id AS sous_categorie_id, 
    sc.name AS sous_categorie, 
    CASE WHEN gsk.disponible = 1 THEN 'Disponible' ELSE 'Non-disponible' END AS disponible
FROM gestion_stock_kitchen gsk
LEFT JOIN cuisine_categorie cc ON gsk.cuisine_categorie_id = cc.id
LEFT JOIN sous_categorie sc ON gsk.sous_categorie_id = sc.id
WHERE gsk.id = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$data = $stmt->fetch(PDO::FETCH_ASSOC);

$response = [
    'success' => true,
    'data' => $data
];

header('Content-Type: application/json');
echo json_encode($response);
?>
