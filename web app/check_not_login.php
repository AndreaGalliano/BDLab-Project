<?php
    session_start();

    if (isset($_SESSION['isLogin'])) {
        if ($_SESSION['isStudente']) {
            header('Location: home_stud.php');
        }
        if ($_SESSION['isDocente']) {
            header('Location: home_doc.php');
        }
        if ($_SESSION['isSegreteria']) {
            header('Location: home_seg.php');
        }
    }
?>