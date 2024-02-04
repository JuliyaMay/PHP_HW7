<?php
session_start();

include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Function to post a message
function postMessage($conn, $user_id, $message) {
    $sql = "INSERT INTO messages (user_id, message) VALUES ('$user_id', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Message posted!<br>";
    } else {
        echo "Error posting message: " . $conn->error . "<br>";
    }
}

// Function to delete a message
function deleteMessage($conn, $message_id, $user_id, $role) {
    if ($role == 'admin') {
        $sql = "DELETE FROM messages WHERE id = '$message_id'";
    } else {
        $sql = "DELETE FROM messages WHERE id = '$message_id' AND user_id = '$user_id'";
    }
    if ($conn->query($sql) === TRUE) {
        echo "Message deleted!<br>";
    } else {
        echo "Error deleting message: " . $conn->error . "<br>";
    }
}

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['message']) && !empty($_POST['message'])) {
        postMessage($conn, $user_id, $conn->real_escape_string($_POST['message']));
    }
    if (isset($_POST['delete_message']) && isset($_POST['message_id'])) {
        deleteMessage($conn, $_POST['message_id'], $user_id, $role);
    }
}

// Display all messages
$sql = "SELECT messages.id, messages.user_id, users.username, messages.message, messages.created_at FROM messages JOIN users ON messages.user_id = users.id ORDER BY messages.created_at ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "[" . $row["created_at"] . "] " . $row["username"] . ": " . $row["message"];
        if ($role == 'admin' || ($role == 'user' && $row["user_id"] == $user_id)) {
            echo " <form method='post' style='display: inline;'>
            <input type='hidden' name='message_id' value='" . $row["id"] . "'>
            <input type='submit' name='delete_message' value='Delete'>
            </form>";
        }
        echo "<br>";
    }
} else {
    echo "No messages.<br>";
}

// Message input form for logged-in users
if (isset($user_id)) {
    echo "<form method='post'>";
    echo "Message: <input type='text' name='message'>";
    echo "<input type='submit' value='Send'>";
    echo "</form>";
}
?>
