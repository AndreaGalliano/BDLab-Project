<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Disiscriviti</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

    <?php
        include_once('navbar.php');
        include_once("check_login.php");

        $mail_splittata = explode(".", $_SESSION['email']);
        $nome = strtoupper($mail_splittata[0]);
        $mail_splittata2 = explode("@", $mail_splittata[1]);
        $cognome = strtoupper($mail_splittata2[0]);

        echo "<h2>Iscrizioni confermate dell'utente: ".$nome." ".$cognome."</h2>";
    
        include_once('connection.php'); 

        $query1 = "SELECT * FROM unitua.get_matricola($1)";

        $res1 = pg_prepare($connection, "get_all", $query1);
        $res1 = pg_execute($connection, "get_all", array($_SESSION['email']));
        $row1 = pg_fetch_assoc($res1);

        $query2 = "SELECT * FROM unitua.get_iscrizioni($1)";

        $res2 = pg_prepare($connection, "get_all_esito", $query2);
        $res2 = pg_execute($connection, "get_all_esito", array($row1['get_matricola']));

        echo "<ul class='list-group' id='centrato'>";

        $anno_corrente = date('Y');
        $flag = false;

        while ($row2 = pg_fetch_assoc($res2)) {
            foreach ($row2 as $key => $value) {
                $annoData = date('Y', strtotime($row2['data_esame']));
                if ($anno_corrente == $annoData) {
                    if (str_contains($key, '_')) {
                        $campi_chiave = explode("_", $key);
                        echo "<li class='list-group-item'>";
                        echo strtoupper($campi_chiave[0])." ".strtoupper($campi_chiave[1]).": ".$value;
                        echo "</li>";
                    } else {
                        echo "<li class='list-group-item'>";
                        echo strtoupper($key).": ".$value;
                        echo "</li>";
                    }
                } else {
                    $flag = true;
                }
            }
            if (!$flag) {
                echo "<br><br>";
            } else {
                $flag = false;
            }
        }

        echo "</ul>";
    ?>

</body>
</html>