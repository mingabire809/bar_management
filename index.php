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
    
</ul>

    <ul class="side-menu">
        <li>
            <a href="#" data-target="rapports-section">
                <i class='bx bxs-report'></i>
                <span class="text">Rapports</span>
            </a>
        </li>
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
            
            

            <form id="stock-form" method="POST">
    
    
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


    <button type="submit" class="submit-btn">Ajouter produit</button>
</form>
        </div>
    </div>

    <div class="table-container" style="margin-top: 10px;">
    <table id="stock-table" class="display">
        <thead>
            <tr>
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

        <form id="stock-form-update" method="POST">
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

            <button type="submit" class="submit-btn">Mettre à jour</button>
        </form>
    </div>
</div>
    </section>

        

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

        <button id="add-employee-btn" class="add-stock-btn">
        <i class='bx bx-plus-circle'></i>
        Ajouter un employe
    </button>


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