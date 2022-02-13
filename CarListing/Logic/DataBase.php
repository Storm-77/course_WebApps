<?php

class DataBase
{

    private $user = "root";
    private $pass = "";
    private $dbName = "ai_CarListing";

    public $Connection;

    function __construct()
    {
        try {
            $this->Connection = new PDO("mysql:host=localhost;dbname=" . $this->dbName, $this->user, $this->pass);
            $this->Connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function __destruct()
    {
        $this->Connection = null;
    }
}
