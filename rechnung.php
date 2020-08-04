<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>OView - Abrechnungssystem</title>
    <link href="style.css" rel="stylesheet" type="text/css"/>

    <?php
        include "tabelle_rechnung.inc.php";
    ?>
</head>
<body>
    <?php
        // Importiert die Navigation
        include "navigation.php";

        //Verbindung zur Datenbank herstellen
        include "connect.inc.php";

        //Tabelle abrufen
        $sql = "SELECT rechnung.RNR, kunde.Firma, kunde.Vorname, kunde.Nachname 
                FROM rechnung, kunde
                WHERE rechnung.KNR = kunde.KNR";
        $res_rechnung = $pdo -> query($sql);

        //Verbindung zur Datenbank fertig
        $pdo = null;
    ?>
    <div class="wrapper">
        <header>
            <div class="column">
                <h2>Rechnungen</h2>
            </div>
            <div class="column">
                <div class="btns">
                    <a href="create_rechnung.php" class="btn neu-btn">+ Rechnung erstellen</a>
                </div>
            </div>
        </header>
        <main>
            <?php
            //Tabelle einfügen
            rechnung_tabelle($res_rechnung);
            ?>
        </main>
    </div>
</body>
