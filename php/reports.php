<?php
session_start();
require_once 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: company-login.php');
    exit;
}

$admin_name = $_SESSION['admin_name'];

// Fetch statistics
$total_vehicles = $pdo->query("SELECT COUNT(*) FROM vehicles")->fetchColumn();
$total_drivers = $pdo->query("SELECT COUNT(*) FROM drivers")->fetchColumn();
$active_assignments = $pdo->query("SELECT COUNT(*) FROM assignments WHERE status = 'active'")->fetchColumn();

// Vehicle counts by type
$stmt = $pdo->query("SELECT type, COUNT(*) as count FROM vehicles GROUP BY type ORDER BY count DESC");
$vehicle_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vehicle counts by fuel type
$stmt = $pdo->query("SELECT fuel_type, COUNT(*) as count FROM vehicles GROUP BY fuel_type ORDER BY count DESC");
$fuel_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vehicle counts by transmission
$stmt = $pdo->query("SELECT transmission, COUNT(*) as count FROM vehicles GROUP BY transmission ORDER BY count DESC");
$transmissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Recent assignments (last 5)
$stmt = $pdo->query("SELECT a.*, d.full_name as driver_name, v.brand, v.model, v.year 
                     FROM assignments a
                     JOIN drivers d ON a.driver_id = d.id
                     JOIN vehicles v ON a.vehicle_id = v.vehicle_id
                     ORDER BY a.assignment_date DESC
                     LIMIT 5");
$recent_assignments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - AutoFlow</title>
    <link rel="stylesheet" href="../css/company-login-interface.css">
    <link rel="stylesheet" href="../css/reports.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-hero" style="height: auto; min-height: 150px;">
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

    <div class="reports-container">
        <h1>Fleet Reports & Analytics</h1>
        
    <div class="summary-cards">
        <div class="summary-card">
            <div class="card-icon">🚗</div>
            <div class="card-content">
                <h3>Total Vehicles</h3>
                <p class="card-number"><?php echo $total_vehicles; ?></p>
            </div>
        </div>
        <div class="summary-card">
            <div class="card-icon">👤</div>
            <div class="card-content">
                <h3>Total Drivers</h3>
                <p class="card-number"><?php echo $total_drivers; ?></p>
            </div>
        </div>
        <div class="summary-card">
            <div class="card-icon">🔑</div>
            <div class="card-content">
                <h3>Active Assignments</h3>
                <p class="card-number"><?php echo $active_assignments; ?></p>
            </div>
        </div>
        <div class="summary-card">
            <div class="card-icon">📊</div>
            <div class="card-content">
                <h3>Utilization</h3>
                <p class="card-number"><?php echo $total_vehicles > 0 ? round(($active_assignments / $total_vehicles) * 100) : 0; ?>%</p>
            </div>
        </div>
    </div>

    <div class="charts-row">
        <div class="chart-container">
            <h2>Vehicles by Type</h2>
            <div class="bar-chart">
                <?php 
                $max_count = $vehicle_types ? max(array_column($vehicle_types, 'count')) : 1;
                foreach ($vehicle_types as $type): 
                    $width = ($type['count'] / $max_count) * 100;
                ?>
                    <div class="chart-item">
                        <span class="chart-label"><?php echo htmlspecialchars($type['type']); ?></span>
                        <div class="chart-bar">
                        <div class="bar-fill" style="width: <?php echo $width; ?>%;"></div>
                        <span class="bar-value"><?php echo $type['count']; ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="chart-container">
            <h2>Vehicles by Fuel Type</h2>
            <div class="bar-chart">
                <?php 
                $max_count = $fuel_types ? max(array_column($fuel_types, 'count')) : 1;
                foreach ($fuel_types as $fuel): 
                    $width = ($fuel['count'] / $max_count) * 100;
                ?>
                    <div class="chart-item">
                        <span class="chart-label"><?php echo htmlspecialchars($fuel['fuel_type']); ?></span>
                        <div class="chart-bar">
                        <div class="bar-fill" style="width: <?php echo $width; ?>%;"></div>
                        <span class="bar-value"><?php echo $fuel['count']; ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

        <div class="charts-row">
            <div class="chart-container">
                <h2>Vehicles by Transmission</h2>
                <div class="bar-chart">
                    <?php 
                    $max_count = $transmissions ? max(array_column($transmissions, 'count')) : 1;
                    foreach ($transmissions as $trans): 
                        $width = ($trans['count'] / $max_count) * 100;
                    ?>
                        <div class="chart-item">
                            <span class="chart-label"><?php echo htmlspecialchars($trans['transmission']); ?></span>
                            <div class="chart-bar">
                            <div class="bar-fill" style="width: <?php echo $width; ?>%;"></div>
                            <span class="bar-value"><?php echo $trans['count']; ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="chart-container">
                <h2>Recent Assignments</h2>
                <table class="recent-table">
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th>Vehicle</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($recent_assignments): ?>
                            <?php foreach ($recent_assignments as $ass): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($ass['driver_name']); ?></td>
                                    <td><?php echo htmlspecialchars($ass['brand'] . ' ' . $ass['model'] . ' ' . $ass['year']); ?></td>
                                    <td><?php echo date('d M Y', strtotime($ass['assignment_date'])); ?></td>
                                    <td><span class="status-badge status-<?php echo $ass['status']; ?>"><?php echo $ass['status']; ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" style="text-align: center;">No recent assignments</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

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
                    <li><a href="../html/privacypolicy.html">Privacy Policy</a></li>
                    <li><a href="../html/terms-os.html">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li><a href="../html/helpcentre.html">Help Center</a></li>
                    <li><a href="../html/contacts.html">Contact Us</a></li>
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