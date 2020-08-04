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
            <a href='leistung.php' class='btn back-btn'>&#8592;</a>
            <h2>Leistung erstellen</h2>
        </div>
        <div class="column">
        </div>
    </header>
    <main>
        <?php
        include 'connect.inc.php';

        if (isset($_POST['submit']))
        {
            $leistung = $_POST['leistung'];
            $stundensatz = $_POST['stundensatz'];

            $query = "INSERT INTO leistung (leistung, stundensatz)
	                        VALUES ('$leistung','$stundensatz')";

            $statement = $pdo->prepare($query);
            if($statement->execute()) {
                echo "<div class='alert alert-success'>Leistung erstellt.</div>";
            } else {
                echo "<div class='alert alert-danger'>Leistung konnte nicht erstellt werden.</div>";
            }

            $pdo = null;
        }
        ?>
        <form action="create_leistung.php" method="post">
            <fieldset>
                <ul>
                    <li>
                        <label for="leistung">Leistung</label>
                        <input type="text" name="leistung" id="leistung" placeholder="Leistung">
                    </li>
                    <li>
                        <label for="stundensatz">Stundensatz</label>
                        <input type="text" name="stundensatz" id="stundensatz" placeholder="Stundensatz">
                    </li>
                    <input type="submit" name="submit" value="submit" class="btn submit-btn">
                </ul>
            </fieldset>
        </form>
    </main>
</div>
</body>
</html>
