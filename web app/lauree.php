<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua: Lauree</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
        include_once('navbar2.php');
        include_once('check_login.php');

        include_once('connection.php');

        $mail_splittata = explode(".", $_SESSION['email']);
        $nome = strtoupper($mail_splittata[0]);
        $mail_splittata2 = explode("@", $mail_splittata[1]);
        $cognome = strtoupper($mail_splittata2[0]);

        echo "<h2 id='scritta_is'>Lauree di cui è stato relatore il docente: ".$nome." ".$cognome."</h2>";

        $query1 = "SELECT * FROM unitua.get_info_doc($1)";
        $res1 = pg_prepare($connection, "rep", $query1);
        $res1 = pg_execute($connection, "rep", array($_SESSION['email'])); 
        $row1 = pg_fetch_assoc($res1);

        $query2 = "SELECT * FROM unitua.get_laurea($1)";
        $res2 = pg_prepare($connection, "rep_ok", $query2);
        $res2 = pg_execute($connection, "rep_ok", array($row1['id']));
        
        echo "<ul class='list-group' id='centrato'>";

        while ($row2 = pg_fetch_assoc($res2)) {
            foreach ($row2 as $key => $value) {
                if ($key != 'lode') {
                    echo "<li class='list-group-item'>";
                    echo strtoupper($key).": ".$value;
                    echo "</li>";
                } else {
                    if ($value == 'f') {
                        echo "<li class='list-group-item'>";
                        echo strtoupper($key).": No";
                        echo "</li>";
                    } else {
                        echo "<li class='list-group-item'>";
                        echo strtoupper($key).": Sì";
                        echo "</li>";
                    }
                }
            }
        }

        echo "</ul>";
    ?>
</body>