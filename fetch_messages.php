<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

$badWords = ['заборона', 'дупа', 'asshole']; // Погані слова

function containsBadWord($message, $badWords) {
    foreach ($badWords as $word) {
        if (strpos(strtolower($message), strtolower($word)) !== false) {
            return true;
        }
    }
    return false;
}

$sql = "SELECT messages.id, messages.user_id, users.username, messages.message, messages.created_at FROM messages JOIN users ON messages.user_id = users.id ORDER BY messages.created_at ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messageText = $row["message"];

        // Заміна кожного поганого слова на заблюроване
        foreach ($badWords as $badWord) {
            $blurredWord = "<span class='blur'>" . $badWord . "</span>";
            $messageText = preg_replace("/\b" . preg_quote($badWord, '/') . "\b/ui", $blurredWord, $messageText);
        }

        //echo "<div>[" . $row["created_at"] . "] " . $row["username"] . ": " . $messageText . "</div>";
        echo  "<div>[" . $row["created_at"] . "] " . $row["username"] . ": " . $messageText;
        if ($role == 'admin' || ($role == 'user' && $row["user_id"] == $user_id)) {
            echo " <form method='post' style='display: inline;'>
            <input type='hidden' name='message_id' value='" . $row["id"] . "'>
            <input type='submit' name='delete_message' value='Delete'>
            </form></div>";
        }
    }
} else {
    echo "No messages.<br>";
}

?>
