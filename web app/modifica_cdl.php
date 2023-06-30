<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Modifica CdL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
        include_once('navbar3.php');
        include_once('check_login.php');

        include_once('connection.php');

        echo "<h2 id='scritta_is'>Corsi di Laurea erogati</h2>";

        $query = "SELECT * FROM unitua.corso_di_laurea";
        $res = pg_prepare($connection, "rep_ok", $query);
        $res = pg_execute($connection, "rep_ok", array());

        echo "<ul class='list-group' id='centrato'>";

        while ($row = pg_fetch_assoc($res)) {
            echo "Corso di Laurea: ".$row['descrizione']."<br>";
            echo "<form method='POST' action='index_modifica_cdl.php'>";
            foreach ($row as $key => $value) {
                switch ($key) {
                    case 'codice':
                        echo "<li class='list-group-item'>Codice CdL:";
                        echo "<input type='number' class='form-control' id='codice' name='codice' value='".$row['codice']."' readonly>";
                        echo "</li>";
                        break;
                    case 'tipologia':
                        echo "<li class='list-group-item'>";
                        echo "<label for='tipologia'>Impostato attualmente come: ".$value."</label>";
                        echo "<select class='form-control' id='tipologia' name='tipologia'>";
                        echo "<option value='Triennale'>Triennale</option>";
                        echo "<option value='Magistrale'>Magistrale</option>";
                        echo "<option value='Ciclo Unico'>Ciclo Unico</option>";
                        echo "</select>";
                        echo "</li>";
                        break;
                    case 'descrizione':
                        echo "<li class='list-group-item'>";
                        echo "<label for='tipologia'>Impostato attualmente come: ".$value."</label>";
                        echo "<input type='text' class='form-control' id='descrizione' name='descrizione' placeholder='Reinserisci il nome' required>";
                        echo "</li>";
                        break;
                }
            }
            echo "<input type='submit' class='btn btn-primary' id='bottone_iscr' value='Modifica CdL'>";
            echo "</form><br><hr>";
        }

        echo "</ul>";
    ?>
</body>