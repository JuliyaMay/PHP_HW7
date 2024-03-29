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
function postMessage($pdo, $user_id, $message) {
    $sql = "INSERT INTO messages (user_id, message) VALUES (:user_id, :message)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([':user_id' => $user_id, ':message' => $message])) {
        echo "Message posted!<br>";
    } else {
        echo "Error posting message.<br>";
    }
}

// Function to delete a message
function deleteMessage($pdo, $message_id, $user_id, $role) {
    if ($role == 'admin') {
        $sql = "DELETE FROM messages WHERE id = :message_id";
        $params = [':message_id' => $message_id];
    } else {
        $sql = "DELETE FROM messages WHERE id = :message_id AND user_id = :user_id";
        $params = [':message_id' => $message_id, ':user_id' => $user_id];
    }
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        echo "Message deleted!<br>";
    } else {
        echo "Error deleting message.<br>";
    }
}

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['message']) && !empty($_POST['message'])) {
        postMessage($pdo, $user_id, $_POST['message']);
    }
    if (isset($_POST['delete_message']) && isset($_POST['message_id'])) {
        deleteMessage($pdo, $_POST['message_id'], $user_id, $role);
    }
}
?>

<html>
<head>
    <title>Chat</title>
    <style>
    .blur {
        color: transparent;
        text-shadow: 0 0 5px rgba(0,0,0,0.5);
    }
    </style>

    <script>
        function fetchMessages() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("chatDisplay").innerHTML = this.responseText;
                }
            };
            xhr.open("GET", "fetch_messages.php", true);
            xhr.send();
        }

        // Fetch messages every 5 seconds
        setInterval(fetchMessages, 5000);
        fetchMessages(); // initial fetch
    </script>
</head>
<body>
    <div id="chatDisplay">
        <!-- Messages will be displayed here -->
    </div>

    <?php if (isset($user_id)) : ?>
        <form method='post'>
            Message: <input type='text' name='message'>
            <input type='submit' value='Send'>
        </form>
    <?php endif; ?>
</body>
</html>
