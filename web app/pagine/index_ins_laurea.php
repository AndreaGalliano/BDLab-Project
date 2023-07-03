<!DOCTYPE html>
<html lang="it">
<html>
<head>
    <title>Unitua: Inserisci laurea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <?php
        include_once('navbar3.php');
        include_once('../script/check_login.php');

        if (isset($_POST['codice'])) {
            include_once('../script/connection.php');

            $query_verificata = "SELECT * FROM unitua.is_cdl($1)";
            $res_verificata = pg_prepare($connection, "", $query_verificata);
            $res_verificata = pg_execute($connection, "", array($_POST['codice']));
            $rowV = pg_fetch_assoc($res_verificata);

            if ($rowV['is_cdl'] == 0) {
                $_SESSION['errore_cdl'] = "L'ID inserito non corrisponde a nessun Corso di Laurea del sistema!";
                header('Location: ../pagine/errore_cdl.php'); 
            }
        }

        $currentDate = date('Y-m-d');
    ?>

    <br>
    <form method="POST" action="../script/index_ins_laurea2.php">
        <div class="form-group" id="divform">
            <label for="bonus">Bonus:</label><br>
            <input type="number" id="bonus1" name="bonus" required />
        </div>
        <div class="form-group" id="divform">
            <label for="data">Data:</label><br>
            <input type="date" id="data1" name="data" value='<?php echo $currentDate ?>' readonly />
        </div>
        <div class="form-group" id="divform">
            <label for="lode">Lode:</label>
            <select class="form-control" id="lode1" name="lode" required>
                    <option value="true">Sì</option>
                    <option value="false">No</option>
            </select>
        </div>
        <div class="form-group" id="divform">
            <label for="bonus">Matricola studente:</label><br>
            <input type="text" id="studente1" name="studente" required>
        </div>
        <div class="form-group" id="divform">
            <label for="bonus">Docente relatore:</label><br>
            <input type="number" id="relatore1" name="relatore" min="100" required>
        </div>
        <div class="form-group" id="divform">
            <label for="cdl">Codice Corso di Laurea:</label><br>
            <input type="number" id="cdl1" name="cdl" value='<?php echo $_POST['codice'] ?>' readonly>
        </div>
        <div class="form-group" id="divform">
            <input type="submit" class="btn btn-primary" id="bottone_iscr" value="Inserisci laurea" />
        </div>
    </form>
</body>
</html>