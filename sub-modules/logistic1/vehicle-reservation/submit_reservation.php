<?php
include 'db_connect.php';

// Function to generate a unique reference number
function generateReferenceNumber($conn) {
    $date = date("Ymd"); // Get current date in YYYYMMDD format
    $randomNumber = rand(1000, 9999); // Generate a random number
    $referenceNumber = $date . $randomNumber; // Generate the reference number

    // Check if the reference number already exists
    $query = "SELECT * FROM reservation WHERE reference_number = '$referenceNumber'";
    $result = mysqli_query($conn, $query);
    
    // If exists, generate another one
    if (mysqli_num_rows($result) > 0) {
        return generateReferenceNumber($conn);
    }
    
    return $referenceNumber;
}

if (isset($_POST['submit_reservation'])) {
    // Collect form data
    $pickup_location = $_POST['pickup_location'];
    $delivery_location = $_POST['delivery_location'];
    $delivery_date = $_POST['delivery_date'];
    $vehicle_type = $_POST['vehicle_type'];
    $contact_number = $_POST['contact_number'];
    $driver = $_POST['driver'];

    // Collect supplies data
    $linens = json_encode($_POST['linens']);
    $towels = json_encode($_POST['towels']);
    $cleaning = json_encode($_POST['cleaning']);
    $guest_amenities = json_encode($_POST['guest_amenities']);
    $laundry = json_encode($_POST['laundry']);
    
    // Collect prices data
    $prices = json_encode($_POST['price']); // Collect the prices for supplies

    // Generate reference number
    $reference_number = generateReferenceNumber($con);

    // Insert the reservation into the database
    $sql = "INSERT INTO reservation (reference_number, pickup_location, delivery_location, delivery_date, vehicle_type, contact_number, driver, linens, towels, cleaning, guest_amenities, laundry, prices)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssissssss", $reference_number, $pickup_location, $delivery_location, $delivery_date, $vehicle_type, $contact_number, $driver, $linens, $towels, $cleaning, $guest_amenities, $laundry, $prices);

    if ($stmt->execute()) {
        // Redirect or show success message
        header("Location: Upcoming-Reservation.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
