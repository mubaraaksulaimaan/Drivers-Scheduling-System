<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../config/db.php';

// Fetch Total Drivers
$driversQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM drivers");
$driversData = mysqli_fetch_assoc($driversQuery);
$totalDrivers = $driversData['total'];

// Fetch Total Vehicles
$vehiclesQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM vehicles");
$vehiclesData = mysqli_fetch_assoc($vehiclesQuery);
$totalVehicles = $vehiclesData['total'];

// Fetch Total Routes
$routesQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM routes");
$routesData = mysqli_fetch_assoc($routesQuery);
$totalRoutes = $routesData['total'];

// Fetch Upcoming Schedules
$schedulesQuery = mysqli_query($conn, "
    SELECT s.schedule_date, d.name AS driver_name, v.vehicle_name, r.route_name
    FROM schedules s
    LEFT JOIN drivers d ON s.driver_id = d.id
    LEFT JOIN vehicles v ON s.vehicle_id = v.id
    LEFT JOIN routes r ON s.route_id = r.id
    ORDER BY s.schedule_date DESC
    LIMIT 5
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="container mt-4">
    <h2>Admin Dashboard</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary p-3">
                <h4>Total Drivers</h4>
                <h2><?= $totalDrivers; ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success p-3">
                <h4>Total Vehicles</h4>
                <h2><?= $totalVehicles; ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning p-3">
                <h4>Total Routes</h4>
                <h2><?= $totalRoutes; ?></h2>
            </div>
        </div>
    </div>

    <h3 class="mt-4">Upcoming Schedules</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Driver</th>
                <th>Vehicle</th>
                <th>Route</th>
                <th>Scheduled Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($schedule = mysqli_fetch_assoc($schedulesQuery)) : ?>
                <tr>
                    <td><?= htmlspecialchars($schedule['driver_name']); ?></td>
                    <td><?= htmlspecialchars($schedule['vehicle_name']); ?></td>
                    <td><?= htmlspecialchars($schedule['route_name']); ?></td>
                    <td><?= htmlspecialchars($schedule['schedule_date']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="../public/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
