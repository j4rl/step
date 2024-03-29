<?php
    require_once('func.php');
    ob_start();
    if(!isLevel(100)) header("Location: index.php");
    //Is editform submitted?
    if(isset($_POST['btn'])){
        $id=$_POST['id'];
        $user=$_POST['usr'];
        $pass=$_POST['pwd'];
        $team=intval($_POST['team']);
        $level=intval($_POST['lvl']);
        $real=$_POST['real'];
        $sql="UPDATE tbluser SET username='$user', password='$pass', name='$real', userlevel=$level, team=$team WHERE userid=$id";
        $result=$db->runQuery($sql);
        header("Location: adm_dash.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("_head.php") ?>
<body>
<header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Ändra användare</header>
 
<main>
    <?php
//first time around, lets check if we got a redirection from listuser (is there a $_GET)?
    if(isset($_GET['edit'])){
        $id=intval($_GET['edit']);
        $sql="SELECT * FROM tbluser WHERE userid=$id";
        $result=$db->runQuery($sql);
        $user=$result->fetch_assoc();
?>
    <form method="post" action="edituser.php"><h1>Ändra användare</h1>
        <label for="real">För och efternamn</label>
        <input type="text" name="real" value="<?=$user['name']?>">

        <input type="hidden" name="id" value="<?=$user['userid']?>">
        <label for="fakeid">ID</label>
        <input type="text" name="fakeid" value="<?=$user['userid']?>" disabled>
        <label for="usr">Användarnamn</label>
        <input type="text" name="usr" value="<?=$user['username']?>">
        <input type="hidden" name="pwd" value="<?=$user['password']?>">
        <label for="fakepwd">Lösenord</label>
        <input type="password" name="fakepwd" value="<?=$user['password']?>" disabled>
        <label for="team"><?=$db->getTeamName($user['team'])?></label>
        <input type="text" name="team" id="team" value="<?=$user['team']?>">
        <div class="fullformdiv">
            <label for="lvl">Användarbehörighet (10-normal, 100-admin)</label>
            <input type="range" name="lvl" id="lvl" min="1" max="200" value="<?=$user['userlevel']?>" onchange="showLevel()">
            <span id="nrlevel"></span>
        </div>
        <input type="submit" value="Skicka" name="btn">
    </form>
<?php  } ?>

    </main>   
<?php require_once("_footer.php") ?>   
</body>
</html>
<script>
        function showLevel(){
        var level=document.getElementById('lvl').value;
        document.getElementById('nrlevel').innerHTML=level;
        }
        showLevel();



</script>