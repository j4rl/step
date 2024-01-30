<?php
    session_start();
    ob_start();
    $_SESSION['uid']="";
    $_SESSION['name']="";
    $_SESSION['lvl']="";
    session_destroy();
    header("Location: index.php");
?>