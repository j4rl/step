<?php
    session_start();
    $_SESSION['uid']="";
    $_SESSION['name']="";
    $_SESSION['lvl']="";
    session_destroy();
    header("Location: index.php");
?>