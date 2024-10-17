<?php
include 'db_connect.php';

// Check if the status and reservation_id were sent via POST
if (isset($_POST['status']) && isset($_POST['reservation_id'])) {
    // Sanitize the inputs
    $status = intval($_POST['status']);
    $reservationId = intval($_POST['reservation_id']); // Prevent SQL injection
    
    // Perform the update query
    $query = $con->query("UPDATE reservation SET status = $status WHERE id = $reservationId");

    // Check if the query was successful
    if ($query) {
        echo 1; // Return 1 to indicate success
    } else {
        echo 0; // Return 0 to indicate failure
    }
} else {
    echo 0; // Return 0 if necessary data wasn't received
}
?>
