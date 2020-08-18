<?php

require 'vendor/autoload.php';
require_once "database.php";

use League\Csv\Writer;

try {
    $dbh = new PDO("mysql:dbname=covidmg_bd;host=localhost;charset=utf8;", "root", "");
} catch (PDOException $e) {
    throw new PDOException($e);
}

//we fetch the info from a DB using a PDO object
/* $sth = $dbh->prepare(
	"SELECT (SELECT confirmadosCaso FROM caso c, municipio m WHERE m.idMunicipio = 10 AND c.idMunicipio = m.idMunicipio AND c.deleted_at = '0000-00-00' ORDER BY c.dataCaso DESC LIMIT 1) / populacaoMunicipio * 1000 as casosPorMilHabitantes FROM municipio WHERE idMunicipio=10"
); */

/* $sth = $dbh->prepare(
    "SELECT m.nomeMunicipio, c.confirmadosCaso FROM caso c, municipio m WHERE c.idMunicipio = m.idMunicipio  AND c.deleted_at = '0000-00-00' ORDER BY c.dataCaso"
); */

$sth = $dbh->prepare(
    "SELECT nomeMunicipio FROM municipio ORDER BY nomeMunicipio"
);

//because we don't want to duplicate the data for each row
// PDO::FETCH_NUM could also have been used
$sth->setFetchMode(PDO::FETCH_ASSOC);
$sth->execute();

//we create the CSV into memory
$csv = Writer::createFromFileObject(new SplTempFileObject());

//we insert the CSV header
$csv->insertOne(['Municipio']);

// The PDOStatement Object implements the Traversable Interface
// that's why Writer::insertAll can directly insert
// the data into the CSV
$csv->insertAll($sth);

// Because you are providing the filename you don't have to
// set the HTTP headers Writer::output can
// directly set them for you
// The file is downloadable
$csv->output('users.csv');
die;
