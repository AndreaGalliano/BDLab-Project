<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Docente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
        include_once('navbar2.php');
        include_once("check_login.php");
    ?>

    <div class = "container text-center">

        <div class = "row text-center">
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/calendario.png" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Gestione del calendario esami</h5>
                        <p class="card-text">Gestisci il calendario relativo agli esami dei tuoi insegnamenti e fissa le varie date.</p>
                        <a href="gest_calendario.php" class="btn btn-primary">Gestisci</a>
                    </div>
                </div>
            </div>
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/insegnamenti.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Studenti iscritti agli appelli</h5>
                        <p class="card-text">Visiona tutti gli studenti finora iscritti agli esami degli insegnamenti di cui sei responsabile.</p>
                        <br>
                        <a href="iscritti.php" class="btn btn-primary">Visualizza</a>
                    </div>
                </div>
            </div>
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/reg_voti.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Registra i voti</h5>
                        <p class="card-text" id="ultima">Registra i voti agli studenti che hanno sostenuto gli esami di tua competenza.</p>
                        <br><br>
                        <a href="ins_voti.php" class="btn btn-primary">Registra</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>