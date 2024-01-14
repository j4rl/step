<!DOCTYPE html>
<?php
    require_once('func.php');
    if(!isLevel(100)) header("Location: index.php");
    if(isset($_POST['btn'])){
        $comp=$_POST['comp'];
        $start=$_POST['start'];
        $stop=$_POST['stop'];
        $sql="INSERT INTO tblcomp (compname, startdate, stopdate) VALUES ('$comp', '$start', '$stop')";
        $result=$db->runQuery($sql);
        header("Location: adm_dash.php");
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add user</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main">
<form method="post" action="addcomp.php"><h1>Ny tävling</h1>
    <label for="comp">Namn på tävlingen</label>
        <input type="text" name="comp">
        <input type="hidden" name="id">
        <label for="start">Startdatum</label>
        <input type="date" name="start">
        <label for="stop">Slutdatum</label>
        <input type="date" name="stop">
        <input type="submit" value="Skicka" name="btn">
    </form>
</div>

</body>
</html>