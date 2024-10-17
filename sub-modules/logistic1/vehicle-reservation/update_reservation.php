<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db_connect.php';

$ID = $_GET['updateID'] ?? null;

if ($ID) {
    // Fetch reservation details with prepared statements
    $sql = "SELECT * FROM reservation WHERE id=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $ID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Extract reservation information
        $pickup_location = $row['pickup_location'];
        $delivery_location = $row['delivery_location'];
        $delivery_date = $row['delivery_date'];
        $contact_number = $row['contact_number'];
        $vehicle_type = $row['vehicle_type'];
        $driver = $row['driver'];

        // Decode JSON-encoded fields (supplies) and ensure they are arrays
        $linens_array = !empty($row['linens']) ? json_decode($row['linens'], true) : [];
        $towels_array = !empty($row['towels']) ? json_decode($row['towels'], true) : [];
        $cleaning_array = !empty($row['cleaning']) ? json_decode($row['cleaning'], true) : [];
        $guest_amenities_array = !empty($row['guest_amenities']) ? json_decode($row['guest_amenities'], true) : [];
        $laundry_array = !empty($row['laundry']) ? json_decode($row['laundry'], true) : [];
        $prices_array = !empty($row['prices']) ? json_decode($row['prices'], true) : [];

        // Ensure that all variables are arrays, even if they are null
        if (!is_array($linens_array)) $linens_array = [];
        if (!is_array($towels_array)) $towels_array = [];
        if (!is_array($cleaning_array)) $cleaning_array = [];
        if (!is_array($guest_amenities_array)) $guest_amenities_array = [];
        if (!is_array($laundry_array)) $laundry_array = [];
        if (!is_array($prices_array)) $prices_array = [];

        // Handle form submission for updating reservation
      if (isset($_POST['submit'])) {
    // Collect form data
    $pickup_location = $_POST['pickup_location'];
    $delivery_location = $_POST['delivery_location'];
    $delivery_date = $_POST['delivery_date'];
    $vehicle_type = $_POST['vehicle_type'];
    $contact_number = $_POST['contact_number'];
    $driver = $_POST['driver'];

    // Collect supplies data with default values
    $linens_array = isset($_POST['linens']) ? json_encode($_POST['linens']) : json_encode([]);
    $towels_array = isset($_POST['towels']) ? json_encode($_POST['towels']) : json_encode([]);
    $cleaning_array = isset($_POST['cleaning']) ? json_encode($_POST['cleaning']) : json_encode([]);
    $guest_amenities_array = isset($_POST['guest_amenities']) ? json_encode($_POST['guest_amenities']) : json_encode([]);
    $laundry_array = isset($_POST['laundry']) ? json_encode($_POST['laundry']) : json_encode([]);
    $prices_array = isset($_POST['prices']) ? json_encode($_POST['prices']) : json_encode([]);

    // Update reservation with prepared statements
    $update_sql = "UPDATE reservation SET
        pickup_location=?, 
        delivery_location=?, 
        delivery_date=?, 
        vehicle_type=?, 
        contact_number=?, 
        driver=?, 
        linens=?, 
        towels=?, 
        cleaning=?, 
        guest_amenities=?, 
        laundry=?, 
        prices=? 
        WHERE id=?";
        
    $update_stmt = mysqli_prepare($con, $update_sql);

    // Bind parameters: 12 strings and 1 integer
    mysqli_stmt_bind_param($update_stmt, "sssssissssssi",
        $pickup_location, 
        $delivery_location, 
        $delivery_date, 
        $vehicle_type, 
        $contact_number, 
        $driver, 
        $linens_array, 
        $towels_array, 
        $cleaning_array, 
        $guest_amenities_array, 
        $laundry_array, 
        $prices_array, 
        $ID // Ensure this is the correct type (integer)
    );
            $result = mysqli_stmt_execute($update_stmt);

            if ($result) {
                $_SESSION['toast'] = "Reservation updated successfully!";
                header('Location: Upcoming-Reservation.php');
                exit;
            } else {
                die("Error updating reservation: " . mysqli_error($con));
            }
        }
    } else {
        $_SESSION['error'] = "Reservation not found!";
        header('Location: Upcoming-Reservation.php');
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid reservation ID!";
    header('Location: Upcoming-Reservation.php');
    exit;
}

