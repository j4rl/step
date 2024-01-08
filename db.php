
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_db = "localhost";
$database_db = "step";
$username_db = "root";
$password_db = "";
$db = mysqli_connect($hostname_db, $username_db, $password_db) or trigger_error(mysqli_error(),E_USER_ERROR); 
?>