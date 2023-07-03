<?php
    session_start();
    if (isset($_POST['studente']) && isset($_POST['lode']) && isset($_POST['data_verb']) && isset($_POST['respinto']) && isset($_POST['codice_appello']) && isset($_POST['codice_esame']) && isset($_POST['id_docente']) && isset($_POST['voto_esame'])) {
        include_once('connection.php');

        $query_preliminare = "SELECT * FROM unitua.esame_fatto($1, $2)";
        $res_preliminare = pg_prepare($connection, "", $query_preliminare);
        $res_preliminare = pg_execute($connection, "", array($_POST['studente'], $_POST['codice_esame']));
        $row_preliminare = pg_fetch_assoc($res_preliminare);

        if ($row_preliminare['esame_fatto'] == 1) {
            // echo "ENTRATO 1";
            // Esame già svolto, quindi trovo il codice della valutazione già avvenuta ed aggiorno il voto:
            $query_prel2 = "SELECT * FROM unitua.get_codice_val($1, $2)";
            $res_prel2 = pg_prepare($connection, "", $query_prel2);
            $res_prel2 = pg_execute($connection, "", array($_POST['studente'], $_POST['codice_esame']));
            $row_prel2 = pg_fetch_assoc($res_prel2);

            // Adesso ho il codice della valutazione e posso aggiornarla:
            $query_agg = "CALL unitua.update_valutazione2($1, $2, $3, $4, $5, $6, $7)";
            $res_agg = pg_prepare($connection, "", $query_agg);
            $res_agg = pg_execute($connection, "", array($row_prel2['get_codice_val'], $_POST['codice_appello'], $_POST['codice_esame'], $_POST['id_docente'], $_POST['studente'], $_POST['voto_esame'], $_POST['lode']));

            if ($res_agg) {
                // echo "entrato 2";
                $affectedRowsAgg = pg_affected_rows($res_agg);

                if ($affectedRowsAgg == 0) {
                    // echo "entrato 3";
                    $_SESSION['rep_voto'] = "Inserimento del voto avvenuto con successo!";
                    header('Location: conf_voto.php');
                } else {
                    $msg = explode(".", pg_last_error($connection));
                    $_SESSION['rep_voto'] = $msg[0];
                    header('Location: conf_voto.php');
                }
            } else {
                $msg = explode(".", pg_last_error($connection));
                $_SESSION['rep_voto'] = $msg[0];
                header('Location: conf_voto.php');
            }
        } else {
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
    }
?>