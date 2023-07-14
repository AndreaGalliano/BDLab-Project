<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Iscriviti</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href=../../css/style2.css>
</head>
<body>

    <?php
        include_once('navbar.php');
        include_once('../../script/check_login.php');

        include_once('../../script/connection.php'); 

        $query1 = "SELECT * FROM unitua.get_cdl($1)";

        $res1 = pg_prepare($connection, "get_all", $query1);
        $res1 = pg_execute($connection, "get_all", array($_SESSION['email']));
        $row1 = pg_fetch_assoc($res1);
        //echo "<p>".$row['get_cdl']."</p>";

        $query2 = "SELECT * FROM unitua.get_calendario($1)";
        $res2 = pg_prepare($connection, "get_all_esito", $query2);
        $res2 = pg_execute($connection, "get_all_esito", array($row1['get_cdl']));
        //$row2 = pg_fetch_assoc($res2);

        echo "<ul class='list-group' id='centrato'>";

        $anno_corrente = date('Y');
        $flag = false;

        while ($row2 = pg_fetch_assoc($res2)) {
            echo "<form method='POST' action='../../script/studente/index_iscrizione.php'>";
            foreach ($row2 as $key => $value) {
                $annoData = date('Y', strtotime($row2['data_esame']));
                if ($anno_corrente == $annoData) {
                    if (str_contains($key, '_')) {
                        $campi_chiave = explode("_", $key);
                        echo "<li class='list-group-item'>";
                        echo strtoupper($campi_chiave[0])." ".strtoupper($campi_chiave[1]).": ";
                        echo "<input type='text' id='".$campi_chiave[0]." ".$campi_chiave[1]."' name='".$campi_chiave[0]." ".$campi_chiave[1]."' value='".$value."' readonly />";
                        echo "</li>";
                    } else {
                        if ($key == 'aperto') {
                            continue;
                        } else {
                            echo "<li class='list-group-item'>";
                            echo strtoupper($key).": ";
                            echo "<input type='text' id='".$key."' name='".$key."' value='".$value."' readonly />";
                            echo "</li>";
                        }
                    }
                } else {
                    $flag = true;
                }
            }
            if (!$flag) {
                echo "<input type='submit' class='btn btn-primary' id='bottone_iscr'>";
                echo "</form><br><br>";
            } else {
                $flag = false;
            }
        }

        echo "</ul>";

        echo "<h5 id='scritta_is'>Tabella delle propedeuticità:</h5>";

        /*
        $query3 = "SELECT * FROM unitua.get_cdl($1)";

        $res3 = pg_prepare($connection, "esito", $query3);
        $res3 = pg_execute($connection, "esito", array($_SESSION['email']));
        $row3 = pg_fetch_assoc($res3);

        $query4 = "SELECT * FROM unitua.get_prop($1)";

        $res4 = pg_prepare($connection, "esito_q", $query4);
        $res4 = pg_execute($connection, "esito_q", array($row3['get_cdl']));

        echo "<ul class='list-group' id='centrato'>";

        while ($row4 = pg_fetch_assoc($res4)) {
            foreach ($row4 as $key => $value) {
                if (!str_contains($key, "rn")) {
                    if (str_contains($key, '_')) {
                    $campi_chiave = explode("_", $key);
                    echo "<li class='list-group-item'>";
                    echo strtoupper($campi_chiave[0])." ".strtoupper($campi_chiave[1]).": ".$value;
                    echo "</li>";
                } else {
                    if ($value == 't') {
                        echo "<li class='list-group-item'>";
                        echo strtoupper($key).": Sì";
                    } else {
                        if ($value == 'f') {
                            echo "<li class='list-group-item'>";
                            echo strtoupper($key).": No";
                        } else {
                            echo "<li class='list-group-item'>";
                            echo strtoupper($key).": ".$value;
                        }
                    }
                    echo "</li>";
                    }
                }
            }
            echo "<br><br>";
        }

        */

        $query4 = "SELECT * FROM unitua.propedeuticita";

        $res4 = pg_prepare($connection, "esito_q", $query4);
        $res4 = pg_execute($connection, "esito_q", array());

        echo "<ul class='list-group' id='centrato'>";

        while ($row4 = pg_fetch_assoc($res4)) {
            foreach ($row4 as $key => $value) {
                switch ($key) {
                    case 'insegnamento_propedeutico':
                        echo "<li class='list-group-item'> Insegnamento propedeutico: ";
                        
                        $query_prop1 = "SELECT * FROM unitua.get_ins_name($1)";
                        $res_prop1 = pg_prepare($connection, "", $query_prop1);
                        $res_prop1 = pg_execute($connection, "", array($row4['insegnamento_propedeutico']));
                        $row_prop1 = pg_fetch_assoc($res_prop1);

                        echo $row_prop1['get_ins_name'];

                        echo "</li>";
                        break;
                    case 'insegnamento_con_propedeuticita':
                        echo "<li class='list-group-item'> Insegnamento con propedeuticità: ";
                        
                        $query_prop2 = "SELECT * FROM unitua.get_ins_name($1)";
                        $res_prop2 = pg_prepare($connection, "", $query_prop2);
                        $res_prop2 = pg_execute($connection, "", array($row4['insegnamento_con_propedeuticita']));
                        $row_prop2 = pg_fetch_assoc($res_prop2);

                        echo $row_prop2['get_ins_name'];

                        echo "</li>";
                        break;
                }
            }
            echo "<br><br>";
        }

        echo "</ul>";
    ?>

</body>
</html>