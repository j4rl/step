<?php
    require_once('func.php');
    ob_start();
    if(!isLevel(100)) header("Location: index.php");
    //Is editform submitted?
    if(isset($_POST['btn'])){

        $selectedUsers = $_POST['selected_users'] ?? [];

        // Skapa en array för att lagra unika userid
        $selectedUserIds = array();
  
        $id=intval($_POST['id']);
        $teamname=$_POST['team'];
        $teamleader=intval($_POST['lead']);      
        
        // Loopa igenom valda användare och lägg till deras userid i arrayen
        foreach ($selectedUsers as $userId) {
            $selectedUserIds[] = (int)$userId; // Förhindra SQL-injektion genom att konvertera till heltal
            $sql="UPDATE tbluser SET team=$id WHERE userid=$userId";
            $r=$db->runQuery($sql);
        }

        $sql="UPDATE tblteam SET teamname='$teamname', teamleader=$teamleader WHERE teamid=$id";
        $result=$db->runQuery($sql);
        header("Location: adm_dash.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("_head.php") ?>
<body>
<header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Ändra lag</header>
 
<main>
    <?php
//first time around, lets check if we got a redirection from listuser (is there a $_GET)?
    if(isset($_GET['edit'])){
        $id=intval($_GET['edit']);
        $sql="SELECT * FROM tblteam WHERE teamid=$id";
        $result=$db->runQuery($sql);
        $team=$result->fetch_assoc();
        $query="SELECT userid, name FROM tbluser ORDER BY name";
        $res=$db->runQuery($query);
?>
    <form method="post" action="editteam.php"><h1>Ändra lag</h1>
        <label for="team">Lagnamn</label>
        <input type="text" name="team" value="<?=$team['teamname']?>">
        <input type="hidden" name="id" value="<?=$team['teamid']?>">
        <label for="fakeid">Lag id</label>
        <input type="text" name="fakeid" value="<?=$team['teamid']?>" disabled>
        <?php //if(intval($team['teamleader'])){ ?>
        <label for="lead">Lagledare</label>

        <select name="lead" id="lead">
                <option value="0" <?php if(intval($team['teamleader'])==0){ echo 'selected';} ?>>Ingen lagledare</option>
                <?php while($user=$res->fetch_assoc()){   ?>
                   <? if($user['userid']==$team['teamleader']) echo "selected" ?>  
                      <option value="<?=$user['userid']?>" <?php if($user['userid']==$team['teamleader']) echo "selected"; ?> ><?=$user['name']?></option>
               <?php } ?>
                </select>
                    <?php //} ?>
                <h3>Lagmedlemmar</h3>
                <div class="colform">
            
            <?php
                // Exekvera en SQL-fråga för att hämta alla användare
                $result = $db->runQuery("SELECT userid, name FROM tbluser");
    
                // Visa checkbox för varje användare
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div><input type="checkbox" name="selected_users[]" <?php if($db->isTeamMember($row['userid'],$id)) echo "checked"; ?> value="<?=$row['userid']?>">&nbsp;&nbsp;<b><?=$row['name']?></b></div> 
             <?php   }    ?>
            </div>
        <input type="submit" value="Skicka" name="btn">
    </form>
<?php  } ?>

                </main>  
<?php require_once("_footer.php") ?>    
</body>
</html>