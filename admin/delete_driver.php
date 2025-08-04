<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $driver_id = $_GET['id'];

    $sql = "DELETE FROM drivers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $driver_id);

    if ($stmt->execute()) {
        header("Location: drivers.php");
        exit();
    } else {
        echo "Error deleting driver: " . $conn->error;
    }
}
?>
