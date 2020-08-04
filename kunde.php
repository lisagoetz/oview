<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>OView - Abrechnungssystem</title>
    <link href="style.css" rel="stylesheet" type="text/css"/>

    <?php
    include "tabelle_kunde.inc.php";
    ?>
</head>
<body>
    <?php
        // Importiert die Navigation
        include "navigation.php";

        //Verbindung zur Datenbank herstellen
        include "connect.inc.php";

        //Tabelle abrufen
        $sql = "SELECT * FROM kunde";
        $res_kunde = $pdo -> query($sql);

        //Verbindung zur Datenbank fertig
        $pdo = null;
    ?>

    <div class="wrapper">
        <header>
            <div class="column">
                <h2>Kunden</h2>
            </div>
            <div class="column">
                <div class="btns">
                    <a href="create_kunde.php" class="btn neu-btn">+ Kunde erstellen</a>
                </div>
            </div>
        </header>
        <main>
            <?php
                //Tabelle einfügen
                kunde_tabelle($res_kunde);
            ?>
            <script type='text/javascript'>
                // Löschen bestätigen
                function delete_kunde( nr ){

                    var answer = confirm('Sind Sie sicher, dass Sie diesen Kunden löschen möchten?');
                    if (answer){
                        // wenn ok geklickt wurde
                        // gib die id an delete_kunde.php weiter und lösche Eintrag
                        window.location = 'delete_kunde.php?id=' + nr;
                    }
                }
            </script>
        </main>
    </div>
</body>
