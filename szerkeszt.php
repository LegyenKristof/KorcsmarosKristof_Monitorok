<?php

require_once "Monitor.php";

$id = $_GET["id"];

$monitor = Monitor::getMonitorById($id);

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nev = $_POST["nev"] ?? "";
    $gyarto = $_POST["gyarto"] ?? "";
    $kepfrissites = $_POST["kepfrissites"] ?? "";
    $ar = $_POST["ar"] ?? "";
    $gyartasideje = $_POST["gyartasideje"] ?? new DateTime();

    //if ($nev != "" && $gyarto != "" && $kepfrissites != "" && $ar != ""){
        header("Location: index.php");
    //}      
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

<form method="POST">
    <div>
        <span>Név: </span><input type="text" name="nev" value="<?php echo $monitor -> getNev() ?>">
    </div>
    <div>
        <span>Gyártó: </span><input type="text" name="gyarto" value="<?php echo $monitor -> getGyarto() ?>">
    </div>
    <div>
        <span>Képfrissítési frekvencia: </span><input type="number" name="kepfrissites" value="<?php echo $monitor -> getKepfrissites() ?>">
    </div>
    <div>
        <span>Ár: </span><input type="number" name="ar" value="<?php echo $monitor -> getAr() ?>">
    </div>
    <div>
        <span>Gyártva: </span><input type="date" name="gyartasideje" value="<?php echo $monitor -> getGyartasideje() -> format("Y-m-d") ?>">
    </div>    
</form>
<div>
    <span></span><form method="POST" class='formButton'><input type="submit" value="Szerkesztés"></form>
    <a href="index.php"><button>Mégse</button></a>
</div>
    
</body>
</html>