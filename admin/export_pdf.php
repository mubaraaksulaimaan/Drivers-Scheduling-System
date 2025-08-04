<?php
require_once('../tcpdf/tcpdf.php');
include '../config/db.php';

// Create new PDF document
$pdf = new TCPDF();
$pdf->AddPage();

// Title
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(190, 10, 'Weekly Driver Report', 0, 1, 'C');

// Column Headers
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(35, 10, 'Driver Name', 1);
$pdf->Cell(55, 10, 'Email', 1); // Increased width for email
$pdf->Cell(30, 10, 'Phone', 1);
$pdf->Cell(30, 10, 'KM Traveled', 1);
$pdf->Cell(30, 10, 'Salary (₦)', 1);
$pdf->Ln();

// Fetch data
$query = "SELECT d.name, d.email, d.phone, 
                 SUM(s.completed * r.distance_km) AS total_km, 
                 SUM(s.completed * r.distance_km * 100) AS total_salary 
          FROM drivers d
          LEFT JOIN schedules s ON d.id = s.driver_id
          LEFT JOIN routes r ON s.route_id = r.id
          GROUP BY d.id";

$result = $conn->query($query);

// Fill table
$pdf->SetFont('helvetica', '', 12);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(40, 10, $row['name'], 1);
    $pdf->Cell(40, 10, $row['email'], 1);
    $pdf->Cell(30, 10, $row['phone'], 1);
    $pdf->Cell(30, 10, number_format($row['total_km'], 2) . " km", 1);
    $pdf->Cell(30, 10, "N" . number_format($row['total_salary'], 2), 1);
    $pdf->Ln();
}


// Output PDF
$pdf->Output('weekly_report.pdf', 'D');
?>
