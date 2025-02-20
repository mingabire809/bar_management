const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})


document.addEventListener("DOMContentLoaded", function () {
    // Get all the sidebar links
    const sidebarLinks = document.querySelectorAll(".side-menu a");

    // Get all the content sections
    const sections = document.querySelectorAll(".content-section");

    // Function to show the selected section and hide others
    function showSection(id) {
        // Hide all sections
        sections.forEach(section => section.classList.remove("active"));

        // Show the selected section
        const selectedSection = document.getElementById(id);
        selectedSection.classList.add("active");
        
        // Highlight the active sidebar link
        sidebarLinks.forEach(link => link.classList.remove("active"));
        document.getElementById(id + "-link").classList.add("active");
    }

    // Add click event listeners to the sidebar links
    sidebarLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();  // Prevent default link behavior
            const sectionId = link.id.replace("-link", "-section");
            showSection(sectionId);
        });
    });

    // Initially, display the dashboard section
    showSection("dashboard-section");
    });


	document.addEventListener("DOMContentLoaded", function () {
    // Get the dark mode switch
    const darkModeSwitch = document.getElementById('switch-mode');

    // Add event listener to toggle dark mode
    darkModeSwitch.addEventListener('change', function () {
        document.body.classList.toggle('dark-mode', this.checked);
    });

    // Get all the sidebar links
    const sidebarLinks = document.querySelectorAll(".side-menu a");

    // Get all the content sections
    const sections = document.querySelectorAll(".content-section");

    // Function to show the selected section and hide others
    function showSection(id) {
        // Hide all sections
        sections.forEach(section => section.classList.remove("active"));

        // Show the selected section
        const selectedSection = document.getElementById(id);
        selectedSection.classList.add("active");

        // Highlight the active sidebar link
        sidebarLinks.forEach(link => link.classList.remove("active"));
        document.getElementById(id + "-link").classList.add("active");
    }

    // Add click event listeners to the sidebar links
    sidebarLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();  // Prevent default link behavior
            const sectionId = link.id.replace("-link", "-section");
            showSection(sectionId);
        });
    });

    // Initially, display the dashboard section
    showSection("dashboard-section");
    });

    function scrollToSection(sectionId) {
    document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
}




function showSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.content-section').forEach(section => {
        section.style.display = 'none';
    });

    // Show the selected section
    document.getElementById(sectionId).style.display = 'block';
}

// Hide all sections initially except the first one
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.content-section').forEach((section, index) => {
        section.style.display = index === 0 ? 'block' : 'none';
    });
});




function showSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.content-section').forEach(section => {
        section.style.display = 'none';
    });

    // Show the selected section
    document.getElementById(sectionId).style.display = 'block';

    // Remove active class from all sidebar links
    document.querySelectorAll('.side-menu li').forEach(item => {
        item.classList.remove('active');
    });

    // Add active class to the clicked sidebar link
    document.querySelector(`[data-target="${sectionId}"]`)?.parentElement.classList.add('active');
}

// Ensure sidebar links trigger the function
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".side-menu a").forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default link behavior
            const sectionId = this.getAttribute("data-target");
            if (sectionId) {
                showSection(sectionId);
            }
        });
    });

    // Ensure dashboard boxes also trigger the function
    document.querySelectorAll(".dashboard .box").forEach(box => {
        box.addEventListener("click", function() {
            const sectionId = this.getAttribute("data-target");
            if (sectionId) {
                showSection(sectionId);
            }
        });
    });

    // Show the first section by default
    document.querySelectorAll('.content-section').forEach((section, index) => {
        section.style.display = index === 0 ? 'block' : 'none';
    });
});



// This function will be called when you click the Gestion Commandes section
function showGestionCommandes() {
    document.getElementById("gestion-commandes-section").style.display = "block";
    // Optionally, hide other sections
}












let isBoissonVisible = false; // To track the visibility state of the Boisson content
let isKitchenVisible = false; // To track the visibility state of the Kitchen content

