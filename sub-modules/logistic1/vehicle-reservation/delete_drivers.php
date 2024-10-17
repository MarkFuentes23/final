<?php
session_start();
include 'db_connect.php';

if (isset($_GET['deleteID'])) {
    $id = $_GET['deleteID'];
    $sql = "DELETE FROM drivers WHERE id=$id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Set success toast notification
        $_SESSION['toast_message'] = 'Driver deleted successfully.';
        $_SESSION['toast_type'] = 'success'; // Set the type to success
    } else {
        // Set error toast notification
        $_SESSION['toast_message'] = 'Error deleting driver.';
        $_SESSION['toast_type'] = 'danger'; // Set the type to danger
    }

    // Redirect back to driver_list to show the toast
    header('Location: driver_list.php');
    exit();
}
?>
