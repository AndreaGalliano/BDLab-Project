<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Studente</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Sei stato redirectato, docente!</h2>

    <?php
        include("check_login.php");
        echo '<h2>'.$_SESSION['isLogin'].'</h2>';
    ?>
</body>
</html>