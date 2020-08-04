<?php

//Diese Funktion erstellt die Tabelle mit erstellten Leistungen
function leistung_tabelle($res_leistung)
{
    //Verbindung zur Datenbank herstellen
    include "connect.inc.php";

    $action = isset($_GET['action']) ? $_GET['action'] : "";

    // Wenn delete_kunde.php ausgeführt wurde
    if($action=='deleted'){
        echo "<div class='alert alert-success'>Leistung wurde gelöscht.</div>";
    }

    $query = "SELECT lnr, leistung, stundensatz FROM leistung";
    $statement = $pdo->prepare($query);
    $statement->execute();

    $num = $statement->rowCount();

    if($num>0){
        echo "<table>";

        //Kopfzeile
        echo "<tr>";
        echo "<th>NR</th>";
        echo "<th>Leistung</th>";
        echo "<th>Stundensatz</th>";
        echo "</tr>";

        //Kunden
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){

            extract($row);

            // Neues Feld pro Eintrag
            echo "<tr>";
            echo "<td>{$lnr}</td>";
            echo "<td>{$leistung}</td>";
            echo "<td>{$stundensatz}</td>";
            echo "<td>";

            // Bearbeiten
            echo "<a href='update_leistung.php?id={$lnr}' class='btn btn-row'>&#9998;</a>";

            // Löschen
            echo "<a href='#' onclick='delete_leistung({$lnr});' class='btn btn-row'>&#10761;</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Keine Einträge gefunden";
    }
}

?>

