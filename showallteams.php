<?php 
    require_once("func.php");
    if(!isset($_GET['comp'])){
        header("Location: index.php");
    }else{
        $comp=intval($_GET['comp']);
        $comptot=$db->getTotStepsForComp($comp);
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("_head.php") ?> 
<body>
<header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Stegtävling</header>
<?php require_once("_menu.php") ?>
<main>
    <section>
    <?php 
                $query="SELECT team, SUM(steps) AS totsteps FROM tblsteps WHERE comp = $comp GROUP BY team ORDER BY totsteps DESC";
                $res=$db->runQuery($query);
                $i=0;
                while($team=$res->fetch_assoc()){ 
                    if($db->ifTeamExists($team['team'])){
                    $i++;
                    $barsize=intval(100*($team['totsteps']/$comptot)); ?>
                    <div class="row"><b><?=$i?></b>&nbsp;&nbsp;<span class="team_name"><?=$db->getTeamName($team['team'])?></span><span class="grow">&nbsp;</span> <?=$team['totsteps']?> steg</div>
                    <p class="bar"><img src="bar.gif" width="<?=$barsize?>%"></p>
              <?php } } ?>

                <?php if(isLoggedIn()){ ?><a href="regsteps.php?comp=<?=$comp?>" class="blink">Registrera&nbsp;steg</a><?php }; ?>
    </section>
</main>
<?php require_once("_footer.php") ?> 
</body>
</html>
<?php } ?>