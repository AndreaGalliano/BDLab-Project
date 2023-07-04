<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Voti</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/style2.css">
</head>
<body>
    <?php
        if (isset($_POST['matricola'])) {
            include_once('navbar2.php');
            include_once('../../script/check_login.php');

            include_once('../../script/connection.php');

            $query_verifica = "SELECT * FROM unitua.is_stud($1)";
            $res_verifica = pg_prepare($connection, "", $query_verifica);
            $res_verifica = pg_execute($connection, "", array($_POST['matricola']));
            $row = pg_fetch_assoc($res_verifica);

            if ($row['is_stud'] == 0) {
                $_SESSION['modifica_voto'] = "La matricola inserita non corrisponde a nessuno studente del sistema!";
                header('Location: ../../pagine/no_update.php');
            }

            $query_doc = "SELECT * FROM unitua.get_info_doc($1)";
            $res_doc = pg_prepare($connection, "rep", $query_doc);
            $res_doc = pg_execute($connection, "rep", array($_SESSION['email']));
            $row_doc = pg_fetch_assoc($res_doc);

            $query = "SELECT * FROM unitua.get_all_valutazioni($1, $2)";
            $res = pg_prepare($connection, "rep_ok", $query);
            $res = pg_execute($connection, "rep_ok", array($row_doc['id'], $_POST['matricola']));
            
            echo "<ul class='list-group' id='centrato'>";

            while ($row = pg_fetch_assoc($res)) {
                echo "<form method='POST' action='../../script/docente/conf_update1.php'>";
                foreach ($row as $key => $value) {
                    switch ($key) {
                        case 'codice':
                            echo "<li class='list-group-item'>";
                            echo "<label for='codice_valutazione'>Codice valutazione:</label>";
                            echo "<input type='number' id='codice_valutazione' name='codice_valutazione' value='".$value."' readonly />";
                            echo "</li>";
                            break;
                        case 'studente':
                            echo "<li class='list-group-item'>";
                            echo "<label for='studente'>Matricola studente:</label>";
                            echo "<input type='text' id='studente' name='studente' value='".$value."' readonly />";
                            echo "</li>";
                            break;
                        case 'calendario':
                            echo "<li class='list-group-item'>";
                            echo "<label for='codice_appello'>Codice appello:</label>";
                            echo "<input type='number' id='codice_appello' name='codice_appello' value='".$value."' readonly />";
                            echo "</li>";
                            break;
                        case 'esame':
                            echo "<li class='list-group-item'>";
                            echo "<label for='codice_esame'>Codice esame:</label>";
                            echo "<input type='number' id='codice_esame' name='codice_esame' value='".$value."' readonly />";
                            echo "</li>";
                            break;
                        case 'docente':
                            echo "<input type='hidden' id='docente' name='docente' value='".$value."' />";
                            break;
                        case 'data_verbalizzazione':
                            echo "<li class='list-group-item'>";
                            echo "<label for='data_verbalizzazione'>Data verbalizzazione:</label>";
                            echo "<input type='date' id='data_verbalizzazione' name='data_verbalizzazione' value='".$value."' readonly />";
                            echo "</li>";
                            break;
                    }
                }
                echo "<li class='list-group-item'>";
                echo "<input type='number' id='voto' name='voto' placeholder='Inserisci nuovo voto' min=18 max=30>";
                echo "</li>";

                // lode:
                echo "<li class='list-group-item'>";
                echo "<label for='lode'>Lode:</label>";
                echo "<select class='form-control' id='lode' name='lode' required>";
                echo "<option value='true'>Sì</option>";
                echo "<option value='false'>No</option>";
                echo "</select>";
                echo "</li>";
                
                // respinto:
                echo "<li class='list-group-item'>";
                echo "<label for='respinto'>Respinto:</label>";
                echo "<select class='form-control' id='respinto' name='respinto' required>";
                echo "<option value='true'>Sì</option>";
                echo "<option value='false'>No</option>";
                echo "</select>";                
                echo "</li>";

                echo "<button type='submit' class='btn btn-primary' id='bottone_update'>Conferma cambiamento</button>";
                echo "</form>";
                echo "<br><br>";
            }
        }
        echo "</ul>";
        echo "<br>";
    ?>
</body>
</html>