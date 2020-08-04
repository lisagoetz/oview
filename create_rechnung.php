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
        <div class="rechnung">
            <form action="" method="post" onsubmit="">
                <fieldset>
                    <select name="kunde" id="kunde">
                        <option>Kunden eingeben</option>
                        <?php
                        include "connect.inc.php";
                        $query = "SELECT firma FROM kunde";
                        $statement = $pdo->prepare($query);
                        $statement->execute();

                        $row = $statement->fetchAll(PDO::FETCH_COLUMN);

                        foreach ($row as $adressat){
                            echo "<option value='$adressat'>$adressat</option>";
                        }
                        ?>
                    </select>
                </fieldset>
            </form>
            <div>
                Hallo
            </div>
        </div>
    </main>
</div>
</body>
</html>
