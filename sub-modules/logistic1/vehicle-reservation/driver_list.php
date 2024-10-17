<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db_connect.php';
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
    <link rel="stylesheet" href="/css/CSS1/update-reservation.css?v=<?php echo time(); ?>">
    <!-- Link to Font Awesome for Icons -->
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

        <!-- Main content area -->
        <div id="layoutSidenav_content">
            <div class="container mt-5">
                
                <!-- Toast Notification -->
                <?php if (isset($_SESSION['toast_message']) && isset($_SESSION['toast_type'])): ?>
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div id="toast" class="toast align-items-center text-bg-<?php echo $_SESSION['toast_type']; ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <?php echo $_SESSION['toast_message']; ?>
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>

                    <script>
                        var toastEl = document.getElementById('toast');
                        var toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    </script>

                    <!-- Unset the toast after displaying it -->
                    <?php unset($_SESSION['toast_message']); unset($_SESSION['toast_type']); ?>
                <?php endif; ?>

        <div class="card">
            <div class="card-body p-5">
                <h2 class="text-center">List of Drivers</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">License Number</th>
                                <th scope="col">License Expiration</th>
                                <th scope="col">License Type</th>
                                <th scope="col">Vehicle Plate #</th>
                                <th scope="col">Type of Vehicle</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `drivers`";
                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $first_name = $row['first_name'];
                                    $middle_initial = $row['middle_initial'];
                                    $last_name = $row['last_name'];
                                    $phone = $row['phone'];
                                    $email = $row['email'];
                                    $license_number = $row['license_number'];
                                    $license_expiry = $row['license_expiry'];
                                    $license_type = $row['license_type'];
                                    $vehicle_id = $row['vehicle_id'];
                                    $vehicle_type = $row['vehicle_type'];

                                    $full_name = $first_name . ' ' . $middle_initial . '. ' . $last_name;

                                    echo '<tr>
                                        <th scope="row">' . $id . '</th>
                                        <td>' . $full_name . '</td>
                                        <td>' . $phone . '</td>
                                        <td>' . $email . '</td>
                                        <td>' . $license_number . '</td>
                                        <td>' . $license_expiry . '</td>
                                        <td>' . $license_type . '</td>
                                        <td>' . $vehicle_id . '</td>
                                        <td>' . $vehicle_type . '</td>
                                        <td>
                                            <a href="update_drivers.php?updateID=' . $id . '" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="delete_drivers.php?deleteID=' . $id . '" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>';
                                }
                            } else {
                                echo "Error: " . mysqli_error($con);
                            }
                            mysqli_close($con);
                            ?>
                        </tbody>
                    </table>
                </div>
 

                <!-- Action buttons -->
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn btn-primary1 me-2" onclick="window.history.back();">Back</button>
                    <a href="fleet_driver.php" class="btn btn-primary1">Insert New</a>
                </div>
            </div>
               </div>
                   </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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
