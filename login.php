<?php
    require_once("func.php");
    if(isset($_POST['btnLogin'])){
        if($db->checkUser($_POST['username'], md5($_POST['password']))) header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="cen">
        <form action="login.php">
            <input type="text" name="username" placeholder="Användarnamn" required>
            <input type="password" name="password" required>
            <input type="submit" value="Logga in">
        </form>
</body>
</html>