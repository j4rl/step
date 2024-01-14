<?php 
    require_once('func.php');

    //if(isLoggedIn()) header("Location: index.php");
    if(isLevel(100)){
        $sql="SELECT * FROM tblteam LEFT JOIN tbluser ON tblteam.teamleader=tbluser.userid ORDER BY tblteam.wins DESC";
    }else{
        $sql="SELECT * FROM tblteam LEFT JOIN tbluser ON tblteam.teamleader=tbluser.userid WHERE teamleader=".intval($_SESSION['uid']."  ORDER BY tblteam.wins DESC");
    }
    
    $r=$db->runQuery($sql);

?>

        <div class="main">
            <div class="container"><h1>Lag<?php if(isLevel(100)){ ?>&nbsp;&nbsp;<a href="addteam.php"><img src="icons/add.png"></a><?php } ?></h1></div>
            <?php while($row=$r->fetch_assoc()){ ?>
                    <div class="row">
                        <div class="usr_row">
                            <b><?=$row['teamname']?></b>
                            &nbsp;Lagledare: <span class="mono"><?=$row['name']?></span>
                            <?php if(intval($row['wins'])){ ?>&nbsp;Antal vinster: <span><?=$row['wins']?></span><?php }  ?>
                            <?php if(isLevel(100)){ ?><a href="delteam.php?del=<?=$row['teamid']?>"><img src="icons/delete.png"></a><?php } ?>
                            <?php if(isLevel(100)){ ?><a href="editteam.php?edit=<?=$row['teamid']?>"><img src="icons/edit.png"></a><?php } ?>
                        </div>                        
                    </div>
            <?php  } ?>
        </div>

