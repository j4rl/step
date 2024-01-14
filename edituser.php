<!DOCTYPE html>
<?php
    require_once('func.php');
    if(!isLevel(100)) header("Location: index.php");
    //Is editform submitted?
    if(isset($_POST['btn'])){
        $id=$_POST['id'];
        $user=$_POST['usr'];
        $pass=$_POST['pwd'];
        $level=intval($_POST['lvl']);
        $real=$_POST['real'];
        $sql="UPDATE tbluser SET username='$user', password='$pass', name='$real', userlevel=$level WHERE userid=$id";
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
        $sql="SELECT * FROM tbluser WHERE userid=$id";
        $result=$db->runQuery($sql);
        $user=$result->fetch_assoc();
?>
    <form method="post" action="edituser.php"><h1>Ändra användare</h1>
        <input type="text" name="real" value="<?=$user['name']?>">
        <input type="hidden" name="id" value="<?=$user['userid']?>">
        <input type="text" name="fakeid" value="<?=$user['userid']?>" disabled>
        <input type="text" name="usr" value="<?=$user['username']?>">
        <input type="hidden" name="pwd" value="<?=$user['password']?>">
        <input type="password" name="fakepwd" value="<?=$user['password']?>" disabled>
        <div class="fullformdiv">
            <input type="range" name="lvl" id="lvl" min="1" max="200" value="<?=$user['userlevel']?>" onchange="showLevel()">
            <span id="nrlevel"></span>
        </div>
        <input type="submit" value="Skicka" name="btn">
    </form>
<?php  } ?>

</div>      
</body>
</html>
<script>
        function showLevel(){
        var level=document.getElementById('lvl').value;
        document.getElementById('nrlevel').innerHTML=level;
        }
        showLevel();



</script>