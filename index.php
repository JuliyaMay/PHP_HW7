<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    echo "Your E-Mail is " . htmlspecialchars($email);
    echo "<br>";
    // echo "Your server is " . htmlspecialchars($_SERVER["PHP_SELF"]);
    // echo "<br>";
    // echo "Your REQUEST_METHOD is " . htmlspecialchars($_SERVER["REQUEST_METHOD"]);
}
?>

<html>
<head>
    <title>Login page</title>
</head>
<body>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    E-Mail: <input type="email" name="email">
    <br>
    Password: <input type="password" name="password">
    <br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
