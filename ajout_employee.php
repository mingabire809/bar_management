<?php
// add_stock.php
header('Content-Type: application/json');

try {
    require_once 'database.php';

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $poste = $_POST['poste'];
    $salaire = $_POST['salaire'];
    $date_embauche = $_POST['date_embauche'];

   
    if (empty($nom) || empty($prenom) || empty($poste) || empty($salaire)  || empty($date_embauche)) {
        throw new Exception("All fields are required");
    }

    if (!is_numeric($salaire)) {
        throw new Exception("Salaire invalide");
    }

   
    $stmt = $conn->prepare("INSERT INTO gestion_employes (nom, prenom, poste, salaire, date_embauche) VALUES (?, ?, ?, ?, ?)");
    
    

    $stmt->execute([$nom, $prenom, $poste, $salaire, $date_embauche]);


    echo json_encode([
        'success' => true,
        'message' => 'Employe ajoute avec sucees'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>