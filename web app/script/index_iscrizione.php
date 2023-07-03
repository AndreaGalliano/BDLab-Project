<?php
    session_start();
    if (isset($_POST['codice_appello']) && isset($_POST['codice_docente']) && isset($_POST['codice_esame'])) {
        
        include_once('connection.php'); 

        $query1 = "SELECT * FROM unitua.get_matricola($1)";

        $res1 = pg_prepare($connection, "get_all", $query1);
        $res1 = pg_execute($connection, "get_all", array($_SESSION['email']));
        $row1 = pg_fetch_assoc($res1); //Adesso ho la matricola dello studente
        //print_r($row1);

        $query_convert = "SELECT * FROM unitua.get_ins($1)";

        $res_conv = pg_prepare($connection, "check", $query_convert);
        $res_conv = pg_execute($connection, "check", array($_POST['codice_esame']));
        $row_convert = pg_fetch_assoc($res_conv);

        $query_check = "SELECT * FROM unitua.check_esame($1)";

        $res_check = pg_prepare($connection, "ok", $query_check);
        $res_check = pg_execute($connection, "ok", array($row_convert['get_ins']));
        $row_check = pg_fetch_assoc($res_check);

        if ($row_check['check_esame'] == 't') {
            $query_check2 = "SELECT * FROM unitua.passato($1, $2)";

            $res_check2 = pg_prepare($connection, "ok2", $query_check2);
            $res_check2 = pg_execute($connection, "ok2", array($row1['get_matricola'], $_POST['codice_esame']));
            $row_check2 = pg_fetch_assoc($res_check2);

            if ($row_check2['passato'] == 't') {
                header('Location: conf_iscrizione.php');
                $query2 = "CALL unitua.insert_iscritto($1, $2, $3, $4)";

                $res2 = pg_prepare($connection, "get_all_res", $query2);
                $res2 = pg_execute($connection, "get_all_res", array($_POST['codice_docente'], $row1['get_matricola'], $_POST['codice_esame'], $_POST['codice_appello']));

                if ($res2 == false) {
                    $errorMessage = pg_last_error($connection);
                    if (strpos($errorMessage, 'duplicate key value violates unique constraint') !== false) {
                        $_SESSION['iscrizione'] = 'Non puoi iscriverti ad un esame in cui risulti già iscritto!';
                    } else {
                        $_SESSION['iscrizione'] = "Errore durante l'iscrizione all'esame!";
                }
                header('Location: conf_iscrizione.php');
                } else {
                    $_SESSION['iscrizione'] = 'Iscrizione avvenuta con successo! ';
                    header('Location: conf_iscrizione.php');
                }
            } else {
                $_SESSION['iscrizione'] = "Non puoi iscriverti ad un esame se non hai prima superato quello propedeutico";
                header('Location: conf_iscrizione.php');
            }

        } else {
            $query2 = "CALL unitua.insert_iscritto($1, $2, $3, $4)";

            try {
                $res2 = pg_prepare($connection, "get_all_res", $query2);
                $res2 = pg_execute($connection, "get_all_res", array($_POST['codice_docente'], $row1['get_matricola'], $_POST['codice_esame'], $_POST['codice_appello']));

                if ($res2 == false) {
                    $errorMessage = pg_last_error($connection);
                    if (strpos($errorMessage, 'duplicate key value violates unique constraint') !== false) {
                        $_SESSION['iscrizione'] = 'Non puoi iscriverti ad un esame in cui risulti già iscritto! ';
                    } else {
                        $_SESSION['iscrizione'] = "Errore durante l'iscrizione all'esame! ".pg_fetch_assoc($res2); //Qui
                    }
                header('Location: conf_iscrizione.php');
                } else {
                    $_SESSION['iscrizione'] = 'Iscrizione avvenuta con successo! ';
                    header('Location: conf_iscrizione.php');
                }
            } catch (Exception $e) {
                echo "Eccezione: ".$e->getMessage();
            }
        }        
    }
?>