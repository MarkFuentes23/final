<?php 
include 'db_connect.php';

// Ensure the reservation ID is obtained safely
$reservationId = intval($_GET['id']); // Use intval to prevent SQL injection

try {
    // Fetch reservation details
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
    } else {
        throw new Exception("Reservation not found.");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <!-- Reservation Details Section -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="callout callout-info">
                                    <dl class="row"> <!-- Added Bootstrap row class -->
                                        <div class="col-md-6"> <!-- First column for Reservation ID -->
                                            <dt>Reservation ID:</dt>
                                            <dd><h4><b><?php echo $reservationId; ?></b></h4></dd>
                                        </div>
                                        <div class="col-md-6"> <!-- Second column for Tracking Number -->
                                            <dt>Tracking Number:</dt>
                                            <dd><h4><b><?php echo $reference_number; ?></b></h4></dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    <div class="container-fluid">
             <div class="row">
                    <div class="col-md-12">
                        <div class="callout callout-info mb-5">
                            <b class="border-bottom border-primary">Reservation Information</b>
                            <dl class="row mt-3"> <!-- Added mt-3 to create space below the header -->
                                <div class="col-md-6 pl-4"> <!-- Left padding for better spacing -->
                                    <dt>Pickup Location:</dt>
                                    <dd><?php echo ucwords($pickup_location); ?></dd>
                                    
                                    <dt>Delivery Date:</dt>
                                    <dd><?php echo date('F j, Y', strtotime($delivery_date)); ?></dd>
                                    
                                    <dt>Contact Number:</dt>
                                    <dd><?php echo htmlspecialchars($contact_number); ?></dd> <!-- Use htmlspecialchars for safety -->
                                    
                                    <dt>Driver Phone:</dt>
                                    <dd><?php echo htmlspecialchars($driver_phone); ?></dd> <!-- Use htmlspecialchars for safety -->
                                    
                                    <dt>Driver License:</dt>
                                    <dd><?php echo htmlspecialchars($driver_license); ?></dd> <!-- Use htmlspecialchars for safety -->
                                </div>
                                <div class="col-md-6 pl-4"> <!-- Left padding for better spacing -->
                                    <dt>Delivery Location:</dt>
                                    <dd><?php echo ucwords($delivery_location); ?></dd>
                                    
                                    <dt>Vehicle Type:</dt>
                                    <dd><?php echo ucwords($vehicle_type); ?></dd>
                                    
                                    <dt>Assigned Driver:</dt>
                                    <dd><?php echo ucwords($driver_name); ?></dd>
                                    
                                    <dt>Driver Email:</dt>
                                    <dd><?php echo htmlspecialchars($driver_email); ?></dd> <!-- Use htmlspecialchars for safety -->
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
                   </div>



      <div class="separator"></div> <!-- Separator between the two columns -->

       <div class="container-fluid">
        <div class="col-md-6">
            <div class="callout callout-info">
                <b class="border-bottom border-primary">SUPPLIES INFORMATION</b>
                <dl class="mt-3"> <!-- Added mt-3 for margin-top -->
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
                </dl>
            </div>
        </div>
         </div>


       <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <b>Status:</b>
                <dd>
                    <?php 
                   switch ($status) {
                        case '1':
                            echo "<span class='badge badge-info'>Pending</span>";
                            break;
                        case '5':
                            echo "<span class='badge badge-pill badge-info'>Collected</span>"; 
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
        
        <!-- Update Status Button -->
        <div class="row">
            <div class="col-md-12">
                <span class="btn badge badge-primary bg-gradient-primary" id="open_update_modal">
                    <i class="fa fa-edit"></i> Update Status
                </span>
                
                <!-- Modal Structure -->
             <!-- Modal Structure -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="max-width: 800px;"> <!-- Set the max-width for the modal -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update Reservation Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="max-height: 400px; overflow-y: auto;"> <!-- Set max-height and enable scrolling -->
                            <form id="update_status_form">
                                <div class="form-group">
                                    <label for="status">Update Status</label>
                                    <select name="status" id="status" class="custom-select" required>
                                        <option value="1">Pending</option>
                                        <option value="5">Collected</option>
                                        <option value="3">Completed</option>
                                        <option value="4">Cancelled</option>
                                    </select>
                                </div>
                                <input type="hidden" name="reservation_id" value="<?php echo $reservationId; ?>"> <!-- Set the actual reservation ID dynamically -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary1" id="submit_status">Update Status</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           </div>
                <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="statusToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Reservation Status Update</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Reservation status updated successfully!
                    </div>
                </div>
            </div>

        <!-- jQuery and Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function() {
        // Open modal when the button is clicked
        $('#open_update_modal').click(function() {
            $('#myModal').modal('show');
        });

        // Handle the form submission
        $('#submit_status').click(function() {
            var formData = $('#update_status_form').serialize(); // Serialize the form data

            $.ajax({
                url: 'manage_reservation_status.php', // PHP file to handle form submission
                method: 'POST',
                data: formData, // Form data being sent
                success: function(response) {
                    // Assuming response is '1' when successful
                    if (response == 1) {
                        // Show the toast notification
                        $('#statusToast').toast({ autohide: true, delay: 3000 });
                        $('#statusToast').toast('show');

                        $('#myModal').modal('hide'); // Close modal
                        location.reload(); // Optionally reload the page
                    } else {
                        alert('Failed to update status.');
                    }
                },
                error: function() {
                    alert('An error occurred while updating status.');
                }
            });
        });
    });
</script>

    </div>
</div>

</body>
</html>
