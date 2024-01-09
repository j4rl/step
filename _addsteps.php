<?php require_once('../Connections/db.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "AddSteps")) {
  $insertSQL = sprintf("INSERT INTO tblsteps (namn, arbetslag, RO, steg, termin) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['AL'], "text"),
                       GetSQLValueString($_POST['RO'], "text"),
                       GetSQLValueString($_POST['steps'], "int"),
                       GetSQLValueString($_POST['termin'], "text"));

  mysqli_select_db($database_db, $db);
  $Result1 = mysql_query($insertSQL, $db) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysqli_select_db($database_db, $db);
$query_nameset = "SELECT * FROM tblnames ORDER BY RO, arbetslag ASC";
$nameset = mysql_query($query_nameset, $db) or die(mysql_error());
$row_nameset = mysql_fetch_assoc($nameset);
$totalRows_nameset = mysql_num_rows($nameset);

mysqli_select_db($database_db, $db);
$query_rsAL = "SELECT arbetslag FROM tblnames GROUP BY arbetslag ORDER BY arbetslag ASC";
$rsAL = mysql_query($query_rsAL, $db) or die(mysql_error());
$row_rsAL = mysql_fetch_assoc($rsAL);
$totalRows_rsAL = mysql_num_rows($rsAL);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Step</title>
<link href="step.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="mainbox">
	<div class="logo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lägg in dina framsteg
     </div>
	<div class="statbox">
	  <form action="<?php //echo $editFormAction; ?>" method="POST" name="AddSteps" class="addform">
   	    <select name="name" id="name"><option value="Välj namn här" selected>Välj namn här</option>
   	      <?php
do {  
?>
   	      <option value="<?php echo $row_nameset['name']?>"><?php echo $row_nameset['name']?></option>
   	      <?php
} while ($row_nameset = mysql_fetch_assoc($nameset));
  $rows = mysql_num_rows($nameset);
  if($rows > 0) {
      mysql_data_seek($nameset, 0);
	  $row_nameset = mysql_fetch_assoc($nameset);
  }
?>
          </select>&nbsp;
          <select name="RO" id="RO">
            <option value="RO2">RO2</option>
            <option value="RO3">RO3</option>
            <option value="RO4">RO4</option>
            <option value="RO5">RO5</option>
            <option value="ADM">ADM</option>
        </select>
          &nbsp;
                    <select name="AL" id="RO">
                      <?php
do {  
?>
                      <option value="<?php echo $row_rsAL['arbetslag']?>"><?php echo $row_rsAL['arbetslag']?></option>
                      <?php
} while ($row_rsAL = mysql_fetch_assoc($rsAL));
  $rows = mysql_num_rows($rsAL);
  if($rows > 0) {
      mysql_data_seek($rsAL, 0);
	  $row_rsAL = mysql_fetch_assoc($rsAL);
  }
?>
        </select>
&nbsp;<input name="steps" type="number" id="steps" value="Antal steg">&nbsp;&nbsp;<!--input name="btn" type="submit" id="btn" value="Lägg in" /-->
          <input name="termin" type="hidden" id="termin" value="HT16">
          <input type="hidden" name="MM_insert" value="AddSteps">
	  </form>
      <br/>
      <div class="content">
      <details>
      	<summary>Hur fyller jag i?</summary>
        Välj ditt namn, ditt rektorsområde och arbetslag, fyll sedan i antal steg som din stegmätare visar.<br/>(Är man rektor, fyller man i det som arbetslag) Nollställ sedan din stegräknare.<br/>Klicka på "Lägg in"<br/>Klart!</details>
        </div>
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($nameset);

mysql_free_result($rsAL);
?>
