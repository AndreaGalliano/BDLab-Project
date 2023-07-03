<?php
    session_start();
    if (isset($_POST['id']) && isset($_POST['nome']) && $_POST['cognome'] && isset($_POST['sesso']) && isset($_POST['codFiscale']) && isset($_POST['cellulare']) && isset($_POST['carica']) && isset($_POST['cdl'])) {
        include_once('connection.php');

        $query = "CALL unitua.update_doc($1, $2, $3, $4, $5, $6, $7, $8)";
        $res = pg_prepare($connection, "rep_ok", $query);
        $res = pg_execute($connection, "rep_ok", array($_POST['id'],$_POST['nome'], $_POST['cognome'], $_POST['sesso'],$_POST['codFiscale'], $_POST['cellulare'], $_POST['carica'], $_POST['cdl']));
        
        if (!$res) {
            $_SESSION['modifica_doc'] = preg_last_error($connection);
            header('Location: conf_update_stud2.php');
        } else {
            $affectedRows = pg_affected_rows($res);
            if ($affectedRows == 0) {
                $_SESSION['modifica_doc'] = "La modifica dei dati del docente è andata a buon fine!";
                header('Location: conf_update_doc2.php');
            } else {
                $_SESSION['modifica_doc'] = preg_last_error($connection);
                header('Location: conf_update_stud2.php');
            }
        }

        
    }
?>