<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Ex Studente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
        include_once('check_login.php');
        include_once('navbar4.php');
    ?>

    <br>
    <h2 id="scritta_is">Bentornato!</h2>
    <h4 id="titoletto">In quanto ex studente, ecco cosa puoi visionare:</h4>

    <div id="al_centro">
    <a href="get_val.php" class="btn btn-primary btn-lg" role="button">Storico valutazioni</a>
    
    <?php
        include_once('connection.php');

        $query1 = "SELECT * FROM unitua.get_ex_matricola($1)";
        $res1 = pg_prepare($connection, "", $query1);
        $res1 = pg_execute($connection, "", array($_SESSION['email']));
        $row1 = pg_fetch_assoc($res1);

        $query2 = "SELECT * FROM unitua.is_laureato($1)";
        $res2 = pg_prepare($connection, "", $query2);
        $res2 = pg_execute($connection, "", array($row1['get_ex_matricola']));
        $row2 = pg_fetch_assoc($res2);

        if ($row2['is_laureato'] == 1) {
            echo "<a href='get_laurea.php' class='btn btn-primary btn-lg' role='button'>Informazioni sulla laurea</a>";
        }
    ?>

    </div>
</body>
</html>