<?php
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get login form data
    $existingUser = htmlspecialchars($_POST['existingUser']);
    $existingPassword = htmlspecialchars($_POST['existingPassword']);

    // Validate login form data
    if ($existingUser && $existingPassword) {
        // Connect to the database
        $pdo = new PDO('sqlite:' . __DIR__ . '/../data/userDataBase.db');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the query to check if the username exists
        $statement = $pdo->prepare('SELECT * FROM members WHERE username = :username');
        $statement->bindValue(':username', $existingUser, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch();

        if ($user && $existingPassword === $user['passwrd']) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // Redirect to chatroom.php
            header('Location: chatroom.php');
            exit();
        }else{
            echo "Invalid username or password";
        }

        
    }
}
