<?php
    session_start();
    require_once("func.php");
    if(!isLevel(100)) header("Location: index.php");
    $id=intval($_GET["del"]);
    $sql="DELETE FROM tblcomp WHERE compid=$id";
    $result=$db->runQuery($sql);
    
    header("Location: adm_dash.php");

?>