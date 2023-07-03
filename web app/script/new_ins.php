<?php
    session_start();
    include_once('connection.php');

    if (isset($_POST['nome_insegnamento']) && isset($_POST['anno_insegnamento']) && isset($_POST['descrizione']) && isset($_POST['docente']) && isset($_POST['cdl']) && isset($_POST['tipologia']) && isset($_POST['modalita'])) {
        // echo "entrato";

        $query1 = "CALL unitua.insert_insegnamento($1, $2, $3, $4, $5)";
        $res1 = pg_prepare($connection, "", $query1);
        $res1 = pg_execute($connection, "", array($_POST['nome_insegnamento'], $_POST['anno_insegnamento'], $_POST['descrizione'], $_POST['docente'], $_POST['cdl']));

        if ($res1) {
            $afftectedRows = pg_affected_rows($res1);

            if ($afftectedRows == 0) {
                $query2 = "SELECT * FROM unitua.get_ins_code($1, $2)";
                $res2 = pg_prepare($connection, "", $query2);
                $res2 = pg_execute($connection, "", array($_POST['nome_insegnamento'], $_POST['docente']));
                $row = pg_fetch_assoc($res2);

                $query3 = "CALL unitua.insert_esame($1, $2, $3)";
                $res3 = pg_prepare($connection, "", $query3);
                $res3 = pg_execute($connection, "", array($row['get_ins_code'], $_POST['tipologia'], $_POST['modalita']));

                $_SESSION['nuovo_ins'] = "Inserimento dell'insegnamento e dell'esame avvenuto con successo!";
                header('Location: conf_new_ins.php');
            } else {
                $msg_error = explode(".", pg_last_error($connection));
                $_SESSION['nuovo_ins'] = $msg_error[0];
                header('Location: conf_new_ins.php');
            }
        } else {
            $msg_error = explode(".", pg_last_error($connection));
            $_SESSION['nuovo_ins'] = $msg_error[0];
            header('Location: conf_new_ins.php');
        }
    }
?>