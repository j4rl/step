<?php require_once("func.php"); ?>
<?php
if(isset($_POST['btn'])){
    $selectedUsers = $_POST['selected_users'] ?? [];

// Skapa en array för att lagra unika userid
$selectedUserIds = array();


// Loopa igenom valda användare och lägg till deras userid i arrayen
foreach ($selectedUsers as $userId) {
    $selectedUserIds[] = (int)$userId; // Förhindra SQL-injektion genom att konvertera till heltal
}

$numTeams=intval($_POST['numteams']);

$selectedUsersCopy = $selectedUsers;



$teamNames=randomTeamNames(intval($_POST['numteams']));

$sql="SELECT * FROM tblteam ORDER BY teamid DESC LIMIT 1";
$row=$db->runQuery($sql)->fetch_assoc();
$startId=intval($row['teamid'])+1;
$stopId=$startId+$numTeams;
for($i=0;$i<$numTeams;$i++){
    $sql="INSERT INTO tblteam (teamname) VALUES ('$teamNames[$i]')";
    $r=$db->runQuery($sql);
}
assignTeamNumbers($selectedUsersCopy, $numTeams, $startId);
header("Location: adm_dash.php");


}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Välj användare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   

    <form action="pickusers.php" method="post" name="pickusers">
        <h1>Välj användare</h1>
        <label for="numteams">Ange antal lag</label>
        <input type="number" name="numteams">
        <div class="colform">
            <h4>Användare</h4>
        <?php
            // Exekvera en SQL-fråga för att hämta alla användare
            $result = $db->runQuery("SELECT userid, name FROM tbluser");

            // Visa checkbox för varje användare
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div><input type="checkbox" name="selected_users[]" value="<?=$row['userid']?>">&nbsp;&nbsp;<b><?=$row['name']?></b></div> 
         <?php   }    ?>
        </div>
        <input type="submit" name="btn" value="Välj användare">
    </form>
</body>
</html>