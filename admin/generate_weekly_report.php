<?php
include '../config/db.php';

// Define rate per kilometer (Example: $50 per km)
$rate_per_km = 50;

// Get all schedules from the past week
$query = "
    SELECT s.driver_id, d.name AS driver_name, SUM(r.distance_km) AS total_km
    FROM schedules s
    JOIN drivers d ON s.driver_id = d.id
    JOIN routes r ON s.route_id = r.id
    WHERE WEEK(s.week_start_date) = WEEK(CURDATE()) - 1
    GROUP BY s.driver_id
";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $driver_id = $row['driver_id'];
        $total_km = $row['total_km'];
        $calculated_salary = $total_km * $rate_per_km;

        // Update the drivers table
        $updateQuery = "
            UPDATE drivers 
            SET kilometers_traveled = kilometers_traveled + $total_km,
                salary = salary + $calculated_salary
            WHERE id = $driver_id
        ";
        $conn->query($updateQuery);
    }
}

echo "Weekly report generated successfully.";
?>
