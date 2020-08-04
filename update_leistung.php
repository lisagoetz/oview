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
            <a href='leistung.php' class='btn back-btn'>&#8592;</a>
            <h2>Leistung bearbeiten</h2>
        </div>
        <div class="column">
        </div>
    </header>
    <main>
        <?php
        $lnr=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        //Verbindung zur Datenbank
        include 'connect.inc.php';

        // Aktuelle Daten auslesen
        try {
            $query = "SELECT lnr, leistung, stundensatz FROM leistung WHERE lnr = ? LIMIT 0,1";
            $statement = $pdo->prepare( $query );

            $statement->bindParam(1, $lnr);

            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $leistung = $row['leistung'];
            $stundensatz = $row['stundensatz'];
        }

        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
        ?>
        <?php

        // Überprüfen, ob das Formular gespeichert wurde
        if($_POST){
            try{
                $query = "UPDATE leistung
                    SET leistung=:leistung, stundensatz=:stundensatz
                    WHERE lnr = :id";

                $statement = $pdo->prepare($query);

                $leistung=htmlspecialchars(strip_tags($_POST['leistung']));
                $stundensatz=htmlspecialchars(strip_tags($_POST['stundensatz']));

                $statement->bindParam(':leistung', $leistung);
                $statement->bindParam(':stundensatz', $stundensatz);
                $statement->bindParam(':id', $lnr);

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

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$lnr}");?>" method="post">
            <fieldset>
                <ul>
                    <li>
                        <label for="leistung">Leistung</label>
                        <input type='text' name='leistung' value="<?php echo htmlspecialchars($leistung, ENT_QUOTES);  ?>"/>
                    </li>
                    <li>
                        <label for="stundensatz">Stundensatz</label>
                        <input type='text' name='stundensatz' value="<?php echo htmlspecialchars($stundensatz, ENT_QUOTES);  ?>"/>
                    </li>
                    <input type="submit" name="submit" value="submit" class="btn submit-btn">
                </ul>
            </fieldset>
        </form>

    </main>
</div>
</body>

