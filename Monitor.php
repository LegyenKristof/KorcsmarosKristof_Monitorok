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

    public static function mentes(Monitor $monitor){
        global $db;

        $db -> prepare("INSERT INTO monitorok (nev, gyarto, kepfrissites, ar, gyartasideje) 
            VALUES (:nev, :gyarto, :kepfrissites, :ar, :gyartasideje)")
            ->execute([
                ":nev" => $monitor -> getNev(),
                ":gyarto" => $monitor -> getGyarto(),
                ":kepfrissites" => $monitor -> getKepfrissites(),
                ":ar" => $monitor -> getAr(),
                ":gyartasideje" => $monitor -> getGyartasideje() -> format("Y-m-d")
            ]);
    }

    public static function torles(int $id){
        global $db;

        $db -> prepare("DELETE FROM monitorok WHERE id LIKE :id")
            ->execute([":id" => $id]);
    }

    public static function szerkeszt(Monitor $monitor, int $id){
        global $db;

        $db -> prepare("UPDATE monitorok SET nev = :nev, gyarto = :gyarto, kepfrissites = :kepfrissites, ar = :ar, gyartasideje = :gyartasideje
        WHERE id = :id")
            ->execute([
                ":nev" => $monitor -> getNev(),
                ":gyarto" => $monitor -> getGyarto(),
                ":kepfrissites" => $monitor -> getKepfrissites(),
                ":ar" => $monitor -> getAr(),
                ":gyartasideje" => $monitor -> getGyartasideje() -> format("Y-m-d"),
                ":id" => $id
            ]);
    }

    public static function getMonitorById(int $id) : Monitor{
        global $db;

        $stmt = $db->prepare('SELECT * FROM monitorok WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $eredmeny = $stmt->fetchAll();

        if (count($eredmeny) !== 1) {
            throw new Exception('A DB lekerdezes nem egy sort adott vissza');
        }

        $monitor = new monitor(
            $eredmeny[0]['nev'],
            $eredmeny[0]['gyarto'],
            $eredmeny[0]['kepfrissites'],
            $eredmeny[0]['ar'],
            new DateTime($eredmeny[0]['gyartasideje'])
        );
        $monitor->id = $eredmeny[0]['id'];
        return $monitor;
    }

}