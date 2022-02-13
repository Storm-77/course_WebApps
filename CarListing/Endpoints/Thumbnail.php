<?php
require "../Logic/DataBase.php";

header("Content-type: image/jpeg");

$id = $_GET["id"];
if (!isset($id)) die("missing parameters");


$db = new DataBase();

$row = $db->Connection->query("select Thumbnail from Cars where Id = $id")->fetch(); //unsafe

echo $row["Thumbnail"];
