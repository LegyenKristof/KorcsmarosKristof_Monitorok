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

    if (trim($nev) != "" && trim($gyarto) != "" && $kepfrissites != "" && $ar != ""){
        Monitor::szerkeszt(new Monitor($nev, $gyarto, $kepfrissites, $ar, new DateTime($gyartasideje)), $id);
        header("Location: index.php");
    }      
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
    <script src="szerkeszt.js"></script>
</head>
<body>

<form method="POST">
    <div>
        <span>Név: </span><input type="text" name="nev" id="nev" value="<?php echo $monitor -> getNev() ?>" required>
    </div>
    <div>
        <span>Gyártó: </span><input type="text" name="gyarto" id="gyarto" value="<?php echo $monitor -> getGyarto() ?>" required>
    </div>
    <div>
        <span>Képfrissítési frekvencia: </span><input type="number" name="kepfrissites" id="kepfrissites" value="<?php echo $monitor -> getKepfrissites() ?>" required>
    </div>
    <div>
        <span>Ár: </span><input type="number" name="ar" id="ar" value="<?php echo $monitor -> getAr() ?>" required>
    </div>
    <div>
        <span>Gyártva: </span><input type="date" name="gyartasideje" value="<?php echo $monitor -> getGyartasideje() -> format("Y-m-d") ?>">
    </div> 
    <div>
        <span></span><input type="submit" value="Szerkesztés" id="szerkesztes">        
    </div>   
</form>

</body>
</html>