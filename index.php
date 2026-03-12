<?php
//include "";, html-t, is lehet be illeszteni,de ha class, fuggvenyeket a require kell
require_once "ab.php";
?>

<!DOCTYPE html>
<html lang="hu-HU">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP - Kártya</title>
</head>

<body>
    <?php
    try {
        //példányosítás
        $adatbazis = new AB();
        echo "Sikerült a kapcsolat";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    echo "<br>";
    //echo $adatbazis->meret("szin");
    /* $matrix = $adatbazis->oszlopLeker("kep","szin");
        $adatbazis->megejelenit($matrix); */

    /* $matrixNev = $adatbazis->oszlopLekerNev("nev","szin");
        $adatbazis->megejelenitNev($adatbazis->oszlopLekerNev("kep","nev","szin")); */
    /* $tomb = $adatbazis->tombbeAlakit($matrix);
        $adatbazis->tablazatKiir($tomb); */


    try {
        if ($adatbazis->meret("kartya") == 0) {
            $adatbazis->feltoltes();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $matrix = $adatbazis->kartyakBeolvas();
    $kartyak = $adatbazis->kartyakObjektumban($matrix);
    $adatbazis->kartyakMegjelenitese($kartyak);

    $adatbazis->kapcsolatLezar("szin", "nev");
    ?>
</body>

</html>