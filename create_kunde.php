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
                <a href='kunde.php' class='btn back-btn'>&#8592;</a>
                <h2>Kunden erstellen</h2>
            </div>
            <div class="column">
            </div>
        </header>
        <main>
            <?php
            include 'connect.inc.php';

            if (isset($_POST['submit']))
            {
                $firma = $_POST['firma'];
                $vorname = $_POST['vorname'];
                $nachname = $_POST['nachname'];
                $strasse = $_POST['strasse'];
                $hausnummer = $_POST['hausnummer'];
                $plz = $_POST['plz'];
                $ort = $_POST['ort'];

                $query = "INSERT INTO kunde (firma, vorname, nachname, strasse, hausnummer, plz, ort)
	                        VALUES ('$firma','$vorname','$nachname','$strasse','$hausnummer','$plz','$ort')";

                $statement = $pdo->prepare($query);
                if($statement->execute()) {
                    echo "<div class='alert alert-success'>Kunde erstellt.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Kunde konnte nicht erstellt werden.</div>";
                }

                $pdo = null;
            }
            ?>
            <form action="create_kunde.php" method="post">
                <fieldset>
                    <ul>
                        <li>
                            <label for="firma">Firma</label>
                            <input type="text" name="firma" id="firma" placeholder="Firma">
                        </li>
                        <li>
                            <label for="vorname">Vorname</label>
                            <input type="text" name="vorname" id="vorname" placeholder="Vorname">
                        </li>
                        <li>
                            <label for="nachname">Nachname</label>
                            <input type="text" name="nachname" id="nachname" placeholder="Nachname">
                        </li>
                        <li>
                            <label for="strasse">Straße</label>
                            <input type="text" name="strasse" id="strasse" placeholder="Straße">
                        </li>
                        <li>
                            <label for="hausnummer">Hausnummer</label>
                            <input type="text" name="hausnummer" id="hausnummer" placeholder="Hausnummer">
                        </li>
                        <li>
                            <label for="plz">PLZ</label>
                            <input type="text" name="plz" id="plz" placeholder="PLZ">
                        </li>
                        <li>
                            <label for="ort">Ort</label>
                            <input type="text" name="ort" id="ort" placeholder="Ort">
                        </li>
                        <input type="submit" name="submit" value="submit" class="btn submit-btn">
                    </ul>
                </fieldset>
            </form>
        </main>
    </div>
</body>
</html>
