<?php
// Database connection parameters
$host = 'localhost'; // Your database host
$dbname = 'g_bar';   // Your database name
$username = 'root';   // Your database username
$password = '';       // Your database password

try {
    // Establish connection with the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    echo "Connection failed: " . $e->getMessage();
}

// Fetch drink names and prices from the database
$query = "SELECT id, nom_boisson, prix_achat FROM gestion_stock_boisson";
$stmt = $pdo->query($query);
$drinks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <!-- jQuery (necessary for DataTables) -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_1.css">

	<title>Ku Kayaga</title>
</head>
<body>


	<!-- Sidebar -->
<section id="sidebar">
    <a href="index.php" class="brand">
        <i class='bx bxs-wine'></i> <!-- Beer icon for the bar -->
        <span class="text">KU KAYAGA</span>
    </a>
    <ul class="side-menu top">
        <li class="active">
            <a href="#" data-target="dashboard-section">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#" data-target="gestion-commandes-section">
                <i class='bx bxs-cart'></i>
                <span class="text">Gestion Commandes</span>
            </a>
        </li>
        <li>
            <a href="#" data-target="gestion-stock-section">
                <i class='bx bxs-box'></i>
                <span class="text">Gestion Stock</span>
            </a>
        </li>
        <li>
            <a href="#" data-target="facturation-section">
                <i class='bx bxs-receipt'></i>
                <span class="text">Facturation</span>
            </a>
        </li>
        <li>
           <a href="#" data-target="gestion-employes-section">
                <i class='bx bxs-user-detail'></i>
                <span class="text">Gestion des Employés</span>
            </a>
        </li>
        <li>
           <a href="#" data-target="gestion-equipement-section">
                <i class='bx bxs-factory'></i>
                <span class="text">Gestion des Equipement</span>
            </a>
        </li>
    </ul>

    <ul class="side-menu top">
        <li class="dropdown">
            <a href="#" class="toggle-submenu">
                <i class='bx bxs-report'></i>
                <span class="text">Rapports</span>
            </a>
            <ul class="submenu">
                <li><a href="#" data-target="bar-section"><i class='bx bxs-chevron-right'></i> Bar</a></li>
                <li><a href="#" data-target="food-section"><i class='bx bxs-chevron-right'></i> Resto</a></li>
                <li><a href="#" data-target="casse-section"><i class='bx bxs-message-x'></i>Casse/Perte</a></li>
            </ul>
        </li>
    </ul>
    
</section>



	<!-- CONTENT -->
<section id="content">
            <!-- NAVBAR -->
            <nav>
                <i class='bx bx-menu'></i>
                <a href="#" class="nav-link">Categories</a>
                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                    </div>
                </form>
                
                <input type="checkbox" id="switch-mode" hidden>
                <label for="switch-mode" class="switch-mode"></label>
                <a href="#" class="notification">
                    <i class='bx bxs-bell'></i>
                    <span class="num">8</span>
                </a>
                
                <a href="#" class="profile" id="profile-link">
                    <img src="img/people.png" alt="Profile Picture">
                </a>
                
                <!-- Profile Modal -->
                <div id="profile-modal" class="profile-modal">
                    <div class="profile-modal-content">
                        <span class="close-profile-modal">&times;</span>
                        <div class="profile-details">
                            <img id="profile-pic" src="users/Profiles/default.png" alt="Profile Picture">
                            <h3 id="profile-username"><i class='bx bxs-user'></i> Username</h3>
                            <p id="profile-email"><i class='bx bxs-envelope'></i> Email</p>
                            <span id="profile-role"><i class='bx bxs-briefcase'></i> Role</span>
                        </div>
                        <button class="logout-btn">
                            <i class='bx bxs-log-out'></i> Logout
                        </button>
                    </div>
                </div>
            </nav>
		<!-- NAVBAR -->

		<!-- Main Content Section -->
