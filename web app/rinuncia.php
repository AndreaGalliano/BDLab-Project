<!DOCTYPE html>
<html lang="it">
<html>
<head>
    <title>Unitua: Rinuncia agli Studi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
    <?php
        // session_start();
        include_once('navbar.php');
        include_once('check_login.php');
    ?>

    <br>
    <h2 id="scritta_is">RINUNCIA AGLI STUDI</h2>
    <hr>
    <h4 id="titoletto">Se sei sicuro di voler effettuare la rinuncia agli studi compila il modulo:</h4>
    <br>
    <div id="centrato">
        <form method="POST" action="index_rinuncia.php">
            <div class="form-group" id="divform">
                <label for="email">Indirizzo e-mail:</label>
                <input type="email" class="form-control" id="email" aria-describedby="email" name="email" value="<?php echo $_SESSION['email']; ?>" readonly>
            </div>
            <div class="form-group" id="divform">
                <label for="matricola">Numero di matricola:</label>
                <input type="text" class="form-control" id="matricola" name="matricola" placeholder="Inserisci matricola" maxlength="6" required>
            </div>
            <div class="form-group" id="divform">
                <button type="submit" class="btn btn-primary">Rinuncia</button>
            </div>
        </form>
    </div>
</body>
</html>