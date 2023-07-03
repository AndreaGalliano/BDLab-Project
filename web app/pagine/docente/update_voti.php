<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Voti</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/style2.css">
</head>
<body>
    <?php
        include_once('navbar2.php');
        include_once('../../script/check_login.php');
    ?>

    <form method="POST" action="../../pagine/docente/index_change_voto.php">
        <div class="form-group" id="divform1">
            <label for="matricola">Matricola dello studente:</label>
            <input type="text" class="form-control" id="matricola" aria-describedby="matricola" name="matricola" placeholder="Matricola" required>
        </div>
        <div class="form-group" id="divform2">
            <button type="submit" class="btn btn-primary">Conferma</button>   
        </div>
    </form>

</body>
</html>