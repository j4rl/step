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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tblnames (name, RO, arbetslag) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['RO'], "text"),
                       GetSQLValueString($_POST['arbetslag'], "text"));

  mysqli_select_db($database_db, $db);
  $Result1 = mysql_query($insertSQL, $db) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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

<form name="form1" method="POST" action="<?php echo $editFormAction; ?>" class="editform">
<span class="formrubrik">Nya uppgifter</span><table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="2">  Namn:<br/>
  <input type="text" name="name" class="formbox"></td>
  </tr>
  <tr>
    <td>  Arbetslag:<br/>
  <input type="text" name="arbetslag" class="formbox"></td>
    <td>  Rektorsområde:<br/>
  <input type="text" name="RO" class="formbox"></td>
  </tr>
  <tr>
    <td></td>
    <td align="right"><input name="btnSubmit" type="submit" class="formbutton" value="Lägg in">
</td>
  </tr>
</table>
<input type="hidden" name="MM_insert" value="form1">

</form>
</body>
</html>