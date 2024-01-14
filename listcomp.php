<?php 
    require_once('func.php');

    //if(isLoggedIn()) header("Location: index.php");
    if(isLevel(100)){
        $sql="SELECT * FROM tblcomp ORDER BY stopdate, startdate DESC";
        $result=$db->runQuery($sql);
    }
    
    

?>

        <div class="main">
            <div class="container"><h1>Tävlingar<?php if(isLevel(100)){ ?>&nbsp;&nbsp;<a href="addcomp.php"><img src="icons/add.png"></a><?php } ?></h1></div>
            <?php while($row=$result->fetch_assoc()){ ?>
                    <div class="row">
                        <div class="usr_row">
                            <b><?=$row['compname']?></b>
                            &nbsp;Start: <span class="mono"><?=$row['startdate']?></span>
                            &nbsp;Slut: <span class="mono"><?=$row['stopdate']?></span>
                            <?php if(isLevel(100)){ ?><a href="delcomp.php?del=<?=$row['compid']?>"><img src="icons/delete.png"></a><?php } ?>
                            <?php if(isLevel(100)){ ?><a href="editcomp.php?edit=<?=$row['compid']?>"><img src="icons/edit.png"></a><?php } ?>
                        </div>                        
                    </div>
            <?php  } ?>
        </div>

