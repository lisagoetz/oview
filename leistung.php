<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>OView - Abrechnungssystem</title>
    <link href="style.css" rel="stylesheet" type="text/css"/>

    <?php
    include "tabelle_leistung.inc.php";
    ?>
</head>
<body>
    <?php
        // Importiert die Navigation
        include "navigation.php";

        //Verbindung zur Datenbank herstellen
        include "connect.inc.php";

        //Tabelle abrufen
        $sql = "SELECT * FROM leistung";
        $res_leistung = $pdo -> query($sql);

        //Verbindung zur Datenbank fertig
        $pdo = null;
    ?>

    <div class="wrapper">
        <header>
            <div class="column">
                <h2>Leistungen</h2>
            </div>
            <div class="column">
                <div class="btns">
                    <a href="create_leistung.php" class="btn neu-btn">+ Leistung erstellen</a>
                </div>
            </div>
        </header>
        <main>
            <?php
            //Tabelle einfügen
            leistung_tabelle($res_leistung);
            ?>
            <script type='text/javascript'>
                // Löschen bestätigen
                function delete_leistung( lnr ){

                    var answer = confirm('Sind Sie sicher, dass Sie diesen Leistung löschen möchten?');
                    if (answer){
                        // wenn ok geklickt wurde
                        // gib die id an delete_leistung.php weiter und lösche Eintrag
                        window.location = 'delete_leistung.php?id=' + lnr;
                    }
                }
            </script>
        </main>
    </div>
</body>
