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
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $poste = $_POST['poste'];
    $salaire = $_POST['salaire'];
    $numero_serveur = $_POST['numero_serveur'];
    $date_embauche = $_POST['date_embauche'];

    // Validate input
    if (empty($nom) || empty($prenom) || empty($poste) || empty($salaire)  || empty($date_embauche)) {
        throw new Exception("All fields are required");
    }

    if (!is_numeric($salaire)) {
        throw new Exception("Salaire invalide");
    }

    $numero_serveur = !empty($numero_serveur) ? $numero_serveur : null;


    // Prepare update query
    $stmt = $conn->prepare("UPDATE gestion_employes SET nom = ?, prenom = ?, poste = ?, salaire = ?, numero_serveur = ?, date_embauche = ? WHERE id = ?");
    $stmt->execute([$nom, $prenom, $poste, $salaire, $numero_serveur, $date_embauche, $id]);

    echo json_encode([
        'success' => true,
        'message' => 'Employe mis a jour avec success'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
