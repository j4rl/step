<!DOCTYPE html>
<?php
    require_once('../../func.php');
    $conn=makeConn('can');
    
    if(isset($_POST['btn'])){
        $user=$_POST['usr'];
        $real=$_POST['real'];
        $pass=md5($_POST['pwd'].$user);
        $sql="INSERT INTO tbluser (user, pass, realname) VALUES ('$user', '$pass', '$real')";
        $result=mysqli_query($conn, $sql);
        header("Location: listuser.php");
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add user</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body>
<?php require_once("../../includes/_aheader.php"); ?>
<?php require_once("../../includes/_menu.php"); ?>
<div class="main">
    <form autocomplete="false" method="post" action="adduser.php">
        <input type="text" name="real" placeholder="Your name">
        <input type="text" name="usr" placeholder="Username">
        <input autocomplete="new-password" type="password" name="pwd">
        <input type="submit" value="Add user" name="btn">
    </form>
</div>
<?php require_once("../../includes/_footer.php"); ?>      
</body>
</html>