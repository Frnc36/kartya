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
            $adatbazis = new AB();
            echo "Sikerült a kapcsolat";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $adatbazis->kapcsolatLezar();
    ?>
</body>
</html>