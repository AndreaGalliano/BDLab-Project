<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Nuovo CdL</title>
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
    ?>

    <br>
    <h4 id="titolino">Creazione di un nuovo Corso di Laurea:</h4>
    <form method='POST' action='../script/new_cdl.php' id='form_add'>
        <div class="form-group" id="divform">
            <label for="tipologia">Tipologia CdL:</label>
            <select class="form-control" id="tipologia" name="tipologia" required>
                <option value="Triennale">Triennale</option>
                <option value="Magistrale">Magistrale</option>
                <option value="Ciclo Unico">Ciclo Unico</option>
            </select>
        </div>
        <div class="form-group" id="divform">
            <label for="tipologia">Nome CdL:</label>
            <input type="text" class="form-control" id="descrizione" aria-describedby="descrizione" name="descrizione" placeholder="Inserisci il nome del corso di laurea" required>
        </div>
        <div class="form-group" id="divform">
            <button type="submit" class="btn btn-primary" id="crea">Crea</button>   
        </div>
    </form>
</body>
</html>