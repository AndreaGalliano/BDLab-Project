<?php
    session_start();
    if (isset($_POST['email']) && isset($_POST['matricola'])) {
        include_once('connection.php');

        $queryVerifica = "SELECT * FROM unitua.verifica_mat($1, $2)";
        $resVerifica = pg_prepare($connection, "", $queryVerifica);
        $resVerifica = pg_execute($connection, "", array($_POST['matricola'], $_POST['email']));
        $rowV = pg_fetch_assoc($resVerifica);
        
        
        if ($rowV['verifica_mat'] == 0) {
            $_SESSION['rinuncia'] = "Hai inserito un numero di matricola che non coincide con il tuo indirizzo mail!";
            echo $_SESSION['rinuncia'];
            //header('Location: conf_rinuncia.php');
        }

        $queryRinuncia = "DELETE FROM unitua.studente WHERE matricola=$1";
        $resRinuncia = pg_prepare($connection, "", $queryRinuncia);
        $resRinuncia = pg_execute($connection, "", array($_POST['matricola']));

        if ($resRinuncia) {
            $affectedRows = pg_affected_rows($resRinuncia);

            if ($affectedRows == 0) {
                $_SESSION['rinuncia'] = "Errore: impossibile effettuare la rinuncia agli Studi...";
                header('Location: conf_rinuncia.php');
            } else {
                $_SESSION['rinuncia'] = "Rinuncia agli studi avvenuta con successo!";
                header('Location: conf_rinuncia.php');
            }
        } else {
            $_SESSION['rinuncia'] = pg_last_error($connection);
            header('Location: conf_rinuncia.php');
        }
    }
?>