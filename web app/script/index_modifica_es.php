<?php
    session_start();

    if (isset($_POST['codice_esame']) && isset($_POST['tipologia']) && isset($_POST['modalita'])) {
        include_once('../script/connection.php');

        $query = "CALL unitua.update_es($1, $2, $3)";
        $res = pg_prepare($connection, "", $query);
        $res = pg_execute($connection, "", array($_POST['codice_esame'], $_POST['tipologia'], $_POST['modalita']));

        $row = pg_fetch_assoc($res);

        if ($res) {
            $afftectedRows = pg_affected_rows($res);

            if ($afftectedRows == 0) {
                $_SESSION['modifica_es'] = "Modifica dell'esame avvenuta con successo!";
                header('Location: ../pagine/conf_modifica_es.php');
            } else {
                $_SESSION['modifica_es'] = preg_last_error($connection);
                header('Location: ../pagine/conf_modifica_es.php');
            }
        } else {
            $_SESSION['modifica_es'] = preg_last_error($connection);
            header('Location: ../pagine/conf_modifica_es.php');
        }
    }
?>