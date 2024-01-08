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

$colname_rs = "-1";
if (isset($_GET['namn'])) {
  $colname_rs = $_GET['namn'];
}
mysqli_select_db($database_db, $db);
$query_rs = sprintf("SELECT * FROM tblsteps WHERE namn = %s ORDER BY inlagt ASC", GetSQLValueString($colname_rs, "text"));
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
<br/><br/>
<span class="formrubrik">Personuppgifter</span><br/><br/>
<span class="fatname"><b><?php echo $row_rs['namn']; ?></b> i arbetslag <?php echo $row_rs['arbetslag']; ?></span><br>
<?php echo $row_rs['RO']; ?>:<?php echo $row_rs['termin']; ?><br/>
Har lagt in <?php echo $totalRows_rs ?> gånger<br/><br/>


<table width="100%" border="0" cellspacing="1" cellpadding="2" class="tableback">
  <tr class="headrow">
    <td>Inlagt</td>
    <td>Steg</td>
  </tr>
  <?php do { ?>
  <tr>
    <td><a href="namnedit.php?ID=<?php echo $row_rs['stepsID']; ?>" class="actionlink"><?php echo $row_rs['inlagt']; ?></a></td>
    <td><?php echo $row_rs['steg']; ?></td>
  </tr>
  <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
</table>

</body>
</html>
<?php
mysql_free_result($rs);
?>
