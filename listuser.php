<?php 
    require_once('func.php');

    //if(isLoggedIn()) header("Location: index.php");
    if(isLevel(100)){
        $sql="SELECT * FROM tbluser LEFT JOIN tblteam ON tbluser.team=tblteam.teamid ORDER BY tblteam.wins DESC";
    }else{
        $sql="SELECT * FROM tbluser LEFT JOIN tblteam ON tbluser.team=tblteam.teamid WHERE tbluser.userid=".intval($_SESSION['uid']." ORDER BY tblteam.wins DESC");
    }
    
    $result=$db->runQuery($sql);

?>

        <div class="main">
            <div class="container"><h1>Användare<?php if(isLevel(100)){ ?>&nbsp;&nbsp;<a href="adduser.php"><img src="icons/add.png"></a><?php } ?></h1></div>
            <?php while($row=$result->fetch_assoc()){ ?>
                    <div class="row">
                        <div class="usr_row">
                            <b><?=$row['name']?></b>
                            &nbsp;Användarnamn: <span class="mono"><?=$row['username']?></span>
                            &nbsp;Nivå: <span class="mono"><?=$row['userlevel']?></span>
                            <?php if(strlen($row['teamname'])){ ?>&nbsp;Lag: <span><?=$row['teamname']?></span><?php }  ?>
                            <?php if(isLevel(100)){ ?><a href="deluser.php?del=<?=$row['userid']?>"><img src="icons/delete.png"></a><?php } ?>
                            <?php if(isLevel(100)){ ?><a href="edituser.php?edit=<?=$row['userid']?>"><img src="icons/edit.png"></a><?php } ?>
                        </div>                        
                    </div>
            <?php  } ?>
        </div>

