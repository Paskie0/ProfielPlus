<?php
$App = require(__DIR__ . '/../private.php');
$dbconn = $App['database'];
$conn = require 'functions/connection.php';
session_start();

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

function sqlGetDataWithParamAll($select, $from, $where, $param, $conn)
{
    $sql = "select $select from $from where $where = :param";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':param', $param);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function sqlDataWithJoin($select, $from, $param, $join, $conn)
{
    $sql = "select $select from $from where = :param join $join";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':param', $param);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function sqlDataWithTwoJoin($select, $from, $param, $join, $join2, $conn)
{
    $sql = "select $select from $from where = :param join $join join $join2";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':param', $param);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}


function sqlInsertIntoValues($table, $columns, $values, $conn)
{
    $columns = explode(',', $columns);
    $valuePlaceholders = rtrim(str_repeat('?,', count($columns)), ',');
    $sql = "INSERT INTO $table (" . implode(',', $columns) . ") VALUES ($valuePlaceholders)";
    $stmt = $conn->prepare($sql);
    $values = explode(',', $values);

    $stmt->execute($values);
}

function sqlCount($select, $from, $where, $param, $conn)
{
    $sql = "select count($select) from $from where $where = :param";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':param', $param);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function sqlUpdateOne($table, $setColumn, $setParam, $where, $whereParam, $conn)
{
    $sql = "update $table set $setColumn = :setParam where $where = :whereParam";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':setParam', $setParam);
    $stmt->bindParam(':whereParam', $whereParam);
    $stmt->execute();
}

function sqlUpdateTwo($table, $setColumnOne, $setParamOne, $setColumnTwo, $setParamTwo, $where, $whereParam, $conn)
{
    $sql = "update $table set $setColumnOne  = :setParamOne , $setColumnTwo = :setParamTwo where $where = :whereParam";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':setParamOne', $setParamOne);
    $stmt->bindParam(':setParamTwo', $setParamTwo);
    $stmt->bindParam(':whereParam', $whereParam);
    $stmt->execute();
}

function sqlDelete($table, $id, $user_id, $conn)
{
    $sql = "delete from $table where user_id = :user_id and id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}