// Function to toggle visibility of the boxes and content
function toggleBox(boxType) {
    const boissonDetailsContainer = document.getElementById('boisson-details-container');
    const kitchenDetailsContainer = document.getElementById('kitchen-details-container');
    const boxBoisson = document.getElementById('box-boisson');
    const boxKitchen = document.getElementById('box-kitchen');

    // When the Boisson box is clicked
    if (boxType === 'boisson') {
        if (isBoissonVisible) {
            // Hide Boisson details and show both Boisson and Kitchen boxes
            boissonDetailsContainer.style.display = 'none';
            boxBoisson.style.display = 'inline-block';
            boxKitchen.style.display = 'inline-block';
        } else {
            // Show Boisson details and hide Kitchen box
            boissonDetailsContainer.style.display = 'block';
            kitchenDetailsContainer.style.display = 'none'; // Hide Kitchen details
            boxBoisson.style.display = 'inline-block';
            boxKitchen.style.display = 'none';
        }
        // Toggle the visibility state for Boisson
        isBoissonVisible = !isBoissonVisible;
        isKitchenVisible = false; // Reset Kitchen visibility
    }

    // When the Kitchen box is clicked
    if (boxType === 'kitchen') {
        if (isKitchenVisible) {
            // Hide Kitchen details and show both Boisson and Kitchen boxes
            kitchenDetailsContainer.style.display = 'none';
            boxBoisson.style.display = 'inline-block';
            boxKitchen.style.display = 'inline-block';
        } else {
            // Show Kitchen details and hide Boisson box
            kitchenDetailsContainer.style.display = 'block';
            boissonDetailsContainer.style.display = 'none'; // Hide Boisson details
            boxBoisson.style.display = 'none';
            boxKitchen.style.display = 'inline-block';
        }
        // Toggle the visibility state for Kitchen
        isKitchenVisible = !isKitchenVisible;
        isBoissonVisible = false; // Reset Boisson visibility
    }
}







function showOrderForm() {
    document.getElementById('order-modal').style.display = 'block';
}

function closeOrderForm() {
    document.getElementById('order-modal').style.display = 'none';
}

// Function to update total price when quantity is changed
function updatePrice() {
    let selectedDrink = document.getElementById("drink-select");
    let price = selectedDrink.options[selectedDrink.selectedIndex].getAttribute("data-price");
    let quantity = document.getElementById("quantity").value;
    let total = price * quantity;
    document.getElementById("total-price").innerText = total + " FBU";
}

function updateTotal() {
    updatePrice();
}

// Move to Step 2 (Verification)
function nextStep() {
    let drink = document.getElementById("drink-select").value;
    let quantity = document.getElementById("quantity").value;
    let table = document.getElementById("table-number").value;
    let server = document.getElementById("server-number").value;
    let total = document.getElementById("total-price").innerText;

    if (!drink || !quantity || !table || !server) {
        alert("Veuillez remplir tous les champs.");
        return;
    }

    // Populate verification step
    document.getElementById("verify-drink").innerText = drink;
    document.getElementById("verify-quantity").innerText = quantity;
    document.getElementById("verify-table").innerText = table;
    document.getElementById("verify-server").innerText = server;
    document.getElementById("verify-total").innerText = total;

    document.getElementById("order-step-1").style.display = "none";
    document.getElementById("order-step-2").style.display = "block";
}

// Go back to Step 1
function prevStep() {
    document.getElementById("order-step-2").style.display = "none";
    document.getElementById("order-step-1").style.display = "block";
}

// Submit Order to Database
function submitOrder() {
    let drink = document.getElementById("verify-drink").innerText;
    let quantity = document.getElementById("verify-quantity").innerText;
    let table = document.getElementById("verify-table").innerText;
    let server = document.getElementById("verify-server").innerText;
    let total = document.getElementById("verify-total").innerText;

    let formData = new FormData();
    formData.append("drink", drink);
    formData.append("quantity", quantity);
    formData.append("table", table);
    formData.append("server", server);
    formData.append("total", total);

    fetch("submit_order.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        closeOrderForm();
    })
    .catch(error => console.error("Error:", error));
}








// Open & Close Modal
function openOrderModal() {
    // Now open the modal as a fresh modal
    document.getElementById("drink-order-modal").style.display = "flex";
}

// Function to close the "openOrderModal"
function closeOrderModal() {
    document.getElementById("drink-order-modal").style.display = "none";
}

// Step Navigation
function nextStep() {
    document.getElementById("drink-step-1").style.display = "none";
    document.getElementById("drink-step-2").style.display = "block";
    document.getElementById("drink-step-circle").textContent = "";

    generateOrderSummary();
}

// Function to go to previous step in the modal
function prevStep() {
    document.getElementById("drink-step-2").style.display = "none"; // Hide step 2
    document.getElementById("drink-step-1").style.display = "block"; // Show step 1
    document.getElementById("drink-step-circle").textContent = "1"; // Reset step circle to 1
}

