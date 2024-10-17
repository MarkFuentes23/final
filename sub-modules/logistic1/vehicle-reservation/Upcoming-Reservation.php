<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
include 'db_connect.php';

// Fetch reservations that are not completed (status = 3)
$sql = "SELECT r.ID, r.reference_number, r.pickup_location, r.delivery_location, r.delivery_date, r.vehicle_type, r.contact_number, 
          r.status, d.first_name, d.last_name, d.phone, d.license_number 
        FROM reservation r
        JOIN drivers d ON r.driver = d.id
        WHERE r.status != 3"; // Exclude completed reservations

$result = mysqli_query($con, $sql);
?>

<!-- Remaining HTML and PHP code -->


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../../../includes/logistic1/header.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/rokkito.css" rel="stylesheet">
    <link href="/css/condense.css" rel="stylesheet">
    <link href="/css/inconsolata.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/CSS1/upcoming-reservation.css?v=<?php echo time(); ?>">
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

                <!-- Toast Notification -->
                <div class="toast-container position-fixed top-0 end-0 p-3">
                    <?php if (isset($_SESSION['toast_message'])): ?>
                        <div id="liveToast" class="toast align-items-center text-bg-<?php echo $_SESSION['toast_type']; ?> border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <?php echo $_SESSION['toast_message']; ?>
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                        <?php unset($_SESSION['toast_message'], $_SESSION['toast_type']); ?>
                    <?php endif; ?>
                </div>

                <!-- Card with Completed Reservations -->
                <div class="card">
                    <div class="card-body p-5">
                        <h2 class="text-center">Upcoming Reservations with Delivery</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered wide-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tracking Number</th> <!-- New Column for Reference Number -->
                                        <th>Pickup Location</th>
                                        <th>Delivery Location</th>
                                        <th>Delivery Date</th>
                                        <th>Vehicle Type</th>
                                        <th>Contact Number</th>
                                        <th>Driver Information</th>
                                        <th>Status</th> <!-- New Status Column -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php
// Your existing code
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
                                        $status = $row['status']; // Get the status

                                        // Determine the status string
                                        switch ($status) {
                                            case 1:
                                                $status_text = "Pending";
                                                $badge_class = "badge bg-info";
                                                $row_class = ""; // No special color for pending
                                                $disabled = false; // Allow actions
                                                break;
                                            case 2:
                                                $status_text = "In Progress";
                                                $badge_class = "badge bg-warning";
                                                $row_class = ""; // No special color for in-progress
                                                $disabled = false; // Allow actions
                                                break;
                                            case 5:
                                                $status_text = "Collected";
                                                $badge_class = "badge bg-info";
                                                $row_class = ""; // No special color for collected
                                                $disabled = false; // Allow actions
                                                break;
                                            case 6:
                                                $status_text = "Shipped";
                                                $badge_class = "badge bg-info";
                                                $row_class = ""; // No special color for shipped
                                                $disabled = false; // Allow actions
                                                break;
                                            case 7:
                                                $status_text = "In-Transit";
                                                $badge_class = "badge bg-primary";
                                                $row_class = ""; // No special color for in-transit
                                                $disabled = false; // Allow actions
                                                break;
                                            case 3:
                                                $status_text = "Completed";
                                                $badge_class = "badge bg-success";
                                                $row_class = "bg-success text-white"; // Green background for completed
                                                $disabled = true; // Disable actions
                                                break;
                                            case 4:
                                                $status_text = "Cancelled";
                                                $badge_class = "badge bg-danger";
                                                $row_class = "bg-danger text-white"; // Green background for cancelled
                                                $disabled = true; // Disable actions
                                                break;
                                            default:
                                                $status_text = "Unknown";
                                                $badge_class = "badge bg-secondary";
                                                $row_class = ""; // No special color for unknown
                                                $disabled = false; // Allow actions
                                                break;
                                        }
                                ?>
                                        <tr class="<?php echo $row_class; ?>"> <!-- Add row_class to the table row -->
                                            <td><?php echo $ID; ?></td>
                                            <td><?php echo $reference_number; ?></td>
                                            <td><?php echo $pickup_location; ?></td>
                                            <td><?php echo $delivery_location; ?></td>
                                            <td><?php echo $delivery_date; ?></td>
                                            <td><?php echo $vehicle_type; ?></td>
                                            <td><?php echo $contact_number; ?></td>
                                            <td>
                                                <strong> Full Name:</strong> <?php echo $driver_first_name . ' ' . $driver_last_name; ?><br>
                                                <strong> Phone:</strong> <?php echo $driver_phone; ?><br>
                                                <strong> License:</strong> <?php echo $driver_license; ?>
                                            </td>
                                            <td><span class="<?php echo $badge_class; ?>"><?php echo $status_text; ?></span></td>
                                            <td>
                                                <!-- Disable buttons if the status is Completed or Cancelled -->
                                                <button type="button" class="btn btn-info btn-flat view_order" data-bs-toggle="modal" data-bs-target="#viewOrderModal" data-id="<?php echo $row['ID']; ?>" <?php echo $disabled ? 'disabled' : ''; ?>>
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="update_reservation.php?updateID=<?php echo $ID; ?>" class="btn btn-success btn-sm <?php echo $disabled ? 'disabled' : ''; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="delete-reservation.php?deleteID=<?php echo $ID; ?>" class="btn btn-danger btn-sm <?php echo $disabled ? '' : ''; ?>">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='10'>No upcoming reservations found.</td></tr>"; // Updated colspan to 10
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal for Viewing Reservation Details -->
                        <div class="modal fade" id="viewOrderModal" tabindex="-1" role="dialog" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg-wide" role="document">
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

                    <script src="/js/upcoming-modal.js"></script>
                        <div class="d-flex justify-content-start">
                            <button type="button" class="btn btn-primary1 me-2" onclick="window.history.back();">Back</button>
                            <a href="Vehicle-Reservation.php" class="btn btn-primary1">Insert New</a>
                        </div>
                    </div>
                </div>
                 </div>
                
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