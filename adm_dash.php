<?php 
    require_once("func.php");
    ob_start(); 
?>
<?php if(!isLevel(100)) header("Location: index.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("_head.php") ?>
<body>
<header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Admin</header>
<?php require_once("_adm-menu.php") ?>
    <main>
        <div class="row">
        <section class="adm_users">
            <!--  Lista användare  -->
            <?php require_once("listuser.php"); ?>
        </section>
        <section class="adm_steps">
            <h1>Steg</h1>
            <p>Denna funktion är inte tillgänglig än</p>
            <!-- Lista allas steginlämningar -->
            <form action="adm_dash.php" method="post">
                <label for="stepsearch">Sök användare</label>
                <input type="search" name="stepsearch" id="stepsearch" placeholder="Skriv namn eller användarnamn" disabled>
                <input type="submit" name="btn" value="Sök" disabled>
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
    <?php require_once("_footer.php") ?>
</body>
</html>