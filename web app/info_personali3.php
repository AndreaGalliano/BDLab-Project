<!DOCTYPE html>
<html lang="it">
<html>
<head>
    <title>Unitua: Info personali</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
    <?php
        include_once('navbar3.php');
        include_once('check_login.php');

        include_once('connection.php'); 

        $query = "SELECT * FROM unitua.get_all_seg($1)";

        $res = pg_prepare($connection, "", $query);
        $res = pg_execute($connection, "", array($_SESSION['email']));

        $mail_splittata = explode(".", $_SESSION['email']);
        $nome = strtoupper($mail_splittata[0]);
        $mail_splittata2 = explode("@", $mail_splittata[1]);
        $cognome = strtoupper($mail_splittata2[0]);

        echo "<h2>Dati personali dell'utente: ".$nome." ".$cognome."</h2>";

        if ($res) {
            $row = pg_fetch_assoc($res);
        } else {
            echo "Errore: ".preg_last_error($connection);
        }
    ?>

<ul class="list-group">
        <li class="list-group-item">
            <?php 
                echo "ID utente: ".$row['id']; 
            ?>
        </li>
        <li class="list-group-item">
            <?php
                echo "Codice fiscale: ".$row['codfiscale'];
            ?>
        </li>
        <li class="list-group-item">
            <?php
                if ($row['sesso'] == 'M') {
                    echo "Sesso: Maschio";
                } else {
                    if ($row['sesso'] == 'F') {
                        echo "Sesso: Femmina";
                    } else {
                        echo "Sesso: Non specificato";
                    }
                }
            ?>
        </li>
        <li class="list-group-item">
            <?php
                echo "Cellulare: ".$row['cellulare'];
            ?>
        </li>
        <li class="list-group-item">
            <?php
                echo "Ruolo: ".$row['ruolo'];
            ?>
        </li>
        <li class="list-group-item">
            <?php
                echo "Email: ".$row['utente_email'];
            ?>
        </li>
    </ul>

</body>
</html>