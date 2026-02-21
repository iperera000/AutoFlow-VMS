<?php
session_start();
require_once 'config.php';

// Check if vehicle ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: inventory.php');
    exit;
}

$vehicle_id = $_GET['id'];

// Fetch vehicle data
$stmt = $pdo->prepare("SELECT * FROM vehicles WHERE vehicle_id = ?");
$stmt->execute([$vehicle_id]);
$vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$vehicle) {
    header('Location: inventory.php');
    exit;
}

$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand = trim($_POST['brand']);
    $model = trim($_POST['model']);
    $year = trim($_POST['year']);
    $type = trim($_POST['type']);
    $engine_cc = trim($_POST['engine_cc']);
    $fuel_type = trim($_POST['fuel_type']);
    $transmission = trim($_POST['transmission']);
    $image = trim($_POST['image']);

    // Basic validation
    if (empty($brand) || empty($model) || empty($year) || empty($type) || empty($engine_cc) || empty($fuel_type) || empty($transmission)) {
        $message = '<div class="alert error">All fields are required.</div>';
    } else {
        $update = $pdo->prepare("UPDATE vehicles SET brand=?, model=?, year=?, type=?, engine_cc=?, fuel_type=?, transmission=?, image=? WHERE vehicle_id=?");
        if ($update->execute([$brand, $model, $year, $type, $engine_cc, $fuel_type, $transmission, $image, $vehicle_id])) {
            $message = '<div class="alert success">Vehicle updated successfully!</div>';
            // Refresh vehicle data
            $stmt->execute([$vehicle_id]);
            $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $message = '<div class="alert error">Update failed.</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Details - AutoFlow</title>
    <link rel="stylesheet" href="../css/inventory.css">
    <style>
        .details-container {
            max-width: 600px;
            margin: 40px auto;
            background: #1a1a1a;
            padding: 30px;
            border-radius: 10px;
            color: white;
        }
        .details-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #a855f7;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #ddd;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #333;
            background: #2a2a2a;
            color: white;
        }
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #a855f7;
        }
        .btn {
            background: #a855f7;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .btn:hover {
            background: #9333ea;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .alert.error {
            background: #f8d7da;
            color: #721c24;
        }
        .alert.success {
            background: #d4edda;
            color: #155724;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #a855f7;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .current-image {
            max-width: 200px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="login-page-bg">
    <div class="details-container">
        <h2>Edit Vehicle Details</h2>

        <?php echo $message; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Vehicle ID (cannot be changed)</label>
                <input type="text" value="<?php echo $vehicle['vehicle_id']; ?>" disabled>
            </div>

            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" name="brand" id="brand" value="<?php echo htmlspecialchars($vehicle['brand']); ?>" required>
            </div>

            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" name="model" id="model" value="<?php echo htmlspecialchars($vehicle['model']); ?>" required>
            </div>

            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" name="year" id="year" value="<?php echo htmlspecialchars($vehicle['year']); ?>" required>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" value="<?php echo htmlspecialchars($vehicle['type']); ?>" required>
            </div>

            <div class="form-group">
                <label for="engine_cc">Engine CC</label>
                <input type="number" name="engine_cc" id="engine_cc" value="<?php echo htmlspecialchars($vehicle['engine_cc']); ?>" required>
            </div>

            <div class="form-group">
                <label for="fuel_type">Fuel Type</label>
                <input type="text" name="fuel_type" id="fuel_type" value="<?php echo htmlspecialchars($vehicle['fuel_type']); ?>" required>
            </div>

            <div class="form-group">
                <label for="transmission">Transmission</label>
                <input type="text" name="transmission" id="transmission" value="<?php echo htmlspecialchars($vehicle['transmission']); ?>" required>
            </div>

            <div class="form-group">
                <label for="image">Image Filename</label>
                <input type="text" name="image" id="image" value="<?php echo htmlspecialchars($vehicle['image']); ?>" required>
                <small style="color: #888;">Enter the image filename (e.g., 'chevrolet-silverado-2020.webp'). Ensure the file exists in the images/ folder.</small>
                <?php if (file_exists('images/' . $vehicle['image'])): ?>
                    <br><img src="images/<?php echo $vehicle['image']; ?>" alt="Current image" class="current-image">
                <?php endif; ?>
            </div>

            <button type="submit" class="btn">Update Vehicle</button>
        </form>

        <a href="../php/inventory.php" class="back-link">← Back to Inventory</a>
    </div>
</body>
</html>