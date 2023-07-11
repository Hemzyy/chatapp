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
        echo "All fields are valid";
    }

}