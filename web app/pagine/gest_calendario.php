<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Gestisci esami</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <?php
        include_once('navbar2.php');
        include_once('check_login.php');

        $mail_splittata = explode(".", $_SESSION['email']);
        $nome = strtoupper($mail_splittata[0]);
        $mail_splittata2 = explode("@", $mail_splittata[1]);
        $cognome = strtoupper($mail_splittata2[0]);

        echo "<h2>Insegnamenti di cui è responsabile il docente: ".$nome." ".$cognome."</h2>";

        include_once('connection.php'); 

        $query = "SELECT * FROM unitua.get_insegnamenti($1)";
        $res = pg_prepare($connection, "rep_ok", $query);
        $res = pg_execute($connection, "rep_ok", array($_SESSION['email']));

        echo "<ul class='list-group' id='centrato'>";

        while ($row = pg_fetch_assoc($res)) {
            echo "<form method='POST' action='index_calendario.php'>";
            echo "<li class='list-group-item'>";
            echo "<input type='date' id='data_esame' name='data_esame' />";
            echo "</li>";
            echo "<li class='list-group-item'>";
            echo "<input type='time' id='ora' name='ora' />";
            echo "</li>";
            echo "<li class='list-group-item'>";
            echo "<input type='text' id='aula' name='aula' placeholder='aula'/>";
            echo "</li>";
            echo "<li class='list-group-item'>";

            $current_year = date('Y');

            echo "<input type='number' id='anno' name='anno' value='".$current_year."' readonly />";
            echo "</li>";
            foreach ($row as $key => $value) {
                switch ($key) {
                    case 'codice':
                        echo "<li class='list-group-item'>";
                        echo "<input type='text' id='codice_esame' name='codice_esame' value='".$value."' readonly />";
                        echo "</li>";
                        break;
                    case 'nome_insegnamento':
                        $campi_chiave = explode("_", $key);
                        echo "<li class='list-group-item'>";
                        echo "<input type='text' id='".$campi_chiave[0]." ".$campi_chiave[1]."' value='".$value."' readonly />";
                        echo "</li>";
                        break;
                    case 'descrizione':
                        echo "<li class='list-group-item'>";
                        echo "<textarea id='descrizione' name='descrizione'>".$value."</textarea>";
                        echo "</li>";
                        break;
                }
            }
            echo "<input type='submit' class='btn btn-primary' id='bottone_iscr' value='Inserisci appello'>";
            echo "</form><br><br>"; 
        }

        echo "</ul>";

    ?>

</body>
</html>