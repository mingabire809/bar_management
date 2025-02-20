<?php
// get_sub_categories.php

require_once 'database.php';

if (isset($_GET['cuisine_category_id'])) {
    $categoryId = $_GET['cusine_category_id'];

    $stmt = $pdo->prepare("SELECT id, name FROM sous_categorie WHERE cusine_category_id = ?");
    $stmt->execute([$categoryId]);

    $subCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($subCategories);
} else {
    echo json_encode([]);
}
