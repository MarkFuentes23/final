<?php
session_start();

include 'db_connect.php';

// Fetch upcoming reservations from the database
$sql = "SELECT pickup_location, delivery_location, delivery_date, vehicle_type, contact_number, driver FROM reservation ORDER BY delivery_date ASC";
$result = $con->query($sql);

// Fetch drivers from the database
$driver_sql = "SELECT id, first_name, middle_initial, last_name, phone, email, license_number FROM drivers";
$driver_result = mysqli_query($con, $driver_sql);
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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
         <div class="container mt-5">
               <h2 class="text-center">Vehicle Reservations with Delivery</h2>
        <div class="profile-card p-5">
            <form class="needs-validation" action="submit_reservation.php" method="POST" novalidate>
                <div class="row mb-4">
                    <!-- Pickup Location -->
                    <div class="col-md-6 mb-4">
                        <label for="pickup_location" class="form-label">Pickup Location</label>
                        <input type="text" class="form-control" id="pickup_location" name="pickup_location" placeholder="Enter pickup location" required>
                        <div class="invalid-feedback">Please provide a pickup location.</div>
                    </div>

                    <!-- Delivery Location -->
                    <div class="col-md-6 mb-4">
                        <label for="delivery_location" class="form-label">Delivery Location</label>
                        <input type="text" class="form-control" id="delivery_location" name="delivery_location" placeholder="Enter delivery location" required>
                        <div class="invalid-feedback">Please provide a delivery location.</div>
                    </div>
                </div>

                <div class="row mb-4">
                    <!-- Delivery Date -->
                    <div class="col-md-6 mb-4">
                        <label for="delivery_date" class="form-label">Delivery Date</label>
                        <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
                        <div class="invalid-feedback">Please choose a delivery date.</div>
                    </div>

                    <!-- Vehicle Type -->
                    <div class="col-md-6 mb-4">
                        <label for="vehicle_type" class="form-label">Vehicle Type</label>
                        <select class="form-select" id="vehicle_type" name="vehicle_type" required>
                            <option value="" disabled selected>Choose...</option>
                            <option value="van">Van</option>
                            <option value="truck">Truck</option>
                            <option value="L300">L300</option>
                        </select>
                        <div class="invalid-feedback">Please choose a vehicle type.</div>
                    </div>
                </div>

                <div class="row mb-4">
                        <div class="col-md-6 mb-4">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_number" name="contact_number" placeholder="Enter Contact Number" required>
                            <div class="invalid-feedback">Please provide a contact number.</div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label for="driver" class="form-label">Assign Driver</label>
                            <select class="form-select" id="driver" name="driver" required>
                                <option value="" disabled selected>Choose...</option>
                                <?php
                                if ($driver_result) {
                                    while ($driver_row = mysqli_fetch_assoc($driver_result)) {
                                        $driver_id = $driver_row['id'];
                                        $driver_name = $driver_row['first_name'] . ' ' . $driver_row['middle_initial'] . '. ' . $driver_row['last_name'];
                                        $driver_phone = $driver_row['phone'];
                                        $driver_email = $driver_row['email'];
                                        $driver_license = $driver_row['license_number'];
                                        
                                        echo "<option value='$driver_id'>$driver_name (Phone: $driver_phone, Email: $driver_email, License: $driver_license)</option>";
                                    }
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">Please select a driver.</div>
                        </div>
                    </div>

             <!-- SUPPLIES INFORMATION SECTION --> 
               <div class="row mb-4">
    <div class="col-md-12">
        <b>SUPPLIES INFORMATION</b>
        <div class="table-responsive">
            <table class="table table-bordered" id="parcel-items">
                <thead>
                    <tr>
                        <th>Linens and Bedding</th>
                        <th>Towels and Bath Supplies</th>
                        <th>Cleaning Supplies</th>
                        <th>Guest Room Amenities</th>
                        <th>Laundry Supplies</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><textarea name='linens[]' class="form-control" rows="3" placeholder="Enter linens and bedding details" class="form-control" required></textarea></td>
                        <td><textarea name='towels[]' class="form-control" rows="3" placeholder="Enter towels and bath supplies" class="form-control" required></textarea></td>
                        <td><textarea name='cleaning[]' class="form-control" rows="3" placeholder="Enter cleaning supplies" class="form-control" required></textarea></td>
                        <td><textarea name='guest_amenities[]' class="form-control" rows="3" placeholder="Enter guest room amenities" class="form-control" required></textarea></td>
                        <td><textarea name='laundry[]' class="form-control" rows="3" placeholder="Enter laundry supplies" class="form-control" required></textarea></td>
                        <td><input type="text" class="form-control price-input" name='price[]' placeholder="Enter price" class="form-control" required></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5"></th>
                        <th class="text-right"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Button Group -->
<div class="button-group">
    <button type="button" class="btn btn-primary1" onclick="window.history.back();">Back</button>
    <button type="submit" class="btn btn-primary1" name="submit_reservation">Submit Reservation</button>
</div>
                </div>

                <!-- Additional Script for SUPPLIES INFORMATION -->
    <script src="/js/supplies.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
 

    
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
