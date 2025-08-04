<?php
include 'config/db.php'; // Ensure database connection is included

// Default admin credentials
$name = "admin";
$email = "admin@example.com";
$password = password_hash("admin123", PASSWORD_BCRYPT); // Securely hash the password
$role = "Super Admin";

// Check if the admin already exists
$sql = "SELECT id FROM admins WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Admin account already exists.";
} else {
    // Insert the admin user
    $sql = "INSERT INTO admins (name, email, password, role) 
            VALUES ('$name', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Admin account created successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
