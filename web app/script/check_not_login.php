<?php
    session_start();

    if (isset($_SESSION['isLogin'])) {
        if ($_SESSION['isStudente']) {
            header('Location: ../pagine/studente/home_stud.php');
        }
        if ($_SESSION['isDocente']) {
            header('Location: ../pagine/docente/home_doc.php');
        }
        if ($_SESSION['isSegreteria']) {
            header('Location: ../pagine/segreteria/home_seg.php');
        }
    }
?>