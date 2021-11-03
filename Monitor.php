<?php

require_once "db.php";

class Monitor{

    private $id;
    private $nev;
    private $gyarto;
    private $kepfrissites;
    private $ar;
    private $gyartasideje;

    public function __construct(string $nev, string $gyarto, int $kepfrissites, int $ar, DateTime $gyartasideje){
        $this -> nev = $nev;
        $this -> gyarto = $gyarto;
        $this -> kepfrissites = $kepfrissites;
        $this -> ar = $ar;
        $this -> gyartasideje = $gyartasideje;
    }
    
    public function getId() : int {
        return $this->id;
    }

    public function getNev() : string {
        return $this->nev;
    }

    public function getGyarto() : string {
        return $this->gyarto;
    }

    public function getKepfrissites() : int {
        return $this->kepfrissites;
    }

    public function getAr() : int {
        return $this->ar;
    }

    public function getGyartasideje() : DateTime {
        return $this->gyartasideje;
    }

    public static function beolvas() : array {
        global $db;

        $t = $db->query("SELECT * FROM monitorok")
            ->fetchAll();
        $eredmeny = [];

        foreach ($t as $elem){
            $monitor = new Monitor(
                $elem["nev"],
                $elem["gyarto"],
                $elem["kepfrissites"],
                $elem["ar"],
                new DateTime($elem["gyartasideje"])
            );
            $monitor -> id = $elem["id"];
            $eredmeny[] = $monitor;
        }

        return $eredmeny;
    }


}