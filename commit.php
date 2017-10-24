<?php

$data = json_decode($_GET["json_data"]);

require_once("DB_CONFIG.php");
$connection = pg_connect(CONNECTION_STRING);

if(!$connection) {
    die("No connection");
}

pg_query("BEGIN") or die("Couldn't start transaction");

foreach($data as $class) {

	$insert = pg_prepare($connection, "in", "SELECT create_transaction($1,$2,$3)");
	pg_execute($connection, "in", array($_POST["type"], $_POST["amount"], $_POST["name"]));

}

pg_query("COMMIT")

pg_close($connection);

?>