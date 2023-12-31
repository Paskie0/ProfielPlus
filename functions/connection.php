<?php
//haal db info op & zet de info een variable
$App = require 'private.php';
$dbconn = $App['database'];
//pdo connection
try {
    $conn = new PDO(
        "mysql:host=$dbconn[servername];
        dbname=$dbconn[dbname]",
        $dbconn['username'],
        $dbconn['drowssap']
    );
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

return $conn;
