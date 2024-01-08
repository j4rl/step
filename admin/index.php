<?php require_once('../../Connections/db.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysqli_select_db($database_db, $db);
$query_rs = "SELECT * FROM tblnames";
$rs = mysql_query($query_rs, $db) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
<!doctype html>
<html>
<head>
<style>
      tr:nth-of-type(even) {      background-color:#ddd;    }
    </style>
<meta charset="utf-8">
<title>Admin</title>
<link href="../step.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="logo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin
    </div>
<br/><a href="new.php">Lägg till ny</a><br/>
<table width="100%" border="0" cellspacing="1" cellpadding="2" class="tableback">
  <tr class="headrow">
    <td width="5%">ID</td>
    <td>Namn</td>
    <td width="10%">Arbetslag</td>
    <td width="10%">RO</td>
    <td width="20%">&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_rs['ID']; ?></td>
      <td><a href="pers.php?namn=<?php echo $row_rs['name']; ?>"><?php echo $row_rs['name']; ?></a></td>
      <td align="center"><?php echo $row_rs['arbetslag']; ?></td>
      <td align="center"><?php echo $row_rs['RO']; ?></td>
      <td align="center"><a href="edit.php?ID=<?php echo $row_rs['ID']; ?>" class="actionlink">EDIT</a>&nbsp;/&nbsp;<a href="del.php?ID=<?php echo $row_rs['ID']; ?>" class="actionlink">DEL</a></td>
    </tr>
    <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rs);
?>
