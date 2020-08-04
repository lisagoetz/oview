<?php
//Diese Funktion erstellt die Tabelle mit erstellten Rechnungen
function rechnung_tabelle($res_rechnung)
{
    //Verbindung zur Datenbank herstellen
    include "connect.inc.php";

    $action = isset($_GET['action']) ? $_GET['action'] : "";

    // Wenn delete_rechnung.php ausgeführt wurde
    if($action=='deleted'){
        echo "<div class='alert alert-success'>Rechnung wurde gelöscht.</div>";
    }

    $query = "SELECT rechnung.rnr, kunde.firma, kunde.vorname, kunde.nachname
                FROM rechnung, kunde
                WHERE rechnung.knr = kunde.nr
                ORDER BY rechnung.rnr";
    $statement = $pdo->prepare($query);
    $statement->execute();

    $num = $statement->rowCount();

    if($num>0){
        echo "<table>";

        //Kopfzeile
        echo "<tr>";
        echo "<th>RNR</th>";
        echo "<th>Firma</th>";
        echo "<th>Ansprechpartner</th>";
        echo "<th>Betrag</th>";
        echo "</tr>";

        //Rechnungen
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){

            extract($row);

            // Neues Feld pro Eintrag
            echo "<tr>";
            echo "<td>{$rnr}</td>";
            echo "<td>{$firma}</td>";
            echo "<td>{$vorname} {$nachname}</td>";
            echo "<td>{}</td>";
            echo "<td>";

            // Bearbeiten
            echo "<a href='update_rechnung.php?id={$rnr}' class='btn btn-row'>&#9998;</a>";

            // Löschen
            echo "<a href='#' onclick='delete_rechnung({$rnr});' class='btn btn-row'>&#10761;</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Keine Einträge gefunden";
    }
}

?>
