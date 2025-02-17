<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_1.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

<!-- jQuery (necessary for DataTables) -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


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
        <li>
            <a href="#" data-target="rapports-section">
                <i class='bx bxs-report'></i>
                <span class="text">Rapports</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="#" class="logout" id="logout-link">
                <i class='bx bxs-log-out'></i> <!-- Logout icon -->
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- Main Content Section -->
<main id="main-content">
    <!-- Dashboard Section -->
    
    <section id="dashboard-section" class="content-section">
        <h1>Dashboard</h1>
        <p>Welcome to your Dashboard!</p>
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
            <div class="dashboard-box" id="box-rapports" onclick="showSection('rapports-section')">
                <i class='bx bxs-report'></i>
                <span>Rapports</span>
            </div>
        </div>
    </section>


    <!-- Gestion Commandes Section -->
    <section id="gestion-commandes-section" class="content-section">
        <h1>Gestion Commandes</h1>
        <p>Here you can manage orders.</p>
    </section>

    <!-- Gestion Stock Section -->
    <section id="gestion-stock-section" class="content-section">
        <h1>Gestion Stock</h1>
        <p>Manage your stock here.</p>

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
        <p>Here you can manage orders.</p>


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
        <input type="number" id="item-quantity" name="quantity" required>
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
                <input type="number" id="item-quantity-update" name="quantity" required>
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
        <p>Here you can manage orders.</p>

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


        

    <script src="script_1.js">


    </script>

    <!-- Facturation Section -->
    <section id="facturation-section" class="content-section">
        <h1>Facturation</h1>
        <p>Manage billing here.</p>
    </section>

    <!-- Gestion des Employés Section -->
    <section id="gestion-employes-section" class="content-section">
        <h1>Gestion des Employés</h1>
        <p>Manage your employees here.</p>

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

    <!-- Gestion des Employés Section -->
    <section id="gestion-equipement-section" class="content-section">
        <h1>Gestion des Equipements</h1>
        <p>Manage your equipments here.</p>

        <button id="add-equipment-btn" class="add-stock-btn">
                <i class='bx bx-plus-circle'></i>
                Ajouter equipement
                </button>

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
    </section>


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




    <!-- Rapports Section -->
    <section id="rapports-section" class="content-section">
        <h1>Rapports</h1>
        <p>View reports here.</p>
    </section>
</main>

	</section>
	<!-- CONTENT -->
	
	<script src="script.js"></script>

</body>
</html>