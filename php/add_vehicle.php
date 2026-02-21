<?php
session_start();
require_once 'config.php';

// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Restrict to logged-in admin only
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../php/company-login.php');
    exit;
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input
    $brand = trim($_POST['brand'] ?? '');
    $model = trim($_POST['model'] ?? '');
    $year = trim($_POST['year'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $engine_cc = trim($_POST['engine_cc'] ?? '');
    $fuel_type = trim($_POST['fuel_type'] ?? '');
    $transmission = trim($_POST['transmission'] ?? '');

    // Validate required fields
    if (empty($brand) || empty($model) || empty($year) || empty($type) || empty($engine_cc) || empty($fuel_type) || empty($transmission)) {
        $error = "All fields are required.";
    } elseif (!is_numeric($year) || $year < 1900 || $year > 2099) {
        $error = "Please enter a valid year (1900-2099).";
    } elseif (!is_numeric($engine_cc) || $engine_cc < 0) {
        $error = "Engine CC must be a positive number.";
    } else {
        // Handle image upload
        $image_filename = 'default-car.jpg';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/autoflow/assets/';
            // Create directory if it doesn't exist
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $tmp_name = $_FILES['image']['tmp_name'];
            $original_name = $_FILES['image']['name'];
            $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif'];

            if (in_array($ext, $allowed)) {
                // Generate unique filename
                $new_filename = uniqid('vehicle_', true) . '.' . $ext;
                $destination = $upload_dir . $new_filename;
                if (move_uploaded_file($tmp_name, $destination)) {
                    $image_filename = $new_filename;
                } else {
                    $error = "Failed to upload image. Check folder permissions.";
                }
            } else {
                $error = "Invalid image type. Allowed: " . implode(', ', $allowed);
            }
        }

        if (empty($error)) {
            // Insert into database
            $stmt = $pdo->prepare("INSERT INTO vehicles (brand, model, year, type, engine_cc, fuel_type, transmission, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$brand, $model, $year, $type, $engine_cc, $fuel_type, $transmission, $image_filename])) {
                // Get the auto-generated ID
                $new_id = $pdo->lastInsertId();
                $message = "Vehicle added successfully! ID: $new_id";
            } else {
                $error = "Database error: could not insert vehicle.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Vehicle Result - AutoFlow</title>
    <link rel="stylesheet" href="../css/company-login-interface.css">
    <link rel="stylesheet" href="../css/add-vehicle-result.css">
</head>
<body>
    <div class="result-container">
        <?php if ($message): ?>
            <div class="success">✔ <?php echo htmlspecialchars($message); ?></div>
        <?php elseif ($error): ?>
            <div class="error">✘ <?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <div>
            <a href="../html/registervehicle.html" class="btn">Add Another Vehicle</a>
            <a href="../php/company-login-interface.php" class="btn secondary">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>