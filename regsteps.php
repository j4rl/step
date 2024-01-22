<?php require_once("func.php") ?>
<?php
    $comp=0;
    if (isset($_POST['btn'])){
        $compid=intval($_POST['comp']);
        $steps=intval($_POST['steps']);
        $userid=intval($_SESSION['uid']);
        $team=intval($_SESSION['team']);
       $sql="INSERT INTO tblsteps (steps, user, comp, team) VALUES ($steps, $userid, $compid, $team)";
       $result=$db->runQuery($sql);
       header("Location: index.php");

    }
    if(isset($_GET['comp'])){
        $comp = $_GET['comp'];
    }


?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("_head.php") ?>
<body>
<?php if(isLoggedIn()){ ?>
    <form action="regsteps.php" method="POST">
        <h1>Fyll i steg</h1>
        <label for="steps"><?=$_SESSION['name']?> har gått</label>
        <input type="number" name="steps" id="steps" required placeholder="Ange antal steg">
        <input type="hidden" name="comp" value="<?=$comp?>">
        <input type="submit" value="Registrera steg" name="btn" id="btn">
    </form>
    <?php }; ?>
    <?php require_once("_footer.php") ?>
</body>
</html>