<?php
    session_start();
    if (isset($_POST['studente']) && isset($_POST['lode']) && isset($_POST['data_verb']) && isset($_POST['respinto']) && isset($_POST['codice_appello']) && isset($_POST['codice_esame']) && isset($_POST['id_docente']) && isset($_POST['voto_esame'])) {
        include_once('connection.php');

        $query = "CALL unitua.insert_valutazione($1, $2, $3, $4, $5, $6, $7, $8)";
        $res = pg_prepare($connection, "rep", $query);

        if ($_POST['voto_esame'] == "") {
            $_POST['voto_esame'] = null;
        }

        $res = pg_execute($connection, "rep", array($_POST['studente'], $_POST['codice_appello'], $_POST['codice_esame'], $_POST['id_docente'], $_POST['voto_esame'], $_POST['lode'], $_POST['respinto'], $_POST['data_verb']));

        if ($res) {
            $affectedRows = pg_affected_rows($res);

            if ($affectedRows > 0) {
                $_SESSION['rep_voto'] = pg_last_error($connection);
                header('Location: conf_voto.php');
            } else {
                $_SESSION['rep_voto'] = "Inserimento del voto avvenuto con successo!";
                header('Location: conf_voto.php');
            }
        } else {
            $str_completa = explode("CONTEXT", pg_last_error($connection));
            $_SESSION['rep_voto'] = $str_completa[0];
            header('Location: conf_voto.php');
        }
    }
?>