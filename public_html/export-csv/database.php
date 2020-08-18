<?php

try {
    $db = new PDO("mysql:dbname=covidmg_bd;host=localhost;charset=utf8;", "root", "");
} catch (PDOException $e) {
    throw new PDOException($e);
}
