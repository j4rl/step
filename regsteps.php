<?php require_once("func.php") ?>
<?php
    $comp=0;
    if (isset($_POST['btn'])){
        $compid=intval($_POST['comp']);
        $steps=intval($_POST['steps']);
        $userid=intval($_SESSION['uid']);
       $sql="INSERT INTO tblsteps (steps, userid, compid) VALUES ($steps, $userid, $compid)";
       $result=$db->runQuery($sql);
       header("Location: index.php");

    }
    if(isset($_GET['comp'])){
        $comp = $_GET['comp'];
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
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
</body>
</html>