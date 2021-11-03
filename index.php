<?php

require_once "Monitor.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $torlesId = $_POST["torles"] ?? "";

    if ($torlesId != ""){        
        Monitor::torles($torlesId);
    }
    else{
        $nev = $_POST["nev"] ?? "";
        $gyarto = $_POST["gyarto"] ?? "";
        $kepfrissites = $_POST["kepfrissites"] ?? "";
        $ar = $_POST["ar"] ?? "";
        $gyartasideje = $_POST["gyartasideje"] ?? new DateTime();

        if (trim($nev) != "" && trim($gyarto) != "" && $kepfrissites != "" && $ar != ""){
            Monitor::mentes(new Monitor($nev, $gyarto, $kepfrissites, $ar, new DateTime($gyartasideje)));
        }
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
    <script src="main.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body class="bg-primary bg-gradient bg-opacity-25">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2">
            <form method="POST">
            <div>
                <span>Név: </span><br><input type="text" name="nev" id="nev" required>
            </div>
            <div>
                <span>Gyártó: </span><br><input type="text" name="gyarto" id="gyarto" required>
            </div>
            <div>
                <span>Képfrissítési frekvencia: </span><br><input type="number" name="kepfrissites" id="kepfrissites" required>
            </div>
            <div>
                <span>Ár: </span><br><input type="number" name="ar" id="ar" required>
            </div>
            <div>
                <span>Gyártva: </span><br><input type="date" name="gyartasideje">
            </div>
            <div>
                <span></span><input type="submit" value="Hozzáadás" id="hozzaad">
            </div>
        </form>
        </div>
        <div class="col-lg-10">
            <table class="table table-striped">
                <tr><th>Név</th><th>Gyártó</th><th>Képfrissítési frekvencia</th><th>Ár</th><th>Gyártva</th><th></th><th></th></tr>
                <?php

                foreach($monitorok as $monitor){
                    echo "<tr>";
                    //echo "ID: " . $monitor -> getId() . "<br>";
                    echo "<td>" . $monitor -> getNev() . "</td>";
                    echo "<td>" . $monitor -> getGyarto() . "</td>";
                    echo "<td>" . $monitor -> getKepfrissites() . "</td>";
                    echo "<td>" . $monitor -> getAr() . "</td>";
                    echo "<td>" . $monitor -> getGyartasideje() -> format("Y-m-d") . "</td>";                    
                    echo "<td><a href='szerkeszt.php?id=" . $monitor -> getId() . "'><button>Szerkesztés</button></a></td>";
                    echo "<td><form method='POST' class='formButton'><button name='torles' value='" . $monitor -> getId() . "'>Törlés</button></form></td>";
                    echo "</tr>";
                }

                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>