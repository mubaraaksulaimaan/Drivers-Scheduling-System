<?php
include '../config/db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Route ID is missing.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM routes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$route = $result->fetch_assoc();

if (!$route) {
    die("Error: Route not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $route_name = trim($_POST['route_name']);
    $distance_km = floatval($_POST['distance_km']);

    $update_sql = "UPDATE routes SET route_name=?, distance_km=? WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sdi", $route_name, $distance_km, $id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Route updated successfully!'); window.location.href='routes.php';</script>";
    } else {
        echo "Error updating route: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include '../includes/navbar.php'; ?>
    <title>Edit Route</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Route</h2>
        <form action="edit_route.php?id=<?php echo $id; ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Route Name:</label>
                <input type="text" name="route_name" class="form-control" value="<?php echo htmlspecialchars($route['route_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Distance (km):</label>
                <input type="number" name="distance_km" step="0.1" class="form-control" value="<?php echo htmlspecialchars($route['distance_km']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Route</button>
            <a href="routes.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
