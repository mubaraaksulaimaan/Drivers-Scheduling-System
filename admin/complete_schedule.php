<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $schedule_id = $_GET['id'];

    // Get the schedule details (fetch driver_id and distance_km)
    $query = "SELECT s.driver_id, r.distance_km FROM schedules s 
              JOIN routes r ON s.route_id = r.id 
              WHERE s.id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Error in SQL Query (Fetching Schedule): " . $conn->error);
    }

    $stmt->bind_param("i", $schedule_id);
    $stmt->execute();
    $stmt->bind_result($driver_id, $distance_km);
    $stmt->fetch();
    $stmt->close();

    // Ensure schedule exists
    if ($driver_id) {
        // Calculate salary increment (₦100 per km)
        $salary_increment = $distance_km * 100;

        // Mark schedule as completed
        $update_query = "UPDATE schedules SET status = 'Completed', completed = 1 WHERE id = ?";
        $stmt = $conn->prepare($update_query);

        if (!$stmt) {
            die("Error in SQL Query (Updating Schedule): " . $conn->error);
        }

        $stmt->bind_param("i", $schedule_id);
        $stmt->execute();
        $stmt->close();

        // Update driver's salary
        $salary_query = "UPDATE drivers SET salary = salary + ? WHERE id = ?";
        $stmt = $conn->prepare($salary_query);

        if (!$stmt) {
            die("Error in SQL Query (Updating Salary): " . $conn->error);
        }

        $stmt->bind_param("di", $salary_increment, $driver_id);
        $stmt->execute();
        $stmt->close();

        echo "<script>alert('Schedule marked as completed. Salary updated.'); window.location.href = 'schedules.php';</script>";
    } else {
        echo "<script>alert('Schedule not found.'); window.location.href = 'schedules.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'schedules.php';</script>";
}
?>
