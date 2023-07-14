<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Modifica profili</title>
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

        if (isset($_POST['id'])) {
            include_once('../../script/connection.php');

            $query_verifica = "SELECT * FROM unitua.is_seg($1)";
            $res_verifica = pg_prepare($connection, "rep", $query_verifica);
            $res_verifica = pg_execute($connection, "rep", array($_POST['id']));
            $row = pg_fetch_assoc($res_verifica);

            if ($row['is_seg'] == 0) {
                $_SESSION['modifica_seg'] = "L'ID inserito non corrisponde a nessun membro della segreteria nel sistema!";
                header('Location: conf_update_seg2.php');
            }

            $querySeg = "SELECT * FROM unitua.get_segretario($1)";
            $res_seg = pg_prepare($connection, "", $querySeg);
            $res_seg = pg_execute($connection, "", array($_POST['id']));
            $row_seg = pg_fetch_assoc($res_seg);

            echo "<ul class='list-group' id='centrato'>";
            
            echo "<form method='POST' action='../../script/segreteria/conf_update_seg1.php'>";
            echo "<li class='list-group-item'>";
            echo "<label for='id'>ID segretario/a: </label>";
            echo "<input type='number' name='id' id='id' value='".$_POST['id']."' readonly />";
            echo "</li>";

            echo "<li class='list-group-item'>";
            echo "<label for='nome'>Nome attuale: ".$row_seg['nome']."</label>";
            echo "<input type='text' name='nome' id='nome' placeholder='Reinserisci il nome' required />";
            echo "</li>";

            echo "<li class='list-group-item'>";
            echo "<label for='cognome'>Cognome attuale: ".$row_seg['cognome']."</label>";
            echo "<input type='text' name='cognome' id='cognome' placeholder='Reinserisci il cognome' required />";
            echo "</li>";

            echo "<li class='list-group-item'>";
            echo "<label for='codfiscale'>Codice fiscale attuale: ".$row_seg['codfiscale']."</label>";
            echo "<input type='text' name='codFiscale' id='codFiscale' placeholder='Reinserisci il codice fiscale' maxlength='16' required />";
            echo "</li>";

            echo "<li class='list-group-item'>";

            $sesso = "";
            if ($row_seg['sesso'] == 'M') {
                $sesso = "Maschio";
            } else {
                if ($row_seg['sesso'] == 'F') {
                    $sesso = "Femmina";
                } else {
                    $sesso = "Non specificato";
                }
            }

            echo "<label for='sesso'>Sesso attuale: ".$sesso."</label>";
            echo "<select class='form-control' id='sesso' name='sesso' required>";
            echo "<option value='M'>Maschio</option>";
            echo "<option value='F'>Femmina</option>";
            echo "<option value='Non specificato'>Non specificato</option>";
            echo "</select>";
            echo "</li>";

            echo "<li class='list-group-item'>";
            echo "<label for='cellulare'>N. di telefono attuale: ".$row_seg['cellulare']."</label>";
            echo "<input type='text' name='cellulare' id='cellulare' placeholder='Reinserisci il numero di telefono' maxlength='10' required />";
            echo "</li>";

            echo "<li class='list-group-item'>";
            echo "<label for='ruolo'>Ruolo attuale: ".$row_seg['ruolo']."</label>";
            echo "<select class='form-control' id='ruolo' name='ruolo' required>";
            echo "<option value='Primo livello'>Primo livello</option>";
            echo "<option value='Secondo livello'>Secondo livello</option>";
            echo "</select>";
            echo "</li>";

            echo "<div id='div_centro'>";
            echo "<br><button type='submit' class='btn btn-primary' id='crea'>Modifica</button>";
            echo "</div>";
            
            echo "</form>";

            echo "</ul>";
        }
    ?>
</body>