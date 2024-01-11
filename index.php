<?php require_once("func.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js"></script>
</head>
<body>
    <header><img src="Mockelngymnasiet-logo-rgb-120.gif" alt="Logo"></header>
    <?php if(!isset($_SESSION["uid"])){
        //show login form
    }else{
        //show logout link
    } ?>
    <nav>
        <a href="index.php">Hem</a>
        <a href="regsteps.php">Registrera&nbsp;steg</a>
        <a href="reguser.php">Registrera&nbsp;användare</a>
        <a href="admin.php">Admin</a>
    </nav>
    <main></main>
    <footer class="cen">&copy;jarl</footer>
    
</body>
</html>