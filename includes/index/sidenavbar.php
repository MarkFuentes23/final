<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="/css/rokkito.css" rel="stylesheet">
    <link href="/css/condense.css" rel="stylesheet">
    <link href="/css/quicksand.css" rel="stylesheet">
</head>

<div class="sb-sidenav-menu">
    <div class="nav">
        <!-- Core Section -->
        <div class="sb-sidenav-menu-heading">Core</div>

        <!-- Main Dashboard -->
        <a class="nav-link collapsed fw-bold" style="font-family: 'Rokkitt';" href="#" id="logisticDropdown" data-bs-toggle="collapse" data-bs-target="#collapseDashboard" aria-expanded="false" aria-controls="collapseDashboard">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: #3CB371;"></i></div>
            DASHBOARD
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse fst-italic" style="font-family: 'Rokkitt';" id="collapseDashboard" aria-labelledby="headingDashboard" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <!-- Dynamic Links for Logistic 1 and Logistic 2 -->
                <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'logistic1_admin') : ?>
                    <a class="nav-link" href="/sub-modules/logistic1/dashboard.php">
                        <i class="fa-solid fa-truck-fast" style="margin-right: 8px; color: #3CB371;"></i> LOGISTIC 1
                    </a>
                <?php endif; ?>
        </div>


        <!-- Admin Panel for Main Admin -->
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <div class="sb-sidenav-menu-heading">Admin</div>
            <a class="nav-link collapsed fw-bold" style="font-family: 'Rokkitt'" href="#!" id="AdminDropdown" data-bs-toggle="collapse" data-bs-target="#collapseAdmin" aria-expanded="false" aria-controls="collapseAdmin">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: #3CB371;"></i></div>
                ADMIN PANEL
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse fst-italic" style="font-family: 'Rokkitt'" id="collapseAdmin" aria-labelledby="headingDashboard" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav fst-italic" style="font-family: 'Rokkitt', sans-serif; color: black;">
                    <!-- <a class="nav-link" href="/includes/admin/dashboard.php">
                        <i class="fa-solid fa-house" style="margin-right: 8px; color: #3CB371;"></i>HOME
                    </a> -->
                    <a class="nav-link" href="/includes/admin/manage_users.php">
                        <i class="fa-solid fa-users" style="margin-right: 8px; color: #3CB371;"></i>USER MANAGEMENT
                    </a>
                    <!-- <a class="nav-link" href="/includes/admin/manage_branches.php">
                        <i class="fa-solid fa-map" style="margin-right: 8px; color: #3CB371;"></i>BRANCHES MANAGEMENT
                    </a> -->
                    <!-- <a class="nav-link" href="/includes/admin/manage_request.php">
                        <i class="fa-solid fa-tasks" style="margin-right: 8px; color: #3CB371;"></i>MANAGE REQUEST
                    </a> -->
                </nav>
            </div>
        <?php endif; ?>

        <!-- Apps Section -->
        <div class="sb-sidenav-menu-heading">Apps</div>
        <a class="nav-link" href="todolist.php" style="font-family: 'Rokkitt', sans-serif; color: black;">
            <div class="sb-nav-link-icon" style="color: #3CB371;"><i class="fas fa-list"></i></div>
            Todo List
        </a>
        <a class="nav-link" href="notes.php" style="font-family: 'Rokkitt', sans-serif; color: black;">
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
    

        <!-- Calendar Section -->

    </div>
</div>

<!-- Footer Section -->
<div class="sb-sidenav-footer" style="font-family: 'Rokkitt';">
    <div class="small">Logged in as:</div>
    <div><?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo htmlspecialchars($_SESSION['role']); ?>)</div>
</div>
