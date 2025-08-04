<?php
include '../config/db.php';

// Check if the ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Vehicle ID is missing.");
}

$id = intval($_GET['id']);

// Fetch the vehicle details from the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If form is submitted, handle the update
    $vehicle_name = $_POST['vehicle_name'];
    $vehicle_type = $_POST['vehicle_type'];
    $plate_number = $_POST['plate_number'];
    $capacity = intval($_POST['capacity']);
    $status = $_POST['status'];

    // Ensure all fields are not empty
    if (empty($vehicle_name) || empty($vehicle_type) || empty($plate_number) || empty($capacity) || empty($status)) {
        die("Error: All fields are required.");
    }

    // Update the vehicle in the database
    $sql = "UPDATE vehicles SET vehicle_name=?, vehicle_type=?, plate_number=?, capacity=?, status=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sssisi", $vehicle_name, $vehicle_type, $plate_number, $capacity, $status, $id);

    if ($stmt->execute()) {
        header("Location: vehicles.php?success=Vehicle updated successfully");
        exit();
    } else {
        die("Error updating vehicle: " . $stmt->error);
    }
}

// Fetch the vehicle data to display in the form
$sql = "SELECT * FROM vehicles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$vehicle = $result->fetch_assoc();

if (!$vehicle) {
    die("Error: Vehicle not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/navbar.php'; ?>
    <title>Edit Vehicle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Vehicle</h2>
        <form action="edit_vehicle.php?id=<?php echo $vehicle['id']; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($vehicle['id']); ?>">

            <div class="mb-3">
                <label class="form-label">Vehicle Name:</label>
                <input type="text" name="vehicle_name" class="form-control" value="<?php echo htmlspecialchars($vehicle['vehicle_name']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Vehicle Type:</label>
                <select name="vehicle_type" class="form-control" required>
                    <option value="Car" <?php if ($vehicle['vehicle_type'] == "Car") echo "selected"; ?>>Car</option>
                    <option value="Bus" <?php if ($vehicle['vehicle_type'] == "Bus") echo "selected"; ?>>Bus</option>
                    <option value="Truck" <?php if ($vehicle['vehicle_type'] == "Truck") echo "selected"; ?>>Truck</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Plate Number:</label>
                <input type="text" name="plate_number" class="form-control" value="<?php echo htmlspecialchars($vehicle['plate_number']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Capacity:</label>
                <input type="number" name="capacity" class="form-control" value="<?php echo htmlspecialchars($vehicle['capacity']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-control" required>
                    <option value="Available" <?php if ($vehicle['status'] == "Available") echo "selected"; ?>>Available</option>
                    <option value="In Use" <?php if ($vehicle['status'] == "In Use") echo "selected"; ?>>In Use</option>
                    <option value="Maintenance" <?php if ($vehicle['status'] == "Maintenance") echo "selected"; ?>>Maintenance</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Vehicle</button>
            <a href="vehicles.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
