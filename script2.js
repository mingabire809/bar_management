function openKitchenOrderModal() {
    document.getElementById("kitchen-order-modal").style.display = "block";
    loadKitchenItems(); // Load kitchen items when modal is opened
}

function closeKitchenOrderModal() {
    document.getElementById("kitchen-order-modal").style.display = "none";
}

let kitchenOrders = [];
let currentKitchenStep = 1;

// Function to fetch kitchen plats from the database
async function fetchKitchenPlats() {
    try {
        let response = await fetch("G_Resto/fetch_kitchen_plats.php"); // Fetch plats from the PHP script
        let plats = await response.json();
        return plats;
    } catch (error) {
        console.error("Error fetching plats:", error);
        return [];
    }
}

// Function to add a new row for kitchen orders
async function addKitchenRow() {
    const plats = await fetchKitchenPlats();
    const tableBody = document.querySelector("#kitchen-table tbody"); // Select table body
    const row = document.createElement("tr"); // Create new row

    // Create row content with fetched plats
    row.innerHTML = `
        <td>
            <select class="kitchen-item-name" onchange="updateKitchenPriceAndTotal(this.closest('tr'))" required>
                <option value="" disabled selected>-- Sélectionner --</option>
                ${plats.map(plat => `<option value="${plat.nom_ingredient}" data-price="${plat.prix_achat}">${plat.nom_ingredient}</option>`).join('')}
            </select>
        </td>
        <td><input type="number" class="kitchen-item-quantity" value="1" min="1" oninput="updateKitchenPriceAndTotal(this.closest('tr'))" required></td>
        <td class="kitchen-item-price">0 FBU</td>
        <td class="kitchen-item-total">0 FBU</td>
        <td>
            <button onclick="removeKitchenRow(this)" style="background: none; border: none; cursor: pointer;">
                <i class="bx bxs-trash" style="font-size: 20px; color: red;"></i>
            </button>
        </td>
    `;

    tableBody.appendChild(row); // Append row to table body
}

// Function to update price and total for a row
function updateKitchenPriceAndTotal(row) {
    const platSelect = row.querySelector(".kitchen-item-name");
    const quantityInput = row.querySelector(".kitchen-item-quantity");
    const priceCell = row.querySelector(".kitchen-item-price");
    const totalCell = row.querySelector(".kitchen-item-total");

    // Get selected plat's price
    const selectedOption = platSelect.options[platSelect.selectedIndex];
    const price = parseFloat(selectedOption.getAttribute("data-price")) || 0;
    const quantity = parseInt(quantityInput.value) || 1;

    // Update price and total
    priceCell.textContent = price + " FBU";
    totalCell.textContent = (price * quantity) + " FBU";

    updateKitchenTotalPrice(); // Update grand total
}

// Function to update the total price of all kitchen items
function updateKitchenTotalPrice() {
    let total = 0;
    document.querySelectorAll(".kitchen-item-total").forEach(cell => {
        total += parseFloat(cell.textContent.replace(" FBU", "")) || 0;
    });
    document.querySelector("#kitchen-total-price").textContent = total + " FBU";
}

// Function to remove a row and update the total price
function removeKitchenRow(button) {
    button.closest("tr").remove();
    updateKitchenTotalPrice();
}

function nextKitchenStep() {
    document.querySelector("#kitchen-step-1").style.display = "none";
    document.querySelector("#kitchen-step-2").style.display = "block";
    document.querySelector("#kitchen-step-circle").innerText = "";
    generateKitchenOrderSummary();
}

function prevKitchenStep() {
    document.querySelector("#kitchen-step-1").style.display = "block";
    document.querySelector("#kitchen-step-2").style.display = "none";
    document.querySelector("#kitchen-step-circle").innerText = "1";
}

