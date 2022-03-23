<?php
require_once("dataBase.php");

// $json = file_get_contents('php://input');
//$data = json_decode($json);

$resp["status"] = "failure";

$stmt = $DB->prepare("SELECT * FROM users WHERE Login=:login");
$stmt->execute(['login' => $_POST['login']]);
$user = $stmt->fetch();

$pass = sha1($_POST["passwd"]);

if ($user["Passwd"] === $pass) {
    $resp["status"] = "success";
    $resp["UserId"] = $user["Id"];
}

echo $resp;
