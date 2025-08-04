<?php
include '../config/db.php';


$sql = "SELECT s.id, d.name AS driver_name, v.vehicle_name, r.route_name, r.distance_km, s.week_start_date, s.status 
        FROM schedules s
        JOIN drivers d ON s.driver_id = d.id
        JOIN vehicles v ON s.vehicle_id = v.id
        JOIN routes r ON s.route_id = r.id
        ORDER BY s.week_start_date DESC";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Schedules Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include '../includes/navbar.php'; ?>
    <div class="container mt-5">
        <h2>Schedules Management</h2>
        <a href="generate_schedule.php" class="btn btn-primary mb-3">Generate Weekly Schedule</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Driver</th>
                    <th>Vehicle</th>
                    <th>Route</th>
                    <th>Distance (km)</th>
                    <th>Week Start</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['driver_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['vehicle_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['route_name']); ?></td>
                        <td><?php echo $row['distance_km']; ?> km</td>
                        <td><?php echo $row['week_start_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
    <?php if ($row['status'] == 'Scheduled') { ?>
        <a href="complete_schedule.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Complete</a>
    <?php } elseif ($row['status'] == 'Completed') { ?>
        <span class="badge bg-success">Completed</span>
    <?php } ?>

    <a href="delete_schedule.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
</td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
