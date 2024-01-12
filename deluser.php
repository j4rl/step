<?php
    $dbserver="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="can";
    $conn=mysqli_connect($dbserver,$dbuser,$dbpass,$dbname);
    $id=$_GET["del"];
    $sql="DELETE FROM tbluser WHERE id=$id";
    $result=mysqli_query($conn, $sql);
    
    header("Location: listuser.php");

?>