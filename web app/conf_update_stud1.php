<?php
    session_start();
    if (isset($_POST['matricola']) && isset($_POST['nome']) && $_POST['cognome'] && isset($_POST['sesso']) && isset($_POST['codFiscale']) && isset($_POST['cellulare']) && isset($_POST['cdl'])) {
        include_once('connection.php');

        $query = "CALL unitua.update_stud($1, $2, $3, $4, $5, $6, $7)";
        $res = pg_prepare($connection, "rep_ok", $query);
        $res = pg_execute($connection, "rep_ok", array($_POST['matricola'],$_POST['nome'], $_POST['cognome'], $_POST['sesso'],$_POST['codFiscale'], $_POST['cellulare'], $_POST['cdl']));
        
        $affectedRows = pg_affected_rows($res);
        if ($affectedRows == 0) {
            $_SESSION['modifica_stud'] = "La modifica dei dati dello studente è andata a buon fine!";
            header('Location: conf_update_stud2.php');
        } else {
            $_SESSION['modifica_stud'] = preg_last_error($connection);
            header('Location: conf_update_stud2.php');
        }
    }
?>