<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Modifica insegnamenti</title>
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

        if (isset($_POST['codice'])) {
            include_once('../../script/connection.php');

            $query_verificata = "SELECT * FROM unitua.is_cdl($1)";
            $res_verificata = pg_prepare($connection, "", $query_verificata);
            $res_verificata = pg_execute($connection, "", array($_POST['codice']));
            $rowV = pg_fetch_assoc($res_verificata);

            if ($rowV['is_cdl'] == 0) {
                $_SESSION['modifica_ins'] = "L'ID inserito non corrisponde a nessun Corso di Laurea del sistema!";
                header('Location: ../pagine/conf_update_ins.php'); 
            }

            echo "<h2 id='scritta_is'>Insegnamenti del CdL selezionato:</h2>";

            $query = "SELECT * FROM unitua.get_all_insegnamenti($1)";
            $res = pg_prepare($connection, "", $query);
            $res = pg_execute($connection, "", array($_POST['codice']));
            
            echo "<ul class='list-group' id='centrato'>";

            while ($row = pg_fetch_assoc($res)) {
                echo "<h5>Nome insegnamento: ".$row['nome_insegnamento']."</h5>";
                echo "<form method='POST' action='../../script/segreteria/index_modifica_ins.php'>";
                foreach ($row as $key => $value) {
                    switch ($key) {
                        case 'codice':
                            echo "<li class='list-group-item'>Codice insegnamento:";
                            echo "<input type='number' class='form-control' id='codice' name='codice' value='".$row['codice']."' readonly>";
                            echo "</li>";
                            break;
                        case 'nome_insegnamento':
                            echo "<li class='list-group-item'>";
                            echo "<label for='nome_insegnamento'>Impostato attualmente come: ".$value."</label>";
                            echo "<input type='text' class='form-control' id='nome_insegnamento' name='nome_insegnamento' placeholder='Reinserisci il nome' required>";
                            echo "</li>";
                            break;
                        case 'anno_insegnamento':
                            echo "<li class='list-group-item'>";
                            echo "<label for='anno_insegnamento'>Impostato attualmente come: ".$value."</label>";
                            echo "<input type='number' class='form-control' id='anno_insegnamento' name='anno_insegnamento' placeholder='Reinserisci anno' min='1' max='5' required>";
                            echo "</li>";
                            break;
                        case 'descrizione':
                            echo "<li class='list-group-item'>";
                            echo "<label for='anno_insegnamento'>Desccrizione:</label>";
                            echo "<input type='text' class='form-control' id='descrizione' name='descrizione' placeholder='Reinserisci la descrizione' required>";
                            echo "</li>";
                            break;
                        case 'docente':
                            echo "<li class='list-group-item'>";
                            echo "<label for='anno_insegnamento'>ID docente responsabile:</label>";
                            echo "<input type='text' class='form-control' id='docente' name='descrizione' value='".$value."' readonly>";
                            echo "</li>";
                            break;
                    }
                }
                echo "<input type='submit' class='btn btn-primary' id='bottone_iscr' value='Modifica Insegnamento'>";
                echo "</form><br><hr>";
            }

            echo "</ul>";

            //Inserimento di un form che dia la possibilità di modificare anche gli esami del corso di laurea:
            echo "<h2 id='scritta_is'>Esami del CdL selezionato:</h2>";

            $query_es = "SELECT * FROM unitua.get_all_es_ins($1)";
            $res_es = pg_prepare($connection, "", $query_es);
            $res_es = pg_execute($connection, "", array($_POST['codice']));
            
            echo "<ul class='list-group' id='centrato'>";

            while ($row_es = pg_fetch_assoc($res_es)) {
                echo "<h5>Esame di: ".$row_es['nome_insegnamento']."</h5>";
                echo "<form method='POST' action='../../script/segreteria/index_modifica_es.php'>";
                foreach ($row_es as $key => $value) {
                    switch ($key) {
                        case 'codice_esame':
                            echo "<li class='list-group-item'>Codice esame:";
                            echo "<input type='number' class='form-control' id='codice_esame1' name='codice_esame' value='".$row_es['codice_esame']."' readonly>";
                            echo "</li>";
                            break;
                        case 'codice_insegnamento':
                            echo "<li class='list-group-item'>Codice insegnamento corrispondente:";
                            echo "<input type='number' class='form-control' id='codice_ins' name='codice_ins' value='".$row_es['codice_insegnamento']."' readonly>";
                            echo "</li>";
                            break;
                        case 'tipologia':
                            echo "<li class='list-group-item'>Tipologia:";
                            echo "<label for='tipologia_esame'>Impostata attualmente come: ".$value."</label>";
                            echo "<select class='form-control' id='tipologia' name='tipologia'>";
                            echo "<option value='Presenza'>Presenza</option>";
                            echo "<option value='Distanza'>Distanza</option>";
                            echo "</select>";
                            echo "</li>";
                            break;
                        case 'modalita':
                            echo "<li class='list-group-item'>Modalità:";
                            echo "<label for='modalita'>Impostata attualmente come: ".$value."</label>";
                            echo "<select class='form-control' id='modalita' name='modalita'>";
                            echo "<option value='Scritto'>Scritto</option>";
                            echo "<option value='Orale'>Orale</option>";
                            echo "<option value='Scritto + Orale'>Scritto + Orale</option>";
                            echo "</select>";
                            echo "</li>";
                            break;
                    }
                }
                echo "<input type='submit' class='btn btn-primary' id='bottone_iscr' value='Modifica esame'>";
                echo "</form><br><hr>";
            }

            echo "</ul>";
        }
    ?>
</body>
</html>