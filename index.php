<?php require_once("func.php") ?>
<?php 
        $today = date("Y-m-d");
        $sql="SELECT * FROM tblcomp WHERE startdate<'$today' AND stopdate>'$today'";
        $result=$db->runQuery($sql);
        $db->updateCompTotSteps();
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("_head.php") ?>
<body>
    <header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Stegtävling</header>
<?php require_once("_menu.php") ?>
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
                    if($db->ifTeamExists($team['team'])){
                    $i++;
                    $barsize=intval(100*($team['totsteps']/$comptot)); ?>
                    <div class="row"><b><?=$i?></b>&nbsp;&nbsp;<span class="team_name"><?=$db->getTeamName($team['team'])?></span><span class="grow">&nbsp;</span> <?=$team['totsteps']?> steg</div>
                    <p class="bar"><img src="bar.gif" width="<?=$barsize?>%"></p>
              <?php } } ?>

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
              <?php if($db->ifTeamExists($team)){ ?>
              <h6>Ditt lag</h6>
                <h2><?=$db->getTeamName($team)?></h2>
                <?php } ?>
              
              <?php 
                $sql="SELECT *, SUM(steps) AS totsteps FROM tblsteps WHERE team=$team";
                $res=$db->runQuery($sql);
                $t=$res->fetch_assoc();
                $sql="SELECT * FROM tbluser WHERE team=$team";
                $res=$db->runQuery($sql);
                $members=$res->num_rows;
                $sql="SELECT DISTINCT * FROM tbluser WHERE team=$team";
                $result=$db->runQuery($sql);
                while ($row=$result->fetch_assoc()){ 
                    if($db->ifTeamExists($row['team'])){?>
                    <div class="row">
                        <b><?=$row['name']?></b>&nbsp;&nbsp;<span class="grow">&nbsp;</span><?=getUserSteps(intval($row['userid']))?>
                    </div>
              <?php  }  ?>
              <p class="row sumrow"><span>Totalt antal steg i laget:&nbsp;</span><span class="grow">&nbsp;</span><b><?=$t['totsteps']?></b></p>
        </section>
        <?php } }; ?>
        </div>
    </main>
    
    
</body>
</html>