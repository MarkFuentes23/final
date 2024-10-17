<?php
ob_start(); // Starts output buffering

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db_connect.php';

$reservationDetails = null; // Initialize to store reservation details

// Check if a reference number has been submitted
if (isset($_POST['reference_number'])) {
    $referenceNumber = $_POST['reference_number'];
    // Prevent SQL injection
    $referenceNumber = $con->real_escape_string($referenceNumber);
    
    // Query to fetch reservation details based on reference number
    $query = "SELECT * FROM reservation WHERE reference_number = '$referenceNumber'";
    $result = $con->query($query);
    
    if ($result && $result->num_rows > 0) {
        $reservationDetails = $result->fetch_array();
    } else {
        $error_message = "No reservation found with that reference number.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../../../includes/logistic1/header.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/rokkito.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/css/CSS1/track.css?v=<?php echo time(); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
        <?php include('../../../includes/logistic1/topnavbar.php'); ?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <?php include('../../../includes/logistic1/user-sidebar.php'); ?>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <div class="container mt-5">
                <h2>Track Your Order</h2>
                <form method="post" class="mb-4">
                    <div class="form-group">
                        <label for="reference_number">Tracking Number:</label>
                        <input type="text" name="reference_number" id="reference_number" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary1">Search</button>
                </form>

                <?php if (isset($reservationDetails)): ?>
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="p-3 rounded mb-3" style="border: 2px solid #3CB371;">
                                    <dt>Reservation ID:</dt>
                                    <dd class="reservation-id"><h4><b><?php echo $reservationDetails['id']; ?></b></h4></dd>
                                </div>
                                <div class="p-3 rounded mb-3" style="border: 2px solid #3CB371;">
                                    <dt>Order Details:</dt>
                                    <dd>
                                        <ul>
                                            <li><strong>Pickup Location:</strong> <?php echo ucwords($reservationDetails['pickup_location']); ?></li>
                                            <li><strong>Delivery Location:</strong> <?php echo ucwords($reservationDetails['delivery_location']); ?></li>
                                            <li><strong>Delivery Date:</strong> <?php echo date('F j, Y', strtotime($reservationDetails['delivery_date'])); ?></li>
                                            <li><strong>Vehicle Type:</strong> <?php echo ucwords($reservationDetails['vehicle_type']); ?></li>
                                            <li><strong>Contact Number:</strong> <?php echo $reservationDetails['contact_number']; ?></li>
                                            <li><strong>Assigned Driver:</strong> 
                                                <?php
                                                $driver_query = $con->query("SELECT first_name, middle_initial, last_name, phone, email, license_number FROM drivers WHERE id = " . $reservationDetails['driver']);
                                                $driver = $driver_query->fetch_array();
                                                $driver_name = ucwords($driver['first_name'] . ' ' . $driver['middle_initial'] . ' ' . $driver['last_name']);
                                                echo $driver_name; // Display only the driver's name here
                                                ?>
                                            </li>
                                            <li><strong>Driver Phone:</strong> <?php echo $driver['phone']; ?></li>
                                            <li><strong>Driver Email:</strong> <?php echo $driver['email']; ?></li>
                                            <li><strong>Driver License:</strong> <?php echo $driver['license_number']; ?></li>
                                        </ul>
                                    </dd>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 rounded mb-3" style="border: 2px solid #3CB371;">
                                    <dt>Tracking Number:</dt>
                                    <dd class="reservation-id"><h4><b><?php echo $reservationDetails['reference_number']; ?></b></h4></dd>
                                </div>
                                <div class="p-3 rounded mb-3" style="border: 2px solid #3CB371;">
                                    <dt>Supplies Information:</dt>
                                    <dd>
                                        <ul>
                                            <?php
                                            // Decode the supplies information
                                            $supplies = (array) ($reservationDetails['linens'] ? json_decode($reservationDetails['linens'], true) : []);
                                            $towels = (array) ($reservationDetails['towels'] ? json_decode($reservationDetails['towels'], true) : []);
                                            $cleaning = (array) ($reservationDetails['cleaning'] ? json_decode($reservationDetails['cleaning'], true) : []);
                                            $guest_amenities = (array) ($reservationDetails['guest_amenities'] ? json_decode($reservationDetails['guest_amenities'], true) : []);
                                            $laundry = (array) ($reservationDetails['laundry'] ? json_decode($reservationDetails['laundry'], true) : []);
                                            $prices = (array) ($reservationDetails['prices'] ? json_decode($reservationDetails['prices'], true) : []);
                                            ?>
                                            <li><strong>Linens and Bedding:</strong>  <?php echo ucwords(implode(", ", $supplies)); ?></li>
                                            <li><strong>Towels and Bath Supplies:</strong> <?php echo ucwords(implode(", ", $towels)); ?></li>
                                            <li><strong>Cleaning Supplies:</strong> <?php echo ucwords(implode(", ", $cleaning)); ?></li>
                                            <li><strong>Guest Room Amenities:</strong> <?php echo ucwords(implode(", ", $guest_amenities)); ?></li>
                                            <li><strong>Laundry Supplies:</strong> <?php echo ucwords(implode(", ", $laundry)); ?></li>
                                            <li><strong>Prices:</strong> <?php echo implode(", ", $prices); ?></li>
                                        </ul>
                                    </dd>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="status-section mt-3">
                            <div class="status">
                                <dt>Status:</dt>
                                <dd>
                                    <?php
                                    switch ($reservationDetails['status']) {
                                        case '1':
                                            echo "Your order is still <span class='badge bg-info'>Pending</span>"; 
                                            break;
                                        case '2':
                                            echo "Your order is currently <span class='badge bg-warning'>In Progress</span>"; 
                                            break;
                                        case '5':
                                            echo "Your order has been <span class='badge bg-info'>Collected</span>"; 
                                            break;
                                        case '6':
                                            echo "Your order is already <span class='badge bg-info'>Shipped</span>"; 
                                            break;
                                        case '7':
                                            echo "Your order is currently <span class='badge bg-primary'>In-Transit</span>"; 
                                            break;
                                        case '3':
                                            echo "Your order has been <span class='badge bg-success'>Completed</span>"; 
                                            break;
                                        case '4':
                                            echo "Your order has been <span class='badge bg-danger'>Cancelled</span>"; 
                                            break;
                                        default:
                                            echo "Your order status is <span class='badge bg-secondary'>Unknown</span>"; 
                                            break;
                                    }
                                    ?>
                                </dd>
                            </div>
                            
                            <div class="status-updated-at text-right">
                                <dt>Status Updated At:</dt>
                                <dd>
                                    <?php
                                    // Format and display the status updated timestamp
                                    echo date('F j, Y, g:i A', strtotime($reservationDetails['status_updated_at']));
                                    ?>
                                </dd>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger mt-4"><?php echo $error_message; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
            <?php include('../../../includes/logistic1/script.php'); ?>
            <footer class="py-4 bg-light mt-auto">
                <?php include('../../../includes/logistic1/footer.php'); ?>
            </footer>
        </div>
    </div>
</body>
</html>