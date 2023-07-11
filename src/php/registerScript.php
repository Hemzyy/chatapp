<?php
ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);

var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //get register form data
    $newUserName = htmlspecialchars($_POST['newUserName']);
    $newUserEmail = htmlspecialchars($_POST['newUserEmail']);
    $newUserPassword = htmlspecialchars($_POST['newUserPassword']);

    //validate register form data
    if ($newUserName && $newUserEmail && $newUserPassword) {
        try{

            $pdo = new PDO('sqlite:' . __DIR__ . '/../data/userDataBase.db');
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->query(
                'CREATE TABLE IF NOT EXISTS members(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    username VARCHAR(50) NOT NULL,
                    email VARCHAR(50) NOT NULL,
                    passwrd TEXT NOT NULL,
                    UNIQUE(email)
                )'
            );

            $statement = $pdo->prepare(
                'INSERT INTO members (username, email, passwrd) VALUES (:username, :email, :passwrd)'
            );
            $statement->bindValue(':username', $newUserName, PDO::PARAM_STR);
            $statement->bindValue(':email', $newUserEmail, PDO::PARAM_STR);
            $statement->bindValue(':passwrd', $newUserPassword, PDO::PARAM_STR);
            $statement->execute();

            header('Location: ../index.php');

        }catch(PDOException $e){
            var_dump($e);
        }
    }

}