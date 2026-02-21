<?php
session_start();
require_once 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: company-login.php');
    exit;
}

$admin_name = $_SESSION['admin_name'];

$search_brand = isset($_GET['brand']) ? trim($_GET['brand']) : '';
$search_model = isset($_GET['model']) ? trim($_GET['model']) : '';
$search_year = isset($_GET['year']) ? trim($_GET['year']) : '';

$vehicles = [];
$searched = false;

// Only search if at least one field is filled
if ($search_brand !== '' || $search_model !== '' || $search_year !== '') {
    $searched = true;
    $sql = "SELECT * FROM vehicles WHERE 1=1";
    $params = [];

    if ($search_brand !== '') {
        $sql .= " AND brand LIKE ?";
        $params[] = "%$search_brand%";
    }
    if ($search_model !== '') {
        $sql .= " AND model LIKE ?";
        $params[] = "%$search_model%";
    }
    if ($search_year !== '') {
        $sql .= " AND year LIKE ?";
        $params[] = "%$search_year%";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Vehicles - AutoFlow</title>
    <link rel="stylesheet" href="../css/company-login-interface.css">
    <link rel="stylesheet" href="../css/available-vehicles.css">
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
                <li><a href="company-login-interface.php">Home</a></li>
                <li><a href="inventory.php">Vehicles</a></li>
                <li><a href="../html/about.html">About</a></li>
                <li><span style="color: #a855f7;">Welcome, <?php echo htmlspecialchars($admin_name); ?>!</span></li>
                <li><a href="logout.php" style="color: #ff6b6b;">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="search-container">
        <h2>Search Available Vehicles</h2>
        <form method="GET" action="available-vehicles.php" class="search-form">
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" name="brand" id="brand" value="<?php echo htmlspecialchars($search_brand); ?>" placeholder="e.g., Toyota">
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" name="model" id="model" value="<?php echo htmlspecialchars($search_model); ?>" placeholder="e.g., Corolla">
            </div>
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="text" name="year" id="year" value="<?php echo htmlspecialchars($search_year); ?>" placeholder="e.g., 2020">
            </div>
            <button type="submit" class="search-btn">Search</button>
            <a href="available-vehicles.php" class="clear-btn">Clear</a>
        </form>
    </div>

    <div class="results-container">
        <?php if ($searched): ?>
            <?php if (count($vehicles) > 0): ?>
                <h3>Search Results (<?php echo count($vehicles); ?>)</h3>
                <div class="vehicle-grid">
                    <?php foreach ($vehicles as $vehicle): ?>
                        <div class="vehicle-card">
                            <?php if (!empty($vehicle['image']) && file_exists($vehicle['image'])): ?>
                                <img src="<?php echo htmlspecialchars($vehicle['image']); ?>" alt="<?php echo htmlspecialchars($vehicle['brand'] . ' ' . $vehicle['model']); ?>" onerror="this.onerror=null; this.src='default-car.jpg';">
                            <?php else: ?>
                                <img src="../assets/default-car.jpg" alt="No image">
                            <?php endif; ?>
                            <h4><?php echo htmlspecialchars($vehicle['brand'] . ' ' . $vehicle['model'] . ' ' . $vehicle['year']); ?></h4>
                            <p><strong>Type:</strong> <?php echo htmlspecialchars($vehicle['type']); ?></p>
                            <p><strong>Engine:</strong> <?php echo $vehicle['engine_cc']; ?> cc</p>
                            <p><strong>Fuel:</strong> <?php echo htmlspecialchars($vehicle['fuel_type']); ?></p>
                            <p><strong>Transmission:</strong> <?php echo htmlspecialchars($vehicle['transmission']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="no-results">No vehicles found matching your criteria.</p>
            <?php endif; ?>
        <?php else: ?>
            <p class="no-results">Enter search terms above to find vehicles.</p>
        <?php endif; ?>
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
                    <li><a href="privacy-policy.html">Privacy Policy</a></li>
                    <li><a href="terms-os.html">Terms of Service</a></li>
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