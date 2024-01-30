<!DOCTYPE html>
<?php
    require_once('func.php');
    ob_start();
    if(!isLevel(100)) header("Location: index.php");
    //Is editform submitted?
    if(isset($_POST['btn'])){
        $id=$_POST['id'];
        $comp=$_POST['comp'];
        $start=$_POST['start'];
        $stop=$_POST['stop'];
        $sql="UPDATE tblcomp SET compname='$comp', startdate='$start', stopdate='$stop' WHERE compid=$id";
        $result=$db->runQuery($sql);
        header("Location: adm_dash.php");
    }

?>
<html lang="en">
<?php require_once("_head.php") ?>
<body>
<header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Ändra tävling</header>
 
<main>
    <?php
//first time around, lets check if we got a redirection from listuser (is there a $_GET)?
    if(isset($_GET['edit'])){
        $id=intval($_GET['edit']);
        $sql="SELECT * FROM tblcomp WHERE compid=$id";
        $result=$db->runQuery($sql);
        $comp=$result->fetch_assoc();
?>
    <form method="post" action="editcomp.php"><h1>Ändra tävling</h1>
    <label for="comp">Namn på tävlingen</label>
        <input type="text" name="comp" value="<?=$comp['compname']?>">
        <input type="hidden" name="id" value="<?=$comp['compid']?>">
        <label for="start">Startdatum</label>
        <input type="date" name="start" value="<?=$comp['startdate']?>">
        <label for="stop">Slutdatum</label>
        <input type="date" name="stop" value="<?=$comp['stopdate']?>">
        <input type="submit" value="Skicka" name="btn">
    </form>
<?php  } ?>

    </main> 
<?php require_once("_footer.php") ?>     
</body>
</html>
