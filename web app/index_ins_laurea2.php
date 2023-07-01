<?php
    session_start();
    if(isset($_POST['bonus']) && isset($_POST['data']) && isset($_POST['lode']) && isset($_POST['studente']) && isset($_POST['relatore']) && isset($_POST['cdl'])) {
        include_once('connection.php');

        $query1 = "SELECT * FROM unitua.is_stud($1)";
        $res1 = pg_prepare($connection, "", $query1);
        $res1 = pg_execute($connection, "", array($_POST['studente']));
        $row1 = pg_fetch_assoc($res1);

        if ($row1['is_stud'] == 0) {
            $_SESSION['errore_cdl'] = "Lo matricola inserita non corrisponde a nessuno studente all'interno del sistema!";
            header('Location: errore_cdl.php');
        }

        $query2 = "SELECT * FROM unitua.is_doc($1)";
        $res2 = pg_prepare($connection, "", $query2);
        $res2 = pg_execute($connection, "", array($_POST['relatore']));
        $row2 = pg_fetch_assoc($res2);

        if ($row2['is_doc'] == 0) {
            $_SESSION['errore_cdl'] = "L'ID inserito non corrisponde a nessun docente all'interno del sistema!";
            header('Location: errore_cdl.php');
        }

        $query3 = "SELECT * FROM unitua.calcolo_media($1)";
        $res3 = pg_prepare($connection, "", $query3);
        $res3 = pg_execute($connection, "", array($_POST['studente']));
        $row3 = pg_fetch_assoc($res3);

        $query4 = "SELECT * FROM unitua.calcolo_voto_laurea($1, $2)";
        $res4 = pg_prepare($connection, "", $query4);
        $res4 = pg_execute($connection, "", array($row3['calcolo_media'], $_POST['bonus']));
        $row4 = pg_fetch_assoc($res4);

        $query5 = "CALL unitua.insert_laurea($1, $2, $3, $4, $5, $6, $7)";
        $res5 = pg_prepare($connection, "", $query5);
        $res5 = pg_execute($connection, "", array($_POST['bonus'], $row4['calcolo_voto_laurea'], $_POST['data'], $_POST['lode'], $_POST['studente'], $_POST['relatore'], $_POST['cdl']));

        if ($res5) {
            $affectedRows = pg_affected_rows($res5);

            if ($affectedRows == 0) {
                $_SESSION['inserimento_laurea'] = "Inserimento della laurea avvenuto con successo!";
                header('Location: conf_ins_laurea.php');
            } else {
                $_SESSION['inserimento_laurea'] = pg_last_error($connection);
                header('Location: conf_ins_laurea.php');
            }
        } else {
            $_SESSION['inserimento_laurea'] = pg_last_error($connection);
            header('Location: conf_ins_laurea.php');
        }
    }
?>