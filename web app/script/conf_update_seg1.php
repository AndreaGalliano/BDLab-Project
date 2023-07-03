<?php
    session_start();

    if (isset($_POST['id']) && isset($_POST['nome']) && $_POST['cognome'] && isset($_POST['sesso']) && isset($_POST['codFiscale']) && isset($_POST['cellulare']) && isset($_POST['ruolo'])) {
        include_once('connection.php');

        $query = "CALL unitua.update_seg($1, $2, $3, $4, $5, $6, $7)";
        $res = pg_prepare($connection, "", $query);
        $res = pg_execute($connection, "", array($_POST['id'],$_POST['nome'], $_POST['cognome'], $_POST['codFiscale'], $_POST['sesso'],$_POST['cellulare'], $_POST['ruolo']));
        
        $affectedRows = pg_affected_rows($res);
        if ($affectedRows == 0) {
            $_SESSION['modifica_seg'] = "La modifica dei dati del membro della segreteria è andata a buon fine!";
            header('Location: conf_update_seg2.php');
        } else {
            $_SESSION['modifica_seg'] = preg_last_error($connection);
            header('Location: conf_update_seg2.php');
        }
    }
?>