<?php
include '../config/db.php';

$query = "SELECT d.id, d.name, d.email, d.phone, d.role, d.grade_level, d.license_number, 
                 COALESCE(v.vehicle_name, 'Not Assigned') AS vehicle_name, 
                 COALESCE(v.status, 'Unknown') AS vehicle_status,
                 COALESCE(r.route_name, 'Not Assigned') AS route_name, 
                 d.created_at
          FROM drivers d
          LEFT JOIN schedules s ON d.id = s.driver_id
          LEFT JOIN routes r ON s.route_id = r.id
          LEFT JOIN vehicles v ON s.vehicle_id = v.id
          ORDER BY d.id DESC";

$drivers = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Drivers Management</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include '../includes/navbar.php'; ?>
<div class="container mt-4">
    <h2>Drivers Management</h2>
    <a href="add_driver.php" class="btn btn-primary mb-3">Add New Driver</a>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Grade Level</th>
            <th>License Number</th>
            <th>Vehicle Assigned</th>
            <th>Vehicle Status</th>
            <th>Route Assigned</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($driver = $drivers->fetch_assoc()) : ?>
            <tr>
                <td><?= htmlspecialchars($driver['name']); ?></td>
                <td><?= htmlspecialchars($driver['email']); ?></td>
                <td><?= htmlspecialchars($driver['phone']); ?></td>
                <td><?= htmlspecialchars($driver['role']); ?></td>
                <td><?= htmlspecialchars($driver['grade_level']); ?></td>
                <td><?= htmlspecialchars($driver['license_number']); ?></td>
                <td><?= !empty($driver['vehicle_name']) ? htmlspecialchars($driver['vehicle_name']) : 'Not Assigned'; ?></td>
                <td>
                    <?php if ($driver['vehicle_status'] == 'Available') : ?>
                        <span class="badge bg-success"><?= htmlspecialchars($driver['vehicle_status']); ?></span>
                    <?php elseif ($driver['vehicle_status'] == 'In Use') : ?>
                        <span class="badge bg-warning"><?= htmlspecialchars($driver['vehicle_status']); ?></span>
                    <?php elseif ($driver['vehicle_status'] == 'Maintenance') : ?>
                        <span class="badge bg-danger"><?= htmlspecialchars($driver['vehicle_status']); ?></span>
                    <?php else : ?>
                        <span class="badge bg-secondary">Unknown</span>
                    <?php endif; ?>
                </td>
                <td><?= !empty($driver['route_name']) ? htmlspecialchars($driver['route_name']) : 'Not Assigned'; ?></td>
                <td>
                    <a href="edit_driver.php?id=<?= $driver['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete_driver.php?id=<?= $driver['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
