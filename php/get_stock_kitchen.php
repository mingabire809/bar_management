<?php
// Database connection
$host = 'localhost';
$db = 'g_bar';
$user = 'root';
$pass = 'password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $e->getMessage()
    ]));
}

// Retrieve parameters from the DataTable
$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
$length = isset($_GET['length']) ? (int)$_GET['length'] : 10;
$searchValue = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';
$orderColumn = isset($_GET['order'][0]['column']) ? (int)$_GET['order'][0]['column'] : 0;
$orderDir = isset($_GET['order'][0]['dir']) ? $_GET['order'][0]['dir'] : 'asc';

// Mapping of column indexes to actual column names
$columns = ['nom_ingredient', 'prix_achat', 'disponible', 'nom_categorie', 'nom_sous_categorie'];
$orderColumnName = isset($columns[$orderColumn]) ? $columns[$orderColumn] : 'nom_ingredient';

// Construct the SQL query with JOINs to get category names
$sql = "SELECT gsk.id, gsk.nom_ingredient, gsk.prix_achat, 
               cc.name AS cuisine_categorie, 
               sc.name AS sous_categorie,
               CASE 
                   WHEN gsk.disponible = 1 THEN 'disponible'
                   ELSE 'non-disponible'
               END AS disponible
        FROM gestion_stock_kitchen gsk
        LEFT JOIN cuisine_categorie cc ON gsk.cuisine_categorie_id = cc.id
        LEFT JOIN sous_categorie sc ON gsk.sous_categorie_id = sc.id
        WHERE (gsk.nom_ingredient LIKE :searchValue 
            OR gsk.prix_achat LIKE :searchValue 
            OR cc.name LIKE :searchValue
            OR sc.name LIKE :searchValue
            OR (CASE 
                    WHEN gsk.disponible = 1 THEN 'disponible'
                    ELSE 'non-disponible'
                END) LIKE :searchValue) 
        ORDER BY $orderColumnName $orderDir 
        LIMIT :start, :length";


// Prepare the statement
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':searchValue', '%' . $searchValue . '%', PDO::PARAM_STR);
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':length', $length, PDO::PARAM_INT);
$stmt->execute();

// Fetch the results
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of records
$totalRecordsStmt = $pdo->query("SELECT COUNT(*) FROM gestion_stock_kitchen");
$totalRecords = $totalRecordsStmt->fetchColumn();

// Return the data in the DataTable format
$response = [
    'draw' => isset($_GET['draw']) ? (int)$_GET['draw'] : 1,
    'recordsTotal' => $totalRecords,
    'recordsFiltered' => $totalRecords,
    'data' => $data
];

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
