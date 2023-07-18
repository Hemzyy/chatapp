<?php
	//creates the db and the table to store messages
   try{
    $pdo = new PDO('sqlite:' . __DIR__ . '/../data/message.db');
		
		$sql ="
		  CREATE TABLE IF NOT EXISTS messages 
		  (ID INTEGER PRIMARY KEY AUTOINCREMENT,
		  USER TEXT NOT NULL,
		  MESSAGE TEXT NOT NULL,
		  TIME TIMESTAMP NOT NULL DEFAULT((julianday('now') - 2440587.5)*86400.0))";
		
		$ret = $pdo->exec($sql);
		echo "Database created successfully!";
   }
   catch(PDOException $e){
	    die('Failed to execute query:'. $e->getMessage());
   }

   $pdo=null;

?>

