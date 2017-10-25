<?php

require_once("DB_CONFIG.php");
$connection = pg_connect(CONNECTION_STRING);

if(!$connection) {
    die("No connection");
}

$result = pg_query($connection, "SELECT * FROM class");
$a = array();
while (($row = pg_fetch_array($result)) != NULL) {
    $r = array();
    $r["name"] = $row["name"];
    $r["code"] = $row["code"];
    $r["professor"] = $row["instructor"];
    array_push($a, $r);
}
echo json_encode($a);