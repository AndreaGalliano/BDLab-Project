<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unitua Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php 
        include_once("check_not_login.php");
        
        if (isset($_SESSION['autenticazione_fallita'])) {
            echo "<p>".$_SESSION['autenticazione_fallita']."</p>";
            unset($_SESSION['autenticazione_fallita']);
        }
    ?>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST" action="../script/index_login.php">
        <h3>Login Unitua</h3>

        <label for="username">Indirizzo Email</label>
        <input type="text" placeholder="Email" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>
        <br/>
        <button type="submit">Log In</button>
    </form>
</body>
</html>