<?php
session_start();
require_once 'config.php';

// Check if driver is logged in
if (!isset($_SESSION['driver_id'])) {
    header('Location: driver-login.php');
    exit;
}

$driver_id = $_SESSION['driver_id'];
$driver_name = $_SESSION['driver_name'];

// Fetch active assignment for this driver
$stmt = $pdo->prepare("
    SELECT a.*, v.* 
    FROM assignments a
    JOIN vehicles v ON a.vehicle_id = v.vehicle_id
    WHERE a.driver_id = ? AND a.status = 'active'
");
$stmt->execute([$driver_id]);
$assignment = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Assigned Vehicle - AutoFlow</title>
    <link rel="stylesheet" href="../css/driver-login-interface.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .vehicle-detail-container {
            max-width: 800px;
            margin: 40px auto;
            background: #1a1a1a;
            padding: 30px;
            border-radius: 10px;
            color: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }
        .vehicle-detail-container h2 {
            color: #a855f7;
            text-align: center;
            margin-bottom: 30px;
        }
        .vehicle-detail-table {
            width: 100%;
            border-collapse: collapse;
        }
        .vehicle-detail-table th,
        .vehicle-detail-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #333;
            text-align: left;
        }
        .vehicle-detail-table th {
            width: 30%;
            color: #a855f7;
            font-weight: 600;
        }
        .vehicle-detail-table td {
            color: #ddd;
        }
        .no-vehicle {
            text-align: center;
            padding: 50px;
            color: #888;
            font-size: 1.2rem;
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
        .vehicle-image {
            max-width: 300px;
            margin: 20px auto;
            display: block;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <header class="main-hero" style="height: auto; min-height: 200px;">
        <video autoplay muted loop playsinline class="video-bg">
            <source src="../assets/car3.mp4" type="video/mp4">
        </video>
        <nav class="navbar">
            <div class="logo">Auto<span>Flow</span></div>
            <ul class="nav-links">
                <li><a href="driver-dashboard.php">Home</a></li>
                <li><a href="assigned-vehicle.php" class="active">Assigned Vehicle</a></li>
                <li><a href="../html/aboutpage.html">About</a></li>
                <li><a href="logout.php" style="color: #ff6b6b;">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="vehicle-detail-container">
        <h2>My Assigned Vehicle</h2>

        <?php if ($assignment): ?>
            <?php if (!empty($assignment['image']) && file_exists($assignment['image'])): ?>
                <img src="<?php echo htmlspecialchars($assignment['image']); ?>" alt="Vehicle Image" class="vehicle-image">
            <?php endif; ?>
            
            <table class="vehicle-detail-table">
                <tr>
                    <th>Vehicle ID</th>
                    <td><?php echo $assignment['vehicle_id']; ?></td>
                </tr>
                <tr>
                    <th>Brand</th>
                    <td><?php echo htmlspecialchars($assignment['brand']); ?></td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td><?php echo htmlspecialchars($assignment['model']); ?></td>
                </tr>
                <tr>
                    <th>Year</th>
                    <td><?php echo $assignment['year']; ?></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td><?php echo htmlspecialchars($assignment['type']); ?></td>
                </tr>
                <tr>
                    <th>Engine CC</th>
                    <td><?php echo $assignment['engine_cc']; ?> cc</td>
                </tr>
                <tr>
                    <th>Fuel Type</th>
                    <td><?php echo htmlspecialchars($assignment['fuel_type']); ?></td>
                </tr>
                <tr>
                    <th>Transmission</th>
                    <td><?php echo htmlspecialchars($assignment['transmission']); ?></td>
                </tr>
                <tr>
                    <th>Assigned On</th>
                    <td><?php echo date('d M Y, h:i A', strtotime($assignment['assignment_date'])); ?></td>
                </tr>
            </table>
        <?php else: ?>
            <div class="no-vehicle">
                <i class="fa-solid fa-car" style="font-size: 4rem; color: #444; margin-bottom: 20px;"></i>
                <p>You don't have any vehicle assigned at the moment.</p>
                <p>Please contact your dispatcher or admin.</p>
            </div>
        <?php endif; ?>

        <a href="driver-dashboard.php" class="back-link">← Back to Dashboard</a>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <h3>Auto<span>Flow</span></h3>
                <p>Leading the way in modern fleet management and vehicle solutions.</p>
            </div>
            <div class="footer-col">
                <h4>Legal</h4>
                <ul>
                    <li><a href="../html/privacypolicy.html">Privacy Policy</a></li>
                    <li><a href="../html/terms-os.html">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li><a href="../html/helpcentre.html">Help Center</a></li>
                    <li><a href="../html/contact.html">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact Info</h4>
                <p>Email: support@autoflow.com</p>
                <p>Phone: +94 773872374</p>
                <p>Location: Colombo 10, Sri Lanka</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 AutoFlow Systems. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>