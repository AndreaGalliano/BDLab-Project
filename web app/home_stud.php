<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Studente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

    <?php
        session_start();
        include_once('connection.php');

        $query = "SELECT * FROM unitua.is_ex_stud($1)";
        $res = pg_prepare($connection, "", $query);
        $res = pg_execute($connection, "", array($_SESSION['email']));
        $row = pg_fetch_assoc($res);

        if ($row['is_ex_stud'] == 1) {
            header('Location: home_ex_stud.php');
        }

        include_once('navbar.php');
        include_once("check_login.php");
    ?>

    <div class = "container text-center">

        <div class = "row text-center">
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/prenotazione.jpeg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Iscrizione agli esami</h5>
                        <p class="card-text">Iscriviti agli esami previsti dal tuo CDL e visiona il calendario accademico per consultare tutti gli appelli disponibili.</p>
                        <br>
                        <a href="iscrizione_stud.php" class="btn btn-primary">Iscriviti</a>
                    </div>
                </div>
            </div>
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/disiscrizione.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Disiscrizione agli esami</h5>
                        <p class="card-text">Disiscriviti agli esami a cui non intendi partecipare per permettere uno svolgimento più rapido dell'appello il giorno dell'esame.</p>
                        <a href="disiscrizione_stud.php" class="btn btn-primary">Disiscriviti</a>
                    </div>
                </div>
            </div>
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/carriera.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Consulta la tua carriera</h5>
                        <p class="card-text">Consulta la tua carriera accademica prendendo visione di tutti gli esami finora effettuati e le relative valutazioni.</p>
                        <a href="carriera.php" class="btn btn-primary">Consulta</a>
                    </div>
                </div>
            </div>
        </div>

        <div class = "row text-center">
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/elenco.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Iscrizioni confermate agli esami</h5>
                        <p class="card-text">Prendi visione di tutte le iscrizioni che hai effettutato agli esami del tuo CDL.</p>
                        <br>
                        <a href="iscrizioni.php" class="btn btn-primary">Visiona</a>
                    </div>
                </div>
            </div>
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/esami_passati.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Esami superati</h5>
                        <p class="card-text">Consulta l'elenco di tutti gli esami che hai svolto prendendo una valutazione sufficiente.</p>
                        <br><br>
                        <a href="carriera_suff.php" class="btn btn-primary">Consulta</a>
                    </div>
                </div>
            </div>
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/other.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Insegnamenti di altri CDL</h5>
                        <p class="card-text">Prendi visione di tutti i vari insegnamenti degli altri CDL attivati dal tuo ateneo.</p>
                        <br><br>
                        <a href="altri_ins.php" class="btn btn-primary">Consulta</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>