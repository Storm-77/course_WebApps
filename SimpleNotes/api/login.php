<?php
require_once("dataBase.php");

// post inputs:
//  login -> login
//  passwd -> password
//
// post response:
//  status -> basic validation
//  UserIs -> id of loggeg in user, does not exist in case of failure

$resp["status"] = "failure";

$stmt = $DB->prepare("SELECT * FROM users WHERE Login=:login");
$stmt->execute(['login' => $_POST['login']]);
$user = $stmt->fetch();

$pass = sha1($_POST["passwd"]);

if ($user["Passwd"] === $pass) {
    $resp["status"] = "success";
    $resp["UserId"] = $user["Id"];
}

echo json_encode($resp);
