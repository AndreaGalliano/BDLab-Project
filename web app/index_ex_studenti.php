<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Ex studenti</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
        if (isset($_POST['codice'])) {
            include_once('navbar3.php');
            include_once('check_login.php');

            echo "<h2 id='scritta_is'>Ex studenti dell'ateneo</h2>";

            include_once('connection.php');

            $query_verificata = "SELECT * FROM unitua.is_cdl($1)";
            $res_verificata = pg_prepare($connection, "", $query_verificata);
            $res_verificata = pg_execute($connection, "", array($_POST['codice']));
            $rowV = pg_fetch_assoc($res_verificata);

            if ($rowV['is_cdl'] == 0) {
                $_SESSION['ex'] = "L'ID inserito non corrisponde a nessun Corso di Laurea del sistema!";
                header('Location: err_ex_stud.php'); 
            }

            $query = "SELECT * FROM unitua.ex_studente WHERE cdl=$1";
            $res = pg_prepare($connection, "", $query);
            $res = pg_execute($connection, "", array($_POST['codice']));

            while ($row = pg_fetch_assoc($res)) {
                echo "<ul class='list-group' id='centrato'>";
                foreach ($row as $key => $value) {
                    switch ($key) {
                        case 'matricola':
                            echo "<li class='list-group-item'>";
                            echo strtoupper($key).": ".$value;

                            $query_laureato = "SELECT * FROM unitua.is_laureato($1)";
                            $res_laureato = pg_prepare($connection, "", $query_laureato);
                            $res_laureato = pg_execute($connection, "", array($row['matricola']));
                            $row_laureato = pg_fetch_assoc($res_laureato);

                            if ($row_laureato['is_laureato'] == 1) {
                                echo "<br><br><a class='btn btn-primary' id='bottone_laurea' href='view_laurea.php' role='button'>Laurea</a>";
                            }

                            echo "</li>";
                            break;
                        case 'nome':
                            echo "<li class='list-group-item'>";
                            echo strtoupper($key).": ".$value;
                            echo "</li>";
                            break;
                        case 'cognome':
                            echo "<li class='list-group-item'>";
                            echo strtoupper($key).": ".$value;
                            echo "</li>";
                            break;
                        case 'codFiscale':
                            echo "<li class='list-group-item'>";
                            echo "CODICE FISCALE: ".$value;
                            echo "</li>";
                            break;
                        case 'sesso':
                            echo "<li class='list-group-item'>";
                            echo strtoupper($key).": ".$value;
                            echo "</li>";
                            break;
                        case 'cellulare':
                            echo "<li class='list-group-item'>";
                            echo strtoupper($key).": ".$value;
                            echo "</li>";
                            break;
                            case 'data_immatricolazione':
                            echo "<li class='list-group-item'>";
                            echo "DATA IMMATRICOLAZIONE: ".$value;
                            echo "</li>";
                            break;
                        case 'utente_email':
                            echo "<li class='list-group-item'>";
                            echo "EMAIL: ".$value;
                            echo "</li>";
                            break;
                        case 'cdl':
                            echo "<li class='list-group-item'>";
                            echo "Codice CdL: ".$value;
                            echo "</li>";
                            break;
                    }
                }
                echo "</ul>";
            }
            echo "<br><br>";
        }
    ?>
</body>
</html>