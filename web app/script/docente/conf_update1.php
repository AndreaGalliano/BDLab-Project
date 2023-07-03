<?php
    session_start();
    // print_r($_POST);

    if (isset($_POST['codice_valutazione']) && isset($_POST['studente']) && isset($_POST['codice_appello']) && isset($_POST['codice_esame']) && isset($_POST['docente']) && isset($_POST['data_verbalizzazione']) && isset($_POST['lode']) && isset($_POST['respinto'])) {
        include_once('../../script/connection.php');

        if ($_POST['respinto'] == 'true') {
            if ($_POST['voto'] != null) {
                $_SESSION['aggiornamento'] = "ERRORE: hai inserito un voto da 18 a 30, ma hai inviato la richiesta di bocciatura!";
                header('Location: ../../pagine/conf_update2.php');
            } else {
                if ($_POST['lode'] == 'true') {
                    $_SESSION['aggiornamento'] = "ERRORE: hai inserito una bocciatura, ma hai selezionato l'opzione della lode!";
                    header('Location: ../../pagine/docente/conf_update2.php');
                } else {
                    $query1 = "CALL unitua.update_valutazione1($1, $2, $3, $4, $5)";
                    $res1 = pg_prepare($connection, "rep", $query1);
                    $res1 = pg_execute($connection, "rep", array($_POST['codice_valutazione'], $_POST['codice_appello'], $_POST['codice_esame'], $_POST['docente'], $_POST['studente']));

                    // controllo che sia andato a buon fine l'aggiornamento:
                    if (pg_affected_rows($res1) > 0) {
                        $_SESSION['aggiornamento'] = preg_last_error($res1);
                        header('Location: ../../pagine/docente/conf_update2.php');
                    } else {
                        $_SESSION['aggiornamento'] = "Cambiamento del voto avvenuto con successo!";
                        header('Location: ../../pagine/docente/conf_update2.php');
                    }
                }
            }
        } else {
            if ($_POST['voto'] == null) {
                $_SESSION['aggiornamento'] = "ERRORE: Non hai inserito un voto da 18 a 30 e non hai inviato la richiesta di bocciatura!";
                header('Location: ../../pagine/docente/conf_update2.php');
            } else {
                if ($_POST['voto'] < 30 && $_POST['lode'] == 'true') {
                    $_SESSION['aggiornamento'] = "ERRORE: hai inserito un voto da 18 a 29, ma hai selezionato la lode!";
                    header('Location: ../../pagine/docente/conf_update2.php');
                } else {
                    $query = "CALL unitua.update_valutazione2($1, $2, $3, $4, $5, $6, $7)";
                    $res = pg_prepare($connection, "rep_ok", $query);
                    $res = pg_execute($connection, "rep_ok", array($_POST['codice_valutazione'], $_POST['codice_appello'], $_POST['codice_esame'], $_POST['docente'], $_POST['studente'], $_POST['voto'], $_POST['lode']));

                    // controllo che sia andato a buon fine l'aggiornamento:
                    if (pg_affected_rows($res) > 0) {
                        $_SESSION['aggiornamento'] = preg_last_error($res);
                        header('Location: ../../pagine/docente/conf_update2.php');
                    } else {
                        $_SESSION['aggiornamento'] = "Cambiamento del voto avvenuto con successo!";
                        header('Location: ../../pagine/docente/conf_update2.php');
                    }
                }
            }
        }
    }
?>