// Fetch available drivers
$driver_sql = "SELECT id, first_name, middle_initial, last_name, phone, email, license_number FROM drivers";
$driver_result = mysqli_query($con, $driver_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../../../includes/logistic1/header.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/rokkito.css" rel="stylesheet">
    <link href="/css/condense.css" rel="stylesheet">
    <link href="/css/inconsolata.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/css/CSS1/vehicle.css?v=<?php echo time(); ?>">
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
                <h2>Update Reservation</h2>
                <div class="profile-card p-5">
                    <form method="POST" action="" class="needs-validation" novalidate>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-4">
                                <label for="pickup_location" class="form-label">Pickup Location</label>
                                <input type="text" class="form-control" id="pickup_location" name="pickup_location" required value="<?php echo htmlspecialchars($pickup_location); ?>">
                                <div class="invalid-feedback">Please provide a pickup location.</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="delivery_location" class="form-label">Delivery Location</label>
                                <input type="text" class="form-control" id="delivery_location" name="delivery_location" required value="<?php echo htmlspecialchars($delivery_location); ?>">
                                <div class="invalid-feedback">Please provide a delivery location.</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4">
                                <label for="delivery_date" class="form-label">Delivery Date</label>
                                <input type="date" class="form-control" id="delivery_date" name="delivery_date" required value="<?php echo htmlspecialchars($delivery_date); ?>">
                                <div class="invalid-feedback">Please choose a delivery date.</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                <select class="form-select" id="vehicle_type" name="vehicle_type" required>
                                    <option value="van" <?php if ($vehicle_type == 'van') echo 'selected'; ?>>Van</option>
                                    <option value="truck" <?php if ($vehicle_type == 'truck') echo 'selected'; ?>>Truck</option>
                                    <option value="L300" <?php if ($vehicle_type == 'L300') echo 'selected'; ?>>L300</option>
                                </select>
                                <div class="invalid-feedback">Please choose a vehicle type.</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4">
                                <label for="contact_number" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number" required value="<?php echo htmlspecialchars($contact_number); ?>">
                                <div class="invalid-feedback">Please provide a contact number.</div>
                            </div>
                          <div class="col-md-6 mb-4">
                                <label for="driver" class="form-label">Assign Driver</label>
                                <select class="form-select" id="driver" name="driver" required>
                                    <option value="" disabled>Choose...</option>
                                    <?php
                                       if ($driver_result) {
                                    while ($driver_row = mysqli_fetch_assoc($driver_result)) {
                                        $driver_id = $driver_row['id'];
                                        $driver_name = $driver_row['first_name'] . ' ' . $driver_row['middle_initial'] . '. ' . $driver_row['last_name'];
                                        $driver_phone = $driver_row['phone'];
                                        $driver_email = $driver_row['email'];
                                        $driver_license = $driver_row['license_number'];
                                        
                                        echo "<option value='$driver_id'>$driver_name (Phone: $driver_phone, Email: $driver_email, License: $driver_license)</option>";
                                    }
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">Please select a driver.</div>
                        </div>
                    </div>

                        <!-- Supplies information -->
                        <div class="col-md-12">
                            <b>SUPPLIES INFORMATION</b>
                             <div class="table-responsive">
                            <table class="table table-bordered" id="parcel-items">
                                <thead>
                                    <tr>
                                        <th>Linens and Bedding</th>
                                        <th>Towels and Bath Supplies</th>
                                        <th>Cleaning Supplies</th>
                                        <th>Guest Room Amenities</th>
                                        <th>Laundry Supplies</th>
                                        <th>prices</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $max_length = max(count($linens_array), count($towels_array), count($cleaning_array), count($guest_amenities_array), count($laundry_array), count($prices_array));

                                    // Ensure all arrays have equal length
                                    $linens_array = array_pad($linens_array, $max_length, '');
                                    $towels_array = array_pad($towels_array, $max_length, '');
                                    $cleaning_array = array_pad($cleaning_array, $max_length, '');
                                    $guest_amenities_array = array_pad($guest_amenities_array, $max_length, '');
                                    $laundry_array = array_pad($laundry_array, $max_length, '');
                                    $prices_array = array_pad($prices_array, $max_length, '');

                                    for ($i = 0; $i < $max_length; $i++) {
                                        echo '<tr>';
                                    echo '<td><textarea name="linens[]" class="form-control" rows="3">' . htmlspecialchars($linens_array[$i]) . '</textarea></td>';
                                    echo '<td><textarea name="towels[]" class="form-control" rows="3">' . htmlspecialchars($towels_array[$i]) . '</textarea></td>';
                                    echo '<td><textarea name="cleaning[]" class="form-control" rows="3">' . htmlspecialchars($cleaning_array[$i]) . '</textarea></td>';
                                    echo '<td><textarea name="guest_amenities[]" class="form-control" rows="3">' . htmlspecialchars($guest_amenities_array[$i]) . '</textarea></td>';
                                    echo '<td><textarea name="laundry[]" class="form-control" rows="3">' . htmlspecialchars($laundry_array[$i]) . '</textarea></td>';
                                    echo '<td><input type="text" name="prices[]" value="' . htmlspecialchars($prices_array[$i]) . '" class="form-control"></td>';
                                    echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                        <div class="button-group">
                            <button type="button" class="btn btn-primary1" onclick="window.history.back();">Back</button>
                            <button type="submit" class="btn btn-primary1" name="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Script to dynamically add new rows to the supplies table -->
            <script>
                $('#new_parcel').click(function() {
                    let row = `
                        <tr>
                            <td><input type="text" name='linens[]' class="form-control" required></td>
                            <td><input type="text" name='towels[]' class="form-control" required></td>
                            <td><input type="text" name='cleaning[]' class="form-control" required></td>
                            <td><input type="text" name='guest_amenities[]' class="form-control" required></td>
                            <td><input type="text" name='laundry[]' class="form-control" required></td>
                            <td><input type="text" class="text-right number" name='prices[]' required></td>
                            <td><button class="btn btn-sm btn-danger" type="button" onclick="$(this).closest('tr').remove()"><i class="fa fa-times"></i></button></td>
                        </tr>`;
                    $('#parcel-items tbody').append(row);
                });
            </script>

            <?php include('../../../includes/logistic1/script.php'); ?>
            <footer class="py-4 bg-light mt-auto">
                <?php include('../../../includes/logistic1/footer.php'); ?>
            </footer>

            <script>
                $(document).ready(function() {
                    $('#liveToast').toast('show');
                });
            </script>
        </div>
    </div>
</body>
</html>
