<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM schedules WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Schedule deleted successfully!'); window.location.href='schedules.php';</script>";
    } else {
        echo "Error deleting schedule: " . $conn->error;
    }
} else {
    echo "Error: Schedule ID missing.";
}
?>
