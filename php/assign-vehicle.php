<?php
session_start();
require_once 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: company-login.php');
    exit;
}

$message = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $driver_id = $_POST['driver_id'] ?? '';
    $vehicle_id = $_POST['vehicle_id'] ?? '';

    if (empty($driver_id) || empty($vehicle_id)) {
        $error = "Please select both a driver and a vehicle.";
    } else {
        // Check if driver exists
        $stmt = $pdo->prepare("SELECT id FROM drivers WHERE id = ?");
        $stmt->execute([$driver_id]);
        if (!$stmt->fetch()) {
            $error = "Selected driver does not exist.";
        } else {
            // Check if vehicle exists
            $stmt = $pdo->prepare("SELECT vehicle_id FROM vehicles WHERE vehicle_id = ?");
            $stmt->execute([$vehicle_id]);
            if (!$stmt->fetch()) {
                $error = "Selected vehicle does not exist.";
            } else {
                // Check if driver already has an active assignment
                $stmt = $pdo->prepare("SELECT id FROM assignments WHERE driver_id = ? AND status = 'active'");
                $stmt->execute([$driver_id]);
                if ($stmt->fetch()) {
                    $error = "This driver already has an active assignment. Please complete the current assignment first.";
                } else {
                    // Insert assignment
                    $stmt = $pdo->prepare("INSERT INTO assignments (driver_id, vehicle_id) VALUES (?, ?)");
                    if ($stmt->execute([$driver_id, $vehicle_id])) {
                        $message = "Vehicle assigned successfully!";
                    } else {
                        $error = "Failed to assign vehicle.";
                    }
                }
            }
        }
    }
}

// Fetch all drivers for dropdown
$drivers = $pdo->query("SELECT id, full_name, username FROM drivers ORDER BY full_name")->fetchAll(PDO::FETCH_ASSOC);

// Fetch all vehicles for dropdown
$vehicles = $pdo->query("SELECT vehicle_id, brand, model, year FROM vehicles ORDER BY brand, model")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Vehicle to Driver - AutoFlow</title>
    <link rel="stylesheet" href="../css/assign-vehicle.css">
</head>

<body class="login-page-bg">
    <div class="assign-container">
        <h2>Assign Vehicle to Driver</h2>

        <?php if ($message): ?>
            <div class="alert success"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="driver_id">Select Driver:</label>
                <select name="driver_id" id="driver_id" required>
                    <option value="">-- Choose a driver --</option>
                    <?php foreach ($drivers as $driver): ?>
                        <option value="<?php echo $driver['id']; ?>">
                            <?php echo htmlspecialchars($driver['full_name'] . ' (' . $driver['username'] . ')'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="vehicle_id">Select Vehicle:</label>
                <select name="vehicle_id" id="vehicle_id" required>
                    <option value="">-- Choose a vehicle --</option>
                    <?php foreach ($vehicles as $vehicle): ?>
                        <option value="<?php echo $vehicle['vehicle_id']; ?>">
                            <?php echo htmlspecialchars($vehicle['brand'] . ' ' . $vehicle['model'] . ' ' . $vehicle['year']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn">Assign Vehicle</button>
        </form>

        <a href="company-login-interface.php" class="back-link">← Back to Dashboard</a>
    </div>
</body>
</html>