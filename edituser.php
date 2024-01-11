<!DOCTYPE html>
<?php
    require_once('../../func.php');
    $conn=makeConn('can');

    //Is editform submitted?
    if(isset($_POST['btn'])){
        $id=$_POST['id'];
        $user=$_POST['usr'];
        $pass=$_POST['pwd'];
        $level=intval($_POST['lvl']);
        $real=$_POST['real'];
        $last=intval($_POST['lastlogin']);
        $sql="UPDATE tbluser SET user='$user', pass='$pass', realname='$real', lastlogin=$last, level=$level WHERE id=$id";
        $result=mysqli_query($conn, $sql);
        header("Location: listuser.php");
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit user</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body>
<?php require_once("../../includes/_aheader.php"); ?>
<?php require_once("../../includes/_menu.php"); ?>
 
<div class="main">
    <?php
//first time around, lets check if we got a redirection from listuser (is there a $_GET)?
    if(isset($_GET['edit'])){
        $id=$_GET['edit'];
        $sql="SELECT * FROM tbluser WHERE id=$id";
        $result=mysqli_query($conn, $sql);
        $user=mysqli_fetch_assoc($result);
?>
    <form method="post" action="edituser.php"><h1>Edit user</h1>
        <input type="text" name="real" value="<?=$user['realname']?>">
        <input type="hidden" name="id" value="<?=$user['id']?>">
        <input type="text" name="fakeid" value="<?=$user['id']?>" disabled>
        <input type="text" name="usr" value="<?=$user['user']?>">
        <input type="hidden" name="pwd" value="<?=$user['pass']?>">
        <input type="password" name="fakepwd" value="<?=$user['pass']?>" disabled>
        <input type="hidden" name="lastlogin" value="<?=$user['lastlogin']?>">
        <input type="text" name="fakelogin" value="<?=fixDate($user['lastlogin'])?>" disabled>
        <div class="fullformdiv">
            <input type="range" name="lvl" id="lvl" min="1" max="200" value="<?=$user['level']?>" onchange="showLevel()">
            <span id="nrlevel"></span>
        </div>
        <input type="submit" value="Submit changes" name="btn">
    </form>
<?php  } ?>

</div>  
<?php require_once("../../includes/_footer.php"); ?>       
</body>
</html>
<script>
        function showLevel(){
        var level=document.getElementById('lvl').value;
        document.getElementById('nrlevel').innerHTML=level;
        }
        showLevel();



</script>