<?php
    require_once("func.php");
    ob_start();
    if(isset($_POST['btnLogin'])){
        if($db->checkUser($_POST['username'], $_POST['password'])) header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("_head.php") ?>
<body class="cen">
<header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Logga in</header>
    <main>
        <form action="login.php" autocomplete="off" method="POST">
            <input type="text" name="username" placeholder="Användarnamn" autocomplete="off" required>
            <input type="password" name="password" autocomplete="new-password" required>
            <input type="submit" name="btnLogin" value="Logga in">
        </form>
</main>
        <?php require_once("_footer.php") ?>
</body>
</html>
