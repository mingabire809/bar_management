<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "g_bar";

// Establish database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize default date range
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : "";
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : "";

// Prepare the base SQL query
$query = "SELECT * FROM gestion_commande_kitchen";
$params = [];
$types = "";

// Check if both dates are provided
if (!empty($start_date) && !empty($end_date)) {
    $query .= " WHERE date_commande BETWEEN ? AND ?";
    $params = [$start_date, $end_date];
    $types = "ss"; // Define parameter types (both are strings)
}

// Prepare statement
$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Title of the page -->
<h2 id="pageTitle">Resto Data</h2>

<!-- Date Range Filter Form -->
<form method="POST" id="filterForm">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($start_date) ?>">
    
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="<?= htmlspecialchars($end_date) ?>">

    <button type="submit">
        <i class="bi bi-search"></i> Search
    </button>
</form>

<!-- Export to Excel Button -->
<a href="#" id="export-to-excel" style="margin-bottom: 10px; padding: 8px 15px; background-color: #4CAF50; color: white; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">
    Exporter vers Excel
</a>

<!-- Display Table -->
<table id="resto-table">
    <thead>
        <tr>   
            <th>N°Serveur</th>
            <th>Plat</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Total</th>
            <th>Table</th>
            <th>N° Facture</th>
            <th>Statut Paiement</th>
            <th>Mode Paiement</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Set the style for statut_paiement based on its value
                $statut_style = "";
                $statut_text = $row['statut_paiement'];
                if (strtolower($statut_text) == "paid") {
                    $statut_style = "color: green; font-weight: bold;";
                } elseif (strtolower($statut_text) == "unpaid" || strtolower($statut_text) == "pending") {
                    $statut_style = "color: red; font-weight: bold;";
                } else {
                    $statut_style = "font-weight: bold;";
                }

                echo "<tr>
                        <td>{$row['numero_serveur']}</td>
                        <td>{$row['nom_plat']}</td>
                        <td>{$row['quantite']}</td>
                        <td>{$row['prix']}</td>
                        <td>{$row['total_price']}</td>
                        <td>{$row['numero_table']}</td>
                        <td>{$row['numero_facture']}</td>
                        <td style='{$statut_style}'>{$statut_text}</td>
                        <td>{$row['mode_paiement']}</td>
                        <td>{$row['date_commande']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No records found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$stmt->close();
$conn->close();
?>

<!-- Include the XLSX.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<!-- Script for exporting the table to Excel -->
<script>
document.getElementById('export-to-excel').addEventListener('click', function (event) {
    event.preventDefault();  // Prevent the default anchor tag behavior (navigating to #)

    var table = document.getElementById('resto-table');
    var wb = XLSX.utils.table_to_book(table, { sheet: "Sheet 1" });
    XLSX.writeFile(wb, 'resto_data.xlsx');
});
</script>

<style>
#export-to-excel:hover {
    background-color: #45a049;
    transform: scale(1.05);
}
</style>
