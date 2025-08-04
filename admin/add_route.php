<?php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $route_name = trim($_POST['route_name']);
    $distance_km = floatval($_POST['distance_km']);

    $sql = "INSERT INTO routes (route_name, distance_km) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sd", $route_name, $distance_km);

    if ($stmt->execute()) {
        echo "<script>alert('Route added successfully!'); window.location.href='routes.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include '../includes/navbar.php'; ?>
    <title>Add Route</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Route</h2>
        <form action="add_route.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Route Name:</label>
                <input type="text" name="route_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Distance (km):</label>
                <input type="number" name="distance_km" step="0.1" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Route</button>
            <a href="routes.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
