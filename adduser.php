<!DOCTYPE html>
<?php
    require_once('func.php');
    if(!isLevel(100)) header("Location: index.php");
    if(isset($_POST['btn'])){
        $user=$_POST['usr'];
        $real=$_POST['real'];
        $pass=md5($_POST['pwd']);
        $sql="INSERT INTO tbluser (username, password, name) VALUES ('$user', '$pass', '$real')";
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
    <form autocomplete="false" method="post" action="adduser.php">
        <label for="usr">Användarnamn</label>
        <input type="text" name="usr" placeholder="Användarnamn" required>
        <label for="real">För och efternamn</label>
        <input type="text" name="real" placeholder="Ditt namn" required>
        <label for="pwd">Lösenord</label>
        <input autocomplete="new-password" type="password" name="pwd" required>
        <input type="submit" value="Lägg till användare" name="btn">
    </form>
</div>

</body>
</html>