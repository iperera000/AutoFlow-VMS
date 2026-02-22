<?php
session_start();
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $nic = trim($_POST['nic']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (empty($full_name) || empty($nic) || empty($email) || empty($phone) || empty($address) || empty($username) || empty($password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (!preg_match('/^(?=.*[0-9])(?=.*_).{8,}$/', $password)) {
        $error = "Password must be at least 8 characters long and include at least one number and one underscore (_).";
    } elseif (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        $error = "Username must be 3-20 characters and can only contain letters, numbers, and underscores.";
    } else {
        // Check if username or email already exists
        $stmt = $pdo->prepare("SELECT id FROM admins WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $error = "Username or email already taken.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO admins (full_name, email, nic, phone, address, username, password) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$full_name, $email, $nic, $phone, $address, $username, $hashed_password])) {
                $success = "Registration successful! You can now <a href='company-login.php'>login</a>.";
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
    <title>Company Register - AutoFlow</title>
    <style>
        #password-error {
            color: #ff4d4d;
            font-size: 0.85rem;
            margin-top: -10px;
            margin-bottom: 15px;
            display: none;
            font-weight: 500;
        }
    </style>
</head>
<body class="login-page-bg">
    <section class="login-container">
        <div class="login-card">
            <h2 class="login-title">Company Register</h2>

            <?php if ($error): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="post" action="" id="company-register-form">
                <div class="input-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" id="full_name" placeholder="Enter full name" required value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="nic">NIC Number</label>
                    <input type="text" name="nic" id="nic" placeholder="Enter NIC" required value="<?php echo isset($_POST['nic']) ? htmlspecialchars($_POST['nic']) : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter business email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" id="phone" placeholder="Enter contact number" required value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="address">Company Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter physical address" required value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
                </div>

                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="reg-username" placeholder="Choose an admin username" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>
                
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="reg-password" placeholder="Create a password" required>
                </div>

                <div class="input-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="reg-password-confirm" placeholder="Confirm password" required>
                </div>

                <div id="password-error">
                    Password must be at least 8 characters, include a number and an underscore (_).
                </div>
                
                <button type="submit" class="login-btn">Register Company</button>
            </form>

            <p class="form-footer">
                Already registered? <a href="../php/company-login.php">Login here</a>
            </p>
        </div>
    </section>

    <script>
        const form = document.getElementById('company-register-form');
        const passInput = document.getElementById('reg-password');
        const confirmInput = document.getElementById('reg-password-confirm');
        const errorMsg = document.getElementById('password-error');

        function validatePasswords() {
            const passValue = passInput.value;
            const confirmValue = confirmInput.value;
            const strongRegex = /^(?=.*[0-9])(?=.*_).{8,}$/;

            if (passValue === "") {
                errorMsg.style.display = "none";
                return true;
            }

            if (!strongRegex.test(passValue)) {
                errorMsg.textContent = "Password must be at least 8 characters, include a number and an underscore (_).";
                errorMsg.style.display = "block";
                return false;
            } else if (confirmValue !== "" && passValue !== confirmValue) {
                errorMsg.textContent = "Passwords do not match.";
                errorMsg.style.display = "block";
                return false;
            } else {
                errorMsg.style.display = "none";
                return true;
            }
        }

        passInput.addEventListener('input', validatePasswords);
        confirmInput.addEventListener('input', validatePasswords);

        form.addEventListener('submit', function(e) {
            if (!validatePasswords()) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>