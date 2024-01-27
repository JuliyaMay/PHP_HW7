<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Initialize the email array in the session if it doesn't exist
    if (!isset($_SESSION['emails'])) {
        $_SESSION['emails'] = array();
    }

    // Add the new email to the session array
    $_SESSION['emails'][] = $email;

    // Display the current email
    echo "Your E-Mail is " . htmlspecialchars($email);
    echo "<br>";

    // Display all emails stored in the session
    echo "All E-Mails: <br>";
    foreach ($_SESSION['emails'] as $storedEmail) {
        echo htmlspecialchars($storedEmail) . "<br>";
    }
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
