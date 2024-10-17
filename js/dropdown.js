
   document.getElementById('fleet').addEventListener('click', function(event) {
            event.preventDefault();  // Prevent the default action
            const submenu = document.getElementById('fleetSubMenu');
            submenu.classList.toggle('show');
        });
