<?php
session_start();

if (!isset($_SESSION['loggedin']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'logistic1_admin')) {
    header("Location: /not_authorized.php");  // Redirect to the 'Not Authorized' page
    exit();
}

// Rest of the page content
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../../includes/logistic1/header.php'); ?>
    <link href="/css/IM Fell Great Primer SC.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
        <?php include('../../includes/logistic1/topnavbar.php'); ?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <?php include('../../includes/logistic1/sidenavbar.php'); ?>
            </nav>
        </div>
        <div id="layoutSidenav_content" style="font-family: 'Rokkitt';">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4" style="font-family: 'Rokkitt'; font-size: 35px;">PARADISE HOTEL</h1>

                    <!-- Charts Section -->
                    <div class="row">
                        <!-- Area Chart: Orders -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Orders
                                </div>
                                <div class="card-body">
                                    <canvas id="myAreaChart" width="100%" height="40"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Bar Chart: Stocks -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Stocks
                                </div>
                                <div class="card-body">
                                    <canvas id="myBarChart" width="100%" height="40"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Logistic Table -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Logistic Table List
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Finn Camacho</td>
                                        <td>Support Engineer</td>
                                        <td>San Francisco</td>
                                        <td>47</td>
                                        <td>2009/07/07</td>
                                        <td>$87,500</td>
                                    </tr>
                                         <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Finn Camacho</td>
                                        <td>Support Engineer</td>
                                        <td>San Francisco</td>
                                        <td>47</td>
                                        <td>2009/07/07</td>
                                        <td>$87,500</td>
                                    </tr>
                                         <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Finn Camacho</td>
                                        <td>Support Engineer</td>
                                        <td>San Francisco</td>
                                        <td>47</td>
                                        <td>2009/07/07</td>
                                        <td>$87,500</td>
                                    </tr>
                                         <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Finn Camacho</td>
                                        <td>Support Engineer</td>
                                        <td>San Francisco</td>
                                        <td>47</td>
                                        <td>2009/07/07</td>
                                        <td>$87,500</td>
                                    </tr>
                                         <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Finn Camacho</td>
                                        <td>Support Engineer</td>
                                        <td>San Francisco</td>
                                        <td>47</td>
                                        <td>2009/07/07</td>
                                        <td>$87,500</td>
                                    </tr>
                                    <!-- Add other rows here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <?php include('../../includes/logistic1/footer.php'); ?>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <?php include('../../includes/logistic1/script.php'); ?>

    <script>
        // Area Chart (Orders) with Success Color
        const ctxArea = document.getElementById('myAreaChart').getContext('2d');
        const myAreaChart = new Chart(ctxArea, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Orders',
                    data: [65, 59, 80, 81, 56, 55],
                    fill: true,
                    backgroundColor: 'rgba(40, 167, 69, 0.2)', // Success color
                    borderColor: 'rgba(40, 167, 69, 1)', // Success color
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Bar Chart (Stocks) with Success Color
        const ctxBar = document.getElementById('myBarChart').getContext('2d');
        const myBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Product 1', 'Product 2', 'Product 3', 'Product 4'],
                datasets: [{
                    label: 'Stock Levels',
                    data: [120, 150, 180, 90],
                    backgroundColor: 'rgba(40, 167, 69, 0.2)', // Success color
                    borderColor: 'rgba(40, 167, 69, 1)', // Success color
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
