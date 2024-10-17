<?php
ob_start(); // Starts output buffering

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../../../includes/logistic1/header.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>budget management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/rokkito.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/css/CSS1/vehicle.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
        <?php include('../../../includes/logistic1/topnavbar.php'); ?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <?php include('../../../includes/logistic1/sidenavbar.php'); ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <div class="main-content">
                    <header class="mb-4">
                        <h1 class="h2">Logistics 1: Hotel & Restaurant Management</h1>
                        <p>Manage your operations efficiently</p>
                    </header>

                    <!-- Dashboard Section -->
                    <section id="dashboard">
                        <h2 class="h4">Dashboard Overview</h2>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Tasks in Progress</h5>
                                        <p class="card-text">
                                            <?php
                                                // Fetch the number of active tasks dynamically from the database
                                                $active_tasks = 12; // Replace this with a database query result
                                                echo $active_tasks . " Active Tasks";
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Warehouse Stock</h5>
                                        <p class="card-text">
                                            <?php
                                                // Fetch warehouse stock dynamically from the database
                                                $warehouse_stock = 320; // Replace this with a database query result
                                                echo $warehouse_stock . " Items Available";
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Vehicle Bookings</h5>
                                        <p class="card-text">
                                            <?php
                                                // Fetch vehicle bookings dynamically from the database
                                                $vehicle_bookings = 5; // Replace this with a database query result
                                                echo $vehicle_bookings . " Reservations";
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                   </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <footer class="py-4 bg-light mt-auto">
                     <?php include('../../../includes/logistic1/footer.php'); ?>
                </footer>
            </div>
        </div>
        <?php include('../../../includes/logistic1/script.php'); ?>
    </body>
</html>
