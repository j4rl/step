<!DOCTYPE html>
<?php
    require_once('func.php');
    if(!isLevel(100)) header("Location: index.php");
    if(isset($_POST['btn'])){
        $id=$_POST['id'];
        $teamname=$_POST['team'];
        $teamleader=intval($_POST['lead']);
        $sql="INSERT INTO tblteam (teamname, teamleader) VALUES ('$teamname', $teamleader)";
        $res=$db->runQuery($sql);
        header("Location: adm_dash.php");
    }else{
        $query="SELECT userid, name FROM tbluser ORDER BY name";
        $res=$db->runQuery($query);
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nytt lag</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main">
    <form autocomplete="false" method="post" action="addteam.php">
        <label for="usr">Lagnamn</label>
        <input type="text" name="team" placeholder="Lagnamn" required>
        <label for="lead">Lagledare</label>
        <select name="lead" id="lead">
                <?php while($user=$res->fetch_assoc()){ ?>
                   <? if($user['userid']==$team['teamleader']) echo "selected" ?>  
                      <option value="<?=$user['userid']?>"><?=$user['name']?></option>
               <?php } ?>
                </select>
        <input type="submit" value="Lägg till lag" name="btn">
    </form>
</div>

</body>
</html>