<?php
session_start();
require_once 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: company-login.php');
    exit;
}

$admin_name = $_SESSION['admin_name'];

// Fetch all drivers from database
$stmt = $pdo->query("SELECT * FROM drivers ORDER BY registered_at DESC");
$drivers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drivers - AutoFlow</title>
    <link rel="stylesheet" href="../css/company-login-interface.css">
    <link rel="stylesheet" href="../css/drivers.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-hero" style="height: auto; min-height: 200px;">
        <video autoplay muted loop playsinline class="video-bg">
            <source src="../assets/car2.mp4" type="video/mp4">
        </video>
        <nav class="navbar">
            <div class="logo">Auto<span>Flow</span></div>
            <ul class="nav-links">
                <li><a href="../html/index.html">Home</a></li>
                <li><a href="inventory.php">Vehicles</a></li>
                <li><a href="../html/aboutpage.html">About</a></li>
                <li><span style="color: #a855f7;">Welcome, <?php echo htmlspecialchars($admin_name); ?>!</span></li>
                <li><a href="logout.php" style="color: #ff6b6b;">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="drivers-container">
        <h2>Registered Drivers</h2>
        <p>Total drivers: <?php echo count($drivers); ?></p>

        <?php if (count($drivers) > 0): ?>
            <table class="drivers-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>NIC</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Username</th>
                        <th>Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($drivers as $driver): ?>
                        <tr>
                            <td><?php echo $driver['id']; ?></td>
                            <td><?php echo htmlspecialchars($driver['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($driver['email']); ?></td>
                            <td><?php echo htmlspecialchars($driver['nic']); ?></td>
                            <td><?php echo htmlspecialchars($driver['phone']); ?></td>
                            <td><?php echo htmlspecialchars($driver['address']); ?></td>
                            <td><?php echo htmlspecialchars($driver['username']); ?></td>
                            <td><?php echo date('d M Y', strtotime($driver['registered_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-drivers">No drivers registered yet.</p>
        <?php endif; ?>

        <a href="company-login-interface.php" class="back-link">← Back to Dashboard</a>
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
                    <li><a href="../html/privacy-policy.html">Privacy Policy</a></li>
                    <li><a href="../html/terms-os.html">Terms of Service</a></li>
                    <li><a href="../html/cookie-policy.html">Cookie Policy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li><a href="../html/helpcentre.html">Help Center</a></li>
                    <li><a href="../html/faq.html">FAQ</a></li>
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