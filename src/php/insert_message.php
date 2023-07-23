<?php
// Connect to the SQLite database using PDO
$databaseFile = __DIR__ . '/../data/message.db'; // Update the path to your database file
try {
    $pdo = new PDO('sqlite:' . $databaseFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the request method is POST (to ensure this script is accessed through a POST request)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get message data from the POST request
    $user = $_POST['user'];
    $message = $_POST['message'];
    $time = date("Y-m-d H:i:s");

    try {
        // Prepare the INSERT query
        $stmt = $pdo->prepare("INSERT INTO messages (USER, MESSAGE, TIME) VALUES (:user, :message, :time)");

        // Bind the values to the prepared statement
        $stmt->bindParam(":user", $user, PDO::PARAM_STR);
        $stmt->bindParam(":message", $message, PDO::PARAM_STR);
        $stmt->bindParam(":time", $time, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Respond with a success message
        echo "Message inserted successfully!";
    } catch (PDOException $e) {
        // Respond with an error message
        echo "Error inserting message: " . $e->getMessage();
    }
} else {
    // Respond with an error message if the script is accessed through a different request method
    http_response_code(405);
    echo "Method Not Allowed";
}

// Close the database connection
$pdo = null;
?>
