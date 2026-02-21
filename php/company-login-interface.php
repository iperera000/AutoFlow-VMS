<?php
session_start();
require_once 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: company-login.php');
    exit;
}

$admin_name = $_SESSION['admin_name'];

// Get counts for dashboard
$vehicle_count = $pdo->query("SELECT COUNT(*) FROM vehicles")->fetchColumn();
$driver_count = $pdo->query("SELECT COUNT(*) FROM drivers")->fetchColumn();
// Placeholder for other stats – you can calculate these later
$available_count = 144; // e.g., vehicles not assigned
$maintenance_count = 12; // e.g., vehicles in maintenance
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company login</title>
    <link rel="stylesheet" href="../css/company-login-interface.css">
</head>
<body>
    <header class="main-hero">
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

    <div class="hero-content">
            <h1>WELCOME TO AUTOFLOW ADMIN INTERFACE</h1>
            <p>The ultimate professional solution for efficient vehicle tracking, sales, and fleet management.</p>
    </div>
    </header>

    <section class="admin-panel">
    <div class="panel-title">
        <h2>Admin Control Center</h2>
        <p>Monitor fleet status and manage system operations in real time.</p>
    </div>

    <div class="panel-grid">

        <div class="panel-card">
            <h3><a href="inventory.php">Vehicles</a></h3>
            <p><?php echo $vehicle_count; ?></p>
        </div>

        <div class="panel-card">
            <h3><a href="available-vehicles.php">Available</a></h3>
            <p><?php echo $available_count; ?></p>
        </div>

        <div class="panel-card">
            <h3><a href="drivers.php">Drivers</a></h3>
            <p><?php echo $driver_count; ?></p>
        </div>

    </div>
</section>

    <section class="operations">
    <div class="operations-header">
        <h2>Fleet Operations</h2>
        <p>Manage vehicles, assignments, and system records.</p>
    </div>

    <div class="operations-grid">

        <div class="op-card"><a href="../html/registervehicle.html">Register Vehicle</a></div>
        <div class="op-card"><a href="vehicle-details.php">Edit Vehicle Details</a></div>
        <div class="op-card"><a href="assign-vehicle.php">Assign Vehicle to Driver</a></div>
        <div class="op-card"><a href="reports.php">View Reports</a></div>

    </div>
</section>

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