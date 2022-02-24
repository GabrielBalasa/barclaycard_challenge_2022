<?php
$server = 'mysql';
$username = 'barclay';
$password = 'barclay';
$schema = 'barclay';
$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);
?>