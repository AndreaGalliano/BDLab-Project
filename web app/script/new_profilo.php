<?php
    session_start();
    include_once('../script/connection.php');
    if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['password']) && isset($_POST['codFiscale']) && isset($_POST['sesso']) && isset($_POST['cellulare']) && isset($_POST['cdl']) && !isset($_POST['carica'])) {
        // Studente:
        $nome = strtolower($_POST['nome']);
        $cognome = strtolower($_POST['cognome']);
        $email = $nome.".".$cognome."@studenti.unitua.it"; 

        // echo "La mail è: ".$email;
        
        $query1 = "CALL unitua.insert_utente($1, $2)";
        $res1 = pg_prepare($connection, "rep", $query1);
        $res1 = pg_execute($connection, "rep", array($email, $_POST['password']));
        
        if ($res1) {
            $affectedRows = pg_affected_rows($res1);

            if ($affectedRows > 0) {
                $_SESSION['insert'] = pg_last_error($connection);
                header('Location: ../pagine/conf_insert_utente.php');
            } else {
                $matricola = "";

                for ($i = 0; $i < 6; $i ++) {
                    $randNum = mt_rand(0, 9);
                    $matricola .= $randNum;
                }

                $dataOdierna = date('Y-m-d');
                $stato = "In corso";

                $query2 = "CALL unitua.insert_studente($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)";
                $res2 = pg_prepare($connection, "rep_ok", $query2);
                $res2 = pg_execute($connection, "rep_ok", array($matricola, $_POST['nome'], $_POST['cognome'], $_POST['codFiscale'], $_POST['sesso'], $_POST['cellulare'], $dataOdierna, $stato, $email, $_POST['cdl']));

                if ($res2) {
                    $affectedRows2 = pg_affected_rows($res2);
                    if ($affectedRows2 == 0) {
                        $_SESSION['insert'] = "Inserimento dello studente avvenuto con successo!";
                        header('Location: ../pagine/conf_insert_utente.php');
                    } else {
                        $_SESSION['insert'] = pg_last_error($connection);
                        header('Location: ../pagine/conf_insert_utente.php');
                    }
                }
            }
        }

    } else {
        if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['password']) && isset($_POST['codFiscale']) && isset($_POST['sesso']) && isset($_POST['cellulare']) && isset($_POST['carica']) && isset($_POST['cdl'])) {
            // Docente:
            $nome = strtolower($_POST['nome']);
            $cognome = strtolower($_POST['cognome']);
            $email = $nome.".".$cognome."@docenti.unitua.it"; 

            $query1 = "CALL unitua.insert_utente($1, $2)";
            $res1 = pg_prepare($connection, "rep", $query1);
            $res1 = pg_execute($connection, "rep", array($email, $_POST['password']));

            if ($res1) {
                $affectedRows = pg_affected_rows($res1);

                if ($affectedRows > 0) {
                    $_SESSION['insert'] = pg_last_error($connection);
                    header('Location: ../pagine/conf_insert_utente.php');
                } else {
                    $query2 = "CALL unitua.insert_docente($1, $2, $3, $4, $5, $6, $7, $8)";
                    $res2 = pg_prepare($connection, "rep_ok", $query2);
                    $res2 = pg_execute($connection, "rep_ok", array($_POST['nome'], $_POST['cognome'], $_POST['codFiscale'], $_POST['sesso'], $_POST['cellulare'], $_POST['carica'], $email, $_POST['cdl']));

                    if ($res2) {
                        $affectedRows2 = pg_affected_rows($res2);

                        if ($affectedRows2 > 0) {
                            $_SESSION['insert'] = pg_last_error($connection);
                            header('Location: ../pagine/conf_insert_utente.php');
                        } else {
                            $_SESSION['insert'] = "Inserimento del docente avvenuto con successo!";
                            header('Location: ../pagine/conf_insert_utente.php');
                        }
                    }
                }
            }
        } else {
            if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['password']) && isset($_POST['codFiscale']) && isset($_POST['sesso']) && isset($_POST['cellulare']) && isset($_POST['ruolo'])) {
                // Segreteria:
                $nome = strtolower($_POST['nome']);
                $cognome = strtolower($_POST['cognome']);
                $email = $nome.".".$cognome."@segreteria.unitua.it"; 

                $query1 = "CALL unitua.insert_utente($1, $2)";
                $res1 = pg_prepare($connection, "rep", $query1);
                $res1 = pg_execute($connection, "rep", array($email, $_POST['password']));

                if ($res1) {
                    $affectedRows = pg_affected_rows($res1);

                    if ($affectedRows > 0) {
                        $_SESSION['insert'] = pg_last_error($connection);
                        header('Location: ../pagine/conf_insert_utente.php');
                    } else {
                        $query2 = "CALL unitua.insert_membro_segreteria($1, $2, $3, $4, $5, $6, $7)";
                        $res2 = pg_prepare($connection, "rep_ok", $query2);
                        $res2 = pg_execute($connection, "rep_ok", array($_POST['nome'], $_POST['cognome'], $_POST['codFiscale'], $_POST['sesso'], $_POST['cellulare'], $_POST['ruolo'], $email));

                        if ($res2) {
                            $affectedRows2 = pg_affected_rows($res2);

                            if ($affectedRows2 > 0) {
                                $_SESSION['insert'] = pg_last_error($connection);
                                header('Location: ../pagine/conf_insert_utente.php');
                            } else {
                                $_SESSION['insert'] = "Inserimento del membro della segreteria avvenuto con successo!";
                                header('Location: ../pagine/conf_insert_utente.php');
                            }
                        }
                    }
                }
            }
        }
    }
?>