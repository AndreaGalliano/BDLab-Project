<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Nuovo profillo</title>
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
    ?>
    <br>
    <h4 id="titolino">Creazione di un nuovo profilo studente:</h4>
    <form method="POST" action="new_profilo.php" id="form_add">
        <div class="form-group" id="divform">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome1" aria-describedby="nome" name="nome" placeholder="Inserisci nome" required>
        </div>
        <div class="form-group" id="divform">
            <label for="cognome">Cognome:</label>
            <input type="text" class="form-control" id="cognome1" aria-describedby="cognome" name="cognome" placeholder="Inserisci cognome" required>
        </div>
        <div class="form-group" id="divform">
            <label for="password">Password:</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="Inserisci password" required>
        </div>
        <div class="form-group" id="divform">
            <label for="codFiscale">Codice fiscale:</label>
            <input type="text" class="form-control" id="codFiscale1" aria-describedby="codFiscale" name="codFiscale" maxlength="16" placeholder="Inserisci codice fiscale" required>
        </div>
        <div class="form-group" id="divform">
            <select class="form-control" id="sesso" name="sesso" required>
                <option value="M">Maschio</option>
                <option value="F">Femmina</option>
                <option value="Non specificato">Non specificato</option>
            </select>
        </div>
        <div class="form-group" id="divform">
            <label for="cellulare">Numero di telefono:</label>
            <input type="number" class="form-control" id="cellulare1" aria-describedby="callulare" name="cellulare" maxlength="10" placeholder="Inserisci numero di telefono" required>
        </div>
        <div class="form-group" id="divform">
            <label for="cdl">Corso di laurea:</label>
            <input type="number" class="form-control" id="cdl1" aria-describedby="cdl" name="cdl" min="1" placeholder="Inserisci corso di laurea" required>
        </div>
        <div class="form-group" id="divform">
            <button type="submit" class="btn btn-primary" id="crea">Crea</button>   
        </div>
    </form>

    <hr>

    <h4 id="titolino">Creazione di un nuovo profilo docente:</h4>
    <form method="POST" action="new_profilo.php" id="form_add">
        <div class="form-group" id="divform">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome1" aria-describedby="nome" name="nome" placeholder="Inserisci nome" required>
        </div>
        <div class="form-group" id="divform">
            <label for="cognome">Cognome:</label>
            <input type="text" class="form-control" id="cognome1" aria-describedby="cognome" name="cognome" placeholder="Inserisci cognome" required>
        </div>
        <div class="form-group" id="divform">
            <label for="password">Password:</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="Inserisci password" required>
        </div>
        <div class="form-group" id="divform">
            <label for="codFiscale">Codice fiscale:</label>
            <input type="text" class="form-control" id="codFiscale1" aria-describedby="codFiscale" name="codFiscale" maxlength="16" placeholder="Inserisci codice fiscale" required>
        </div>
        <div class="form-group" id="divform">
            <select class="form-control" id="sesso" name="sesso" required>
                <option value="M">Maschio</option>
                <option value="F">Femmina</option>
                <option value="Non specificato">Non specificato</option>
            </select>
        </div>
        <div class="form-group" id="divform">
            <label for="cellulare">Numero di telefono:</label>
            <input type="number" class="form-control" id="cellulare1" aria-describedby="callulare" name="cellulare" maxlength="10" placeholder="Inserisci numero di telefono" required>
        </div>
        <div class="form-group" id="divform">
            <select class="form-control" id="carica" name="carica" required>
                <option value="Ordinario">Ordinario</option>
                <option value="Associato">Associato</option>
                <option value="Ricercatore">Ricercatore</option>
            </select>
        </div>
        <div class="form-group" id="divform">
            <label for="cdl">Corso di laurea:</label>
            <input type="number" class="form-control" id="cdl1" aria-describedby="cdl" name="cdl" min="1" placeholder="Inserisci corso di laurea" required>
        </div>
        <div class="form-group" id="divform">
            <button type="submit" class="btn btn-primary" id="crea">Crea</button>   
        </div>
    </form>
    <hr>

    <?php
        include_once('connection.php');

        $query = "SELECT * FROM unitua.get_all_seg($1)";
        $res = pg_prepare($connection, "", $query);
        $res = pg_execute($connection, "", array($_SESSION['email']));

        $row = pg_fetch_assoc($res);
        if ($row['ruolo'] == 'Primo livello') {
            include_once('membro_segreteria.php');
        }
    ?>

</body>