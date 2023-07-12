<?php
ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);

function member_exists($dbc, $col, $val){
    $query = $dbc->prepare("SELECT * FROM members WHERE $col = :val");
    $query->execute(array(':val' => $val));
    $fetch = $query->fetch();
    if($fetch[$col]){
        return true;
    }else{
        return false;
    }
}

$userDB = new PDO('sqlite:' . __DIR__ . '/../data/userDataBase.db');

