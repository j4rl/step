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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tblsteps SET namn=%s, arbetslag=%s, RO=%s, steg=%s, inlagt=%s, termin=%s WHERE stepsID=%s",
                       GetSQLValueString($_POST['namn'], "text"),
                       GetSQLValueString($_POST['arbetslag'], "text"),
                       GetSQLValueString($_POST['RO'], "text"),
                       GetSQLValueString($_POST['steg'], "int"),
                       GetSQLValueString($_POST['inlagt'], "date"),
                       GetSQLValueString($_POST['termin'], "text"),
                       GetSQLValueString($_POST['stepsID'], "int"));

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
$query_rs = sprintf("SELECT * FROM tblsteps WHERE stepsID = %s", GetSQLValueString($colname_rs, "int"));
$rs = mysql_query($query_rs, $db) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Namnlöst dokument</title>
<link href="../step.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="logo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin
    </div>
<br/><br/>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>" class="editform"><table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td><input name="namn" type="text" class="formbox" value="<?php echo $row_rs['namn']; ?>">
<input name="stepsID" type="hidden" id="hiddenField" value="<?php echo $row_rs['stepsID']; ?>">
<input name="arbetslag" type="hidden" id="hiddenField2" value="<?php echo $row_rs['arbetslag']; ?>">
<input name="RO" type="hidden" id="hiddenField3" value="<?php echo $row_rs['RO']; ?>">
<input name="steg" type="hidden" id="hiddenField4" value="<?php echo $row_rs['steg']; ?>">
<input name="inlagt" type="hidden" id="hiddenField5" value="<?php echo $row_rs['inlagt']; ?>">
<input name="termin" type="hidden" id="hiddenField6" value="<?php echo $row_rs['termin']; ?>">
</td>
  </tr>
  <tr>
    <td align="right"><input name="button" type="submit" class="formbutton" id="button" value="Ändra namn">
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
