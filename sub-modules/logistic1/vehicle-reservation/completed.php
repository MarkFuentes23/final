<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
include 'db_connect.php';

// Fetch completed reservations (status = 3)
$sql = "SELECT r.ID, r.reference_number, r.pickup_location, r.delivery_location, r.delivery_date, r.vehicle_type, r.contact_number, 
          r.status, d.first_name, d.last_name, d.phone, d.license_number 
        FROM reservation r
        JOIN drivers d ON r.driver = d.id
        WHERE r.status = 3"; // Only completed reservations

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../../../includes/logistic1/header.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/rokkito.css" rel="stylesheet">
    <link href="/css/condense.css" rel="stylesheet">
    <link href="/css/inconsolata.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/css/CSS1/upcoming-reservation.css?v=<?php echo time(); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
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
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body p-5">
                <h2 class="text-center">Completed Reservations</h2>
                <div class="table-responsive">
                    <table class="table table-bordered wide-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tracking Number</th>
                                <th>Pickup Location</th>
                                <th>Delivery Location</th>
                                <th>Delivery Date</th>
                                <th>Vehicle Type</th>
                                <th>Contact Number</th>
                                <th>Driver Information</th>
                                <th>Action</th> <!-- Add Action Column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $ID = $row['ID'];
                                    $reference_number = $row['reference_number'];
                                    $pickup_location = $row['pickup_location'];
                                    $delivery_location = $row['delivery_location'];
                                    $delivery_date = $row['delivery_date'];
                                    $vehicle_type = $row['vehicle_type'];
                                    $contact_number = $row['contact_number'];
                                    $driver_first_name = $row['first_name'];
                                    $driver_last_name = $row['last_name'];
                                    $driver_phone = $row['phone'];
                                    $driver_license = $row['license_number'];
                            ?>
                                    <tr>
                                        <td><?php echo $ID; ?></td>
                                        <td><?php echo $reference_number; ?></td>
                                        <td><?php echo $pickup_location; ?></td>
                                        <td><?php echo $delivery_location; ?></td>
                                        <td><?php echo $delivery_date; ?></td>
                                        <td><?php echo $vehicle_type; ?></td>
                                        <td><?php echo $contact_number; ?></td>
                                        <td>
                                            <strong>Full Name:</strong> <?php echo $driver_first_name . ' ' . $driver_last_name; ?><br>
                                            <strong>Phone:</strong> <?php echo $driver_phone; ?><br>
                                            <strong>License:</strong> <?php echo $driver_license; ?>
                                        </td>
                                        <td>
                                             <button type="button" class="btn btn-info btn-flat view_order" data-bs-toggle="modal" data-bs-target="#viewOrderModal" data-id="<?php echo $row['ID']; ?>"><i class="fas fa-eye"></i></button>
                                            <a href="receipts.php?id=<?php echo $ID; ?>" class="btn btn-success btn-sm"> <i class="bi bi-check-circle"></i> Generate Receipts</a>
                                        </td> <!-- Action Button -->
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='9'>No completed reservations found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                    </div>
            </div>
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn btn-primary1 me-2" onclick="window.history.back();">Back</button>
                </div>
            </div>

                <div class="modal fade" id="viewOrderModal" tabindex="-1" role="dialog" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg-wide" role="document"> <!-- Use your custom class -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewOrderModalLabel">Reservation Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modalContent">
                            <!-- Reservation details will be loaded here -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="/js/deliver-confirmation.js"></script>
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
