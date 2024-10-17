<?php
include 'db_connect.php';

if (isset($_POST['ref_no'])) {
    $ref_no = mysqli_real_escape_string($con, $_POST['ref_no']);
    
    // Fetch reservation tracking data
    $query = "SELECT r.reference_number, r.status, r.delivery_date 
              FROM reservation r 
              WHERE r.reference_number = '$ref_no'";

    $result = mysqli_query($con, $query);
    $history = array();
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $status = "";
            switch ($row['status']) {
                case '1':
                    $status = 'Pending';
                    break;
                case '2':
                    $status = 'In Progress';
                    break;
                case '5':
                    $status = 'Collected';
                    break;
                case '6':
                    $status = 'Shipped';
                    break;
                case '7':
                    $status = 'In-Transit';
                    break;
                case '3':
                    $status = 'Completed';
                    break;
                case '4':
                    $status = 'Cancelled';
                    break;
            }
            $history[] = array('time' => $row['delivery_date'], 'status' => $status);
        }
        echo json_encode($history);
    } else {
        echo json_encode([]);
    }
}
?>
