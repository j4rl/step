<?php 
    require_once('func.php');

    //if(isLoggedIn()) header("Location: index.php");
    if(isLevel(100)){
        $sql="SELECT * FROM tblcomp ORDER BY stopdate, startdate DESC";
        $result=$db->runQuery($sql);
    }
    
    

?>

        <div class="main">
            <div class="container"><h1>Tävlingar<?php if(isLevel(100)){ ?>&nbsp;&nbsp;<a href="addcomp.php"><i class="fi fi-rr-add" title="Lägg till tävling"></i></a><?php } ?></h1></div>
            <?php while($row=$result->fetch_assoc()){ ?>
                    <div class="row">
                        <div class="usr_row">
                            <b><?=$row['compname']?></b>
                            &nbsp;Start:&nbsp;<span class="mono"><?=$row['startdate']?></span>
                            &nbsp;&nbsp;Slut:&nbsp;<span class="mono"><?=$row['stopdate']?></span>
                            <span class="grow">&nbsp;</span>
                            <?php if(isLevel(100)){ ?><a href="delcomp.php?del=<?=$row['compid']?>"><i class="fi fi-rr-trash"></i></a><?php } ?>
                            <?php if(isLevel(100)){ ?><a href="editcomp.php?edit=<?=$row['compid']?>"><i class="fi fi-rr-edit"></i></a><?php } ?>
                        </div>                        
                    </div>
            <?php  } ?>
        </div>

