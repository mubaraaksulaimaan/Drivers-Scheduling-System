<?php
include '../config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<?php include '../includes/navbar.php'; ?>
<div class="container mt-5">
    <h2>Generated Reports</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Driver Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>KM Traveled</th>
                <th>Salary (₦)</th>
                <th>Report Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM reports ORDER BY report_date DESC";
            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['driver_name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['kilometers_traveled']} km</td>
                    <td>N" . number_format($row['salary'], 2) . "</td>
                    <td>{$row['report_date']}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
