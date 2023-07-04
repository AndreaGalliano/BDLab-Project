<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Ex studenti</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/style2.css">
</head>
<body>
    <?php
        include_once('navbar3.php');
        include_once('../../script/check_login.php');

        if (isset($_POST['matricola'])) {
            include_once('../../script/connection.php');

            $query = "SELECT * FROM unitua.storico_valutazione WHERE ex_studente=($1)";
            $res = pg_prepare($connection, "", $query);
            $res = pg_execute($connection, "", array($_POST['matricola']));
            
            while ($row = pg_fetch_assoc($res)) {
                echo "<ul class='list-group' id='centrato'>";
                foreach ($row as $key => $value) {
                    switch ($key) {
                        case 'calendario':
                            $flag = true;
                            echo "<li class='list-group-item'>";
                            echo "CODICE APPELLO: ".$value;
                            echo "</li>";
                            break;
                        case 'esame':
                            echo "<li class='list-group-item'>";
                            echo "CODICE ESAME: ".$value;
                            echo "</li>";
                            break;
                        case 'docente':
                            echo "<li class='list-group-item'>";
                            echo "ID DOCENTE: ".$value;
                            echo "</li>";
                            break;
                        case 'voto':
                            if ($value != null) {
                                echo "<li class='list-group-item'>";
                                echo strtoupper($key).": ".$value;
                                echo "</li>";
                            }
                            break;
                        case 'lode':
                            if ($key == 'true') {
                                echo "<li class='list-group-item'>";
                                echo strtoupper($key).": Sì";
                                echo "</li>";
                            }
                            break;
                        case 'respinto':
                            if ($value != false) {
                                echo "<li class='list-group-item'>";
                                echo strtoupper($key).": Sì";
                                echo "</li>";
                            }
                            break;
                    }
                }
                echo "</ul>";
                echo $flag;
            }
            echo "<br><br>";
        }
    ?>
</body>
</html>