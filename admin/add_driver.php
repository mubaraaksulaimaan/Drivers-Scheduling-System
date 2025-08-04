<?php
include '../config/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $grade_level = $_POST['grade_level'];
    $license_number = $_POST['license_number'];

    $sql = "INSERT INTO drivers (name, email, phone, role, grade_level, license_number) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $phone, $role, $grade_level, $license_number);
    
    if ($stmt->execute()) {
        header("Location: drivers.php");
        exit();
    } else {
        $error = "Failed to add driver: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Driver</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include '../includes/navbar.php'; ?>
<div class="container mt-4">
    <h2>Add Driver</h2>
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" required class="form-control">
                <option>Chief Driver</option>
                <option>Junior Driver</option>
                <option>Car Driver</option>
                <option>Bus Driver</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Grade Level</label>
            <input type="text" name="grade_level" required class="form-control">
        </div>
        <div class="mb-3">
            <label>License Number</label>
            <input type="text" name="license_number" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Driver</button>
    </form>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
