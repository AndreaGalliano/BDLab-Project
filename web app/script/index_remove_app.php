<?php
    session_start();
    if (isset($_POST['codice_appello']) && isset($_POST['data_esame']) && isset($_POST['codice_esame'])) {
        include_once('connection.php');

        $query = "CALL unitua.remove_appello($1)";
        $res = pg_prepare($connection, "rep_ok", $query);
        $res = pg_execute($connection, "rep_ok", array($_POST['codice_appello']));

        print_r(pg_fetch_assoc($res));

        if ($res) {
            $affectedRows = pg_affected_rows($res);
            if ($affectedRows > 0) {
                $_SESSION['rimozione_appello'] = preg_last_error($connection);
                header('Location: conf_chiusura.php'); 
            } else {
                $_SESSION['rimozione_appello'] = "Chiusura dell'appello avvenuta con successo!";
                header('Location: conf_chiusura.php');
            }
        } else {
            $_SESSION['rimozione_appello'] = "Errore nella chiusura dell'appello...";
            header('Location: conf_chiusura.php');
        }
    }
?>