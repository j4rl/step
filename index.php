<?php require_once("func.php");  ?>
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
    <nav>
        <a href="index.php">Hem</a>
		<?php if(isLoggedIn()){ ?><a href="regsteps.php">Registrera&nbsp;steg</a><?php }; ?>       
        <?php if(isAdmin()){ ?><a href="admin.php">Admin</a><?php }; ?>
		<?php if(!isLoggedIn()){ ?><a href="reguser.php">Registrera&nbsp;användare</a><?php }; ?>
		<?php if(isLoggedIn()){ ?><a href="logout.php">Logga&nbsp;ut</a><?php }else{ ?><a href="login.php">Logga&nbsp;in</a><?php }; ?>
    </nav>
    <main></main>
    <footer class="cen">&copy;j4rl</footer>
    
</body>
</html>