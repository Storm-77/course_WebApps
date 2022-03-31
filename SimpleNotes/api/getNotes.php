<?php
require_once("dataBase.php");

// post inputs:
//  userId -> id of the owner
//
// post response:
//  status -> basic validation
//  notes -> json dictionary of all matching notes

$resp["status"] = "failure";

$stmt = $DB->prepare("SELECT * FROM notes WHERE UserId=:id");
$stmt->execute(['id' => $_POST['userId']]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach($rows as $row) 
    $resp["notes"][] = $row;

if(count($rows) !== 0)
    $resp["status"] = "success";

echo json_encode($resp);
