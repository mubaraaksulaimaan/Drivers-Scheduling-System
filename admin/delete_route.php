<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM routes WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Route deleted successfully!'); window.location.href='routes.php';</script>";
    } else {
        echo "Error deleting route: " . $conn->error;
    }
} else {
    echo "Error: Route ID missing.";
}
?>
