<?php
ob_start(); // Starts output buffering

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure that session role is set to prevent errors when accessing $_SESSION['role']
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

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
        <!-- Tracking Orders Link -->
        <a class="nav-link" href="/sub-modules/logistic1/vehicle-reservation/user-only.php" style="font-family: 'Rokkitt', sans-serif; color: black;">
            <div class="sb-nav-link-icon" style="color: #3CB371;"><i class="fas fa-search"></i></div>
            Tracking Orders
        </a>
        <a class="nav-link" href="notes.php" style="font-family: 'Rokkitt', sans-serif; color: black;">
            <div class="sb-nav-link-icon" style="color: #3CB371;"><i class="fas fa-sticky-note"></i></div>
            Notes
        </a>
        <a class="nav-link" href="scrumboard.php" style="font-family: 'Rokkitt', sans-serif; color: black;">
            <div class="sb-nav-link-icon" style="color: #3CB371;"><i class="fas fa-tasks"></i></div>
            Driver Location
        </a>
        <a class="nav-link" href="contacts.php" style="font-family: 'Rokkitt', sans-serif; color: black;">
            <div class="sb-nav-link-icon" style="color: #3CB371;"><i class="fas fa-address-book"></i></div>
            Contacts
        </a>
    </div>
</div>

<!-- Footer Section -->
<div class="sb-sidenav-footer">
    <div class="small">Logged in as:</div>
    <div><?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo htmlspecialchars($_SESSION['role']); ?>)</div>
</div>

<?php ob_end_flush(); // End output buffering ?>
