<?php

//Diese Funktion erstellt die Tabelle mit erstellten Kunden
function kunde_tabelle($res_kunde)
{
    //Verbindung zur Datenbank herstellen
    include "connect.inc.php";

    $action = isset($_GET['action']) ? $_GET['action'] : "";

    // Wenn delete_kunde.php ausgeführt wurde
    if($action=='deleted'){
        echo "<div class='alert alert-success'>Kunde wurde gelöscht.</div>";
    }

    $query = "SELECT nr, firma, vorname, nachname, strasse, hausnummer, plz, ort FROM kunde";
    $statement = $pdo->prepare($query);
    $statement->execute();

    $num = $statement->rowCount();

    if($num>0){
        echo "<table>";

        //Kopfzeile
        echo "<tr>";
        echo "<th>NR</th>";
        echo "<th>Firma</th>";
        echo "<th>Ansprechpartner</th>";
        echo "<th>Straße & Hausnummer</th>";
        echo "<th>PLZ</th>";
        echo "<th>Ort</th>";
        echo "</tr>";

        //Kunden
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){

            extract($row);

            // Neues Feld pro Eintrag
            echo "<tr>";
            echo "<td>{$nr}</td>";
            echo "<td>{$firma}</td>";
            echo "<td>{$vorname} {$nachname}</td>";
            echo "<td>{$strasse} {$hausnummer}</td>";
            echo "<td>{$plz}</td>";
            echo "<td>{$ort}</td>";
            echo "<td>";

            // Bearbeiten
            echo "<a href='update_kunde.php?id={$nr}' class='btn btn-row'>&#9998;</a>";

            // Löschen
            echo "<a href='#' onclick='delete_kunde({$nr});' class='btn btn-row'>&#10761;</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Keine Einträge gefunden";
    }
}

?>
