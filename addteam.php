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
<?php require_once("_head.php") ?>
<body>
<header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Lägg till lag</header>
<main>
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
                </main>
<?php require_once("_footer.php") ?>
</body>
</html>