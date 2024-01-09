<?php require_once('db.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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
$query_rsRO2 = "SELECT * FROM tblsteps WHERE RO = 'RO2' AND termin = 'HT16'";
$rsRO2 = mysql_query($query_rsRO2, $db) or die(mysql_error());
$row_rsRO2 = mysql_fetch_assoc($rsRO2);
$totalRows_rsRO2 = mysql_num_rows($rsRO2);

mysqli_select_db($database_db, $db);
$query_rsRO3 = "SELECT * FROM tblsteps WHERE RO = 'RO3' AND termin = 'HT16'";
$rsRO3 = mysql_query($query_rsRO3, $db) or die(mysql_error());
$row_rsRO3 = mysql_fetch_assoc($rsRO3);
$totalRows_rsRO3 = mysql_num_rows($rsRO3);

mysqli_select_db($database_db, $db);
$query_rsRO4 = "SELECT * FROM tblsteps WHERE RO = 'RO4' AND termin = 'HT16'";
$rsRO4 = mysql_query($query_rsRO4, $db) or die(mysql_error());
$row_rsRO4 = mysql_fetch_assoc($rsRO4);
$totalRows_rsRO4 = mysql_num_rows($rsRO4);

mysqli_select_db($database_db, $db);
$query_rsRO5 = "SELECT * FROM tblsteps WHERE RO = 'RO5' AND termin = 'HT16'";
$rsRO5 = mysql_query($query_rsRO5, $db) or die(mysql_error());
$row_rsRO5 = mysql_fetch_assoc($rsRO5);
$totalRows_rsRO5 = mysql_num_rows($rsRO5);

mysqli_select_db($database_db, $db);
$query_rsADM = "SELECT * FROM tblsteps WHERE RO = 'ADM' AND termin = 'HT16'";
$rsADM = mysql_query($query_rsADM, $db) or die(mysql_error());
$row_rsADM = mysql_fetch_assoc($rsADM);
$totalRows_rsADM = mysql_num_rows($rsADM);

mysqli_select_db($database_db, $db);
$query_rsSumRO2 = "SELECT * FROM tblsteps WHERE RO = 'RO2' AND termin = 'HT16' ORDER BY steg DESC";
$rsSumRO2 = mysql_query($query_rsSumRO2, $db) or die(mysql_error());
$row_rsSumRO2 = mysql_fetch_assoc($rsSumRO2);
$totalRows_rsSumRO2 = mysql_num_rows($rsSumRO2);

mysqli_select_db($database_db, $db);
$query_rsSumRO3 = "SELECT * FROM tblsteps WHERE RO = 'RO3' AND termin = 'HT16' ORDER BY steg DESC";
$rsSumRO3 = mysql_query($query_rsSumRO3, $db) or die(mysql_error());
$row_rsSumRO3 = mysql_fetch_assoc($rsSumRO3);
$totalRows_rsSumRO3 = mysql_num_rows($rsSumRO3);

mysqli_select_db($database_db, $db);
$query_rsSumRO4 = "SELECT * FROM tblsteps WHERE RO = 'RO4' AND termin = 'HT16' ORDER BY steg DESC";
$rsSumRO4 = mysql_query($query_rsSumRO4, $db) or die(mysql_error());
$row_rsSumRO4 = mysql_fetch_assoc($rsSumRO4);
$totalRows_rsSumRO4 = mysql_num_rows($rsSumRO4);

mysqli_select_db($database_db, $db);
$query_rsSumRO5 = "SELECT * FROM tblsteps WHERE RO = 'RO5' AND termin = 'HT16' ORDER BY steg DESC";
$rsSumRO5 = mysql_query($query_rsSumRO5, $db) or die(mysql_error());
$row_rsSumRO5 = mysql_fetch_assoc($rsSumRO5);
$totalRows_rsSumRO5 = mysql_num_rows($rsSumRO5);

mysqli_select_db($database_db, $db);
$query_rsSumADM = "SELECT * FROM tblsteps WHERE RO = 'ADM' AND termin = 'HT16' ORDER BY steg DESC";
$rsSumADM = mysql_query($query_rsSumADM, $db) or die(mysql_error());
$row_rsSumADM = mysql_fetch_assoc($rsSumADM);
$totalRows_rsSumADM = mysql_num_rows($rsSumADM);

mysqli_select_db($database_db, $db);
$query_rsNamesRO2 = "SELECT DISTINCT namn FROM tblsteps WHERE RO='RO2'";
$rsNamesRO2 = mysql_query($query_rsNamesRO2, $db) or die(mysql_error());
$row_rsNamesRO2 = mysql_fetch_assoc($rsNamesRO2);
$totalRows_rsNamesRO2 = mysql_num_rows($rsNamesRO2);

mysqli_select_db($database_db, $db);
$query_rsNamesRO3 = "SELECT DISTINCT namn FROM tblsteps WHERE RO='RO3'";
$rsNamesRO3 = mysql_query($query_rsNamesRO3, $db) or die(mysql_error());
$row_rsNamesRO3 = mysql_fetch_assoc($rsNamesRO3);
$totalRows_rsNamesRO3 = mysql_num_rows($rsNamesRO3);

mysqli_select_db($database_db, $db);
$query_rsNamesRO4 = "SELECT DISTINCT namn FROM tblsteps WHERE RO='RO4'";
$rsNamesRO4 = mysql_query($query_rsNamesRO4, $db) or die(mysql_error());
$row_rsNamesRO4 = mysql_fetch_assoc($rsNamesRO4);
$totalRows_rsNamesRO4 = mysql_num_rows($rsNamesRO4);

mysqli_select_db($database_db, $db);
$query_rsNamesRO5 = "SELECT DISTINCT namn FROM tblsteps WHERE RO='RO5'";
$rsNamesRO5 = mysql_query($query_rsNamesRO5, $db) or die(mysql_error());
$row_rsNamesRO5 = mysql_fetch_assoc($rsNamesRO5);
$totalRows_rsNamesRO5 = mysql_num_rows($rsNamesRO5);

mysqli_select_db($database_db, $db);
$query_rsNamesADM = "SELECT DISTINCT namn FROM tblsteps WHERE RO='ADM'";
$rsNamesADM = mysql_query($query_rsNamesADM, $db) or die(mysql_error());
$row_rsNamesADM = mysql_fetch_assoc($rsNamesADM);
$totalRows_rsNamesADM = mysql_num_rows($rsNamesADM);

mysqli_select_db($database_db, $db);
$query_rsTopRO2 = "SELECT namn, RO, SUM( steg ) AS Summa FROM  tblsteps  WHERE RO ='RO2' AND termin = 'HT16' GROUP BY namn ORDER BY Summa DESC  LIMIT 0 , 10";
$rsTopRO2 = mysql_query($query_rsTopRO2, $db) or die(mysql_error());
$row_rsTopRO2 = mysql_fetch_assoc($rsTopRO2);
$totalRows_rsTopRO2 = mysql_num_rows($rsTopRO2);

mysqli_select_db($database_db, $db);
$query_rsTopRO3 = "SELECT namn, RO, SUM( steg ) AS Summa FROM  tblsteps  WHERE RO ='RO3' AND termin = 'HT16' GROUP BY namn ORDER BY Summa DESC  LIMIT 0 , 10";
$rsTopRO3 = mysql_query($query_rsTopRO3, $db) or die(mysql_error());
$row_rsTopRO3 = mysql_fetch_assoc($rsTopRO3);
$totalRows_rsTopRO3 = mysql_num_rows($rsTopRO3);

mysqli_select_db($database_db, $db);
$query_rsTopRO4 = "SELECT namn, RO, SUM( steg ) AS Summa FROM  tblsteps  WHERE RO ='RO4' AND termin = 'HT16' GROUP BY namn ORDER BY Summa DESC  LIMIT 0 , 10";
$rsTopRO4 = mysql_query($query_rsTopRO4, $db) or die(mysql_error());
$row_rsTopRO4 = mysql_fetch_assoc($rsTopRO4);
$totalRows_rsTopRO4 = mysql_num_rows($rsTopRO4);

mysqli_select_db($database_db, $db);
$query_rsTopRO5 = "SELECT namn, RO, SUM( steg ) AS Summa FROM  tblsteps  WHERE RO ='RO5' AND termin = 'HT16' GROUP BY namn ORDER BY Summa DESC  LIMIT 0 , 10";
$rsTopRO5 = mysql_query($query_rsTopRO5, $db) or die(mysql_error());
$row_rsTopRO5 = mysql_fetch_assoc($rsTopRO5);
$totalRows_rsTopRO5 = mysql_num_rows($rsTopRO5);

mysqli_select_db($database_db, $db);
$query_rsTopADM = "SELECT namn, RO, SUM( steg ) AS Summa FROM  tblsteps  WHERE RO ='ADM' AND termin = 'HT16' GROUP BY namn ORDER BY Summa DESC  LIMIT 0 , 10";
$rsTopADM = mysql_query($query_rsTopADM, $db) or die(mysql_error());
$row_rsTopADM = mysql_fetch_assoc($rsTopADM);
$totalRows_rsTopADM = mysql_num_rows($rsTopADM);

mysqli_select_db($database_db, $db);
$query_rsTopAL = "SELECT arbetslag, SUM( steg ) AS Summa FROM tblsteps WHERE termin = 'HT16' GROUP BY arbetslag ORDER BY Summa DESC";
$rsTopAL = mysql_query($query_rsTopAL, $db) or die(mysql_error());
$row_rsTopAL = mysql_fetch_assoc($rsTopAL);
$totalRows_rsTopAL = mysql_num_rows($rsTopAL);
?>
<?php
//-----------------------------------------------------------RO2
	$sumStepsRO2=0;
	do { 
		$sumStepsRO2=$sumStepsRO2+$row_rsRO2['steg'];			
	} while ($row_rsRO2 = mysql_fetch_assoc($rsRO2));
	if($totalRows_rsRO2){
	$avgStepsRO2=intval($sumStepsRO2/$totalRows_rsNamesRO2);
	}else{ $avgStepsRO2=0;};
//-----------------------------------------------------------RO3
	$sumStepsRO3=0;
	do { 
		$sumStepsRO3=$sumStepsRO3+$row_rsRO3['steg'];			
	} while ($row_rsRO3 = mysql_fetch_assoc($rsRO3));
	if($totalRows_rsRO3){
	$avgStepsRO3=intval($sumStepsRO3/$totalRows_rsNamesRO3);
	}else{ $avgStepsRO3=0;};
//-----------------------------------------------------------RO4
	$sumStepsRO4=0;
	do { 
		$sumStepsRO4=$sumStepsRO4+$row_rsRO4['steg'];			
	} while ($row_rsRO4 = mysql_fetch_assoc($rsRO4));
	if($totalRows_rsRO4){
	$avgStepsRO4=intval($sumStepsRO4/$totalRows_rsNamesRO4);
	}else{ $avgStepsRO4=0;};
//-----------------------------------------------------------RO5
	$sumStepsRO5=0;
	do { 
		$sumStepsRO5=$sumStepsRO5+$row_rsRO5['steg'];			
	} while ($row_rsRO5 = mysql_fetch_assoc($rsRO5));
	if($totalRows_rsRO5){
	$avgStepsRO5=intval($sumStepsRO5/$totalRows_rsNamesRO5);
	}else{ $avgStepsRO5=0;};
//-----------------------------------------------------------ADM
	$sumStepsADM=0;
	do { 
		$sumStepsADM=$sumStepsADM+$row_rsADM['steg'];			
	} while ($row_rsADM = mysql_fetch_assoc($rsADM));
	if($totalRows_rsADM){
	$avgStepsADM=intval($sumStepsADM/$totalRows_rsNamesADM);
	}else{ $avgStepsADM=0;};
//-----------------------------------------------------------
	$totAvgSum=$avgStepsRO2+$avgStepsRO3+$avgStepsRO4+$avgStepsRO5+$avgStepsADM;
	//if($totSum) $scaleFactor=$intSteps/$totSum;

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
	<div class="logo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stegutmaningen
  		<!--div class="addbox"><a href="addsteps.php" class="addsteps">Lägg in</a></div-->
    </div>
	<div class="statbox">
		<div class="content">&nbsp;&nbsp;&nbsp;Område
    			<div width="100%">
      				<div class="barlabel">RO2</div>
      				<div class="bar" ><?php echo $avgStepsRO2; ?> steg i snitt, totalt <?php echo $sumStepsRO2;?> steg</div>
                   	<details><summary>Topp RO2</summary>
						<ul>
                          <?php do { ?>
                            <li><?php echo $row_rsTopRO2['namn']; ?> <?php echo $row_rsTopRO2['Summa']; ?> steg</li>
                            <?php } while ($row_rsTopRO2 = mysql_fetch_assoc($rsTopRO2)); ?>
                        </ul>
                    </details> 
    			</div>
    			<div width="100%">
      				<div class="barlabel">RO3</div>
      				<div class="bar" ><?php echo $avgStepsRO3; ?> steg i snitt, totalt <?php echo $sumStepsRO3;?> steg</div>
                   	<details><summary>Topp RO3</summary>
						<ul>
                          <?php do { ?>
                            <li><?php echo $row_rsTopRO3['namn']; ?> <?php echo $row_rsTopRO3['Summa']; ?> steg</li>
                            <?php } while ($row_rsTopRO3 = mysql_fetch_assoc($rsTopRO3)); ?>
                        </ul>
                    </details> 
    			</div>
    			<div width="100%">
      				<div class="barlabel">RO4</div>
      				<div class="bar" ><?php echo $avgStepsRO4; ?> steg i snitt, totalt <?php echo $sumStepsRO4;?> steg</div>
                   	<details><summary>Topp RO4</summary>
						<ul>
                          <?php do { ?>
                          <li><?php echo $row_rsTopRO4['namn']; ?> <?php echo $row_rsTopRO4['Summa']; ?> steg</li>
                            <?php } while ($row_rsTopRO4 = mysql_fetch_assoc($rsTopRO4)); ?>
                        </ul>
                    </details>                    
    			</div>
    			<div width="100%">
      				<div class="barlabel">RO5</div>
      				<div class="bar" ><?php echo $avgStepsRO5; ?> steg i snitt, totalt <?php echo $sumStepsRO5;?> steg</div>
                   	<details><summary>Topp RO5</summary>
						<ul>
                          <?php do { ?>
                          <li><?php echo $row_rsTopRO5['namn']; ?> <?php echo $row_rsTopRO5['Summa']; ?> steg</li>
                            <?php } while ($row_rsTopRO5 = mysql_fetch_assoc($rsTopRO5)); ?>
                        </ul>
                    </details>                    
    			</div>
    			<div width="100%">
      				<div class="barlabel">ADM</div>
      				<div class="bar" ><?php echo $avgStepsADM; ?> steg i snitt, totalt <?php echo $sumStepsADM;?> steg</div>
                   	<details><summary>Topp ADM</summary>
						<ul>
                          <?php do { ?>
                          <li><?php echo $row_rsTopADM['namn']; ?> <?php echo $row_rsTopADM['Summa']; ?> steg</li>
                            <?php } while ($row_rsTopADM = mysql_fetch_assoc($rsTopADM)); ?>
                        </ul>
                    </details>                    
    			</div>
                <br>
<details><summary>Topplista arbetslag</summary>
                    <ul>
                      <?php do { ?>
                      <li><b><?php echo $row_rsTopAL['arbetslag']; ?>:</b> <?php echo $row_rsTopAL['Summa']; ?> steg</li>
                        <?php } while ($row_rsTopAL = mysql_fetch_assoc($rsTopAL)); ?>
                    </ul>
                    </details>
        </div>
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($rsRO2);
mysql_free_result($rsRO3);
mysql_free_result($rsRO4);
mysql_free_result($rsRO5);
mysql_free_result($rsADM);

mysql_free_result($rsSumRO2);
mysql_free_result($rsSumRO3);
mysql_free_result($rsSumRO4);
mysql_free_result($rsSumRO5);
mysql_free_result($rsSumADM);

mysql_free_result($rsNamesRO2);
mysql_free_result($rsNamesRO3);
mysql_free_result($rsNamesRO4);
mysql_free_result($rsNamesRO5);
mysql_free_result($rsNamesADM);

mysql_free_result($rsTopRO2);
mysql_free_result($rsTopRO3);
mysql_free_result($rsTopRO4);
mysql_free_result($rsTopRO5);
mysql_free_result($rsTopADM);


mysql_free_result($rsTopAL);
?>
