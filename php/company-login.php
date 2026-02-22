<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['admin_id'])) {
    header('Location: company-login-interface.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Please enter username and password.";
    } else {
        $stmt = $pdo->prepare("SELECT id, full_name, username, password FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['full_name'];
            header('Location: company-login-interface.php');
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>
<!-- HTML form remains exactly as before -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login - AutoFlow</title>
</head>
<body class="login-page-bg">
    <section class="login-container">
        <div class="login-card">
            <h2 class="login-title">AutoFlow Admin Login</h2>

            <?php if ($error): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter your username" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>
                
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
                
                <button type="submit" class="login-btn">Sign In</button>
            </form>

            <p class="form-footer">
                Don't have an account? <a href="../php/company-register.php">Register</a>
            </p>
            <p class="form-footer">Forgot password? <a href="../html/forgot-password.html">Click here</a></p>
        </div>
    </section>
</body>
</html>