// Update Price Based on Selection
function updatePrice(selectElement) {
    let selectedOption = selectElement.options[selectElement.selectedIndex];
    let price = selectedOption.getAttribute("data-price");
    let row = selectElement.parentElement.parentElement;

    row.querySelector(".unit-price").textContent = price + " FBU";
    updateTotal(row.querySelector(".quantity"));
}

// Update Total Price When Quantity Changes
function updateTotal(inputElement) {
    let row = inputElement.parentElement.parentElement;
    let unitPrice = parseFloat(row.querySelector(".unit-price").textContent);
    let quantity = parseInt(inputElement.value);
    let totalPrice = unitPrice * quantity;

    row.querySelector(".total-price").textContent = totalPrice + " FBU";
    updateGrandTotal();
}

// Update Grand Total Price
function updateGrandTotal() {
    let totalPrices = document.querySelectorAll(".total-price");
    let grandTotal = 0;

    totalPrices.forEach(price => {
        grandTotal += parseFloat(price.textContent);
    });

    document.getElementById("drink-total-price").textContent = grandTotal + " FBU";
}

// Remove a Drink Row
function removeRow(button) {
    button.parentElement.parentElement.remove();
    updateGrandTotal();
}

// Generate Order Summary in Step 2
function generateOrderSummary() {
    let summaryDiv = document.getElementById("drink-order-summary");
    summaryDiv.innerHTML = "";

    // Retrieve table number and server number from Step 1
    let tableNumber = document.getElementById("drink-table-number").value;
    let serverNumber = document.getElementById("drink-server-number").value;

    // Add table and server information to the summary
    summaryDiv.innerHTML += `<p><strong>Numéro de Table:</strong> ${tableNumber}</p>`;
    summaryDiv.innerHTML += `<p><strong>Numéro du Serveur:</strong> ${serverNumber}</p>`;

    // Retrieve drink order details
    let tableRows = document.querySelectorAll("#drink-table tbody tr");
    tableRows.forEach(row => {
        let drink = row.querySelector(".drink-select").value;
        let quantity = row.querySelector(".quantity").value;
        let total = row.querySelector(".total-price").textContent;

        // Add each drink's details to the summary
        summaryDiv.innerHTML += `<p><strong>${drink}</strong>: ${quantity} unités - ${total}</p>`;
    });

    // Add total price to the summary
    summaryDiv.innerHTML += `<p><strong>Total: </strong> ${document.getElementById("drink-total-price").textContent}</p>`;
}


