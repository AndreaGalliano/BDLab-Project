<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Chiudi appello</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/style2.css">
</head>
<body>
    <?php
        include_once('navbar2.php');
        include_once('../../script/check_login.php');

        $mail_splittata = explode(".", $_SESSION['email']);
        $nome = strtoupper($mail_splittata[0]);
        $mail_splittata2 = explode("@", $mail_splittata[1]);
        $cognome = strtoupper($mail_splittata2[0]);

        include_once('../../script/connection.php');

        echo "<h2 id='scritta_is'>Appelli aperti dal docente: ".$nome." ".$cognome."</h2><br>";

        $query_ins = "SELECT * FROM unitua.get_insegnamenti($1)";
        $res_ins = pg_prepare($connection, "rep", $query_ins);
        $res_ins = pg_execute($connection, "rep", array($_SESSION['email']));

        while ($row_ins = pg_fetch_assoc($res_ins)) {
            $query_es = "SELECT * FROM unitua.get_es($1)";
            $res_es = pg_prepare($connection, "", $query_es);
            $res_es = pg_execute($connection, "", array($row_ins['codice']));

            echo "<ul class='list-group' id='centrato'>";

            while ($row_es = pg_fetch_assoc($res_es)) {
                $current_year = date('Y');
                $query_app = "SELECT * FROM unitua.get_appello($1, $2, $3)";
                $res_app = pg_prepare($connection, "", $query_app);
                $res_app = pg_execute($connection, "", array($row_ins['id'], $current_year, $row_es['get_es'])); 

                while ($row_app = pg_fetch_assoc($res_app)) {
                    echo "<form method='POST' action='../../script/docente/index_remove_app.php'>";
                    foreach ($row_app as $key => $value) {
                        switch($key) {
                            case 'codice_appello':
                                echo "<li class='list-group-item'>";
                                echo "<label for='codice_appello' id='codice_appello'>Codice appello:</label>";
                                echo "<input type='number' id='codice_appello' name='codice_appello' value='".$value."' readonly />";
                                echo "</li>";
                                break;
                            case 'data_esame':
                                echo "<li class='list-group-item'>";
                                echo "<label for='data_esame' id='codice_esame'>Codice esame:</label>";
                                echo "<input type='date' id='data_esame' name='data_esame' value='".$value."' readonly />";
                                echo "</li>";
                                break;
                            case 'esame':
                                echo "<li class='list-group-item'>";
                                echo "<label for='codice_esame' id='codice_esame'>Codice esame:</label>";
                                echo "<input type='number' id='codice_esame' name='codice_esame' value='".$value."' readonly />";
                                echo "</li>";
                                break;
                        }
                    }
                    echo "<li class='list-group-item'>";
                    
                    $query_ins2 = "SELECT * FROM unitua.get_name_ins($1)";
                    $res_ins2 = pg_prepare($connection, "", $query_ins2);
                    $res_ins2 = pg_execute($connection, "", array($row_app['esame']));

                    $row_finale = pg_fetch_assoc($res_ins2);

                    echo "Nome dell'insegnamento: ".$row_finale['get_name_ins'];
                    echo "</li>";

                    echo "<input type='submit' class='btn btn-primary' id='bottone_dis' value='Chiudi appello'>";
                    echo "</form><br><br>";
                }
            }
            echo "</ul>";
            echo "<br><br>";
        }
    ?>
</body>
</html>