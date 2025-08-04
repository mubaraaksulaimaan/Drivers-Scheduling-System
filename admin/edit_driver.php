<?php
include '../config/db.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Driver ID is missing.");
}

$driver_id = $_GET['id'];

// Fetch existing driver details
$sql = "SELECT * FROM drivers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $driver_id);
$stmt->execute();
$result = $stmt->get_result();
$driver = $result->fetch_assoc();

if (!$driver) {
    die("Error: Driver not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $grade_level = $_POST['grade_level'];
    $license_number = $_POST['license_number'];

    $updateSQL = "UPDATE drivers SET name=?, email=?, phone=?, role=?, grade_level=?, license_number=? WHERE id=?";
    $stmt = $conn->prepare($updateSQL);
    $stmt->bind_param("ssssssi", $name, $email, $phone, $role, $grade_level, $license_number, $driver_id);

    if ($stmt->execute()) {
        header("Location: drivers.php");
        exit();
    } else {
        $error = "Failed to update driver: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Driver</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include '../includes/navbar.php'; ?>
<div class="container mt-4">
    <h2>Edit Driver</h2>
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($driver['name']); ?>" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($driver['email']); ?>" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($driver['phone']); ?>" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" required class="form-control">
                <option <?= ($driver['role'] == "Chief Driver") ? "selected" : ""; ?>>Chief Driver</option>
                <option <?= ($driver['role'] == "Junior Driver") ? "selected" : ""; ?>>Junior Driver</option>
                <option <?= ($driver['role'] == "Car Driver") ? "selected" : ""; ?>>Car Driver</option>
                <option <?= ($driver['role'] == "Bus Driver") ? "selected" : ""; ?>>Bus Driver</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Grade Level</label>
            <input type="text" name="grade_level" value="<?= htmlspecialchars($driver['grade_level']); ?>" required class="form-control">
        </div>
        <div class="mb-3">
            <label>License Number</label>
            <input type="text" name="license_number" value="<?= htmlspecialchars($driver['license_number']); ?>" required class="form-control">
        </div>

        <!-- Read-Only Fields -->
        <div class="mb-3">
            <label>Vehicle Assigned</label>
            <input type="text" value="<?= htmlspecialchars($driver['vehicle_assigned']); ?>" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label>Route Assigned</label>
            <input type="text" value="<?= htmlspecialchars($driver['route_assigned']); ?>" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label>Kilometers Traveled</label>
            <input type="text" value="<?= htmlspecialchars($driver['kilometers_traveled']); ?>" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label>Salary</label>
            <input type="text" value="<?= htmlspecialchars($driver['salary']); ?>" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Update Driver</button>
        <a href="drivers.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
