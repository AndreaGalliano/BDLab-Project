<?php
    function login() {
        if (isset($_POST["username"]) && isset($_POST["password"])) {
                include_once('../script/connection.php'); 
                $sql = "SELECT * FROM unitua.verifica($1, $2)";
                $res = pg_prepare($connection, "get_all_esito_attesa_acc", $sql);

                $res = pg_execute($connection, "get_all_esito_attesa_acc", array($_POST["username"], $_POST["password"]));

                $row = pg_fetch_assoc($res); // associo i campi della riga ai nomi dei campi della select del DB
                pg_close($connection);
                
                if ($row["email"] === null) {
                    $_SESSION['autenticazione_fallita'] = "Credenziali non corrette, riprova";
                    header('Location: ../pagine/index.php');
                } else {
                    $_SESSION['isLogin'] = true;

                    $_SESSION['email'] = $row["email"];
                    
                    $dominio = explode("@", $row["email"])[1];

                    switch ($dominio) {
                        case "studenti.unitua.it":
                            $_SESSION['isStudente'] = true;
                            $_SESSION['isDocente'] = false;
                            $_SESSION['isSegreteria'] = false;
                            header('Location: ../pagine/studente/home_stud.php');
                            break;
                        case "docenti.unitua.it":
                            $_SESSION['isStudente'] = false;
                            $_SESSION['isDocente'] = true;
                            $_SESSION['isSegreteria'] = false;
                            header('Location: ../pagine/docente/home_doc.php');
                            break;
                        case "segreteria.unitua.it":
                            $_SESSION['isStudente'] = false;
                            $_SESSION['isDocente'] = false;
                            $_SESSION['isSegreteria'] = true;
                            header('Location: ../pagine/home_seg.php');
                            break;
                        default:
                            $_SESSION['autenticazione_fallita'] = "Dominio non riconosciuto, riprova";
                            header('Location: ../pagine/index.php');
                            break;
                    }
                }
        }
    }

    function logout() {
        session_start();
        session_unset();
        header('Location: ../pagine/index.php');
    }

    function effettua_cambiamento() {
        if (isset($_POST['email']) && isset($_POST['old_pw']) && isset($_POST['new_pw']) && isset($_POST['conf_new_pw'])) {
            if ($_POST['new_pw'] != $_POST['conf_new_pw']) {
                $_SESSION['errore_ins_pw'] = "Le 2 password nuove per effettuare il cambiamento non coincidono"; 
                ('Location: pagine/cambio_pw.php');
                return;
            }

            include_once('../script/connection.php'); 

            $primo_test = "SELECT * FROM unitua.verifica($1, $2)";

            $res1 = pg_prepare($connection, "get_all_esito_attesa_acc", $primo_test);
            $res1 = pg_execute($connection, "get_all_esito_attesa_acc", array($_POST["email"], $_POST["old_pw"]));
            $row1 = pg_fetch_assoc($res1); 

            if ($row1["email"] === null) {
                $_SESSION['autenticazione_fallita'] = "La password attuale inserita non è corretta, riprova";
                header('Location: ../pagine/pagine/cambio_pw.php');
                return;
            }

            $sql = "SELECT * FROM unitua.change_pw($1, $2, $3)";

            $res = pg_prepare($connection, "get_all_esito_attesa", $sql);
            $res = pg_execute($connection, "get_all_esito_attesa", array($_POST["email"], $_POST['old_pw'], $_POST["new_pw"]));
            $row = pg_fetch_assoc($res);

            pg_close($connetion);

            if ($row['change_pw'] == '0') {
                $_SESSION['cambiamento_fallito'] = "Il cambiamento della tua password non è andato a buon fine";
                $_SESSION['row'] = $row['change_pw'];
                if (isset($_SESSION['isStudente'])) {
                    header('Location: ../pagine/cambio_pw.php');
                } else {
                    if (isset($_SESSION['isDocente'])) {
                        header('Location: ../pagine/cambio_pw2.php');
                    } else {
                        if (isset($_SESSION['isSegreteria'])) {
                            header('Location: ../pagine/cambio_pw3.php');
                        }
                    }
                }
            } else {
                $_SESSION['cambiamento_fatto'] = "Cambiamento password avvenuto con successo!";
                header('Location: ../pagine/cambio_pw.php');
            }
        }
    }
?>