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

// Example of showing details for Boisson or Kitchen (can be customized)
