<?php

if (!isset($_POST["submit"])) die("Fatal error 777");
$imageFile = $_FILES["Image"];
if ($imageFile["size"] === 0) die("No file");

require "../Logic/Car.php";
require "../Logic/DataBase.php";
require "../Logic/ImageProcessor.php";

$car = new Car();

$car->Brand = $_POST["Brand"];
$car->Model = $_POST["Model"];
$car->Year = $_POST["Year"];

$image = new ImageProcessor($imageFile["tmp_name"]);

$car->Picture = $image->GetImage();
$car->Thumbnail = $image->AspectResizeWidth(500); //width of a thumbnail

$db = new DataBase();
$car->InsertIntoDatabase($db);


?>

<script>
    window.setTimeout(() => {
        window.location = "../index.php";
    }, 1500);
    alert("success!");
</script>