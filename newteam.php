<?php 
require_once("func.php");
ob_start();
?>
<?php 

    if(isset($_POST['btn'])){
        $teamname=$_POST['team']; 
        $teamleader=intval($_POST['teamleader']);


        $sql="INSERT INTO tblteam (teamname, teamleader) VALUES ('$teamname',$teamleader)";
        $res=$db->runQuery($sql);
        $sql="SELECT * FROM tblteam ORDER BY teamid DESC LIMIT 1";
        $r=$db->runQuery($sql);
        $b=$r->fetch_assoc();
        $teamnr=intval($b['teamid']);
        $usr=intval($b['teamleader']);
        $sql="UPDATE tbluser SET team=$teamnr WHERE userid=$usr";
        $res=$db->runQuery($sql);
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("_head.php") ?>
<body>
<header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Nytt lag</header><main>
    <?php     if(isLevel(10)){ 
                $sql="SELECT userid, name FROM tbluser ORDER BY name DESC";
                $result=$db->runQuery($sql);
                
        ?>
        
    <form action="newteam.php" method="post">
        <h1>Skapa nytt lag</h1>
        <label for="team">Lagnamn (Ehrrm, håll god ton...)</label>
        <input type="text" name="team" id="team" required>
        <label for="teamleader">Lagledare</label>
        <select name="teamleader" id="teamleader" required>
            <?php while($row=$result->fetch_assoc()){ 
                $isSame=intval($_SESSION['uid'])==intval($row['userid']); ?>
            <option value="<?=$row['userid']?>" <?php if($isSame){echo 'selected';} ?>><?=$row['name']?></option>
            <?php } ?>
        </select>
        <div id="teamleaderStatus"></div>
    <input type="submit" name="btn" id="btn" value="Registrera">
    </form>   <?php } ?></main>
    <?php require_once("_footer.php") ?>
    <script>
        $(document).ready(function() {
            $('#teamleader').on('select', function() {
                var teamleader = $(this).val();

                // Make an AJAX request to check username availability
                $.post('check_teamleader.php', {teamleader: teamleader }, function(response) {
                    $('#teamleaderStatus').html(response);
                });
            });
        });
    </script>
</body>
</html>