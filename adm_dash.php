<?php require_once("func.php") ?>
<?php
$db=new Database("step");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js"></script>
</head>
<body>
<header><img src="Mockelngymnasiet-logo-rgb-120.gif" alt="Logo"></header>
    <nav>
        <a href="index.php">Tillbaka</a>
        <a href="adm_dash.php">Admin&nbsp;hem</a>
        <a href="reguser.php">Ny&nbsp;stegtävling</a>
    </nav>
    <main>
        <section class="adm_users">
            <!--  Lista användare  -->
        </section>
        <section class="adm_comp">
            <!-- Lista tävlingar -->
        </section>
        <section class="adm_steps">
            <!-- Lista allas steginlämningar -->
        </section>
        <section class="adm_teams">
            <!-- Lista alla lag -->
        </section>
    </main>
    <footer class="cen">&copy;jarl</footer>    
</body>
</html>