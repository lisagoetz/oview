<?php
// include database connection
include 'connect.inc.php';

try {

    // get Eintrag's ID
    $nr=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

    // Löschen
    $query = "DELETE FROM kunde WHERE nr = ?";
    $statement = $pdo->prepare($query);
    $statement->bindParam(1, $nr);

    if($statement->execute()){
        // redirect to read records page and
        // tell the user record was deleted
        header('Location: kunde.php?action=deleted');
    }else{
        die('Löschen nicht möglich.');
    }
}

    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
?>
