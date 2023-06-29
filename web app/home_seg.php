<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Segreteria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
        include_once('navbar3.php');
        include_once("check_login.php");
    ?>

    <div class = "container text-center">

        <div class = "row text-center">
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/gest_stud2.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Creazione dei profili utenti</h5>
                        <br>
                        <p class="card-text">Crea i vari profili dei nuovi utenti dell'università.</p>
                        <br><br>
                        <a href="#" class="btn btn-primary">Crea</a>
                    </div>
                </div>
            </div>
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/gest_stud.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Gestione dei profili studenti</h5>
                        <p class="card-text">Gestisci i vari profili degli studenti dell'università per poterne modificare i dati.</p>
                        <br><br>
                        <a href="#" class="btn btn-primary">Gestisci</a>
                    </div>
                </div>
            </div>
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/gest_doc.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Gestione dei profili docenti</h5>
                        <p class="card-text" id="ultima">Gestisci i vari profili dei docenti dell'università modificandone dati e insegnamenti.</p>
                        <br><br>
                        <a href="#" class="btn btn-primary">Gestisci</a>
                    </div>
                </div>
            </div>
        </div>

        <div class = "row text-center">
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/crea_cdl.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Creazione dei corsi di laurea</h5>
                        <br>
                        <p class="card-text">Crea eventuali corso di laurea nuovi per l'ateneo.</p>
                        <br><br>
                        <a href="#" class="btn btn-primary">Crea</a>
                    </div>
                </div>
            </div>
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/gestione_cdl.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Gestione dei corsi di laurea</h5>
                        <br>
                        <p class="card-text">Gestisci i vari corsi di laurea dell'ateneo per poterne modificare i dati.</p>
                        <br><br>
                        <a href="#" class="btn btn-primary">Gestisci</a>
                    </div>
                </div>
            </div>
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/add_ins.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Creazione degli insegnamenti</h5>
                        <p class="card-text" id="ultima">Aggiungi nuovi insegnamenti per i corsi di laurea dell'ateneo.</p>
                        <br><br><br>
                        <a href="#" class="btn btn-primary">Crea</a>
                    </div>
                </div>
            </div>
        </div>

        <div class = "row text-center">
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/gest_ins.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Gestione degli insegnamenti</h5>
                        <br>
                        <p class="card-text">Gestisci i vari insegnamenti dei corsi di laurea dell'ateneo per poterne modificare i dati.</p>
                        <br><br>
                        <a href="#" class="btn btn-primary">Gestisci</a>
                    </div>
                </div>
            </div>
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/ex_stud.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Gestione degli ex studenti</h5>
                        <br>
                        <p class="card-text">Gestisci e modifica i profili riguardanti gli ex studenti dell'ateneo.</p>
                        <br><br><br>
                        <a href="#" class="btn btn-primary">Gestisci</a>
                    </div>
                </div>
            </div>
            <div class = "col-sm mt-3">
                <div class = "card h-100" style="width: 18rem; margin: auto;">
                    <img src="/img/gest_lauree.jpg" class="card-img-top" id = "minitatura">
                    <div class="card-body">
                        <h5 class="card-title">Gestione delle lauree</h5>
                        <p class="card-text" id="ultima">Gestisci le lauree dell'ateneo inserendo gli studenti che hanno terminato il loro percorso di studi.</p>
                        <br><br><br>
                        <a href="#" class="btn btn-primary">Gestisci</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>