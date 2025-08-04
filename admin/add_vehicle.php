<?php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle_name = trim($_POST['vehicle_name']);
    $vehicle_type = $_POST['vehicle_type'];
    $plate_number = trim($_POST['plate_number']);
    $capacity = intval($_POST['capacity']);
    $status = $_POST['status'];

    $sql = "INSERT INTO vehicles (vehicle_name, vehicle_type, plate_number, capacity, status, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssds", $vehicle_name, $vehicle_type, $plate_number, $capacity, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Vehicle added successfully!'); window.location.href='vehicles.php';</script>";
    } else {
        echo "<script>alert('Error: ".$stmt->error."');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include '../includes/navbar.php'; ?>
    <title>Add Vehicle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Vehicle</h2>
        <form action="add_vehicle.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Vehicle Name:</label>
                <input type="text" name="vehicle_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Vehicle Type:</label>
                <select name="vehicle_type" class="form-control">
                    <option value="Car">Car</option>
                    <option value="Bus">Bus</option>
                    <option value="Truck">Truck</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Plate Number:</label>
                <input type="text" name="plate_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Capacity:</label>
                <input type="number" name="capacity" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-control">
                    <option value="Available">Available</option>
                    <option value="In Use">In Use</option>
                    <option value="Maintenance">Maintenance</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Vehicle</button>
            <a href="vehicles.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
