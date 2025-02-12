document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('stock-modal');
    const modalUpdate = document.getElementById('stock-modal-update');
    const addStockBtn = document.getElementById('add-stock-btn');
    const closeBtn = document.querySelector('.close');
    const stockForm = document.getElementById('stock-form');
    const stockFormUpdate = document.getElementById('stock-form-update');

    const employeeModal = document.getElementById('employee-modal');
    const employeeForm = document.getElementById('employee-form');
    const addEmployeeBtn = document.getElementById('add-employee-btn');
    const closeEmployeeBtn = document.getElementById('close-employee')

    const employeModalUpdate = document.getElementById('employee-modal-update');

    const stockTable = $('#stock-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "get_stock_boisson.php", 
            "type": "GET",
            "data": function(d) {
                
                console.log(d); 
            },
            "dataSrc": function (json) {
                return json.data;  
            }
        },
        "columns": [
            { "data": "nom_boisson" },  
            { "data": "quantite_stock" },
            { "data": "prix_achat" }, 
            { 
                "data": null,  
                "render": function(data, type, row) {
                    return `
                        <div class="button-group">
                            <button class="edit-btn" data-id="${row.id}">
                                <i class="fas fa-edit"></i> Modifier
                            </button>
                            <button class="delete-btn" data-id="${row.id}">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </button>
                        </div>
                    `;
                },
                "orderable": false
            }
        ]
    });


    const employeeTable = $('#employee-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "get_employee.php",  // URL to the PHP file handling the data retrieval
            "type": "GET",
            "data": function(d) {
                console.log(d);  // Optional: log the DataTable's request data for debugging
            },
            "dataSrc": function(json) {
                return json.data;  // Return the data array from the response
            }
        },
        "columns": [
            { "data": "nom" },  
            { "data": "prenom" },
            { "data": "poste" }, 
            { 
                "data": null,  
                "render": function(data, type, row) {
                    return `
                        <div class="button-group">
                            <button class="edit-btn employee-edit" data-id="${row.id}">
                                <i class="fas fa-edit"></i> Modifier
                            </button>
                            <button class="delete-btn employee-edit" data-id="${row.id}">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </button>
                        </div>
                    `;
                },
                "orderable": false
            }
        ]
    });
    

   


    $('#stock-table').on('click', '.delete-btn', function() {
        let stockId = $(this).data('id');
    
        if (confirm('Are you sure you want to delete this stock item?')) {
            $.ajax({
                url: 'delete_stock_boisson.php',  // Match the correct PHP file name
                type: 'POST',  // Use POST to send data securely
                data: { id: stockId },
                dataType: 'json',  // Expect JSON response
                success: function(response) {
                    if (response.success) {
                        alert(response.message);  // Show success message
                        stockTable.ajax.reload();  // Reload the DataTable
                    } else {
                        alert('Error: ' + response.message);  // Show error message from PHP
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);  // Log error details
                    alert('Failed to delete stock item. Please try again.');
                }
            });
        }
    });


    $('#stock-table').on('click', '.edit-btn', function() {
        let stockId = $(this).data('id');

        // Fetch stock data from the server
        $.ajax({
            url: 'get_stock_details.php', // Create this PHP file to return stock details
            type: 'GET',
            data: { id: stockId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#item-name-update').val(response.data.nom_boisson);
                    $('#item-quantity-update').val(response.data.quantite_stock);
                    $('#item-price-update').val(response.data.prix_achat);
                    
                    // Store stockId in the form for updating
                    $('#stock-form-update').data('id', stockId);

                    // Show the modal
                    $('#stock-modal-update').show();
                } else {
                    alert('Failed to fetch stock details.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Error fetching stock details.');
            }
        });
    });




    $('#employee-table').on('click', '.delete-btn', function() {
        let employeeId = $(this).data('id');
    
        if (confirm('Etes-vous sur de vouloir supprimer les details de cet employe?')) {
            $.ajax({
                url: 'delete_employee.php',  // Match the correct PHP file name
                type: 'POST',  // Use POST to send data securely
                data: { id: employeeId },
                dataType: 'json',  // Expect JSON response
                success: function(response) {
                    if (response.success) {
                        alert(response.message);  // Show success message
                        employeeTable.ajax.reload();  // Reload the DataTable
                    } else {
                        alert('Error: ' + response.message);  // Show error message from PHP
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);  // Log error details
                    alert("Probleme de suppression des details de 'employe.");
                }
            });
        }
    });


    $('#employee-table').on('click', '.edit-btn', function() {
        let employeeId = $(this).data('id');

        // Fetch stock data from the server
        $.ajax({
            url: 'get_employee_details.php', // Create this PHP file to return stock details
            type: 'GET',
            data: { id: employeeId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#nom-update').val(response.data.nom);
                    $('#prenom-update').val(response.data.prenom);
                    $('#poste-update').val(response.data.poste);
                    $('#salaire-update').val(response.data.salaire);
                    $('#date_embauche-update').val(response.data.date_embauche);
                    
                    // Store stockId in the form for updating
                    $('#employee-form-update').data('id', employeeId);

                    // Show the modal
                    $('#employee-modal-update').show();
                } else {
                    alert('Failed to fetch employee details.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Error fetching employee details.');
            }
        });
    });



    // Close the modal
    $('.close').on('click', function() {
        $('#stock-modal-update').hide();
    });

    $('.close').on('click', function() {
        $('#employee-modal-update').hide();
    });

    // Submit form for updating stock
    $('#stock-form-update').on('submit', function(e) {
        e.preventDefault();

        let stockId = $(this).data('id');
        let formData = {
            id: stockId,
            name: $('#item-name-update').val(),
            quantity: $('#item-quantity-update').val(),
            price: $('#item-price-update').val()
        };

        $.ajax({
            url: 'update_stock.php', // Create this PHP file to handle updates
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    $('#stock-modal-update').hide();
                    stockTable.ajax.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Failed to update stock.');
            }
        });
    });



    $('#employee-form-update').on('submit', function(e) {
        e.preventDefault();

        let employeeId = $(this).data('id');
        let formData = {
            id: employeeId,
            nom: $('#nom-update').val(),
            prenom: $('#prenom-update').val(),
            poste: $('#poste-update').val(),
            salaire: $('#salaire-update').val(),
            date_embauche: $('#date_embauche-update').val()
        };

        $.ajax({
            url: 'update_employee.php', // Create this PHP file to handle updates
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    $('#employee-modal-update').hide();
                    employeeTable.ajax.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Failed to update employee.');
            }
        });
    });

   

    // Open modal
    addStockBtn.onclick = function() {
        modal.style.display = 'block';
        stockForm.style.display='block';
    }

    addEmployeeBtn.onclick = function() {
        employeeModal.style.display = 'block';
        employeeForm.style.display='block';
    }

    // Close modal
    closeBtn.onclick = function() {
        modal.style.display = 'none';
       ;
        stockForm.classList.add('hidden');
        stockForm.reset();
    }

    closeEmployeeBtn.onclick = function() {
        employeeModal.style.display = 'none';
        employeeForm.classList.add('hidden');
        employeeForm.reset();
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
            
            stockForm.classList.add('hidden');
            stockForm.reset();
        } else if (event.target == modalUpdate) {
            modalUpdate.style.display = 'none';
            
            //stockFormUpdate.classList.add('hidden');
            //stockFormUpdate.reset();
        }else if (event.target == employeeModal){
            employeeModal.style.display = 'none';
        } else if (event.target == employeModalUpdate){
        employeModalUpdate.style.display='none';
    }
    }

 

    // Show form when category is selected
   

    // Handle form submission
    stockForm.onsubmit = function(e) {
        e.preventDefault();
        const formData = new FormData(this);
    
        fetch('ajout_stock_boisson.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if (data.success) {
                alert('Stock added successfully!');
                modal.style.display = 'none';
              
                stockForm.style.display = 'none';
                stockForm.reset();
                stockTable.ajax.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            console.log(error)
            alert('An error occurred while adding the stock.');
        });
    }




    employeeForm.onsubmit = function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        console.log(formData);
    
        fetch('ajout_employee.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if (data.success) {
                alert('Employe ajoute avec success!');
                employeeModal.style.display = 'none';
                employeeTable.ajax.reload();
              
              //  stockForm.style.display = 'none';
              //  stockForm.reset();
              //  stockTable.ajax.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            console.log(error)
            alert('An error occurred while adding the employee.');
        });
    }
});

function showBoissonDetails() {
    document.getElementById("gestion-stock-section").style.display = "";
    document.getElementById("gestion-boisson-section").style.display = "block";
}

function showKitchenDetails() {
    alert("Details for Kitchen");
    // You can add more logic here to load content for Kitchen
}