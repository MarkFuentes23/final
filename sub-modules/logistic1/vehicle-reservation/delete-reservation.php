<?php
include 'db_connect.php';

if (isset($_GET['deleteID'])) {
    // Ensure $ID is treated as an integer
    $ID = intval($_GET['deleteID']);

    // Check if the record exists before deletion
    $check_sql = "SELECT * FROM reservation WHERE id = ?";
    $check_stmt = $con->prepare($check_sql);
    $check_stmt->bind_param("i", $ID);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Use a prepared statement to delete the record
        $stmt = $con->prepare("DELETE FROM reservation WHERE id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $con->error);
        }

        $stmt->bind_param("i", $ID);

        // Execute the prepared statement
        $result = $stmt->execute();

        // Initialize session for toast notification
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($result) {
            $_SESSION['toast_message'] = 'Reservation deleted successfully!';
            $_SESSION['toast_type'] = 'success'; // Success message type
        } else {
            $_SESSION['toast_message'] = 'Error deleting reservation: ' . $stmt->error;
            $_SESSION['toast_type'] = 'danger'; // Error message type
        }
    } else {
        // Initialize session for toast notification
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['toast_message'] = "No record found with ID: $ID";
        $_SESSION['toast_type'] = 'danger';
    }

    // Redirect back to the upcoming reservations page
    header('location: Upcoming-Reservation.php');
    exit(); // Always exit after redirecting to stop further script execution
}
?>
