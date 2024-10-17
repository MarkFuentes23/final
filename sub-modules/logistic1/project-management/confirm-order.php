<?php 
include 'db_connect.php';

// Ensure the reservation ID is obtained safely
$reservationId = intval($_GET['id']); // Use intval to prevent SQL injection
$reservation = $con->query("SELECT * FROM reservation WHERE id = $reservationId")->fetch_array();

if ($reservation) {
    $pickup_location = $reservation['pickup_location'];
    $delivery_location = $reservation['delivery_location'];
    $delivery_date = $reservation['delivery_date'];
    $vehicle_type = $reservation['vehicle_type'];
    $contact_number = $reservation['contact_number'];
    $driver_id = $reservation['driver'];
    $status = $reservation['status'];
    $reference_number = $reservation['reference_number']; // Fetch reference number
    $status_updated_at = $reservation['status_updated_at']; // Fetch last status update time

    // Fetch driver details
    $driver_query = $con->query("SELECT first_name, middle_initial, last_name, phone, email, license_number FROM drivers WHERE id = $driver_id");
    $driver_row = $driver_query->fetch_array();
    
    // Concatenate driver name and additional details
    $driver_name = ucwords($driver_row['first_name'] . ' ' . $driver_row['middle_initial'] . '. ' . $driver_row['last_name']);
    $driver_phone = $driver_row['phone'];
    $driver_email = $driver_row['email'];
    $driver_license = $driver_row['license_number'];

    // Fetch supplies information
    $supplies = (array) ($reservation['linens'] ? json_decode($reservation['linens'], true) : []);
    $towels = (array) ($reservation['towels'] ? json_decode($reservation['towels'], true) : []);
    $cleaning = (array) ($reservation['cleaning'] ? json_decode($reservation['cleaning'], true) : []);
    $guest_amenities = (array) ($reservation['guest_amenities'] ? json_decode($reservation['guest_amenities'], true) : []);
    $laundry = (array) ($reservation['laundry'] ? json_decode($reservation['laundry'], true) : []);
    $prices = (array) ($reservation['prices'] ? json_decode($reservation['prices'], true) : []);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include('../../../includes/logistic1/header.php'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="/css/rokkito.css" rel="stylesheet">
    <link href="/css/condense.css" rel="stylesheet">
    <link href="/css/inconsolata.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/CSS1/get_resevation.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <div class="row mb-4">
        <!-- Reservation ID -->
        <div class="col-md-6">
            <div class="p-3 rounded mb-3" style="border: 2px solid #3CB371;">
                <dt>Reservation ID:</dt>
                <dd class="reservation-id"><h4><b><?php echo $reservationId; ?></b></h4></dd>
            </div>
        </div>

        <!-- Tracking Number -->
        <div class="col-md-6 text-right">
            <div class="p-3 rounded mb-3" style="border: 2px solid #3CB371;">
                <dt>Tracking Number:</dt>
                <dd class="reservation-id"><h4><b><?php echo $reference_number; ?></b></h4></dd>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Order Details -->
        <div class="col-md-12">
            <div class="p-3 rounded mb-3" style="border: 2px solid #3CB371;">
                <h5>Order Details</h5>
                <div class="row">
                    <div class="col-md-6">
                        <dt>Pickup Location:</dt>
                        <dd><?php echo ucwords($pickup_location); ?></dd>
                    </div>
                    <div class="col-md-6">
                        <dt>Delivery Location:</dt>
                        <dd><?php echo ucwords($delivery_location); ?></dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <dt>Delivery Date:</dt>
                        <dd><?php echo date('F j, Y', strtotime($delivery_date)); ?></dd>
                    </div>
                    <div class="col-md-6">
                        <dt>Vehicle Type:</dt>
                        <dd><?php echo ucwords($vehicle_type); ?></dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <dt>Contact Number:</dt>
                        <dd><?php echo $contact_number; ?></dd>
                    </div>
                    <div class="col-md-6">
                        <dt>Assigned Driver:</dt>
                        <dd><?php echo $driver_name; ?></dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <dt>Driver Phone:</dt>
                        <dd><?php echo $driver_phone; ?></dd>
                    </div>
                    <div class="col-md-6">
                        <dt>Driver Email:</dt>
                        <dd><?php echo $driver_email; ?></dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <dt>Driver License:</dt>
                        <dd><?php echo $driver_license; ?></dd>
                    </div>
                </div>
            </div>
        </div>

        <!-- Supplies Information -->
        <div class="col-md-12">
            <div class="p-3 rounded mb-3" style="border: 2px solid #3CB371;">
                <h5>Supplies Information</h5>
                <dt>Linens and Bedding:</dt>
                <dd><?php echo ucwords(implode(", ", $supplies)); ?></dd>
                <dt>Towels and Bath Supplies:</dt>
                <dd><?php echo ucwords(implode(", ", $towels)); ?></dd>
                <dt>Cleaning Supplies:</dt>
                <dd><?php echo ucwords(implode(", ", $cleaning)); ?></dd>
                <dt>Guest Room Amenities:</dt>
                <dd><?php echo ucwords(implode(", ", $guest_amenities)); ?></dd>
                <dt>Laundry Supplies:</dt>
                <dd><?php echo ucwords(implode(", ", $laundry)); ?></dd>
                <dt>Prices:</dt>
                <dd><?php echo implode(", ", $prices); ?></dd>
            </div>
        </div>

        <!-- Status Section -->
        <div class="col-md-12">
            <div class="p-3 rounded mb-3" style="border: 2px solid #3CB371;">
                <b>Status:</b>
                <dd>
                    <?php 
                    switch ($status) {
                        case '1':
                            echo "<span class='badge badge-info'>Pending</span>";
                            break;
                        case '2':
                            echo "<span class='badge badge-warning'>In Progress</span>"; 
                            break;
                        case '5':
                            echo "<span class='badge badge-pill badge-info'>Collected</span>"; 
                            break;
                        case '6':
                            echo "<span class='badge badge-pill badge-info'>Shipped</span>"; 
                            break;
                        case '7':
                            echo "<span class='badge badge-pill badge-primary'>In-Transit</span>";
                            break;
                        case '3':
                            echo "<span class='badge badge-success'>Completed</span>"; 
                            break;
                        case '4':
                            echo "<span class='badge badge-danger'>Cancelled</span>"; 
                            break;
                        default:
                            echo "<span class='badge badge-secondary'>Unknown Status</span>"; 
                            break;
                    }
                    ?>
                </dd>
            </div>
        </div> 
    </div>
</div>
</body>
</html>
