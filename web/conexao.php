<?php
/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:dbname=covidmg_bd;host=localhost';
$user = 'covidmg_test';
$password = '84068905';

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>