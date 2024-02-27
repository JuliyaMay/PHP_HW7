<?php
session_start();

// Redirect user to chat if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: chat.php");
    exit;
}

include 'db.php';
$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT id, username, role FROM users WHERE username = :username AND password = :password";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username, 'password' => $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header("Location: chat.php");
        exit;
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>

<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST" action="">
        Username: <input type="text" name="username" required>
        <br>
        Password: <input type="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
    <?php if ($login_error != '') { echo "<p>$login_error</p>"; } ?>
</body>
</html>
