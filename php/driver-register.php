<?php
session_start();
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $nic = trim($_POST['nic']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($full_name) || empty($email) || empty($nic) || empty($phone) || empty($address) || empty($username) || empty($password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        // Check existing username/email
        $stmt = $pdo->prepare("SELECT id FROM drivers WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $error = "Username or email already taken.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO drivers (full_name, email, nic, phone, address, username, password) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$full_name, $email, $nic, $phone, $address, $username, $hashed_password])) {
                $success = "Registration successful! You can now <a href='driver-login.php'>login</a>.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Driver Register - AutoFlow</title>
</head>
<body class="login-page-bg">
    <section class="login-container">
        <div class="login-card">
            <h2 class="login-title">Driver Registration</h2>

            <?php if ($error): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="input-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" id="full_name" placeholder="Enter your full name" required value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="nic">NIC</label>
                    <input type="text" name="nic" id="nic" placeholder="Enter your NIC" required value="<?php echo isset($_POST['nic']) ? htmlspecialchars($_POST['nic']) : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" required value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter your address" required value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Choose a username" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>
                
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Create a password" required>
                </div>

                <div class="input-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>
                </div>
                
                <button type="submit" class="login-btn">Register</button>
            </form>

            <p class="form-footer">
                Already have an account? <a href="../php/driver-login.php">Login here</a>
            </p>
        </div>
    </section>
</body>
</html>