<?php require_once("func.php") ?>
<?php if(!isLevel(100)) header("Location: index.php"); ?>
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
<header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Admin</header>
    <nav>
        <a href="index.php">Tillbaka</a>
        <a href="adm_dash.php">Admin&nbsp;hem</a>
        <a href="reguser.php">Ny&nbsp;stegtävling</a>
    </nav>
    <main>
        <div class="row">
        <section class="adm_users">
            <!--  Lista användare  -->
            <?php require_once("listuser.php"); ?>
        </section>
        <section class="adm_steps">
            <h1>Steg</h1>
            <!-- Lista allas steginlämningar -->
            <form action="adm_dash.php" method="post">
                <label for="stepsearch">Sök användare</label>
                <input type="search" name="stepsearch" id="stepsearch" placeholder="Skriv namn eller användarnamn">
                <input type="submit" name="btn" value="Sök">
            </form>
        </section>            
        </div>
        <div class="row">
        <section class="adm_comp">
            <!-- Lista tävlingar -->
            <?php require_once("listcomp.php"); ?>
        </section>

        <section class="adm_teams">
            <!-- Lista alla lag -->
            <?php require_once("listteam.php"); ?>
        </section>            
        </div>

    </main>
    <footer class="cen">&copy;jarl</footer>    
</body>
</html>