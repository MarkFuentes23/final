<?php
ob_start();
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
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/rokkito.css" rel="stylesheet">
    <link href="/css/condense.css" rel="stylesheet">
    <link href="/css/inconsolata.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/CSS1/vehicle.css?v=<?php echo time(); ?>">
    <!-- Link to Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Style for the map container */
        iframe {
            width: 100%;
            height: 500px; /* Reduced height for desktop */
            border: none;
        }

        /* Media query for smaller screens */
        @media (max-width: 768px) {
            iframe {
                height: 350px; /* Smaller height for tablets and medium-sized screens */
            }
        }

        @media (max-width: 480px) {
            iframe {
                height: 250px; /* Further reduction for smartphones */
            }
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
    <?php include('../../../includes/logistic1/topnavbar.php'); ?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <?php include('../../../includes/logistic1/driver-sidebar.php'); ?>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container mt-4">
                    <h3>Waze Map</h3>
                    <div class="map-container">
                        <iframe 
                            src="https://embed.waze.com/iframe?zoom=13&lat=14.5995&lon=120.9842" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="mt-4">
                        <h5>Route from Start to End</h5>
                        <p>
                            <a href="https://waze.com/ul?ll=14.5995%2C120.9842&navigate=yes" target="_blank" class="btn btn-primary">
                                Start Here
                            </a>
                            <a href="https://waze.com/ul?ll=14.6010%2C120.9922&navigate=yes" target="_blank" class="btn btn-primary">
                                End Here
                            </a>
                        </p>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php include('../../../includes/logistic1/script.php'); ?>
    <footer class="py-4 bg-light mt-auto">
    <?php include('../../../includes/logistic1/footer.php'); ?>
    </footer>
</div>

<script src="../../../JS/vehicle-reservation.js"></script>
<?php include('../../../includes/logistic1/script.php'); ?>
<script src="/js/scripts.js"></script>
</body>
</html>