// Generate Order Summary in Step 2
function generateOrderSummary() {
    const summaryDiv = document.getElementById("drink-order-summary");
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
    const tableNumber = document.getElementById("drink-table-number").value;
    const serverNumber = document.getElementById("drink-server-number").value;

    // Generate unique invoice number
    let invoiceNumber = `BOIS#${Math.floor(Math.random() * 1000000)}`;
    while (checkInvoiceExists(invoiceNumber)) {
        invoiceNumber = `BOIS#${Math.floor(Math.random() * 1000000)}`;  // Regenerate if exists
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

    // Order Table (Drink Orders)
    const tableRows = document.querySelectorAll("#drink-table tbody tr");
    if (tableRows.length > 0) {
        let orderTable = `
            <p class="ordered-items-heading" style="margin-top: 10px; font-weight: bold;">Articles commandés:</p>
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="background-color: #f4f4f4;">
                        <th style="border: 1px solid #000; padding: 8px;">Boisson</th>
                        <th style="border: 1px solid #000; padding: 8px;">Quantité</th>
                        <th style="border: 1px solid #000; padding: 8px;">Prix Unitaire</th>
                        <th style="border: 1px solid #000; padding: 8px;">Total</th>
                    </tr>
                </thead>
                <tbody>
        `;

        tableRows.forEach(row => {
            const drink = row.querySelector(".drink-select").value;
            const quantity = row.querySelector(".quantity").value;
            const unitPrice = row.querySelector(".unit-price").textContent;
            const total = row.querySelector(".total-price").textContent;

            orderTable += `
                <tr>
                    <td style="border: 1px solid #000; padding: 8px;">${drink}</td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">${quantity}</td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: right;">${unitPrice}</td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: right;">${total}</td>
                </tr>
            `;
        });

        orderTable += `
                </tbody>
            </table>
            <hr style="border-top: 2px dashed #ccc; margin-top:25px;">
        `;
        summaryDiv.innerHTML += orderTable;
    } else {
        summaryDiv.innerHTML += "<p>Aucune boisson sélectionnée.</p>";
    }

    // Total Price
    const totalPrice = document.getElementById("drink-total-price").textContent;
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
            </select>
            </div>
        </div>
    `;
    summaryDiv.innerHTML += paymentStatus;
}

// Mock function to check if invoice number exists (replace with actual logic for real database)
function checkInvoiceExists(invoiceNumber) {
    // For now, assuming no invoice exists. In a real scenario, check in the database.
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
    }
}











document.addEventListener('DOMContentLoaded', function() {
    const profileLink = document.getElementById('profile-link');
    const profileModal = document.getElementById('profile-modal');
    const closeModal = document.querySelector('.close-profile-modal');

    profileLink.addEventListener('click', function(event) {
        event.preventDefault();
        // Fetch user data from the server
        fetchUserData().then(userData => {
            // Populate modal with user data
            document.getElementById('profile-pic').src = userData.profilePic;
            document.getElementById('profile-username').textContent = userData.username;
            document.getElementById('profile-email').textContent = userData.email;
            document.getElementById('profile-role').textContent = userData.role;
            // Display the modal
            profileModal.style.display = 'block';
        });
    });

    closeModal.addEventListener('click', function() {
        profileModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === profileModal) {
            profileModal.style.display = 'none';
        }
    });

    async function fetchUserData() {
        // Replace with actual data fetching logic
        return {
            profilePic: 'users/Profiles/dellyboo.png',
            username: 'i\'am Dellyboo',
            email: 'dellyboo@example.com',
            role: 'Administrator'
        };
    }    
});
























// Function to send drink order data to the backend
function submitOrder() {
    let tableNumber = document.getElementById("drink-table-number").value;
    let serverNumber = document.getElementById("drink-server-number").value;
    let totalPrice = document.getElementById("drink-total-price").textContent;
    let paymentStatus = document.getElementById("payment-status").value;
    let paymentMode = document.getElementById("payment-mode").value;

    let drinks = [];
    let tableRows = document.querySelectorAll("#drink-table tbody tr");

    tableRows.forEach(row => {
        let drink = row.querySelector(".drink-select").value;
        let quantity = row.querySelector(".quantity").value;
        let unitPrice = row.querySelector(".unit-price").textContent;
        let total = row.querySelector(".total-price").textContent;

        drinks.push({
            drink: drink,
            quantity: quantity,
            unitPrice: unitPrice,
            total: total
        });
    });

    // Send the order data to the backend using AJAX
    fetch('G_Boisson/process_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            tableNumber: tableNumber,
            serverNumber: serverNumber,
            totalPrice: totalPrice,
            paymentStatus: paymentStatus,
            paymentMode: paymentMode,
            drinks: drinks
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Commande confirmée avec succès, merci !');
            closeOrderModal(); // Open a new fresh modal after the order is successful
        } else {
            alert('Erreur lors de la commande.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de la commande.');
    });
}

// Function to open the "drink-order-modal"
function openOrderModal() {
    document.getElementById("drink-order-modal").style.display = "flex";
}

// Function for the previous step
function prevStep() {
    document.getElementById("drink-step-2").style.display = "none";
    document.getElementById("drink-step-1").style.display = "block";
    document.getElementById("drink-step-circle").textContent = "1";
}

















function toggleSection(sectionId) {
    var section = document.getElementById(sectionId);
    if (section.style.display === "none" || section.style.display === "") {
        section.style.display = "block";
    } else {
        section.style.display = "none";
    }
}

async function fetchBillingData() {
    const response = await fetch('fetch_bar_billing.php');
    const data = await response.json();
    
    // Sort the bills by the most recent date first
    data.sort((a, b) => new Date(b.date_commande) - new Date(a.date_commande));

    // Call displayBills with all data initially
    displayBills(data);
}

function displayBills(data) {
    const grid = document.getElementById("bar-billing-grid");
    grid.innerHTML = "";

    if (data.length === 0) {
        grid.innerHTML = "<p>No data found</p>";
        return;
    }

    data.forEach(bill => {
        const billCard = document.createElement("div");
        billCard.classList.add("bill-card");
        billCard.classList.add(bill.statut_paiement === "paid" ? "paid" : "unpaid");

        billCard.innerHTML = `
            <h3>Facture : ${bill.numero_facture}</h3>
            <p><strong>Total:</strong> ${bill.total_price} FBU</p>
            <p><strong>Serveur:</strong> ${bill.numero_serveur}</p>
            <p><strong>Table:</strong> ${bill.numero_table}</p>
            <p><strong>Mode de paiement:</strong> ${bill.mode_paiement}</p>
            <p><strong>Statut de paiement:</strong> ${bill.statut_paiement}</p>
            <p><strong>Date:</strong> ${bill.date_commande}</p>
        `;
        grid.appendChild(billCard);
    });
}


// Function to filter the billing data based on the selected time range
function filterBillingData() {
    const selectedRange = document.getElementById("time-range").value;
    const currentDate = new Date();
    let filteredData = [];

    // Call the fetch function again to get the latest data
    fetch('fetch_bar_billing.php')
        .then(response => response.json())
        .then(data => {
            // Apply filtering based on the selected time range
            switch (selectedRange) {
                case "today":
                    filteredData = data.filter(bill => isToday(new Date(bill.date_commande), currentDate));
                    break;
                case "week":
                    filteredData = data.filter(bill => isThisWeek(new Date(bill.date_commande), currentDate));
                    break;
                case "month":
                    filteredData = data.filter(bill => isThisMonth(new Date(bill.date_commande), currentDate));
                    break;
                case "custom":
                    const startDate = document.getElementById("start-date").value;
                    const endDate = document.getElementById("end-date").value;

                    // Validate if both start and end dates are provided
                    if (startDate && endDate) {
                        filteredData = data.filter(bill => {
                            const billDate = new Date(bill.date_commande);
                            return billDate >= new Date(startDate) && billDate <= new Date(endDate);
                        });
                    }
                    break;
                default:
                    filteredData = data; // "All Time" - no filter
                    break;
            }
            displayBills(filteredData);
        });
}

// Helper functions to check date ranges
function isToday(billDate, currentDate) {
    return billDate.toDateString() === currentDate.toDateString();
}

function isThisWeek(billDate, currentDate) {
    const startOfWeek = new Date(currentDate);
    startOfWeek.setDate(currentDate.getDate() - currentDate.getDay()); // Get start of the week (Sunday)
    return billDate >= startOfWeek && billDate <= currentDate;
}

function isThisMonth(billDate, currentDate) {
    return billDate.getMonth() === currentDate.getMonth() && billDate.getFullYear() === currentDate.getFullYear();
}

// Event listener for DOM content loaded
document.addEventListener("DOMContentLoaded", fetchBillingData);

// Update the toggleSection function for smooth transition
function toggleSection(sectionId) {
    var section = document.getElementById(sectionId);
    section.classList.toggle("visible");
}

// Show the custom date range inputs when "Custom" is selected
document.getElementById("time-range").addEventListener("change", function() {
    const selectedRange = this.value;
    const customDateRange = document.getElementById("custom-date-range");
    if (selectedRange === "custom") {
        customDateRange.style.display = "block";
    } else {
        customDateRange.style.display = "none";
    }
});

// Event listener for the 'Show' button to apply custom date filter
document.getElementById("show-button").addEventListener("click", function() {
    filterBillingData(); // Fetch and filter data based on the selected custom date range
});


function displayBills(data) {
    const grid = document.getElementById("bar-billing-grid");
    grid.innerHTML = ""; // Clear existing grid content

    data.forEach(bill => {
        const billCard = document.createElement("div");
        billCard.classList.add("bill-card");
        billCard.classList.add(bill.statut_paiement === "paid" ? "paid" : "unpaid");

        billCard.innerHTML = `
            <h3>Facture : ${bill.numero_facture}</h3>
            <p><strong>Total:</strong> ${bill.total_price} FBU</p>
            <p><strong>Serveur:</strong> ${bill.numero_serveur}</p>
            <p><strong>Table:</strong> ${bill.numero_table}</p>
            <p><strong>Mode de paiement:</strong> ${bill.mode_paiement}</p>
            <p><strong>Statut de paiement:</strong> ${bill.statut_paiement}</p>
            <p><strong>Date:</strong> ${bill.date_commande}</p>
        `;

        // If the bill is unpaid or pending, add a "Payez maintenant" buttonm //
        if (bill.statut_paiement === "unpaid" || bill.statut_paiement === "pending") {
            const payButton = document.createElement("button");
            
            // Create an icon element
            const icon = document.createElement("i");
            icon.classList.add("bx", "bxs-credit-card"); // Add the payment icon class
        
            // Add icon and text to the button
            payButton.appendChild(icon);
            payButton.appendChild(document.createTextNode(" Payez maintenant"));
            
            payButton.classList.add("pay-now-button");
        
            // Add click event to trigger payment action (or a modal)
            payButton.addEventListener("click", function() {
                // Handle the payment action here
                handlePayment(bill);
            });
        
        billCard.appendChild(payButton);
    }
    grid.appendChild(billCard);
});
}

// Handle the payment process
function handlePayment(bill) {
    // Show payment options to the user
    const paymentMode = prompt("Please choose a payment mode: (e.g., Cash, Lumicash)");

    if (paymentMode) {
        // Send the updated payment information to the server
        fetch('update_payment_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                numero_facture: bill.numero_facture,
                statut_paiement: "paid",
                mode_paiement: paymentMode
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Facture ${bill.numero_facture} marked as paid with payment mode: ${paymentMode}`);
                // Refresh the page or update the grid to reflect the changes
                fetchBillingData(); // Call the function to refresh the bill grid
            } else {
                alert("Payment update failed. Please try again.");
            }
        })
        .catch(error => {
            console.error("Error updating payment:", error);
            alert("An error occurred. Please try again later.");
        });
    } else {
        alert("Please choose a valid payment mode.");
    }
}













