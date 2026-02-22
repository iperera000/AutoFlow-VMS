<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['driver_id'])) {
    header('Location: driver-login.php');
    exit;
}

$driver_id = $_SESSION['driver_id'];
$driver_name = $_SESSION['driver_name'];

// Fetch driver details from database
$stmt = $pdo->prepare("SELECT * FROM drivers WHERE id = ?");
$stmt->execute([$driver_id]);
$driver = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$driver) {
    session_destroy();
    header('Location: driver-login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Details - AutoFlow</title>
    <link rel="stylesheet" href="../css/driver-login-interface.css">
    <link rel="stylesheet" href="../css/driver-details.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

</head>

<body>
    <header class="main-hero" style="height: auto; min-height: 200px;">
        <video autoplay muted loop playsinline class="video-bg">
            <source src="../assets/car3.mp4" type="video/mp4">
        </video>
        <nav class="navbar">
            <div class="logo">Auto<span>Flow</span></div>
            <ul class="nav-links">
                <li><a href="../php/driver-dashboard.php">Home</a></li>
                <li><a href="../php/assigned-vehicle.php">Assigned Vehicle</a></li>
                <li><a href="../html/aboutpage.html">About</a></li>
                <li><span style="color: #a855f7;">Welcome, <?php echo htmlspecialchars($driver_name); ?>!</span></li>
                <li><a href="../php/logout.php" style="color: #ff6b6b;">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="details-container">
        <h2>My Details</h2>

        <table class="details-table">
            <tr>
                <th>Driver ID</th>
                <td><?php echo $driver['id']; ?></td>
            </tr>
            <tr>
                <th>Full Name</th>
                <td><?php echo htmlspecialchars($driver['full_name']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($driver['email']); ?></td>
            </tr>
            <tr>
                <th>NIC</th>
                <td><?php echo htmlspecialchars($driver['nic']); ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?php echo htmlspecialchars($driver['phone']); ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo nl2br(htmlspecialchars($driver['address'])); ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><?php echo htmlspecialchars($driver['username']); ?></td>
            </tr>
            <tr>
                <th>Registered Since</th>
                <td><?php echo date('d M Y, h:i A', strtotime($driver['registered_at'])); ?></td>
            </tr>
        </table>

        <a href="../php/driver-dashboard.php" class="back-link">← Back to Dashboard</a>
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
