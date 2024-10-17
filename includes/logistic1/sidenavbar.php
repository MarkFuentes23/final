<?php
ob_start(); // Starts output buffering

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure that session role is set to prevent errors when accessing $_SESSION['role']
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'Guest';

// Ensure that session username is set to prevent errors when accessing $_SESSION['username']
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rokkitt:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="/css/rokkito.css" rel="stylesheet">
    <link href="/css/condense.css" rel="stylesheet">
</head>

<div class="sb-sidenav-menu">
    <div class="nav">
        <!-- Main Admin Link (conditionally visible based on session role) -->
        <?php if ($role === 'admin') : ?>
            <a class="nav-link collapsed fw-bold" style="font-family: 'Rokkitt'; color: black; font-size: 12px;" href="/index.php">
                <div class="sb-nav-link-icon"><i class="fas fa-th-large" style="color: #3CB371; margin-right: 8px;"></i></div>
                ADMIN DASHBOARD
            </a>
        <?php endif; ?>
        
        <!-- Core Section -->
        <div class="sb-sidenav-menu-heading">Core</div>
        
        <!-- Project Management -->
        <a class="nav-link collapsed fw-bold fst-italic" style="font-family: 'Rokkitt';" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProjectManagement" aria-expanded="false" aria-controls="collapseProjectManagement">
            <div class="sb-nav-link-icon" style="color: #3CB371;"><i class="fas fa-tasks"></i></div>
            Project Management
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseProjectManagement" aria-labelledby="headingProjectManagement" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav fst-italic" style="font-family: 'Rokkitt', sans-serif; color: black;">
                <a class="nav-link" href="/sub-modules/logistic1/project-management/task-milestone.php">Task & Milestone Tracking</a>
                <a class="nav-link" href="/sub-modules/logistic1/project-management/budget-management.php">Budget Management</a>
                <a class="nav-link" href="/sub-modules/logistic1/project-management/resource-alloc.php">Resource Allocation</a>
                <a class="nav-link" href="/sub-modules/logistic1/project-management/Progress-report.php">Progress Reports</a>
                <a class="nav-link" href="/sub-modules/logistic1/project-management/Gantt-chart.php">Gantt Chart</a>
                <a class="nav-link" href="/sub-modules/logistic1/project-management/completed.php">Completed Task</a>
            </nav>
        </div>

        <!-- Warehouse -->
        <a class="nav-link collapsed fw-bold fst-italic" style="font-family: 'Rokkitt';" href="#" data-bs-toggle="collapse" data-bs-target="#collapseWarehouse" aria-expanded="false" aria-controls="collapseWarehouse">
            <div class="sb-nav-link-icon" style="color: #3CB371;"><i class="fas fa-warehouse"></i></div>
            Warehouse
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseWarehouse" aria-labelledby="headingWarehouse" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav fst-italic" style="font-family: 'Rokkitt', sans-serif; color: black;">
                <a class="nav-link" href="/sub-modules/logistic1/warehouse/Stock-tracking.php">Stock Tracking</a>
                <a class="nav-link" href="/sub-modules/logistic1/warehouse/Replenishment-req.php">Replenishment Request</a>
                <a class="nav-link" href="/sub-modules/logistic1/warehouse/Inventory-distribute.php">Inventory Distribution</a>
                <a class="nav-link" href="/sub-modules/logistic1/warehouse/Inventory-categorized.php">Inventory Categorization</a>
                <a class="nav-link" href="/sub-modules/logistic1/warehouse/Warehouse-audit.php">Warehouse Audits</a>
                <a class="nav-link" href="/sub-modules/logistic1/warehouse/Stock-report.php">Stock Reports</a>
            </nav>
        </div>

        <!-- Vehicle Reservation -->
        <a class="nav-link collapsed fw-bold fst-italic" style="font-family: 'Rokkitt';" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVehicleReservation" aria-expanded="false" aria-controls="collapseVehicleReservation">
            <div class="sb-nav-link-icon" style="color: #3CB371;"><i class="fas fa-truck"></i></div>
            Vehicle Reservation
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseVehicleReservation" aria-labelledby="headingVehicleReservation" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav fst-italic" style="font-family: 'Rokkitt', sans-serif; color: black;">
                <a class="nav-link" href="/sub-modules/logistic1/vehicle-reservation/Vehicle-Reservation.php">Vehicle Reservation</a>
                <a class="nav-link" href="/sub-modules/logistic1/vehicle-reservation/Upcoming-Reservation.php">View Vehicle Reservation</a>
                <a class="nav-link" href="/sub-modules/logistic1/vehicle-reservation/fleet_driver.php">Fleet Driver</a>
                <a class="nav-link" href="/sub-modules/logistic1/vehicle-reservation/driver_list.php">View Driver Info</a>
                <a class="nav-link" href="/sub-modules/logistic1/vehicle-reservation/completed.php">Delivery Completed</a>
            </nav>
        </div>

        <!-- Apps Section -->
        <div class="sb-sidenav-menu-heading">Apps</div>
        <a class="nav-link" href="/sub-modules/logistic1/vehicle-reservation/track.php" style="font-family: 'Rokkitt', sans-serif; color: black;">
            <div class="sb-nav-link-icon" style="color: #3CB371;"><i class="fas fa-search"></i></div>
            Tracking Orders
        </a>

        <a class="nav-link" href="/sub-modules/logistic1/vehicle-reservation/reports.php" style="font-family: 'Rokkitt', sans-serif; color: black;">
            <div class="sb-nav-link-icon" style="color: #3CB371;"><i class="fas fa-sticky-note"></i></div>
            Notes
        </a>
        <a class="nav-link" href="scrumboard.php" style="font-family: 'Rokkitt', sans-serif; color: black;">
            <div class="sb-nav-link-icon" style="color: #3CB371;"><i class="fas fa-tasks"></i></div>
            Scrumboard
        </a>
        <a class="nav-link" href="contacts.php" style="font-family: 'Rokkitt', sans-serif; color: black;">
            <div class="sb-nav-link-icon" style="color: #3CB371;"><i class="fas fa-address-book"></i></div>
            Contacts
        </a>

        <!-- Invoice Section with Dropdown -->
    </div>
</div>

<!-- Footer Section -->
<div class="sb-sidenav-footer" >
    <div class="small">Logged in as:</div>
    <div><?php echo htmlspecialchars($username); ?> (<?php echo htmlspecialchars($role); ?>)</div>
</div>

<?php ob_end_flush(); // End output buffering ?>
