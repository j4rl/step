<?php require_once("func.php") ?>
<?php 
        $today = date("Y-m-d");
        $sql="SELECT * FROM tblcomp WHERE startdate<'$today' AND stopdate>'$today'";
        $result=$db->runQuery($sql);
        $db->updateCompTotSteps();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
	<script src="app.js"></script>
</head>
<body>
    <header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Stegtävling</header>
    <nav>
        <div class="menu">
        <a href="index.php">Hem</a>     
            <?php if(isLevel(100)){ ?><a href="adm_dash.php">Admin</a><?php }; ?>
            <?php if(!isLoggedIn()){ ?><a href="reguser.php">Registrera&nbsp;användare</a><?php }; ?>
        </div>
		<div class="loginout"><?php if(isLoggedIn()){ ?><a href="logout.php">Logga&nbsp;ut</a><?php }else{ ?><a href="login.php">Logga&nbsp;in</a><?php }; ?></div>
    </nav>
    <main>
        <div class="row">
        <section>
            <h1>Aktuella tävlingar</h1>
            <?php while($row=$result->fetch_assoc()) { 
                $comp=intval($row['compid']);
                $comptot=$db->getTotStepsForComp($comp);?>
                <h2><?=$row['compname']?></h2>
                <p>Håller på från <?=$row['startdate']?> och slutar <?=$row['stopdate']?> det är <?=dateDiff($row['startdate'],$row['stopdate'])?> dagar kvar</p>
                 <?php 
                $query="SELECT team, SUM(steps) AS totsteps FROM tblsteps WHERE comp = $comp GROUP BY team ORDER BY totsteps DESC LIMIT 5";
                $res=$db->runQuery($query);
                $i=0;
                while($team=$res->fetch_assoc()){ 
                    $i++;
                    $barsize=intval(100*($team['totsteps']/$comptot)); ?>
                    <div class="row"><b><?=$i?></b>&nbsp;&nbsp;<span class="team_name"><?=$db->getTeamName($team['team'])?></span><span class="grow">&nbsp;</span> <?=$team['totsteps']?> steg</div>
                    <p class="bar"><img src="bar.gif" width="<?=$barsize?>%"></p>
              <?php  } ?>

                <?php if(isLoggedIn()){ ?><a href="regsteps.php?comp=<?=$row['compid']?>" class="blink">Registrera&nbsp;steg</a><?php }; ?>
           <?php } ?>
        </section>
        <?php if(isLoggedIn()){ ?>
        <section>
            <h1><?=$_SESSION['name']?></h1>
            <h6>Senaste registreringar</h6>
            <?php 
                $uid = intval($_SESSION['uid']);
                $team=intval($_SESSION['team']);
                $totSteps=0;
                $query="SELECT * FROM tblsteps WHERE user=$uid ORDER BY posted DESC LIMIT 5";
                $result=$db->runQuery($query);
                while($row = $result->fetch_assoc()) { 
                    $totSteps+=intval($row['steps']); ?>
                    <div class="row"><?=$row['posted']?><span class="grow">&nbsp;</span><b><?=$row['steps']?></b></div>
              <?php  }  ?>
              <p class="row sumrow"><span>Totalt antal steg:</span> <span class="grow">&nbsp;</span><b><?=$totSteps?></b></p>
              <h6>Ditt lag</h6>
                <h2><?=$db->getTeamName($team)?></h2>
              
              <?php 
                $sql="SELECT *, SUM(steps) AS totsteps FROM tblsteps WHERE team=$team";
                $res=$db->runQuery($sql);
                $t=$res->fetch_assoc();
                $sql="SELECT * FROM tbluser WHERE team=$team";
                $res=$db->runQuery($sql);
                $members=$res->num_rows;
                $sql="SELECT DISTINCT * FROM tbluser WHERE team=$team";
                $result=$db->runQuery($sql);
                while ($row=$result->fetch_assoc()){ ?>
                    <div class="row">
                        <b><?=$row['name']?></b>&nbsp;&nbsp;<span class="grow">&nbsp;</span><?=getUserSteps(intval($row['userid']))?>
                    </div>
              <?php  }  ?>
              <p class="row sumrow"><span>Totalt antal steg i laget:&nbsp;</span><span class="grow">&nbsp;</span><b><?=$t['totsteps']?></b></p>
        </section>
        <?php }; ?>
        </div>
    </main>
    <footer class="cen">&copy;j4rl</footer>
    
</body>
</html>