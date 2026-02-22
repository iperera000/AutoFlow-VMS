<?php
require_once 'config.php';

// The 12 vehicle IDs for default view (in the order of your inventory.html)
$default_ids = [10113, 10114, 10122, 1014, 10143, 1015, 10124, 10111, 1018, 10123, 1016, 1019];

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$vehicles = [];
$is_search = ($search !== '');

if ($is_search) {
    // Search all vehicles
    $stmt = $pdo->prepare("SELECT * FROM vehicles WHERE brand LIKE ? OR model LIKE ? OR year LIKE ? ORDER BY brand, model");
    $searchTerm = "%$search%";
    $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Show only the 12 default vehicles in the original order
    $placeholders = implode(',', array_fill(0, count($default_ids), '?'));
    $order_by = "FIELD(vehicle_id, " . implode(',', $default_ids) . ")";
    $stmt = $pdo->prepare("SELECT * FROM vehicles WHERE vehicle_id IN ($placeholders) ORDER BY $order_by");
    $stmt->execute($default_ids);
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management - AutoFlow</title>
    <link rel="stylesheet" href="../css/inventory.css">
    
</head>
<body>
    <header class="main-hero">
        <video autoplay muted loop playsinline class="video-bg">
            <source src="../assets/car-video3.mp4" type="video/mp4">
        </video>
        <nav class="navbar">
            <div class="logo">Auto<span>Flow</span></div>
            <ul class="nav-links">
                <li><a href="../php/company-login-interface.php">Home</a></li>
            </ul> 
        </nav>
        <div class="hero-content">
            <h1>MANAGE VEHICLE DATA</h1>
        </div>
    </header>

    <section class="search-section">
        <form method="GET" action="inventory.php" style="display: flex; gap: 10px; align-items: center;">
            <input type="text" name="search" placeholder="Search by make, model, year..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
            <?php if ($is_search): ?>
                <a href="../php/inventory.php" class="clear-btn">Clear</a>
            <?php endif; ?>
        </form>
    </section>

    <section class="feature-1">
        <?php if (count($vehicles) > 0): ?>
            <?php if ($is_search): ?>
                <!-- Search results: use generic divs -->
                <?php foreach ($vehicles as $vehicle): ?>
                    <div>
                        <img src="../assets/<?php echo htmlspecialchars($vehicle['image']); ?>" 
                             alt="<?php echo htmlspecialchars($vehicle['brand'] . ' ' . $vehicle['model']); ?>"
                             onerror="this.onerror=null; this.src='../assets/default-car.jpg';">
                        <h3><?php echo htmlspecialchars($vehicle['brand'] . ' ' . $vehicle['model'] . ' ' . $vehicle['year']); ?></h3>
                        <a href="vehicle-details.php?id=<?php echo $vehicle['vehicle_id']; ?>">
                            <button>See More & Edit</button>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Default view: use numbered classes card-1 to card-12 -->
                <?php $index = 1; ?>
                <?php foreach ($vehicles as $vehicle): ?>
                    <div class="card-<?php echo $index; ?>">
                        <img src="../assets/<?php echo htmlspecialchars($vehicle['image']); ?>" 
                             alt="<?php echo htmlspecialchars($vehicle['brand'] . ' ' . $vehicle['model']); ?>"
                             onerror="this.onerror=null; this.src='../assets/default-car.jpg';">
                        <h3><?php echo htmlspecialchars($vehicle['brand'] . ' ' . $vehicle['model'] . ' ' . $vehicle['year']); ?></h3>
                        <a href="vehicle-details.php?id=<?php echo $vehicle['vehicle_id']; ?>">
                            <button>See More & Edit</button>
                        </a>
                    </div>
                    <?php $index++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php else: ?>
            <div class="no-results">No results found.</div>
        <?php endif; ?>
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
                    <li><a href="../html/contact.html">Conatact Us</a></li>
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
