<!DOCTYPE html>
<?php 
    require_once('func.php');

    //if(isLoggedIn()) header("Location: index.php");
    if(isLevel(100)){
        $sql="SELECT * FROM tbluser LEFT JOIN tblteam ON tbluser.team=tblteam.id";
    }else{
        //$sql="SELECT * FROM tbluser LEFT JOIN tblteam ON tbluser.team=tblteam.id WHERE tbluser.id=".$_SESSION['uid'];
    }
    
    $result=$db->runQuery($sql);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
        <div class="main">
            <?=$result->num_rows?>
            <div class="container"><h1>List of users</h1><?php if(isLevel(100)){ ?><a href="adduser.php"><img src="/icons/add64.png"></a><?php } ?></div>
            <?php while($row=$result->fetch_assoc()){ ?>
                    <div class="row">
                        <div class="real"><?=$row['name']?></div>
                        Username: <span class="mono"><?=$row['username']?></span><br>Level: <span class="mono"><?=$row['userlevel']?></span><br>
                        <span class="pass"><?=$row['password']?></span>
                        <span><?=$row['teamname']?></span>
                        <div>
                        <?php if(isLevel(100)){ ?><a href="deluser.php?del=<?=$row['id']?>"><img src="/icons/delete.png"></a><?php } ?>
                        <?php if(isLevel(100)){ ?><a href="edituser.php?edit=<?=$row['id']?>"><img src="/icons/edit.png"></a><?php } ?>
                        </div>
                    </div>
            <?php  } ?>
        </div>
</body>
</html>