async function fetchRestaurantBillingData() {
    const response = await fetch('fetch_restaurant_billing.php');
    const data = await response.json();

    // Sort the bills by the most recent date first
    data.sort((a, b) => new Date(b.date_commande) - new Date(a.date_commande));

    // Call displayRestaurantBills with all data initially
    displayRestaurantBills(data);
}

function displayRestaurantBills(data) {
    const grid = document.getElementById("restaurant-billing-grid");
    grid.innerHTML = ""; // Clear existing grid content

    data.forEach(bill => {
        const billCard = document.createElement("div");
        billCard.classList.add("bill-card");
        billCard.classList.add(bill.statut_paiement === "paid" ? "paid" : "unpaid");

        billCard.innerHTML = `
            <h3>Facture : ${bill.numero_facture}</h3>
            <p><strong>Total:</strong> ${bill.total_price} FBU</p>
            <p><strong>Serveur:</strong> ${bill.numero_serveur}</p>
            <p><strong>Table:</strong> ${bill.numero_table}</p>
            <p><strong>Mode de paiement:</strong> ${bill.mode_paiement}</p>
            <p><strong>Statut de paiement:</strong> ${bill.statut_paiement}</p>
            <p><strong>Date:</strong> ${bill.date_commande}</p>
        `;

        // If the bill is unpaid or pending, add a "Payez maintenant" button
        if (bill.statut_paiement === "unpaid" || bill.statut_paiement === "pending") {
            const payButton = document.createElement("button");
            payButton.textContent = "Payez maintenant";
            payButton.classList.add("pay-now-button");

            // Add a payment icon to the button
            const icon = document.createElement("i");
            icon.classList.add("bx", "bxs-credit-card");
            payButton.prepend(icon); // Add the icon to the beginning of the button text

            // Add click event to trigger payment action (or a modal)
            payButton.addEventListener("click", function() {
                // Handle the payment action here
                handleRestaurantPayment(bill);
            });

            billCard.appendChild(payButton);
        }

        grid.appendChild(billCard);
    });
}

