<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include('database.php'); // Ensure this is correct, or include your connection logic here

$input = json_decode(file_get_contents("php://input"), true);
$sortBy = isset($input['sort_by']) ? $input['sort_by'] : '';
$dateSelected = isset($input['date_selected']) ? $input['date_selected'] : '';
$dateStart = isset($input['date_start']) ? $input['date_start'] : '';
$dateEnd = isset($input['date_end']) ? $input['date_end'] : '';

try {
    if ($sortBy == 'date' && !empty($dateSelected)) {
        // If sorting by date and a specific date is selected
        $query = "SELECT nom_boisson, SUM(quantite) AS total_quantite, prix, 
                  SUM(prix * quantite) AS total_price, statut_paiement, DATE(date_commande) AS date_commande
                  FROM gestion_commande_boisson
                  WHERE DATE(date_commande) = :date_selected
                  GROUP BY nom_boisson, prix, statut_paiement, DATE(date_commande)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':date_selected', $dateSelected);
    } else if ($sortBy == 'date' && !empty($dateStart) && !empty($dateEnd)) {
        // If sorting by date and a date range is selected
        $query = "SELECT nom_boisson, SUM(quantite) AS total_quantite, prix, 
                  SUM(prix * quantite) AS total_price, statut_paiement, DATE(date_commande) AS date_commande
                  FROM gestion_commande_boisson
                  WHERE DATE(date_commande) BETWEEN :date_start AND :date_end
                  GROUP BY nom_boisson, prix, statut_paiement, DATE(date_commande)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':date_start', $dateStart);
        $stmt->bindParam(':date_end', $dateEnd);
    } else if ($sortBy == 'serveur') {
        // If sorting by server and no date filter is applied
        $query = "SELECT numero_serveur, nom_boisson, SUM(quantite) AS total_quantite, prix, 
                  SUM(prix * quantite) AS total_price, statut_paiement, DATE(date_commande) AS date_commande
                  FROM gestion_commande_boisson
                  GROUP BY numero_serveur, nom_boisson, prix, statut_paiement, DATE(date_commande)";
        $stmt = $conn->prepare($query);
    } else {
        // If neither sorting by date nor server is specified
        exit(json_encode(['status' => 'error', 'message' => 'Invalid parameters']));
    }

    // Execute the query
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results as JSON
    if ($data) {
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data found']);
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