<main id="main-content">
    <!-- Dashboard Section -->
    
    <section id="dashboard-section" class="content-section">
        <h1>Dashboard</h1>
        <p></p>
        <div class="dashboard-grid">
            <div class="dashboard-box" id="box-commandes" onclick="showSection('gestion-commandes-section')">
                <i class='bx bxs-cart'></i>
                <span>Gestion Commandes</span>
            </div>
            <div class="dashboard-box" id="box-stock" onclick="showSection('gestion-stock-section')">
                <i class='bx bxs-box'></i>
                <span>Gestion Stock</span>
            </div>
            <div class="dashboard-box" id="box-facturation" onclick="showSection('facturation-section')">
                <i class='bx bxs-receipt'></i>
                <span>Facturation</span>
            </div>
            <div class="dashboard-box" id="box-employes" onclick="showSection('gestion-employes-section')">
                <i class='bx bxs-user-detail'></i>
                <span>Gestion des Employés</span>
            </div>
            <div class="dashboard-box" id="box-equipement" onclick="showSection('gestion-equipement-section')">
                <i class='bx bxs-factory'></i>
                <span>Gestion des Equipements</span>
            </div>
        </div>
    </section>


    <!-- Gestion Commandes Section -->
    <section id="gestion-commandes-section" class="content-section">
        <h1>Gestion Commandes</h1>
        <p></p>
        <div class="gestion-commandes-grid">
            <!-- Boisson Box -->
            <div class="gestion-commandes-box" id="box-boisson" onclick="toggleBox('boisson')">
                <i class="bx bxs-wine"></i> <!-- Wine/Bar icon -->
                <span>Bar</span>
            </div>

            <!-- Kitchen Box -->
            <div class="gestion-commandes-box" id="box-kitchen" onclick="toggleBox('kitchen')">
                <i class="bx bxs-store-alt"></i> <!-- Restaurant icon -->
                <span>Restaurant</span>
            </div>
        </div>
        
        <!-- This is the container where available drinks and the order form will appear -->
        <div id="boisson-details-container" style="display: none;">
            <!-- Button to show the order section (placed below the grid) -->
            <button class="order-btn" onclick="openOrderModal()">
                <i class="bx bxs-cart-add"></i> Passez une commande boisson
            </button>
             
            <div class="grid-container">
            <?php
    // Database connection settings
    $host = 'localhost';
    $dbname = 'g_bar';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query to fetch data including picture column, ordered alphabetically by nom_boisson
        $query = "SELECT nom_boisson, quantite_stock, prix_achat, picture FROM gestion_stock_boisson ORDER BY nom_boisson ASC";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Determine image path
                $imagePath = !empty($row['picture']) ? "./pictures/" . $row['picture'] : "G_boisson/uploads/default.jpg";

                // Determine stock status and class
                if ($row['quantite_stock'] <= 1) {
                    $stockClass = 'stock-out';
                    $stockText = 'Non disponible';
                } elseif ($row['quantite_stock'] < 10) {
                    $stockClass = 'stock-low';
                    $stockText = $row['quantite_stock'];
                } else {
                    $stockClass = 'stock-high';
                    $stockText = $row['quantite_stock'];
                }
                ?>
                <div class="grid-item">
                    <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Boisson Image">
                    <div class="boisson-name"><?php echo htmlspecialchars($row['nom_boisson']); ?></div>
                    <div class="boisson-quantity <?php echo $stockClass; ?>"><?php echo htmlspecialchars($stockText); ?></div>
                    <div class="boisson-price"><?php echo htmlspecialchars($row['prix_achat']); ?> FBU</div>
                </div>
                <?php
            }
        } else {
            echo '<p class="stock-out">Non disponible</p>';
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
?>




</div>




            
            <!-- Drink Order Modal -->
<div id="drink-order-modal" class="drink-order-modal">
    <div class="drink-modal-content">
        <span class="drink-close" onclick="closeOrderModal()">&times;</span>
        
        <!-- Step Indicator -->
        <div class="drink-step-indicator">
            <span id="drink-step-circle">1</span>
        </div>

        <!-- Step 1: Select Drinks -->
        <div id="drink-step-1">
            <h2>Passer une commande boisson</h2>
            
            <table id="drink-table">
                <thead>
                    <tr>
                        <th>Boisson</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows will be added dynamically -->
                </tbody>
            </table>
            
            <button onclick="addDrinkRow()">+ Ajouter une boisson</button>
            
            <!-- Total Price -->
            <div class="drink-total-price-box">
                <strong>Total: </strong> <span id="drink-total-price">0 FBU</span>
            </div>
            
            <!-- Table & Server Details -->
            <label for="drink-table-number">Numéro de Table:</label>
            <input type="text" id="drink-table-number" required>

            <label for="drink-server-number">Numéro du Serveur:</label>
            <input type="text" id="drink-server-number" required>

            <!-- Navigation -->
            <button onclick="nextStep()">
                Next <i class="bx bx-chevron-right"></i>
            </button>
        </div>
        
        <!-- Step 2: Confirm Order -->
         <div id="drink-step-2" style="display: none;">
            <div id="drink-order-summary">
                <!-- Order summary will be populated here -->
            </div>
            
            <!-- Navigation Buttons -->
             <button onclick="prevStep()">
                <i class="bx bx-chevron-left"></i> Retour
            </button>
            <button onclick="submitOrder()">
                <i class="bx bxs-badge-check"></i> Confirmer la commande
            </button>
        </div>

    </div>
</div>

        </div>

        <!-- This is the container where available kitchen items and the order form will appear -->
        <div id="kitchen-details-container" style="display: none;">
            <!-- Kitchen specific content can go here -->
            <button class="order-btn" onclick="openKitchenOrderModal()">
                <i class="bx bxs-cart-add"></i> Passez une commande cuisine
            </button>
            
            <div class="grid-container">
    <?php
    // Database connection settings
    $host = 'localhost';
    $dbname = 'g_bar';
    $username = 'root';
    $password = '';
    
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Query to fetch data including availability and picture columns, ordered alphabetically by nom_plat
        $query = "SELECT nom_ingredient, availability, prix_achat, picture FROM gestion_stock_kitchen ORDER BY nom_ingredient ASC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Set color based on availability value
                $availabilityColor = ($row['availability'] === 'non-disponible') ? 'red' : 'green';
                
                // Set image path (assuming images are stored in 'G_boisson/uploads/')
                $imagePath = !empty($row['picture']) ? "./pictures/" . htmlspecialchars($row['picture']) : "G_boisson/uploads/default.jpg";
                
                echo '<div class="grid-item">';
                echo '<img src="' . htmlspecialchars($imagePath) . '" alt="Plat Image">';
                echo '<div class="plat-name" style="font-weight: bold;">' . htmlspecialchars($row['nom_ingredient']) . '</div>';
                echo '<div class="plat-availability" style="color:' . $availabilityColor . '; font-weight: normal;">' . htmlspecialchars($row['availability']) . '</div>';
                echo '<div class="plat-price">' . htmlspecialchars($row['prix_achat']) . ' FBU</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No kitchen items available.</p>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
</div>



    <!-- Kitchen Order Modal -->
<div id="kitchen-order-modal" class="kitchen-order-modal" style="display: none;">
    <div class="kitchen-modal-content">
        <span class="kitchen-close" onclick="closeKitchenOrderModal()">&times;</span>
        
        <!-- Step Indicator -->
        <div class="kitchen-step-indicator">
            <span id="kitchen-step-circle">1</span>
        </div>

        <!-- Step 1: Select Kitchen Items -->
        <div id="kitchen-step-1">
        <h2>Passer une commande cuisine</h2>
            
            <table id="kitchen-table">
                <thead>
                    <tr>
                        <th>Plat</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows will be added dynamically -->
                </tbody>
            </table>
            
            <button onclick="addKitchenRow()">+ Ajouter un plat</button>
            
            <!-- Total Price -->
            <div class="kitchen-total-price-box">
                <strong>Total: </strong> <span id="kitchen-total-price">0 FBU</span>
            </div>
            
            <!-- Table & Server Details -->
            <label for="kitchen-table-number">Numéro de Table:</label>
            <input type="text" id="kitchen-table-number" required>

            <label for="kitchen-server-number">Numéro du Serveur:</label>
            <input type="text" id="kitchen-server-number" required>

            <!-- Navigation -->
            <button onclick="nextKitchenStep()">
                next <i class="bx bx-chevron-right"></i>
            </button>
        </div>
        
        <!-- Step 2: Confirm Kitchen Order -->
        <div id="kitchen-step-2" style="display: none;">
            <div id="kitchen-order-summary"></div>
            
            <!-- Retour Button with bx Icon -->
            <button onclick="prevKitchenStep()">
                <i class="bx bx-chevron-left"></i> Retour
            </button>

            <!-- Confirmer la commande Button with bx Icon -->
            <button onclick="submitKitchenOrder()">
                <i class="bx bxs-badge-check"></i> Confirm order
            </button>
        </div>
    </div>
</div>

</div>

    </section>












    <!-- Gestion Stock Section -->
    <section id="gestion-stock-section" class="content-section">
        <h1>Gestion Stock</h1>
        <p></p>

        <div class="gestion-stock-grid">
        <div class="gestion-stock-box" id="box-supplies" onclick="showBoissonDetails()">
            <i class="bx bxs-wine"></i> <!-- Box icon for supplies -->
            <span>Boisson</span>
        </div>
        <div class="gestion-stock-box" id="box-equipment" onclick="showKitchenDetails()">
            <i class="bx bxs-store-alt"></i> <!-- Wrench icon for equipment -->
            <span>Cuisines</span>
        </div>
    </div>


    
    </section>


    <section id="gestion-boisson-section" class="content-section">
        <h1>Gestion Boissons</h1>
        <p></p>


        <button id="add-stock-btn" class="add-stock-btn">
        <i class='bx bx-plus-circle'></i>
        Ajouter Stock
    </button>

    <!-- Modal/Dialog -->
    <div id="stock-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Ajouter produit</h2>
            
            

            <form id="stock-form" method="POST" enctype="multipart/form-data">
    
    
    <div class="form-group">
        <label for="item-name">Nom:</label>
        <input type="text" id="item-name" name="name" required>
    </div>

    <div class="form-group">
        <label for="item-quantity">Quantite:</label>
        <input id="item-quantity" name="quantity" required>
    </div>

    <div class="form-group">
        <label for="item-price">Prix d'achat:</label>
        <input type="number" step="0.01" id="item-price" name="price" required>
    </div>

    <div class="form-group">
                <label for="ingredient-picture">Image de la boisson: </label>
                <input type="file" id="boisson-picture" name="picture" accept="image/*">
            </div>

            <div class="form-group">
                <img id="image-preview" src="" alt="Aperçu de l'image" style="max-width: 100px; display: none;">
            </div>

    <button type="submit" class="submit-btn">Ajouter produit</button>
</form>
        </div>
    </div>

    <div class="table-container" style="margin-top: 10px;">
    <table id="stock-table" class="display">
        <thead>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Quantité</th>
                <th>Prix d'achat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here -->
        </tbody>
    </table>
</div>

<div id="stock-modal-update" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Modifier le produit</h2>

        <form id="stock-form-update" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="item-name">Nom:</label>
                <input type="text" id="item-name-update" name="name" required>
            </div>

            <div class="form-group">
                <label for="item-quantity">Quantité:</label>
                <input id="item-quantity-update" name="quantity" required>
            </div>

            <div class="form-group">
                <label for="item-price">Prix d'achat:</label>
                <input type="number" step="0.01" id="item-price-update" name="price" required>
            </div>

            <div class="form-group">
                <label>Image Actuelle:</label>
                <img id="current-image-preview-boisson" src="" alt="Aucune image" style="max-width: 200px; display: block; margin-top: 10px;">
            </div>

            <!-- File Input for New Image -->
            <div class="form-group">
                <label for="boisson-picture-update">Changer l'image:</label>
                <input type="file" id="boisson-picture-update" name="picture" accept="image/*">
            </div>

            <div class="form-group">
                <img id="image-preview-update-boisson" src="" alt="Aperçu de l'image" style="max-width: 100px; display: none;">
            </div>

            <button type="submit" class="submit-btn">Mettre à jour</button>
        </form>
    </div>
</div>
    </section>


    <section id="gestion-cuisine-section" class="content-section">

    <h1>Gestion Cuisines</h1>
        <p></p>

            <div style="display: flex; align-items: center; justify-content: space-between">
            <button id="add-stock-kitchen-btn" class="add-stock-btn">
                <i class='bx bx-plus-circle'></i>
                Ajouter Stock
                </button>


                <button id="add-category-btn" class="add-stock-btn">
            <i class='bx bx-plus-circle'></i>
            Ajouter Categorie
        </button>
            </div>
        
            <div class="table-container" style="margin-top: 10px;">
    <table id="stock-kitchen-table" class="display">
        <thead>
            <tr>
                <th></th>
                <th>Nom du plat</th>
                <th>Prix d'achat</th>
                <th>Categorie</th>
                <th>Sous Categorie</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here -->
        </tbody>
    </table>
</div>
    </section>

    

    <!-- Modal for Adding Category or Subcategory -->
    <div id="category-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Ajouter une Catégorie</h2>

        <form id="category-form" method="POST">
            <div class="form-group">
                <label for="category-type">Type:</label>
                <select id="category-type" name="category_type" required>
                    <option value="cuisine_categorie">Catégorie</option>
                    <option value="sous_categorie">Sous-Catégorie</option>
                </select>
            </div>

            <div id="parent-category-group" class="form-group" style="display: none;">
                <label for="parent-category">Catégorie Parent:</label>
                <select id="parent-category" name="parent_category"></select>
            </div>

            <div class="form-group">
                <label for="category-name">Nom:</label>
                <input type="text" id="category-name" name="category_name" required>
            </div>

            <button type="submit" class="submit-btn">Ajouter</button>
        </form>
    </div>
</div>



<!-- Modal to Add Kitchen Stock -->
<div id="stock-kitchen-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-stock-kitchen-modal">&times;</span>
        <h2>Ajouter au stock de cuisine</h2>

        <form id="stock-kitchen-form" method="POST" enctype="multipart/form-data">
            <!-- Category Selection -->
            <div class="form-group">
                <label for="category">Catégorie:</label>
                <select id="category" name="cuisine_categorie_id" required>
                    <option value="">Sélectionner une catégorie</option>
                    <!-- Categories will be loaded here -->
                </select>
            </div>

            <!-- Sub-Category Selection (Initially hidden) -->
            <div class="form-group" id="sub-category-group" style="display: none;">
                <label for="sub-category">Sous-Catégorie:</label>
                <select id="sub-category" name="sous_categorie_id">
                    <option value="">Sélectionner une sous-catégorie</option>
                    <!-- Sub-categories will be loaded here -->
                </select>
            </div>

            <div class="form-group">
                <label for="ingredient-name">Nom du plat</label>
                <input type="text" id="ingredient-name" name="nom_ingredient" required>
            </div>


            <div class="form-group">
                <label for="ingredient-price">Prix d'achat:</label>
                <input type="number" step="0.01" id="ingredient-price" name="prix_achat" required>
            </div>

            <div class="form-group">
                <label for="ingredient-picture">Image du produit:</label>
                <input type="file" id="ingredient-picture" name="picture" accept="image/*">
            </div>

            <div class="form-group">
                <img id="image-preview" src="" alt="Aperçu de l'image" style="max-width: 100px; display: none;">
            </div>


            <button type="submit" class="submit-btn">Ajouter au stock</button>
        </form>
    </div>
</div>




<div id="stock-kitchen-modal-update" class="modal">
    <div class="modal-content">
        <span class="close" id="close-stock-kitchen-modal">&times;</span>
        <h2 id="modal-title">Ajouter au stock de cuisine</h2>

        <form id="stock-kitchen-form-update" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category">Catégorie:</label>
                <select id="category-update" name="cuisine_categorie_id" required>
                    <option value="">Sélectionner une catégorie</option>
                </select>
            </div>

            <div class="form-group" id="sub-category-group">
                <label for="sub-category">Sous-Catégorie:</label>
                <select id="sub-category-update" name="sous_categorie_id">
                    <option value="">Sélectionner une sous-catégorie</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ingredient-name">Nom du plat</label>
                <input type="text" id="ingredient-name-update" name="nom_ingredient" required>
            </div>

            <div class="form-group">
                <label for="ingredient-price">Prix d'achat:</label>
                <input type="number" step="0.01" id="ingredient-price-update" name="prix_achat" required>
            </div>

            <div class="form-group">
            <label for="availability">Disponibilité:</label>
            <select id="availability" class="form-control">
                <option value="1">Disponible</option>
                <option value="0">Non-disponible</option>
            </select>
            </div>

            <div class="form-group">
                <label>Image Actuelle:</label>
                <img id="current-image-preview" src="" alt="Aucune image" style="max-width: 200px; display: block; margin-top: 10px;">
            </div>

            <!-- File Input for New Image -->
            <div class="form-group">
                <label for="ingredient-picture-update">Changer l'image:</label>
                <input type="file" id="ingredient-picture-update" name="picture" accept="image/*">
            </div>

            <div class="form-group">
                <img id="image-preview-update" src="" alt="Aperçu de l'image" style="max-width: 100px; display: none;">
            </div>

            <input type="hidden" id="item-id" name="id">
            <button type="submit" class="submit-btn">Modifier</button>
        </form>
    </div>
</div>


















    <section id="facturation-section" class="content-section">
        <h1>Facturation</h1>
        <p></p>
        
        <div class="facturation-container">
            <div class="facturation-box bar" onclick="toggleSection('bar-content')">
                <i class='bx bxs-wine'></i>
                <span>Bar</span>
            </div>
            <div class="facturation-box restaurant" onclick="toggleSection('restaurant-content')">
                <i class='bx bxs-store-alt'></i>
                <span>Restaurant</span>
            </div>
        </div>

        <div id="bar-content" class="facturation-content">
            <h2>Facturation du bar</h2>
            <!-- Custom Date Range Section -->
            <div id="custom-date-range" style="display:none;">
                <label for="start-date">Start Date:</label>
                <input type="date" id="start-date">
    
                <label for="end-date">End Date:</label>
                <input type="date" id="end-date">
    
                <button id="show-button">Show</button>
            </div>
            <div id="time-filter">
                <label for="time-range">Trier par:</label>
                <select id="time-range" onchange="filterBillingData()">
                    <option value="all">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="custom">Custom Date Range</option>
                </select>
            </div>
            <div id="bar-billing-grid" class="billing-grid"></div>
        </div>
    
        <div id="restaurant-content" class="facturation-content"> 
            <h2>Facturation des restaurants</h2>
            <div id="restaurant-time-filter">
                <label for="restaurant-time-range">Trier par:</label>
                <select id="restaurant-time-range" onchange="filterRestaurantBillingData()">
                    <option value="all">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="1month">Last 1 Month</option>
                    <option value="2months">Last 2 Months</option>
                    <option value="3months">Last 3 Months</option>
                    <option value="4months">Last 4 Months</option>
                    <option value="5months">Last 5 Months</option>
                    <option value="6months">Last 6 Months</option>
                    <option value="7months">Last 7 Months</option>
                    <option value="8months">Last 8 Months</option>
                    <option value="9months">Last 9 Months</option>
                    <option value="10months">Last 10 Months</option>
                    <option value="11months">Last 11 Months</option>
                    <option value="12months">Last 12 Months</option>
                </select>
            </div>
            <div id="restaurant-billing-grid" class="billing-grid"></div>
            <div id="no-data-message" style="display: none; color: red; text-align: center;">No data found for the selected date range.</div>
        </div>
    </section>





    <!-- Gestion des Employés Section -->
    <section id="gestion-employes-section" class="content-section">
        <h1>Gestion des Employés</h1>
        <p></p>

        <div style="display: flex; align-items: center; justify-content: space-between">

        <button id="add-employee-btn" class="add-stock-btn">
        <i class='bx bx-plus-circle'></i>
        Ajouter un employe
    </button>

    <button id="presence-employee-btn" class="add-stock-btn">
        <i class='bx bx-plus-circle'></i>
        Presence des employes
    </button>

        </div>


        <div id="attendance-modal" style="display: none;" class="modal">
    <div class="modal-content">
        <h2>Presence des Employés</h2>

        <!-- Tab navigation -->
        <div class="tab-nav">
            <button class="tab-btn active" data-tab="make-attendance">Faire l'Attendance</button>
            <button class="tab-btn" data-tab="view-attendance">Voir l'Attendance</button>
        </div>

        <!-- Tabs content -->
        <div id="make-attendance" class="tab-content active">
            <form id="attendance-form">
            <table id="employee-attendance-manage-table">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Attendance</th>
                            
                        </tr>
                    </thead>
                    <tbody id="manage-employee-list">
                        <!-- Employee list for managing attendance will be dynamically generated here -->
                    </tbody>
                </table>
                <button type="submit" class="save-btn">Save Attendance</button>
            </form>
        </div>

        <div id="view-attendance" class="tab-content">
            <label for="attendance-date">Select Date:</label>
            <input type="date" id="attendance-date" name="attendance-date">
            <button id="view-attendance-btn" class="save-btn">View Attendance</button>

            <table id="employee-attendance-table">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Attendance Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Attendance data will be dynamically loaded here -->
                </tbody>
            </table>
        </div>

        <button id="close-modal-btn" class="close-btn">Close</button>
    </div>
</div>



        <!--Employee modal-->
        <div id="employee-modal" class="modal">
        <div class="modal-content">
            <span id="close-employee" class="close">&times;</span>
            <h2>Ajouter un employe</h2>
            
            

            <form id="employee-form" method="POST">
    
    
    <div class="form-group">
        <label for="item-name">Nom:</label>
        <input type="text" id="nom" name="nom" required>
    </div>

    <div class="form-group">
        <label for="item-name">Prenom:</label>
        <input type="text" id="prenom" name="prenom" required>
    </div>

    <div class="form-group">
        <label for="item-name">Poste:</label>
        <input type="text" id="poste" name="poste" required>
    </div>


    <div class="form-group">
        <label for="item-price">Salaire:</label>
        <input type="number" step="0.01" id="salaire" name="salaire" required>
    </div>

    <div class="form-group">
        <label for="item-price">Numero du serveur:</label>
        <input type="number" id="numero_serveur" name="numero_serveur">
    </div>

    <div class="form-group">
        <label for="item-name">Date d'embauche:</label>
        <input type="date" id="date_embauche" name="date_embauche" required>
    </div>


    <button type="submit" class="submit-btn">Ajouter employe</button>
</form>
        </div>
    </div>



    <div id="employee-modal-update" class="modal">
        <div class="modal-content">
            <span id="close-employee" class="close">&times;</span>
            <h2>Mettre a jour les details</h2>
            
            

            <form id="employee-form-update" method="POST">
    
    
    <div class="form-group">
        <label for="item-name">Nom:</label>
        <input type="text" id="nom-update" name="nom" required>
    </div>

    <div class="form-group">
        <label for="item-name">Prenom:</label>
        <input type="text" id="prenom-update" name="prenom" required>
    </div>

    <div class="form-group">
        <label for="item-name">Poste:</label>
        <input type="text" id="poste-update" name="poste" required>
    </div>


    <div class="form-group">
        <label for="item-price">Salaire:</label>
        <input type="number" step="0.01" id="salaire-update" name="salaire" required>
    </div>

    <div class="form-group">
        <label for="item-price">Numero du serveur:</label>
        <input type="number" id="numero_serveur-update" name="numero_serveur">
    </div>

    <div class="form-group">
        <label for="item-name">Date d'embauche:</label>
        <input type="date" id="date_embauche-update" name="date_embauche" required>
    </div>


    <button type="submit" class="submit-btn">Mettre a jour</button>
</form>
        </div>
    </div>


    <div class="table-container" style="margin-top: 10px;">
    <table id="employee-table" class="display">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Poste</th>
                <th>Numero du serveur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here -->
        </tbody>
    </table>
</div>

    </section>








    <section id="gestion-equipement-section" class="content-section">
        <h1>Gestion des Equipements</h1>
        <p></p>

        <div style="display: flex; align-items: center; justify-content: space-between">
        <button id="add-equipment-btn" class="add-stock-btn">
                <i class='bx bx-plus-circle'></i>
                Ajouter equipement
                </button>

                <button id="add-complaints-btn" class="add-stock-btn" onclick="showGestionPlaintes()">
                <i class='bx bx-show'></i>
                    Voir rapport des equippements
                </button>

        </div>

                <div class="table-container" style="margin-top: 10px;">
    <table id="equipement-table" class="display">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Quantite</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here -->
        </tbody>
    </table>
</div>


<div id="equipement-modal" class="modal">
        <div class="modal-content">
            <span id="close-equipment" class="close">&times;</span>
            <h2>Ajouter un equipement</h2>
            
            

            <form id="equipement-form" method="POST">
    
    
    <div class="form-group">
        <label for="item-name">Nom de l'equipement:</label>
        <input type="text" id="nom_equipement" name="nom_equipement" required>
    </div>



    <div class="form-group">
        <label for="item-price">Quantite:</label>
        <input type="number" step="0.01" id="quantite" name="quantite" required>
    </div>



    <button type="submit" class="submit-btn">Ajouter equipement</button>
</form>
        </div>
    </div>




    <div id="equipement-modal-update" class="modal">
        <div class="modal-content">
            <span id="close-equipment" class="close">&times;</span>
            <h2>Ajouter un equipement</h2>
            
            

            <form id="equipement-form-update" method="POST">
    
    
    <div class="form-group">
        <label for="item-name">Nom de l'equipement:</label>
        <input type="text" id="nom_equipement-update" name="nom_equipement-update" required>
    </div>



    <div class="form-group">
        <label for="item-price">Quantite:</label>
        <input type="number" id="quantite-update" name="quantite-update" required>
    </div>



    <button type="submit" class="submit-btn">Modifier equipement</button>
</form>
        </div>
    </div>
    </section>

    <!--Complaints section-->

    <section id="complaints-section" class="content-section">
        <h1>Rapports des plaintes</h1>
        <div id="complaints-grid" class="complaints-grid">
        <p>Chargement des plaintes...</p>
    </div>


    </section>

    



    <!-- Rapports Section -->
    <section id="rapports-section" class="content-section">
        <h1>Rapports</h1>
        <p></p>
    </section>

    <div id="bar-section" class="content-section">
        <h2>Bar Data</h2>
        
        <!-- Sort by options -->
        <label for="sort-by">Trier par:</label>
        <select id="sort-by" onchange="fetchData()">
            <option value="date">Date</option>
            <option value="serveur">Serveur</option>
        </select>
    
        <!-- Date selection for sorting by date -->
        <div id="date-selection" style="display: block;">
            <label for="date-start">Date Début:</label>
            <input type="date" id="date-start">
            <label for="date-end">Date Fin:</label>
            <input type="date" id="date-end">
            
            <!-- Button to trigger data fetch -->
            <button type="button" onclick="fetchData()">
                <i class="bi bi-search"></i>
            </button>
        </div>
        
        <button id="export-to-excel" style="display:none;">Exporter vers Excel</button>
        <!-- Table to display data -->
        <table id="bar-data-table">
            <thead>
                <tr id="table-header">
                    <!-- Dynamic headers will be added here -->
               </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here -->
            </tbody>
        </table>
    </div>






    <div id="food-section" class="content-section">
        <h2>Resto Section</h2>
    </div>




    


    <div id="casse-section" class="content-section custom-complaint-form">
    <h2>Rapport de Casse ou de Perte</h2>
    <form action="complaints/submit_complaint.php" method="POST" id="complaint-form" enctype="multipart/form-data">
        <div class="form-section">
            <div class="left">
                <label for="manager-name"><i class="bx bx-user-circle"></i> Nom du responsable :</label>
                <input type="text" id="manager-name" name="manager_name" required>

                <label for="specific-item"><i class="bx bx-cube"></i> Matériau ou article spécifique :</label>
                <input type="text" id="specific-item" name="specific_item" required>

                <label for="impact"><i class="bx bx-flag"></i> Impact :</label>
                <input type="text" id="impact" name="impact">

                <label for="complaint-description"><i class="bx bx-message"></i> Description de la plainte :</label>
                <textarea id="complaint-description" name="complaint_description" rows="4" required></textarea>
            </div>

            <div class="right">
                <label for="complaint-category"><i class="bx bx-category"></i> Catégorie de plainte :</label>
                <select id="complaint-category" name="complaint_category" required>
                    <option value="missing_materials">Matériaux manquants</option>
                    <option value="lost_items">Articles perdus</option>
                    <option value="quality_issues">Problèmes de qualité</option>
                    <option value="customer_complaints">Plaintes des clients</option>
                    <option value="autres">Autres</option>
                </select>
                <label for="incident-date-time"><i class="bx bx-calendar"></i> Date et heure :</label>
                <input type="datetime-local" id="incident-date-time" name="incident_date_time" required>

                <label for="cause"><i class="bx bx-purchase-tag"></i> Cause (si connue) :</label>
                <input type="text" id="cause" name="cause">
                
                <label for="incident-location"><i class="bx bx-location-plus"></i> Lieu de l'incident :</label>
                <input type="text" id="incident-location" name="incident_location" required>

                <label for="attachments"><i class="bx bx-image"></i> Pièces jointes :</label>
                <input type="file" id="attachments" name="attachments[]" multiple>

                <label for="employee-comments"><i class="bx bx-comment"></i> Commentaires de l'employé :</label>
                <textarea id="employee-comments" name="employee_comments" rows="4"></textarea>
            </div>
        </div>
        <div class="button-container">
            <button type="submit"><i class="bx bx-send"></i> Soumettre le rapport</button>
        </div>
    </form>
</div>







</main>
</section>
	<!-- CONTENT -->
	
	<script src="script_1.js"></script>
    <script src="script.js"></script>
    <script src="script2.js"></script>
    <script>
        
// Function to update the price and total for each row, and update the grand total
function updatePriceAndTotal(row) {
    const drinkSelect = row.querySelector(".drink-select");
    const quantityInput = row.querySelector(".quantity");
    const priceCell = row.querySelector(".unit-price");
    const totalCell = row.querySelector(".total-price");

    // Get the selected drink's price
    const selectedOption = drinkSelect.options[drinkSelect.selectedIndex];
    const price = parseFloat(selectedOption.getAttribute("data-price"));
    const quantity = parseInt(quantityInput.value);

    // Update the price and total cells for the current row
    priceCell.textContent = price ? price + " FBU" : "0 FBU";
    totalCell.textContent = (price * quantity) + " FBU"; // Total for this row

    // Update the grand total after modifying a row
    updateGrandTotal();
}

// Function to update the total price of all drinks selected
function updateGrandTotal() {
    let grandTotal = 0;

    // Get all the total-price cells
    const totalCells = document.querySelectorAll(".total-price");

    totalCells.forEach(cell => {
        // Remove the " FBU" and parse the value to float
        const total = parseFloat(cell.textContent.replace(" FBU", ""));
        if (!isNaN(total)) {
            grandTotal += total; // Sum up the total prices
        }
    });

// Update the grand total display
document.getElementById("drink-total-price").textContent = grandTotal + " FBU";
}

// Function to add a new drink row
function addDrinkRow() {
    const tableBody = document.querySelector("#drink-table tbody");
    const newRow = document.createElement("tr");

    // Create the row content
    newRow.innerHTML = `
        <td>
            <select class="drink-select" onchange="updatePriceAndTotal(this.closest('tr'))">
                <option value="" disabled selected>-- Sélectionner --</option>
                <?php foreach ($drinks as $drink): ?>
                    <option value="<?= $drink['nom_boisson'] ?>" data-price="<?= $drink['prix_achat'] ?>"><?= htmlspecialchars($drink['nom_boisson']) ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <td><input type="number" class="quantity" min="1" value="1" oninput="updatePriceAndTotal(this.closest('tr'))"></td>
        <td class="unit-price">0 FBU</td>
        <td class="total-price">0 FBU</td>
        <td><button onclick="removeRow(this)" style="background: none; border: none; cursor: pointer;">
        <i class="bx bxs-trash" style="font-size: 20px; color: red;"></i>
        </button></td>

    `;

    tableBody.appendChild(newRow); // Append the new row to the table body
    updateGrandTotal(); // Update the grand total after adding a row
}

// Function to remove a row and recalculate the total
function removeRow(button) {
    const row = button.closest('tr');
    row.remove();
    updateGrandTotal(); // Recalculate the grand total after row removal
}
    </script>
</body>
</html>