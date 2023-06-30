<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">Benvenuto!</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="home_seg.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="info_personali3.php">Informazioni personali</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="cambio_pw3.php">Cambio password</a>
            </li>

            <?php
                include_once('check_login.php');
                include_once('connection.php');

                $query = "SELECT * FROM unitua.get_all_seg($1)";
                $res = pg_prepare($connection, "rep_ok", $query);
                $res = pg_execute($connection, "rep_ok", array($_SESSION['email']));

                $row = pg_fetch_assoc($res);
                if ($row['ruolo'] == 'Primo livello') {
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='update_seg.php'>Gestisci profili segreteria</a>";
                    echo "</li>";  
                }
            ?>

            <li>
                <form action="logout.php" method="get" id="bottone_logout">
                    <button class="nav-link" type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>