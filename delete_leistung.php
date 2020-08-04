<?php
// include database connection
include 'connect.inc.php';

try {

    // get Eintrag's ID
    $lnr=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

    // Löschen
    $query = "DELETE FROM leistung WHERE lnr = ?";
    $statement = $pdo->prepare($query);
    $statement->bindParam(1, $lnr);

    if($statement->execute()){
        // redirect to read records page and
        // tell the user record was deleted
        header('Location: leistung.php?action=deleted');
    }else{
        die('Löschen nicht möglich.');
    }
}

catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
