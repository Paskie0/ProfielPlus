<?php
$App = require(__DIR__ . '/../private.php');
$dbconn = $App['database'];

try {
    $conn = new PDO(
        "mysql:host=$dbconn[servername];
        dbname=$dbconn[dbname]",
        $dbconn['username'],
        $dbconn['drowssap']);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function sqlGetDataWithParam($select, $from, $where, $param, $conn)
{
    $sql = "select $select from $from where $where = :param";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':param', $param);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function sqlInsertIntoValues($table, $cullums, $values, $conn){
    $sql = "insert into $table($cullums)values($values)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
