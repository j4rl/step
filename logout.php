<?php
    session_destroy();
    $db->$loggedInUser = false;
    header("Location: index.php");
?>