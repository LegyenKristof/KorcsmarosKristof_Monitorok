<?php

require_once "Monitor.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nev = $_POST["nev"] ?? "";
    $gyarto = $_POST["gyarto"] ?? "";
    $kepfrissites = $_POST["kepfrissites"] ?? "";
    $ar = $_POST["ar"] ?? "";
    $gyartasideje = $_POST["gyartasideje"] ?? new DateTime();

    if ($nev != "" && $gyarto != "" && $kepfrissites != "" && $ar != ""){
        Monitor::mentes(new Monitor($nev, $gyarto, $kepfrissites, $ar, new DateTime($gyartasideje)));
    }
}

$monitorok = Monitor::beolvas();

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
    <span>Név: </span><input type="text" name="nev">
</div>
<div>
    <span>Gyártó: </span><input type="text" name="gyarto">
</div>
<div>
    <span>Képfrissítési frekvencia: </span><input type="number" name="kepfrissites">
</div>
<div>
    <span>Ár: </span><input type="number" name="ar">
</div>
<div>
    <span>Gyártva: </span><input type="date" name="gyartasideje">
</div>
<div>
    <span></span><input type="submit" value="Hozzáadás">
</div>

</form>
    
<ul>
<?php

foreach($monitorok as $monitor){
    echo "<li>";
    //echo "ID: " . $monitor -> getId() . "<br>";
    echo "Név: " . $monitor -> getNev() . "<br>";
    echo "Gyártó: " . $monitor -> getGyarto() . "<br>";
    echo "Képfrissítési frekvencia: " . $monitor -> getKepfrissites() . "<br>";
    echo "Ár: " . $monitor -> getAr() . "<br>";
    echo "Gyártva: " . $monitor -> getGyartasideje() -> format("Y-m-d") . "<br>";
    echo "</li>";
}

?>
</ul>

</body>
</html>