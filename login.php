<?php
    require_once("func.php");
    if(isset($_POST['btnLogin'])){
        if($db->checkUser($_POST['username'], $_POST['password'])) header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("_head.php") ?>
<body class="cen">
    <div class="main">
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Användarnamn" required>
            <input type="password" name="password" required>
            <input type="submit" name="btnLogin" value="Logga in">
        </form>
    </div>
        <?php require_once("_footer.php") ?>
</body>
</html>