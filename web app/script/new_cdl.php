<?php
    session_start();
    include_once('connection.php');
    
    // print_r($_POST);

    if (isset($_POST['tipologia']) && isset($_POST['descrizione'])) {
        $query = "CALL unitua.insert_corso_di_laurea($1, $2)";
        $res = pg_prepare($connection, "rep_ok", $query);
        $res = pg_execute($connection, "rep_ok", array($_POST['tipologia'], $_POST['descrizione']));

        if ($res) {
            $affectedRows = pg_affected_rows($res);
            
            if ($affectedRows == 0) {
                $_SESSION['nuovo_cdl'] = "Inserimento del Corso di Laurea avvenuto con successo!";
                header('Location: conf_new_cdl.php');
            } else {
                $_SESSION['nuovo_cdl'] = "Errore nell'inserimento del nuovo Corso di Laurea...";
                header('Location: conf_new_cdl.php');
            }
        } else {
            $_SESSION['nuovo_cdl'] = pg_last_error($connection);
            header('Location: conf_new_cdl.php');
        }
    }
?>