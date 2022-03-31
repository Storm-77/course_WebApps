<?php
require_once("dataBase.php");

// post inputs:
//  userId -> id of the owner
//  title -> title
//  content -> content
//
// post response:
//  status -> basic validation

$resp["status"] = "failure";

$stmt = $DB->prepare("INSERT INTO notes (UserId, Title, Content) VALUES (:userid,:title,:content) ");
$res = $stmt->execute(
    [
        'userid' => $_POST['userId'],
        'title' => $_POST['title'],
        'content' => $_POST['content']
    ]
);

if($res)
    $resp["status"] = "success";

echo json_encode($resp);