// Function to generate the Kitchen Order Summary
function generateKitchenOrderSummary() {
    const summaryDiv = document.getElementById("kitchen-order-summary");
    summaryDiv.innerHTML = "";  // Clear existing content

    // Business Information
    const businessInfo = `
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; margin-top: -60px;">
            <img src="logo/logo.png" alt="Logo" id="invoice-logo" style="width: 220px; height: auto;">
            <div style="text-align: right;">
                <p>Adresse: Gasenyi, Q. Taba</p>
                <p>Téléphone: +25779232041</p>
            </div>
        </div>
        <hr style="border-top: 2px solid #000;">
    `;
    summaryDiv.innerHTML += businessInfo;

    // Retrieve table number and server number from Step 1
    const tableNumber = document.getElementById("kitchen-table-number").value || "N/A";
    const serverNumber = document.getElementById("kitchen-server-number").value || "N/A";

    // Generate unique invoice number
    let invoiceNumber = `CUIS#${Math.floor(Math.random() * 1000000)}`;
    while (checkInvoiceExists(invoiceNumber)) {
        invoiceNumber = `CUIS#${Math.floor(Math.random() * 1000000)}`;
    }

    // Date and Time
    const now = new Date();
    const date = now.toLocaleDateString();
    const time = now.toLocaleTimeString();

    // Invoice Information
    const invoiceInfo = `
        <div style="padding: 10px 0; font-size: 14px;">
            <p><strong>Date:</strong> ${date} <strong>Heure:</strong> ${time}</p>
            <p><strong>Numéro de Serveur:</strong> ${serverNumber}</p>
            <p><strong>Numéro de Table:</strong> ${tableNumber}</p>
            <p><strong>Numéro de Facture:</strong> ${invoiceNumber}</p>
        </div>
        <hr style="border-top: 2px dashed #ccc;">
    `;
    summaryDiv.innerHTML += invoiceInfo;

    // Order Table (Kitchen Orders)
    const tableRows = document.querySelectorAll("#kitchen-table tbody tr");

    if (tableRows.length > 0) {
        let orderTable = `
            <p class="ordered-items-heading" style="margin-top: 10px; font-weight: bold;">Articles commandés:</p>
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="background-color: #f4f4f4;">
                        <th style="border: 1px solid #000; padding: 8px;">Plat</th>
                        <th style="border: 1px solid #000; padding: 8px;">Quantité</th>
                        <th style="border: 1px solid #000; padding: 8px;">Prix Unitaire</th>
                        <th style="border: 1px solid #000; padding: 8px;">Total</th>
                    </tr>
                </thead>
                <tbody>
        `;

        tableRows.forEach(row => {
            const dishElement = row.querySelector(".kitchen-item-name");
            const quantityElement = row.querySelector(".kitchen-item-quantity");
            const unitPriceElement = row.querySelector(".kitchen-item-price");
            const totalElement = row.querySelector(".kitchen-item-total");

            // Ensure elements exist before retrieving values
            if (dishElement && quantityElement && unitPriceElement && totalElement) {
                const dish = dishElement.options[dishElement.selectedIndex]?.text || "N/A";
                const quantity = quantityElement.value;
                const unitPrice = unitPriceElement.textContent;
                const total = totalElement.textContent;

                orderTable += `
                    <tr>
                        <td style="border: 1px solid #000; padding: 8px;">${dish}</td>
                        <td style="border: 1px solid #000; padding: 8px; text-align: center;">${quantity}</td>
                        <td style="border: 1px solid #000; padding: 8px; text-align: right;">${unitPrice}</td>
                        <td style="border: 1px solid #000; padding: 8px; text-align: right;">${total}</td>
                    </tr>
                `;
            }
        });

        orderTable += `
                </tbody>
            </table>
            <hr style="border-top: 2px dashed #ccc; margin-top:25px;">
        `;
        summaryDiv.innerHTML += orderTable;
    } else {
        summaryDiv.innerHTML += "<p>Aucun plat sélectionné.</p>";
    }

    // Total Price
    const totalPriceElement = document.getElementById("kitchen-total-price");
    const totalPrice = totalPriceElement ? totalPriceElement.textContent : "0";
    summaryDiv.innerHTML += `<p style="font-size: 16px; font-weight: bold;">Total: ${totalPrice}</p>`;

    // Payment Status and Mode
    const paymentStatus = `
        <div class="payment-container">
            <div class="payment-status">
                <p><strong>Statut de Paiement:</strong></p>
                <select id="payment-status" onchange="updatePaymentStatusColor()">
                    <option value="pending" style="color: black;" selected>en attente</option>
                    <option value="paid">Payé</option>
                    <option value="unpaid">Non Payé</option>
                </select>
            </div>
            <div class="payment-mode">
                <p><strong>Mode de Paiement:</strong></p>
                <select id="payment-mode">
                    <option value="pending">-</option>
                    <option value="cash">Cash</option>
                    <option value="lumicash">Lumicash</option>
                    <option value="card">Carte</option>
                </select>
            </div>
        </div>
    `;
    summaryDiv.innerHTML += paymentStatus;
}

// Mock function to check if invoice number exists (replace with actual logic for real database)
function checkInvoiceExists(invoiceNumber) {
    return false;
}

// Function to update the color of the payment status
function updatePaymentStatusColor() {
    const paymentStatus = document.getElementById("payment-status");
    const status = paymentStatus.value;

    if (status === "paid") {
        paymentStatus.style.color = "green";
    } else if (status === "unpaid") {
        paymentStatus.style.color = "red";
    } else {
        paymentStatus.style.color = "black";
    }
}














async function submitKitchenOrder() {
    const serverNumber = document.getElementById("kitchen-server-number").value || "N/A";
    const tableNumber = document.getElementById("kitchen-table-number").value || "N/A";
    const paymentStatus = document.getElementById("payment-status").value || "pending";
    const paymentMode = document.getElementById("payment-mode").value || "pending";
    const totalPrice = document.querySelector("#kitchen-total-price").textContent.replace(" FBU", "").trim();
    
    // Prepare kitchen items from the order table
    const kitchenItems = [];
    const tableRows = document.querySelectorAll("#kitchen-table tbody tr");

    tableRows.forEach(row => {
        const platSelect = row.querySelector(".kitchen-item-name");
        const quantityInput = row.querySelector(".kitchen-item-quantity");
        const unitPriceElement = row.querySelector(".kitchen-item-price");
        const totalCell = row.querySelector(".kitchen-item-total");

        // Get selected plat details
        const dish = platSelect.options[platSelect.selectedIndex]?.text || "N/A";
        const quantity = quantityInput.value;
        const unitPrice = unitPriceElement.textContent;
        const total = totalCell.textContent.replace(" FBU", "").trim();

        kitchenItems.push({ dish, quantity, unitPrice, total });
    });

    // Generate unique invoice number
    let invoiceNumber = `CUIS#${Math.floor(Math.random() * 1000000)}`;
    while (await checkInvoiceExists(invoiceNumber)) {
        invoiceNumber = `CUIS#${Math.floor(Math.random() * 1000000)}`;
    }

    // Prepare the data for the backend
    const data = {
        kitchenItems,
        serverNumber,
        tableNumber,
        invoiceNumber,
        totalPrice,
        paymentStatus,
        paymentMode,
    };

    // Send the data to the PHP script via fetch
    try {
        const response = await fetch('G_Resto/insert_kitchen_order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });

        const result = await response.json();
        if (result.success) {
            alert("Commande confirmée avec succès, merci !");
            closeKitchenOrderModal(); // Close the modal after submitting
        } else {
            alert("Failed to submit order. Please try again.");
        }
    } catch (error) {
        console.error("Error submitting order:", error);
        alert("An error occurred while submitting the order.");
    }
}
9


