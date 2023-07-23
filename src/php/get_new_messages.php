<?php
ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);

// Connect to the SQLite database (replace these credentials with your actual database details)
$databaseFile = __DIR__ . '/../data/message.db'; // Update the path to your database file
try {
    $pdo = new PDO('sqlite:' . $databaseFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
// Assuming you have a "messages" table in your message.db containing fields: ID, MESSAGE, TIME
// Fetch new messages from the database (you need to adapt this query according to your database schema)
$lastMessageId = isset($_GET['lastMessageId']) ? $_GET['lastMessageId'] : 0;
$query = "SELECT * FROM messages WHERE ID > :lastMessageId";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":lastMessageId", $lastMessageId, PDO::PARAM_INT);
$stmt->execute();


// Prepare an array to hold the new messages
$messages = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $messages[] = array(
        'ID' => $row['ID'],
        'USER' => $row['USER'],
        'MESSAGE' => $row['MESSAGE'],
        'TIME' => $row['TIME']
    );
}

// Close the database connection
$pdo = null;

// Send the new messages back to the client as JSON
header("Content-Type: application/json");
echo json_encode(array('messages' => $messages));
?>
