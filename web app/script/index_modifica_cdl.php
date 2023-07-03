<?php
    session_start();

    if (isset($_POST['codice']) && isset($_POST['tipologia']) && isset($_POST['descrizione'])) {
        include_once('../script/connection.php');

        $query = "CALL unitua.update_cdl($1, $2, $3)";
        $res = pg_prepare($connection, "rep_ok", $query);
        $res = pg_execute($connection, "rep_ok", array($_POST['codice'], $_POST['tipologia'], $_POST['descrizione']));
        $row = pg_fetch_assoc($res);

        if ($res) {
            $afftectedRows = pg_affected_rows($res);

            if ($afftectedRows == 0) {
                $_SESSION['modifica_cdl'] = "Modifica del Corso di Laurea avvenuta con successo!";
                header('Location: ../pagine/conf_update_cdl.php');
            } else {
                $_SESSION['modifica_cdl'] = pg_last_error($connection);
                header('Location: ../pagine/conf_update_cdl.php');
            }
        } else {
            $_SESSION['modifica_cdl'] = pg_last_error($connection);
            header('Location: ../pagine/conf_update_cdl.php');
        }
    }
?>