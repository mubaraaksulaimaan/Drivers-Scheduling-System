<?php
include '../config/db.php';

// Fetch all vehicles
$sql = "SELECT id, vehicle_name, vehicle_type, plate_number, capacity, 
               COALESCE(status, 'Unknown') AS status, created_at 
        FROM vehicles ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/navbar.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Vehicles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Vehicle Management</h2>

        <!-- Add Vehicle Button -->
        <a href="add_vehicle.php" class="btn btn-primary mb-3">Add Vehicle</a>

        <!-- Vehicle Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vehicle Name</th>
                    <th>Vehicle Type</th>
                    <th>Plate Number</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['vehicle_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['vehicle_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['plate_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['capacity']); ?></td>
                    <td>
                        <?php if ($row['status'] == 'Available') : ?>
                            <span class="badge bg-success"><?php echo htmlspecialchars($row['status']); ?></span>
                        <?php elseif ($row['status'] == 'In Use') : ?>
                            <span class="badge bg-warning"><?php echo htmlspecialchars($row['status']); ?></span>
                        <?php elseif ($row['status'] == 'Maintenance') : ?>
                            <span class="badge bg-danger"><?php echo htmlspecialchars($row['status']); ?></span>
                        <?php else : ?>
                            <span class="badge bg-secondary">Unknown</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit_vehicle.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_vehicle.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this vehicle?');">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
