<?php
    session_start();

    if (isset($_SESSION['isLogin'])) {
        if ($_SESSION['isStudente']) {
            header('Location: ../pagine/home_stud.php');
        }
        if ($_SESSION['isDocente']) {
            header('Location: ../pagine/home_doc.php');
        }
        if ($_SESSION['isSegreteria']) {
            header('Location: ../pagine/home_seg.php');
        }
    }
?>