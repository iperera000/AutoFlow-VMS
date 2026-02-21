<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['driver_id'])) {
    header('Location: driver-login.php');
    exit;
}

$driver_name = $_SESSION['driver_name'];

//fetch fresh details from DB

$stmt = $pdo->prepare("SELECT full_name FROM drivers WHERE id = ?");
$stmt->execute([$_SESSION['driver_id']]);
$driver = $stmt->fetch();
if ($driver) {
    $driver_name = $driver['full_name'];
    $_SESSION['driver_name'] = $driver_name;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoFlow - Driver</title>
    <link rel="stylesheet" href="../css/driver-login-interface.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

</head>

<body>

    <header class="main-hero">
        <video autoplay muted loop playsinline class="video-bg">
            <source src="../assets/car3.mp4" type="video/mp4">
        </video>

        <nav class="navbar">
            <div class="logo">Auto<span>Flow</span></div>
            <ul class="nav-links">
                <li><a href="../html/index.html" class="active">Home</a></li>
                <li><a href="../php/assigned-vehicle.php">Assigned Vehicle</a></li>
                <li><a href="../html/aboutpage.html">About</a></li>
                <li><a href="../php/logout.php" style="color: #ff6b6b;">Logout</a></li>
            </ul>
        </nav>

        <div class="hero-content">
            <h1>Welcome to AutoFlow, <?php echo htmlspecialchars($driver_name); ?>!</h1>
            <p>Your shift has started. Check your assigned vehicle to begin your route.</p>
            
            <div class="action-buttons">
                <a href="../php/driver-details.php" class="primary-btn">View My Details</a>
            </div>
        </div>
    </header>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <h3>Auto<span>Flow</span></h3>
                <p>Leading the way in modern fleet management and vehicle solutions.</p>
            </div>
            <div class="footer-col">
                <h4>Legal</h4>
                <ul>
                    <li><a href="privacypolicy.html">Privacy Policy</a></li>
                    <li><a href="terms-os.html">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li><a href="helpcentre.html">Help Center</a></li>
                    <li><a href="contacts.html">Contact Us</a></li>
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