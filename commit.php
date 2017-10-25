<?php
$data = json_decode($_GET["json_data"]);

require_once("DB_CONFIG.php");
$connection = pg_connect(CONNECTION_STRING);

if(!$connection) {
    die("No connection");
}
pg_query($connection, "BEGIN") or die("Couldn't start transaction");
pg_query($connection, "DELETE FROM class");
for($i =0; $i < count($data); $i++) {
    $class = $data[$i];
	$insert = pg_prepare($connection, "in" . $i, "SELECT create_class($1,$2,$3)");
	pg_execute($connection, "in" . $i, array($class->name, $class->code, $class->professor));
}


pg_query($connection, "COMMIT");

pg_close($connection);

?>