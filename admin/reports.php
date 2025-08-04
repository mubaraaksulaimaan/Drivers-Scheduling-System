<?php
include '../config/db.php';

// Fetch weekly report data
$query = "
    SELECT d.name, d.email, d.phone, d.kilometers_traveled, d.salary
    FROM drivers d
    ORDER BY d.kilometers_traveled DESC
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/navbar.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
</head>
<body>
    <div class="container mt-5">
        <h2>Weekly Driver Reports</h2>

        <a href="export_pdf.php" class="btn btn-success mb-3">Export as PDF</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Driver Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Total Kilometers</th>
                    <th>Salary Earned</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo number_format($row['kilometers_traveled'], 2); ?> km</td>
                    <td>₦<?php echo number_format($row['salary'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
