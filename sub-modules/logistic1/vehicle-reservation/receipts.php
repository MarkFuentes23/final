<?php 
include 'db_connect.php';

// Ensure the reservation ID is obtained safely
$reservationId = intval($_GET['id']); 
$reservation = $con->query("SELECT * FROM reservation WHERE id = $reservationId")->fetch_array();

if ($reservation) {
    // Fetch reservation details
    $pickup_location = $reservation['pickup_location'];
    $delivery_location = $reservation['delivery_location'];
    $delivery_date = $reservation['delivery_date'];
    $vehicle_type = $reservation['vehicle_type'];
    $contact_number = $reservation['contact_number'];
    $driver_id = $reservation['driver'];
    $reference_number = $reservation['reference_number'];
    $status_updated_at = $reservation['status_updated_at'];

    // Fetch driver details
    $driver_query = $con->query("SELECT first_name, middle_initial, last_name, phone, email, license_number FROM drivers WHERE id = $driver_id");
    $driver_row = $driver_query->fetch_array();
    
    // Concatenate driver name
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
    <title>Reservation Receipt</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="/css/rokkito.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa; /* Light background for better contrast */
        }
        .receipt-header, .receipt-footer {
            text-align: center;
            margin: 15px 0;
        }
        .receipt-details dt {
            font-weight: bold;
            margin-bottom: 2px; /* Reduce space between dt and dd */
        }
        .receipt-details dd {
            margin-bottom: 2px; /* Space between details */
            line-height: 1.2; /* Adjust line height for denser spacing */
        }
        .no-print {
            display: inline; /* Show buttons */
        }
        @media print {
            .no-print {
                display: none; /* Hide buttons on print */
            }
        }
        hr {
            margin: 10px 0; /* Reduce space around horizontal rules */
        }

        /* Responsive Design Adjustments */
        @media (max-width: 576px) {
            .receipt-header h1 {
                font-size: 24px; /* Smaller header font size */
            }
            .receipt-details dt, .receipt-details dd {
                font-size: 14px; /* Adjust font size for details */
            }
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="receipt-header">
        <h1>Reservation Receipt</h1>
        <h5>Paradise Hotel</h5>
        <hr>
    </div>

    <div class="receipt-details">
        <dl class="row">
            <dt class="col-6">Reservation ID:</dt>
            <dd class="col-6"><strong><?php echo $reservationId; ?></strong></dd>

            <dt class="col-6">Tracking Number:</dt>
            <dd class="col-6"><strong><?php echo $reference_number; ?></strong></dd>

            <dt class="col-6">Pickup Location:</dt>
            <dd class="col-6"><?php echo ucwords($pickup_location); ?></dd>

            <dt class="col-6">Delivery Location:</dt>
            <dd class="col-6"><?php echo ucwords($delivery_location); ?></dd>

            <dt class="col-6">Delivery Date:</dt>
            <dd class="col-6"><?php echo date('F j, Y', strtotime($delivery_date)); ?></dd>

            <dt class="col-6">Vehicle Type:</dt>
            <dd class="col-6"><?php echo ucwords($vehicle_type); ?></dd>

            <dt class="col-6">Contact Number:</dt>
            <dd class="col-6"><?php echo $contact_number; ?></dd>

            <dt class="col-6">Assigned Driver:</dt>
            <dd class="col-6"><?php echo $driver_name; ?></dd>

            <dt class="col-6">Driver Phone:</dt>
            <dd class="col-6"><?php echo $driver_phone; ?></dd>

            <dt class="col-6">Driver Email:</dt>
            <dd class="col-6"><?php echo $driver_email; ?></dd>

            <dt class="col-6">Driver License:</dt>
            <dd class="col-6"><?php echo $driver_license; ?></dd>
        </dl>

        <h5>Supplies Information</h5>
        <dl class="row">
            <dt class="col-6">Linens and Bedding:</dt>
            <dd class="col-6"><?php echo ucwords(implode(", ", $supplies)); ?></dd>

            <dt class="col-6">Towels and Bath Supplies:</dt>
            <dd class="col-6"><?php echo ucwords(implode(", ", $towels)); ?></dd>

            <dt class="col-6">Cleaning Supplies:</dt>
            <dd class="col-6"><?php echo ucwords(implode(", ", $cleaning)); ?></dd>

            <dt class="col-6">Guest Room Amenities:</dt>
            <dd class="col-6"><?php echo ucwords(implode(", ", $guest_amenities)); ?></dd>

            <dt class="col-6">Laundry Supplies:</dt>
            <dd class="col-6"><?php echo ucwords(implode(", ", $laundry)); ?></dd>

            <dt class="col-6">Prices:</dt>
            <dd class="col-6"><?php echo implode(", ", $prices); ?></dd>
        </dl>
        
    <div class="receipt-footer">
        <hr>
        <p>Thank you for your reservation!</p>
        <p>For any inquiries, please contact us.</p>
        <div class="no-print">
            <button class="btn btn-primary" onclick="printReservation()"><i class="fas fa-print"></i> Print</button>
            <button class="btn btn-secondary" onclick="window.history.back();"><i class="fas fa-arrow-left"></i> Back</button>
        </div>
    </div>
</div>
<script>
    function printReservation() {
        window.print();
    }
</script>
</body>
</html>
