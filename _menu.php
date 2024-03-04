<i class="fi fi-rr-menu-burger" id="borg"></i>
<nav>
    <div class="menu">
        <a href="index.php">Hem</a>     
        <?php if(isLevel(100)){ ?><a href="adm_dash.php">Admin</a><?php }; ?>
        <?php if(!isLoggedIn()){ ?><a href="reguser.php">Registrera&nbsp;användare</a><?php }; ?>
    </div>
	<div class="loginout"><?php if(isLoggedIn()){ ?><a href="logout.php">Logga&nbsp;ut</a><?php }else{ ?><a href="login.php">Logga&nbsp;in</a><?php }; ?></div>
</nav>