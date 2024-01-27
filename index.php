<?php
session_start(); // Start the session at the beginning of the script
$filename = 'emails.txt'; // File to store emails

// Function to delete a specific email
function deleteEmail($filename, $emailToDelete) {
    // Read all emails from the file
    $emails = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    // Remove the specific email
    $emails = array_filter($emails, function($email) use ($emailToDelete) {
        return trim($email) !== trim($emailToDelete);
    });
    // Save the remaining emails back to the file
    file_put_contents($filename, implode(PHP_EOL, $emails));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deleteAll'])) {
        file_put_contents($filename, ""); // Empty the file
        echo "All emails have been deleted.<br>";
    } elseif (isset($_POST['deleteEmail']) && !empty($_POST['emailToDelete'])) {
        $emailToDelete = $_POST['emailToDelete'];
        deleteEmail($filename, $emailToDelete);
        echo "Email " . htmlspecialchars($emailToDelete) . " has been deleted.<br>";
    } else {
        $email = $_POST['email'];

        // Append the new email to the file
        file_put_contents($filename, htmlspecialchars($email) . PHP_EOL, FILE_APPEND);

        // Display the current email
        echo "Your E-Mail is " . htmlspecialchars($email);
        echo "<br>";
    }
}

// Display all emails stored in the file
echo "All E-Mails: <br>";
if(file_exists($filename) && filesize($filename) > 0) {
    $fileContent = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($fileContent as $line) {
        echo htmlspecialchars($line);
        echo ' <form style="display: inline;" method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
        echo '<input type="hidden" name="emailToDelete" value="' . $line . '">';
        echo '<input type="submit" name="deleteEmail" value="Delete">';
        echo '</form>';
        echo '<br>';
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

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="deleteAll" value="1">
    <input type="submit" value="Delete All Emails">
</form>

</body>
</html>
