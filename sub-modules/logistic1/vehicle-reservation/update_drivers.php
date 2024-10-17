<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
include 'db_connect.php';
$id = $_GET['updateID'];
$sql = "SELECT * FROM drivers WHERE id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
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

if (isset($_POST['submit'])) {
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

    $sql = "UPDATE drivers SET first_name='$first_name', middle_initial='$middle_initial', last_name='$last_name', phone='$phone', email='$email', license_number='$license_number', license_expiry='$license_expiry', license_type='$license_type', vehicle_id='$vehicle_id', vehicle_type='$vehicle_type' WHERE id=$id";
    
      $result = mysqli_query($con, $sql);
    if ($result) {
        $_SESSION['toast_message'] = "Driver information updated successfully!";
        $_SESSION['toast_type'] = "success"; // or "error" for failure
        header('location:driver_list.php');
        exit();
    } else {
        $_SESSION['toast_message'] = "Error updating driver information: " . mysqli_error($con);
        $_SESSION['toast_type'] = "error";
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
                <h1>Update Driver Information</h1>
                <div class="profile-card p-5">
                    <form method="POST" class="needs-validation" novalidate>
                        <!-- Driver Information Section -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required>
                                <div class="invalid-feedback">Please provide the first name.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="middle_initial" class="form-label">Middle Initial</label>
                                <input type="text" class="form-control" id="middle_initial" name="middle_initial" value="<?php echo $middle_initial; ?>" required>
                                <div class="invalid-feedback">Please provide the middle initial.</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required>
                                <div class="invalid-feedback">Please provide the last name.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
                                <div class="invalid-feedback">Please provide the phone number.</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                                <div class="invalid-feedback">Please provide a valid email address.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="license_number" class="form-label">License Number</label>
                                <input type="text" class="form-control" id="license_number" name="license_number" value="<?php echo $license_number; ?>" required>
                                <div class="invalid-feedback">Please provide the license number.</div>
                            </div>
                        </div>

                        <!-- Vehicle Information Section -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="license_expiry" class="form-label">License Expiry</label>
                                <input type="date" class="form-control" id="license_expiry" name="license_expiry" value="<?php echo $license_expiry; ?>" required>
                                <div class="invalid-feedback">Please provide the license expiration date.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="license_type" class="form-label">License Type</label>
                                <input type="text" class="form-control" id="license_type" name="license_type" value="<?php echo $license_type; ?>" required>
                                <div class="invalid-feedback">Please provide the license type.</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="vehicle_id" class="form-label">Vehicle Plate Number</label>
                                <input type="text" class="form-control" id="vehicle_id" name="vehicle_id" value="<?php echo $vehicle_id; ?>" required>
                                <div class="invalid-feedback">Please provide the vehicle ID or number.</div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                <select class="form-select" id="vehicle_type" name="vehicle_type" required>
                                    <option value="" disabled selected>Choose...</option>
                                    <option value="van" <?php if($vehicle_type == 'van') echo 'selected'; ?>>Van</option>
                                    <option value="truck" <?php if($vehicle_type == 'truck') echo 'selected'; ?>>Truck</option>
                                    <option value="L300" <?php if($vehicle_type == 'L300') echo 'selected'; ?>>L300</option>
                                </select>
                                <div class="invalid-feedback">Please choose a vehicle type.</div>
                            </div>
                        </div>

                        <!-- Button Section -->
                        <div class="button-group">
                            <button type="button" class="btn btn-primary1" onclick="window.history.back();">Back</button>
                            <button type="submit" class="btn btn-primary1" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <!-- Toast Notification -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
            <div class="toast-header">
                <strong class="me-auto"><?php echo isset($_SESSION['toast_type']) && $_SESSION['toast_type'] === "success" ? "Success" : "Error"; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php 
                if (isset($_SESSION['toast_message'])) {
                    echo $_SESSION['toast_message'];
                    unset($_SESSION['toast_message']);
                    unset($_SESSION['toast_type']);
                } 
                ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Show the toast if there's a message
            <?php if (isset($_SESSION['toast_message'])): ?>
                var toast = new bootstrap.Toast($('#liveToast'));
                toast.show();
            <?php endif; ?>
        });
    </script>
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