// Handle payment for restaurant bills
function handleRestaurantPayment(bill) {
    // Show payment options to the user
    const paymentMode = prompt("Please choose a payment mode: (e.g., Cash, Card)");

    if (paymentMode) {
        // Send the updated payment information to the server
        fetch('update_payment_status_restaurant.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                numero_facture: bill.numero_facture,
                statut_paiement: "paid",
                mode_paiement: paymentMode
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Facture ${bill.numero_facture} marked as paid with payment mode: ${paymentMode}`);
                // Refresh the page or update the grid to reflect the changes
                fetchRestaurantBillingData();
            } else {
                alert("Payment update failed. Please try again.");
            }
        })
        .catch(error => {
            console.error("Error updating payment:", error);
            alert("An error occurred. Please try again later.");
        });
    } else {
        alert("Please choose a valid payment mode.");
    }
}

// Call fetchRestaurantBillingData when the page loads
document.addEventListener("DOMContentLoaded", fetchRestaurantBillingData);








function filterRestaurantBillingData() {
    const selectedRange = document.getElementById("restaurant-time-range").value;
    const currentDate = new Date();
    let filteredData = [];

    // Fetch the latest data
    fetch('fetch_restaurant_billing.php')
        .then(response => response.json())
        .then(data => {
            switch (selectedRange) {
                case "today":
                    filteredData = data.filter(bill => isToday(new Date(bill.date_commande), currentDate));
                    break;
                case "week":
                    filteredData = data.filter(bill => isThisWeek(new Date(bill.date_commande), currentDate));
                    break;
                case "month":
                    filteredData = data.filter(bill => isThisMonth(new Date(bill.date_commande), currentDate));
                    break;
                case "1month":
                    filteredData = data.filter(bill => isWithinLastMonths(new Date(bill.date_commande), currentDate, 1));
                    break;
                case "2months":
                    filteredData = data.filter(bill => isWithinLastMonths(new Date(bill.date_commande), currentDate, 2));
                    break;
                case "3months":
                    filteredData = data.filter(bill => isWithinLastMonths(new Date(bill.date_commande), currentDate, 3));
                    break;
                case "4months":
                    filteredData = data.filter(bill => isWithinLastMonths(new Date(bill.date_commande), currentDate, 4));
                    break;
                case "5months":
                    filteredData = data.filter(bill => isWithinLastMonths(new Date(bill.date_commande), currentDate, 5));
                    break;
                case "6months":
                    filteredData = data.filter(bill => isWithinLastMonths(new Date(bill.date_commande), currentDate, 6));
                    break;
                case "7months":
                    filteredData = data.filter(bill => isWithinLastMonths(new Date(bill.date_commande), currentDate, 7));
                    break;
                case "8months":
                    filteredData = data.filter(bill => isWithinLastMonths(new Date(bill.date_commande), currentDate, 8));
                    break;
                case "9months":
                    filteredData = data.filter(bill => isWithinLastMonths(new Date(bill.date_commande), currentDate, 9));
                    break;
                case "10months":
                    filteredData = data.filter(bill => isWithinLastMonths(new Date(bill.date_commande), currentDate, 10));
                    break;
                case "11months":
                    filteredData = data.filter(bill => isWithinLastMonths(new Date(bill.date_commande), currentDate, 11));
                    break;
                case "12months":
                    filteredData = data.filter(bill => isWithinLastMonths(new Date(bill.date_commande), currentDate, 12));
                    break;
                default:
                    filteredData = data; // "All Time"
                    break;
            }
            displayRestaurantBills(filteredData);
        });
}

// Helper functions for date ranges
function isToday(billDate, currentDate) {
    return billDate.toDateString() === currentDate.toDateString();
}

function isThisWeek(billDate, currentDate) {
    const startOfWeek = new Date(currentDate);
    startOfWeek.setDate(currentDate.getDate() - currentDate.getDay()); // Get start of the week (Sunday)
    return billDate >= startOfWeek && billDate <= currentDate;
}

function isThisMonth(billDate, currentDate) {
    return billDate.getMonth() === currentDate.getMonth() && billDate.getFullYear() === currentDate.getFullYear();
}

function isWithinLastMonths(billDate, currentDate, months) {
    const dateMonthsAgo = new Date(currentDate);
    dateMonthsAgo.setMonth(currentDate.getMonth() - months); // Get the date X months ago
    return billDate >= dateMonthsAgo && billDate <= currentDate;
}



















// Toggle submenu visibility
document.querySelector('.toggle-submenu').addEventListener('click', function (e) {
    e.preventDefault();
    const submenu = this.nextElementSibling;
    submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
});

// Show content when subtitle is clicked
document.querySelectorAll('.submenu a').forEach(item => {
    item.addEventListener('click', function (e) {
        e.preventDefault();
        let targetId = this.getAttribute('data-target');
        
        // Hide all sections
        document.querySelectorAll('.content-section').forEach(section => {
            section.style.display = 'none';
        });

        // Show the selected section
        document.getElementById(targetId).style.display = 'block';
    });
});















// Function to fetch data based on sorting criteria
function fetchData() {
    var sortBy = document.getElementById('sort-by').value || 'serveur'; // Default to 'serveur' if no sort option is selected
    var dateStart = document.getElementById('date-start') ? document.getElementById('date-start').value : '';
    var dateEnd = document.getElementById('date-end') ? document.getElementById('date-end').value : '';

    // Show date selection if sorting by date is selected
    if (sortBy === 'date') {
        document.getElementById('date-selection').style.display = 'block';
    } else {
        document.getElementById('date-selection').style.display = 'none';
    }

    // Prepare the data to be sent to the PHP backend
    var data = {
        sort_by: sortBy,
        date_start: dateStart,
        date_end: dateEnd
    };

    // Send the data to the backend via AJAX (using Fetch API)
    fetch('G_boisson/fetch-bar-data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            displayData(data.data, sortBy);
            document.getElementById('export-to-excel').style.display = 'inline-block'; // Show the export button
        } else {
            // Only show error message if data is empty or status is error
            if (data.message) {
                console.error(data.message);
            }
            document.getElementById('export-to-excel').style.display = 'none'; // Hide the export button if no data
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('export-to-excel').style.display = 'none'; // Hide the export button on error
    });
}

// Function to display the fetched data in a table
function displayData(data, sortBy) {
    var tableHeader = document.getElementById('table-header');
    var tableBody = document.querySelector('#bar-data-table tbody');

    // Clear any previous table data
    tableHeader.innerHTML = '';
    tableBody.innerHTML = '';

    var headers = [];
    var rows = [];

    // Function to apply color based on statut_paiement value
    function getPaymentStatusClass(status) {
        if (status === 'unpaid' || status === 'pending') {
            return 'red-status';
        } else if (status === 'paid') {
            return 'green-status';
        }
        return ''; // Return empty if no matching status
    }

    if (sortBy === 'date') {
        // Table headers for sorting by date
        headers = ['Boisson', 'Quantité', 'Prix', 'Total', 'Statut', 'Date'];

        // Populate the table rows
        data.forEach(row => {
            var statutClass = getPaymentStatusClass(row.statut_paiement); // Get the appropriate class
            var tableRow = document.createElement('tr');
            tableRow.innerHTML = `
                <td>${row.nom_boisson}</td>
                <td>${row.total_quantite}</td>
                <td>${row.prix}</td>
                <td>${row.total_price}</td>
                <td class="payment-status ${statutClass}">${row.statut_paiement}</td>
                <td>${row.date_commande}</td>
            `;
            rows.push([row.nom_boisson, row.total_quantite, row.prix, row.total_price, row.statut_paiement, row.date_commande]);
            tableBody.appendChild(tableRow);
        });
    } else if (sortBy === 'serveur') {
        // Table headers for sorting by serveur
        headers = ['N° Serveur', 'Boisson', 'Quantité', 'Prix', 'Total', 'Statut', 'Date'];

        // Populate the table rows
        data.forEach(row => {
            var statutClass = getPaymentStatusClass(row.statut_paiement); // Get the appropriate class
            var tableRow = document.createElement('tr');
            tableRow.innerHTML = `
                <td>${row.numero_serveur}</td>
                <td>${row.nom_boisson}</td>
                <td>${row.total_quantite}</td>
                <td>${row.prix}</td>
                <td>${row.total_price}</td>
                <td class="payment-status ${statutClass}">${row.statut_paiement}</td>
                <td>${row.date_commande}</td>
            `;
            rows.push([row.numero_serveur, row.nom_boisson, row.total_quantite, row.prix, row.total_price, row.statut_paiement, row.date_commande]);
            tableBody.appendChild(tableRow);
        });
    }

    // Set up the table headers
    tableHeader.innerHTML = headers.map(header => `<th>${header}</th>`).join('');
}

// Function to export table data to Excel
document.getElementById('export-to-excel').addEventListener('click', function () {
    var table = document.getElementById('bar-data-table');
    var wb = XLSX.utils.table_to_book(table, { sheet: "Sheet 1" });
    XLSX.writeFile(wb, 'data_export.xlsx');
});

// Initial data fetch when page loads
window.onload = fetchData;














document.addEventListener("DOMContentLoaded", function () {
    const restoButton = document.querySelector('[data-target="food-section"]');
    const foodSection = document.getElementById("food-section");

    restoButton.addEventListener("click", function (event) {
        event.preventDefault(); // Prevents page from reloading
        foodSection.style.display = "block"; // Show the section
    });
});



function loadFoodSection() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "G_Resto/food-section.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("food-section").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

// Load data on page load
window.onload = loadFoodSection;

// Handle form submission for filtering data
document.addEventListener("submit", function (event) {
    if (event.target.id === "filterForm") {
        event.preventDefault();
        var formData = new FormData(event.target);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "G_Resto/food-section.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("food-section").innerHTML = xhr.responseText;
            }
        };
        xhr.send(formData);
    }
});

















let currentStep = 1;
    const steps = document.querySelectorAll('.step');
    const nextButtons = document.querySelectorAll('.next-btn');
    const backButtons = document.querySelectorAll('.back-btn');

    nextButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            steps[currentStep - 1].style.display = 'none';
            currentStep++;
            if (currentStep <= steps.length) {
                steps[currentStep - 1].style.display = 'block';
            }
        });
    });

    backButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            steps[currentStep - 1].style.display = 'none';
            currentStep--;
            if (currentStep >= 1) {
                steps[currentStep - 1].style.display = 'block';
            }
        });
    });