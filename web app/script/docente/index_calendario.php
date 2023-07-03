<?php
    session_start();
    if (isset($_POST['data_esame']) && isset($_POST['ora']) && isset($_POST['aula']) && isset($_POST['codice_esame']) && isset($_POST['anno'])) {
        include_once('../../script/connection.php');

        $query1 = "SELECT * FROM unitua.get_info_doc($1)";
        $res1 = pg_prepare($connection, "rep", $query1);
        $res1 = pg_execute($connection, "rep", array($_SESSION['email']));
        $row1 = pg_fetch_assoc($res1);

        $query_esame = "SELECT * FROM unitua.get_es($1)";
        $res_esame = pg_prepare($connection, "ok", $query_esame);
        $res_esame = pg_execute($connection, "ok", array($_POST['codice_esame']));
        $row_esame = pg_fetch_assoc($res_esame);

        //Inserisco l'appello adesso che ho tutti i dati necessari:
        $query2 = "CALL unitua.insert_calendario($1, $2, $3, $4, $5, $6, $7, $8)";
        $res2 = pg_prepare($connection, "rep_ok", $query2);
        $res2 = pg_execute($connection, "rep_ok", array($_POST['data_esame'], $_POST['ora'], $_POST['aula'], true, $row_esame['get_es'], $_POST['anno'], $row1['id'], $row1['cdl']));

        if ($res2) {
            $affectedRows = pg_affected_rows($res2);

            if ($affectedRows > 0) {
                $_SESSION['insert_appello'] = pg_last_error($connection);
                header('Location: ../../pagine/docente/conf_cal.php');
            } else {
                $_SESSION['insert_appello'] = "Inserimento dell'appello avvenuto con successo!";
                header('Location: ../../pagine/docente/conf_cal.php');
            }
        } else {
            $_SESSION['insert_appello'] = "Errore nell'inserimento dell'appello...";
            header('Location: ../../pagine/docente/conf_cal.php');
        }
    }
?>