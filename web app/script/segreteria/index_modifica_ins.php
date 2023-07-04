<?php
    session_start();

    if (isset($_POST['codice']) && isset($_POST['nome_insegnamento']) && isset($_POST['anno_insegnamento']) && isset($_POST['descrizione'])) {
        include_once('../../script/connection.php');

        $query = "CALL unitua.update_ins($1, $2, $3, $4)";
        $res = pg_prepare($connection, "", $query);
        $res = pg_execute($connection, "", array($_POST['codice'], $_POST['nome_insegnamento'], $_POST['anno_insegnamento'], $_POST['descrizione']));

        $row = pg_fetch_assoc($res);

        if ($res) {
            $afftectedRows = pg_affected_rows($res);

            if ($afftectedRows == 0) {
                $_SESSION['modifica_ins'] = "Modifica dell'insegnamento avvenuta con successo!";
                header('Location: ../../pagine/segreteria/conf_mod_ins.php');
            } else {
                $_SESSION['modifica_ins'] = preg_last_error($connection);
                header('Location: ../../pagine/segreteria/conf_mod_ins.php');
            }
        } else {
            $_SESSION['modifica_ins'] = preg_last_error($connection);
            header('Location: ../../pagine/segreteria/conf_mod_ins.php');
        }
    }
?>