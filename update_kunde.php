<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>OView - Abrechnungssystem</title>
    <link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
// Importiert die Navigation
include "navigation.php";
?>

<div class="wrapper">
    <header>
        <div class="column">
            <a href='kunde.php' class='btn back-btn'>&#8592;</a>
            <h2>Kunde bearbeiten</h2>
        </div>
        <div class="column">
        </div>
    </header>
    <main>
        <?php
        $nr=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        //Verbindung zur Datenbank
        include 'connect.inc.php';

        // Aktuelle Daten auslesen
        try {
            $query = "SELECT nr, firma, vorname, nachname, strasse, hausnummer, plz, ort FROM kunde WHERE nr = ? LIMIT 0,1";
            $statement = $pdo->prepare( $query );

            $statement->bindParam(1, $nr);

            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $firma = $row['firma'];
            $vorname = $row['vorname'];
            $nachname = $row['nachname'];
            $strasse = $row['strasse'];
            $hausnummer = $row['hausnummer'];
            $plz = $row['plz'];
            $ort = $row['ort'];
        }

        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
        ?>
        <?php

        // Überprüfen, ob das Formular gespeichert wurde
        if($_POST){
            try{
                $query = "UPDATE kunde
                    SET firma=:firma, vorname=:vorname, nachname=:nachname, strasse=:strasse, hausnummer=:hausnummer, plz=:plz, ort=:ort
                    WHERE nr = :id";

                $statement = $pdo->prepare($query);

                $firma=htmlspecialchars(strip_tags($_POST['firma']));
                $vorname=htmlspecialchars(strip_tags($_POST['vorname']));
                $nachname=htmlspecialchars(strip_tags($_POST['nachname']));
                $strasse=htmlspecialchars(strip_tags($_POST['strasse']));
                $hausnummer=htmlspecialchars(strip_tags($_POST['hausnummer']));
                $plz=htmlspecialchars(strip_tags($_POST['plz']));
                $ort=htmlspecialchars(strip_tags($_POST['ort']));

                $statement->bindParam(':firma', $firma);
                $statement->bindParam(':vorname', $vorname);
                $statement->bindParam(':nachname', $nachname);
                $statement->bindParam(':strasse', $strasse);
                $statement->bindParam(':hausnummer', $hausnummer);
                $statement->bindParam(':plz', $plz);
                $statement->bindParam(':ort', $ort);
                $statement->bindParam(':id', $nr);

                if($statement->execute()){
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                }else{
                    echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                }
            }

            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$nr}");?>" method="post">
            <fieldset>
                <ul>
                    <li>
                        <label for="firma">Firma</label>
                        <input type='text' name='firma' value="<?php echo htmlspecialchars($firma, ENT_QUOTES);  ?>"/>
                    </li>
                    <li>
                        <label for="vorname">Vorname</label>
                        <input type='text' name='vorname' value="<?php echo htmlspecialchars($vorname, ENT_QUOTES);  ?>"/>
                    </li>
                    <li>
                        <label for="nachname">Nachname</label>
                        <input type='text' name='nachname' value="<?php echo htmlspecialchars($nachname, ENT_QUOTES);  ?>"/>
                    </li>
                    <li>
                        <label for="strasse">Straße</label>
                        <input type='text' name='strasse' value="<?php echo htmlspecialchars($strasse, ENT_QUOTES);  ?>"/>
                    </li>
                    <li>
                        <label for="hausnummer">Hausnummer</label>
                        <input type='text' name='hausnummer' value="<?php echo htmlspecialchars($hausnummer, ENT_QUOTES);  ?>"/>
                    </li>
                    <li>
                        <label for="plz">PLZ</label>
                        <input type='text' name='plz' value="<?php echo htmlspecialchars($plz, ENT_QUOTES);  ?>"/>
                    </li>
                    <li>
                        <label for="ort">Ort</label>
                        <input type='text' name='ort' value="<?php echo htmlspecialchars($ort, ENT_QUOTES);  ?>"/>
                    </li>
                    <input type="submit" name="submit" value="submit" class="btn submit-btn">
                </ul>
            </fieldset>
        </form>

    </main>
</div>
</body>

