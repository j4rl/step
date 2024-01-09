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

mysqli_select_db($database_db, $db);
$query_rs = "SELECT * FROM tblnames";
$rs = mysql_query($query_rs, $db) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);



$totalRows_rs = mysql_num_rows($rs);

if(isset($_GET['term'])){
	$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends
}else{
	$term='';
};
$qstring = "SELECT name as value,ID,RO FROM tblnames WHERE name LIKE '%".$term."%'";
$result = mysql_query($qstring,$db);//query the database for entries containing the term

while ($row = mysql_fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
{
		$row['value']=htmlentities(stripslashes($row['value']));
		$row['ID']=(int)$row['ID'];
		$row['RO']=$row['RO'];
		$row_set[] = $row;//build an array
}
echo json_encode($row_set);//format the array into json data


mysql_free_result($rs);
?>
