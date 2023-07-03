<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Modifica docenti</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <?php
        include_once('navbar3.php');
        include_once('check_login.php');
        if (isset($_POST['id'])) {
            include_once('connection.php');

            $query_verifica = "SELECT * FROM unitua.is_doc($1)";
            $res_verifica = pg_prepare($connection, "rep", $query_verifica);
            $res_verifica = pg_execute($connection, "rep", array($_POST['id']));
            $row = pg_fetch_assoc($res_verifica);

            if ($row['is_doc'] == 0) {
                $_SESSION['modifica_doc'] = "L'ID inserito non corrisponde a nessun docente del sistema!";
                header('Location: conf_update_doc2.php');
            }

            echo "<ul class='list-group' id='centrato'>";
            
            echo "<form method='POST' action='conf_update_doc1.php'>";
            echo "<li class='list-group-item'>";
            echo "<input type='text' name='id' id='id' value='".$_POST['id']."' readonly />";
            echo "</li>";

            echo "<li class='list-group-item'>";
            echo "<input type='text' name='nome' id='nome' placeholder='Reinserisci il nome' required />";
            echo "</li>";

            echo "<li class='list-group-item'>";
            echo "<input type='text' name='cognome' id='cognome' placeholder='Reinserisci il cognome' required />";
            echo "</li>";

            echo "<li class='list-group-item'>";
            echo "<select class='form-control' id='sesso' name='sesso' required>";
            echo "<option value='M'>Maschio</option>";
            echo "<option value='F'>Femmina</option>";
            echo "<option value='Non specificato'>Non specificato</option>";
            echo "</select>";
            echo "</li>";

            echo "<li class='list-group-item'>";
            echo "<input type='text' name='codFiscale' id='codFiscale' placeholder='Reinserisci il codice fiscale' maxlength='16' required />";
            echo "</li>";

            echo "<li class='list-group-item'>";
            echo "<input type='text' name='cellulare' id='cellulare' placeholder='Reinserisci il numero di telefono' maxlength='10' required />";
            echo "</li>";

            echo "<li class='list-group-item'>";
            echo "<select class='form-control' id='carica' name='carica' required>";
            echo "<option value='Ordinario'>Ordinario</option>";
            echo "<option value='Associato'>Associato</option>";
            echo "<option value='Ricercatore'>Ricercatore</option>";
            echo "</select>";
            echo "</li>";

            echo "<li class='list-group-item'>";
            echo "<input type='number' name='cdl' id='cdl' placeholder='Reinserisci il CdL' maxlength='10' min='1' required />";
            echo "</li>";

            echo "<div id='div_centro'>";
            echo "<br><button type='submit' class='btn btn-primary' id='crea'>Modifica</button>";
            echo "</div>";
            
            echo "</form>";

            echo "</ul>";
        }
    ?>
</body>