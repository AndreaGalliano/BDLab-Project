<!DOCTYPE html>
<html lang="it">
<html>
<head>
    <title>Unitua: Cambio Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
        session_start();
        include_once('navbar3.php');
        include_once('script.php');
        effettua_cambiamento();

        if (isset($_SESSION['autenticazione_fallita'])) {
            echo "<p>".$_SESSION['autenticazione_fallita']."</p>";
            unset($_SESSION['autenticazione_fallita']);
        } else {
            if (isset($_SESSION['cambiamento_fallito'])) {
                echo "<p>".$_SESSION['cambiamento_fallito']." ".$_SESSION['row']."</p>";
                unset($_SESSION['cambiamento_fallito']);
            } else {
                if (isset($_SESSION['errore_ins_pw'])) {
                    echo "<p>".$_SESSION['errore_ins_pw']."</p>";
                    unset($_SESSION['errore_ins_pw']);
                } else {
                    if (isset($_SESSION['cambiamento_fatto'])) {
                        echo "<p>".$_SESSION['cambiamento_fatto']."</p>";
                        unset($_SESSION['cambiamento_fatto']);
                    }
                }
            }
        }
    ?>
    
    <form method="POST" action="index_change.php">
        <div class="form-group" id="divform">
            <label for="email">Indirizzo e-mail</label>
            <input type="email" class="form-control" id="email" aria-describedby="email" name="email" value="<?php echo $_SESSION['email']; ?>" readonly>
        </div>
        <div class="form-group" id="divform">
            <label for="old_pw">Password attuale</label>
            <input type="password" class="form-control" id="old_pw" name="old_pw" placeholder="Password attuale" required>
        </div>
        <div class="form-group" id="divform">
            <label for="new_pw">Nuova password</label>
            <input type="password" class="form-control" id="new_pw" name="new_pw" placeholder="Password nuova" required>
        </div>
        <div class="form-group" id="divform">
            <label for="conf_new_pw">Conferma nuova password</label>
            <input type="password" class="form-control" id="conf_new_pw" name="conf_new_pw" placeholder="Conferma nuova password" required>
        </div>
        <div class="form-group" id="divform">
            <button type="submit" class="btn btn-primary">Modifica</button>   
        </div>
    </form>
</body>
</html>