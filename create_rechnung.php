<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
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
            <a href='rechnung.php' class='btn back-btn'>&#8592;</a>
            <h2>Rechnung erstellen</h2>
        </div>
        <div class="column">
        </div>
    </header>
    <main>
        <?php
        include 'connect.inc.php';

        if (isset($_POST['submit']))
        {
            $knr = $_POST['knr'];

            $query = "INSERT INTO rechnung (knr)
	                        VALUES ('$knr')";

            $statement = $pdo->prepare($query);
            if($statement->execute()) {
                echo "<div class='alert alert-success'>Rechnung erstellt.</div>";
            } else {
                echo "<div class='alert alert-danger'>Rechnung konnte nicht erstellt werden.</div>";
            }

            $pdo = null;
        }
        ?>
        <form action="create_rechnung.php" method="post">
            <fieldset>
                <ul>
                    <li>
                        <label for="kunde">Kunde</label>
                        <select name="kunde" id="kunde">
                            <option>Kunden eingeben</option>
                            <?php
                            include "connect.inc.php";
                            $query = "SELECT knr, firma FROM kunde";
                            $statement = $pdo->prepare($query);
                            $statement->execute();

                            $row = $statement->fetchAll(PDO::FETCH_COLUMN);

                            foreach ($row as $adressat){
                                echo "<option value='".$adressat['knr']."'>'".$adressat['firma']."'</option>";
                            }
                            ?>
                        </select>
                        <select name="kunde" id="kunde">
                            <option>Kunden eingeben</option>
                            <?php
                            include "connect.inc.php";
                            $query = "SELECT firma FROM kunde";
                            $statement = $pdo->prepare($query);
                            $statement->execute();

                            $row = $statement->fetchAll(PDO::FETCH_COLUMN);

                            foreach ($row as $adressat){
                                echo "<option value=$adressat>$adressat</option>";
                            }
                            ?>
                        </select>
                    </li>
                    <input type="submit" name="submit" value="submit" class="btn submit-btn">
                </ul>
            </fieldset>
        </form>
    </main>
</div>
</body>
</html>
