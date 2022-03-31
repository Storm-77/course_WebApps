<?php
require_once("dataBase.php");

// post inputs:
//  id -> id of note to be removed
//
// post response:
//  status -> basic validation

$resp["status"] = "failure";

$stmt = $DB->prepare("DELETE FROM notes WHERE Id=:noteid ");
$res = $stmt->execute(
    [
        'noteid' => $_POST['id']
    ]
);

if($res)
    $resp["status"] = "success";

echo json_encode($resp);