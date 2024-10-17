<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
include 'db_connect.php';
if (isset($_POST['confirm'])) {
    $first_name = $_POST['first_name'];
    $middle_initial = $_POST['middle_initial'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $license_number = $_POST['license_number'];
    $license_expiry = $_POST['license_expiry'];
    $license_type = $_POST['license_type'];
    $vehicle_id = $_POST['vehicle_id'];
    $vehicle_type = $_POST['vehicle_type'];

    $sql = "INSERT INTO drivers (first_name, middle_initial, last_name, phone, email, license_number, license_expiry, license_type, vehicle_id, vehicle_type) 
    VALUES('$first_name', '$middle_initial', '$last_name', '$phone', '$email', '$license_number', '$license_expiry', '$license_type', '$vehicle_id', '$vehicle_type')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:driver_list.php');
    } else {
        die(mysqli_error($con));
    }
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
            <h1>Fleet Driver Information Form</h1>
        <div class="profile-card p-5">
                <form method="POST" class="needs-validation" novalidate>
                    <!-- Driver Information Section -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                            <div class="invalid-feedback">Please provide the first name.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="middle_initial" class="form-label">Middle Initial</label>
                            <input type="text" class="form-control" id="middle_initial" name="middle_initial"  placeholder="Middle Initial" required>
                            <div class="invalid-feedback">Please provide the middle initial.</div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                            <div class="invalid-feedback">Please provide the last name.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone number" required>
                            <div class="invalid-feedback">Please provide the phone number.</div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                            <div class="invalid-feedback">Please provide a valid email address.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="license_number" class="form-label">License Number</label>
                            <input type="text" class="form-control" id="license_number" name="license_number" placeholder="License Number"required>
                            <div class="invalid-feedback">Please provide the license number.</div>
                        </div>
                    </div>

                    <!-- Vehicle Information Section -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="license_expiry" class="form-label">License Expiration</label>
                            <input type="date" class="form-control" id="license_expiry" name="license_expiry"  required>
                            <div class="invalid-feedback">Please provide the license expiration date.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="license_type" class="form-label">License Type</label>
                            <input type="text" class="form-control" id="license_type" name="license_type" placeholder="License Type" required>
                            <div class="invalid-feedback">Please provide the license type.</div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="vehicle_id" class="form-label">Vehicle Plate Number</label>
                            <input type="text" class="form-control" id="vehicle_id" name="vehicle_id"  placeholder="Vehicle Plate Number" required>
                            <div class="invalid-feedback">Please provide the vehicle ID or number.</div>
                        </div>
                        
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

                    <!-- Button Section -->
                    <div class="button-group">
                        <button type="button" class="btn btn-primary1" onclick="window.history.back();">Back</button>
                        <button type="submit" class="btn btn-primary1" name="confirm">Submit</button>
                    </div>
                </form>
            </div>
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

