<?php
include '../config/db.php';

// Fetch all available vehicles
$sql_vehicles = "SELECT * FROM vehicles WHERE status = 'Available'";
$vehicles_result = $conn->query($sql_vehicles);

// Fetch all drivers who don't have a schedule for the week
$sql_drivers = "SELECT * FROM drivers WHERE id NOT IN (
    SELECT driver_id FROM schedules 
    WHERE week_start_date = (SELECT MAX(week_start_date) FROM schedules)
)";
$drivers_result = $conn->query($sql_drivers);

// Fetch all routes that have not been assigned in the current week
$sql_routes = "SELECT * FROM routes WHERE id NOT IN (
    SELECT route_id FROM schedules 
    WHERE week_start_date = (SELECT MAX(week_start_date) FROM schedules)
)";
$routes_result = $conn->query($sql_routes);

// Check if queries are successful
if (!$vehicles_result || !$drivers_result || !$routes_result) {
    die("<script>alert('Error fetching data!'); window.location.href = 'schedules.php';</script>");
}

$vehicles = $vehicles_result->fetch_all(MYSQLI_ASSOC);
$drivers = $drivers_result->fetch_all(MYSQLI_ASSOC);
$routes = $routes_result->fetch_all(MYSQLI_ASSOC);

// If no available drivers
if (empty($drivers)) {
    echo "<script>alert('No available drivers to assign this week.'); window.location.href = 'schedules.php';</script>";
    exit();
}

// If all routes have been assigned
if (empty($routes)) {
    echo "<script>alert('All routes have already been assigned this week.'); window.location.href = 'schedules.php';</script>";
    exit();
}

// Calculate the start of the current week (Monday) and end of the week (Sunday)
$today = date('N'); // 1 (Monday) to 7 (Sunday)
$week_start_date = date('Y-m-d', strtotime('last Monday', strtotime('+' . (1 - $today) . ' days')));
$week_end_date = date('Y-m-d', strtotime($week_start_date . ' +6 days')); // Sunday

$schedule_created = false;
foreach ($drivers as $driver) {
    $driver_role = $driver['role'];

    // Filter vehicles based on driver role
    $available_vehicles = array_filter($vehicles, function ($vehicle) use ($driver_role) {
        return ($driver_role == 'Bus Driver' && $vehicle['vehicle_type'] == 'Bus') ||
               ($driver_role == 'Car Driver' && $vehicle['vehicle_type'] == 'Car') ||
               ($driver_role == 'Junior Driver' || $driver_role == 'Senior Driver');
    });

    if (empty($available_vehicles)) continue;

    // Pick a random vehicle
    $random_vehicle = $available_vehicles[array_rand($available_vehicles)];

    // Pick a random route
    if (empty($routes)) continue;
    $random_route_key = array_rand($routes);
    $random_route = $routes[$random_route_key];
    unset($routes[$random_route_key]); // Remove the assigned route

    // Assign schedule date (Week Start)
    $schedule_date = $week_start_date;

    // Insert into database (now includes week_end_date)
    $sql_schedule = "INSERT INTO schedules (driver_id, vehicle_id, route_id, schedule_date, week_start_date, week_end_date, status) 
                     VALUES (?, ?, ?, ?, ?, ?, 'Scheduled')";
    $stmt_schedule = $conn->prepare($sql_schedule);
    $stmt_schedule->bind_param("iiisss", $driver['id'], $random_vehicle['id'], $random_route['id'], $schedule_date, $week_start_date, $week_end_date);

    if ($stmt_schedule->execute()) {
        $schedule_created = true;
    }
}

// Show success or failure message
if ($schedule_created) {
    echo "<script>alert('Weekly Schedule generated successfully from $week_start_date to $week_end_date!'); window.location.href = 'schedules.php';</script>";
} else {
    echo "<script>alert('No schedules created. Check available drivers and routes.'); window.location.href = 'schedules.php';</script>";
}
?>
