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
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $sql = "SELECT id, username, role FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

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
    <?php if($login_error != '') { echo "<p>$login_error</p>"; } ?>
</body>
</html>
