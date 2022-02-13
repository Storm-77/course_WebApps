<?php

class Car
{

    //todo implement getters and setters for sql injection protection 
    public $Brand;
    public $Model;
    public $Year;

    function __construct()
    {
    }

    function __destruct()
    {
        if (isset($this->Thumbnail)) $this->Thumbnail->Dispose();
        if (isset($this->Picture)) $this->Picture->Dispose();
    }

    public $Picture;
    public $Thumbnail;

    public function InsertIntoDatabase($database)
    {
        try {

            $pdo = $database->Connection;

            $sql = "INSERT INTO Cars(Brand, Model, Year, Picture, Thumbnail) VALUES(:brand,:model, :year, :picture, :thumbnail)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':brand', $this->Brand);
            $stmt->bindParam(':model', $this->Model);
            $stmt->bindParam(':year', $this->Year);

            $imstr = $this->Picture->Stream;
            $thstr = $this->Thumbnail->Stream;

            rewind($imstr);
            rewind($thstr);

            $stmt->bindParam(':picture', $imstr, PDO::PARAM_LOB);
            $stmt->bindParam(':thumbnail', $thstr, PDO::PARAM_LOB);

            return $stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function GetHtmlRepresetation($row)
    {
        $brand = $row["Brand"];
        $model = $row["Model"];
        $year = $row["Year"];

        $dbId = $row["Id"];
        $thumbnailUrl = "Endpoints/Thumbnail.php?id=$dbId";
        $picturelUrl = "Endpoints/Picture.php?id=$dbId";

        $html = "<div>";

        $html .= "<div> $brand </div>";
        $html .= "<div> $model </div>";
        $html .= "<div> $year </div>";

        $html .= '<div> <a ' . "href=$picturelUrl" . '> <img src="' . $thumbnailUrl . '"' . 'alt="This car has no thumbnail"' . '> </a></div>';
        // $html .= "<div> </div>";

        $html .= "</div>";
        return $html;
    }
}
