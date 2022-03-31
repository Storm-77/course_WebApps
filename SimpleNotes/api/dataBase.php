<?php
require_once 'pdoConfig.php'; //defines connection parameters

try {
    $DB = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
