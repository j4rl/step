<?php
    session_start();
    require_once("func.php");
    ob_start();
    if(!isLevel(100)) header("Location: index.php");
    $id=intval($_GET["del"]);
    $sql="DELETE FROM tblteam WHERE teamid=$id";
    $result=$db->runQuery($sql);
    if($db->cleanSteps()){};
    header("Location: adm_dash.php");
?>