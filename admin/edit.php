<?php require_once('../db.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tblnames SET name=%s, RO=%s, arbetslag=%s WHERE ID=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['RO'], "text"),
                       GetSQLValueString($_POST['arbetslag'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysqli_select_db($database_db, $db);
  $Result1 = mysql_query($updateSQL, $db) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rs = "-1";
if (isset($_GET['ID'])) {
  $colname_rs = $_GET['ID'];
}
mysqli_select_db($database_db, $db);
$query_rs = sprintf("SELECT * FROM tblnames WHERE ID = %s", GetSQLValueString($colname_rs, "int"));
$rs = mysql_query($query_rs, $db) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin</title>
<link href="../step.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="logo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin
    </div>
<br/><br/>

<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" class="editform">
<span class="formrubrik">Ändring av uppgifter</span>
<table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="2">  Namn:<br/>
  <input name="name" type="text" value="<?php echo $row_rs['name']; ?>" class="formbox"></td>
  </tr>
  <tr>
    <td>  Arbetslag:<br/>
  <input name="arbetslag" type="text" value="<?php echo $row_rs['arbetslag']; ?>" class="formbox"></td>
    <td>  Rektorsområde:<br/>
  <input name="RO" type="text" value="<?php echo $row_rs['RO']; ?>" class="formbox"></td>
  </tr>
  <tr>
    <td><input name="ID" type="hidden" id="ID" value="<?php echo $row_rs['ID']; ?>"></td>
    <td align="right"><input name="btnSubmit" type="submit" value="Ändra" class="formbutton">
</td>
  </tr>
</table>
<input type="hidden" name="MM_update" value="form1">

</form>
</body>
</html>
<?php
mysql_free_result($rs);
?>
