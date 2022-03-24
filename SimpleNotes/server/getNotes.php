<?php
require_once("dataBase.php");

$resp["status"] = "failure";

$stmt = $DB->prepare("SELECT * FROM notes WHERE Id=:id");
$stmt->execute(['id' => $_POST['userId']]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach($rows as $row) 
    $resp["notes"][$row["Id"]] = $row;

if(count($rows) !== 0)
    $resp["status"] = "success";

echo json_encode($resp);
