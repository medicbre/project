<?php

class Dbh {
    protected $host = "localhost";
    protected $username = "root";

    protected function connect() {
        try 
        {
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=reborn', $username, $password);
            return $dbh;
        } 
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function accesPublicConnect() {
        return $this->connect(); // Pozivamo protected metodu
    }
}