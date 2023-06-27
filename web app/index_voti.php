<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Inserisci voti</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
        include_once('navbar2.php');
        include_once('check_login.php');

        // print_r($_POST);
        // print_r($_SESSION['email']);
        // print_r($_SESSION['appello']);

        if (!isset($_POST['matricola']) && !isset($_SESSION['appello'])) {
            echo "<h2>Errore nel caricamento dei dati per l'inserimento dei voti.</h2>";
        } else {
            include_once('connection.php');

            $query = "SELECT * FROM unitua.get_info_doc($1)";
            $res = pg_prepare($connection, "rep_ok", $query);
            $res = pg_execute($connection, "rep_ok", array($_SESSION['email']));
                
            $row = pg_fetch_assoc($res);
        }
    ?>

    <form method="POST" action="conf_voto.php">
    <div class="form-group" id="divform">
            <label for="studente">Matricola studente:</label>
            <input type="text" class="form-control" id="studente" aria-describedby="studente" name="studente" value='<?php echo $_POST['matricola']; ?>' readonly>
        </div>
        <div class="form-group" id="divform">
            <label for="codice_appello">Codice appello:</label>
            <input type="number" class="form-control" id="codice_appello" name="codice_appello" value='<?php echo $_SESSION['appello'] ?>' readonly>
        </div>
        <div class="form-group" id="divform">
            <label for="codice_esame">Codice esame:</label>
            <input type="number" class="form-control" id="codice_esame" name="codice_esame" value='<?php echo $_POST['codice_esame'] ?>' readonly>
        </div>
        <div class="form-group" id="divform">
            <label for="id_docente">ID docente:</label>
            <input type="number" class="form-control" id="id_docente" name="id_docente" value=<?php echo $row['id'] ?> readonly>
        </div>
        <div class="form-group" id="divform">
            <label for="codice_esame">Voto in trentesimi:</label>
            <input type="number" class="form-control" id="voto_esame" name="voto_esame" placeholder="Inserisci voto" required>
        </div>
        <div class="form-group" id="divform">
            <label for="lode">Lode:</label>
            <select class="form-control" id="lode" name="lode" required>
                <option value="si_lode">Sì</option>
                <option value="no_lode">No</option>
            </select>
        </div>
        <div class="form-group" id="divform">
            <label for="respinto">Respinto:</label>
            <select class="form-control" id="respinto" name="respinto" required>
                <option value="si_resp">Sì</option>
                <option value="no_resp">No</option>
            </select>
        </div>
        <div class="form-group" id="divform">
            <label for="data_verb">Data di verbalizzazione:</label>
            <input type="date" class="form-control" id="data_verb" name="data_verb" value="
            <?php
                echo date("Y/m/d")
            ?>
            " readonly>
        </div>
        <div class="form-group" id="divform">
            <button type="submit" class="btn btn-primary">Conferma</button>   
        </div>
    </form>
    
</body>
</html>