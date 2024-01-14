<!DOCTYPE html>
<?php
    require_once('func.php');
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
<head>
    <meta charset="UTF-8">
    <title>Edit user</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

 
<div class="main">
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

</div>      
</body>
</html>
