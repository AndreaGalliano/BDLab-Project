<?php
    session_start();
    include_once('../../script/connection.php');

    if (isset($_POST['nome_insegnamento']) && isset($_POST['anno_insegnamento']) && isset($_POST['descrizione']) && isset($_POST['docente']) && isset($_POST['cdl']) && isset($_POST['tipologia']) && isset($_POST['modalita'])) {
        // echo "entrato";

        $queryDoc = "SELECT * FROM unitua.get_info_doc2($1)";
        $resDoc = pg_prepare($connection, "", $queryDoc);
        $resDoc = pg_execute($connection, "", array($_POST['docente']));
        $rowDoc = pg_fetch_assoc($resDoc);

        // print_r($rowDoc);

        if ($rowDoc['cdl'] != $_POST['cdl']) {
            $_SESSION['nuovo_ins'] = "L'ID docente non coincide con il CdL in cui insegna!";
            // echo "entrato";
            header('Location: ../../pagine/segreteria/conf_new_ins.php');
        } else {
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
                    
                    if (isset($_POST['propedeutico'])) {
                        $query5 = "CALL unitua.insert_propedeuticita($1, $2)";
                        $res5 = pg_prepare($connection, "", $query5);
                        $res5 = pg_execute($connection, "", array($_POST['propedeutico'], $row['get_ins_code']));

                        if ($res5) {
                            $affRows2 = pg_affected_rows($res5);

                            if ($affRows2 == 0) {
                                $_SESSION['nuovo_ins'] = "Inserimento dell'insegnamento avvenuto con successo!";
                                header('Location: ../../pagine/segreteria/conf_new_ins.php');
                            } else {
                                $msg_error = explode(".", pg_last_error($connection));
                                $_SESSION['nuovo_ins'] = $msg_error[0];
                                header('Location: ../../pagine/segreteria/conf_new_ins.php');
                            }
                        } else {
                            $msg_error = explode(".", pg_last_error($connection));
                            $_SESSION['nuovo_ins'] = $msg_error[0];
                            header('Location: ../../pagine/segreteria/conf_new_ins.php');
                        }
                    } else {
                        $_SESSION['nuovo_ins'] = "Inserimento dell'insegnamento e dell'esame avvenuto con successo!";
                        header('Location: ../../pagine/segreteria/conf_new_ins.php');
                    }
                } else {
                    $msg_error = explode(".", pg_last_error($connection));
                    $_SESSION['nuovo_ins'] = $msg_error[0];
                    header('Location: ../../pagine/segreteria/conf_new_ins.php');
                }
            } else {
                $msg_error = explode(".", pg_last_error($connection));
                $_SESSION['nuovo_ins'] = $msg_error[0];
                header('Location: ../../pagine/segreteria/conf_new_ins.php');
            }
        }
    }
?>