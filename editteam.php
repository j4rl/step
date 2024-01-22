<!DOCTYPE html>
<?php
    require_once('func.php');
    if(!isLevel(100)) header("Location: index.php");
    //Is editform submitted?
    if(isset($_POST['btn'])){
        $id=$_POST['id'];
        $teamname=$_POST['team'];
        $teamleader=intval($_POST['lead']);
        $sql="UPDATE tblteam SET teamname='$teamname', teamleader=$teamleader WHERE teamid=$id";
        $result=$db->runQuery($sql);
        header("Location: adm_dash.php");
    }

?>
<html lang="en">
<?php require_once("_head.php") ?>
<body>

 
<div class="main">
    <?php
//first time around, lets check if we got a redirection from listuser (is there a $_GET)?
    if(isset($_GET['edit'])){
        $id=intval($_GET['edit']);
        $sql="SELECT * FROM tblteam WHERE teamid=$id";
        $result=$db->runQuery($sql);
        $team=$result->fetch_assoc();
        $query="SELECT userid, name FROM tbluser ORDER BY name";
        $res=$db->runQuery($query);
?>
    <form method="post" action="editteam.php"><h1>Ändra lag</h1>
        <label for="team">Lagnamn</label>
        <input type="text" name="team" value="<?=$team['teamname']?>">
        <input type="hidden" name="id" value="<?=$team['teamid']?>">
        <label for="fakeid">Lag id</label>
        <input type="text" name="fakeid" value="<?=$team['teamid']?>" disabled>
        <label for="lead">Lagledare</label>
        <select name="lead" id="lead">
                <?php while($user=$res->fetch_assoc()){ ?>
                   <? if($user['userid']==$team['teamleader']) echo "selected" ?>  
                      <option value="<?=$user['userid']?>" <?php if($user['userid']==$team['teamleader']) echo "selected"; ?> ><?=$user['name']?></option>
               <?php } ?>
                </select>
        <input type="submit" value="Skicka" name="btn">
    </form>
<?php  } ?>

</div>  
<?php require_once("_footer.php") ?>    
</body>
</html>