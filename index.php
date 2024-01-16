<?php require_once("func.php") ?>
<?php 
        $today = date("Y-m-d");
        $sql="SELECT * FROM tblcomp WHERE startdate<'$today' AND stopdate>'$today'";
        $result=$db->runQuery($sql);

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
            <?php if(isLoggedIn()){ ?><a href="regsteps.php">Registrera&nbsp;steg</a><?php }; ?>       
            <?php if(isLevel(100)){ ?><a href="adm_dash.php">Admin</a><?php }; ?>
            <?php if(!isLoggedIn()){ ?><a href="reguser.php">Registrera&nbsp;användare</a><?php }; ?>
        </div>
		<div class="loginout"><?php if(isLoggedIn()){ ?><a href="logout.php">Logga&nbsp;ut</a><?php }else{ ?><a href="login.php">Logga&nbsp;in</a><?php }; ?></div>
    </nav>
    <main>
        <div class="row">
        <section>
            <h1>Aktuella tävlingar</h1>
            <?php while($row=$result->fetch_assoc()) { ?>
                <h2><?=$row['compname']?></h2>
                <p>Håller på från <?=$row['startdate']?> och slutar <?=$row['stopdate']?> det är <?=dateDiff($row['startdate'],$row['stopdate'])?> dagar kvar</p>
                 <?php 
                $query="SELECT competition_name, team_name, total_steps, rank
            FROM (
                SELECT
                    tblcomp.compname AS competition_name,
                    tblteam.teamname AS team_name,
                    COALESCE(SUM(tblsteps.steps), 0) AS total_steps,
                    ROW_NUMBER() OVER (PARTITION BY tblcomp.compid ORDER BY COALESCE(SUM(tblsteps.steps), 0) DESC) AS rank
                FROM tblcomp
                JOIN tblsteps ON tblcomp.compid = tblsteps.user
                JOIN tbluser ON tblsteps.user = tbluser.userid
                JOIN tblteam ON tbluser.team = tblteam.teamid
                GROUP BY tblcomp.compid, tblteam.teamid
                ) AS subquery
            WHERE rank <= 5
            ORDER BY competition_name, rank DESC;";
                $res=$db->runQuery($query);
                while($team=$res->fetch_assoc()){ ?>
                    <div class="team"><b><?=$team['rank']?></b>: <span class="team_name"><?=$team['team_name']?></span> <?=$team['total_steps']?> steg</div>
              <?php  } ?>

                <?php if(isLoggedIn()){ ?><a href="regsteps.php?comp=<?=$row['compid']?>" class="blink">Registrera&nbsp;steg</a><?php }; ?>
           <?php } ?>
        </section>
        <?php if(isLoggedIn()){ ?>
        <section>
            <h1><?=$_SESSION['name']?></h1>
            <?php 
                $uid = intval($_SESSION['uid']);
                $team=intval($_SESSION['team']);
                $totSteps=0;
                $query="SELECT * FROM tblsteps WHERE user=$uid ORDER BY posted DESC";
                $result=$db->runQuery($query);
                while($row = $result->fetch_assoc()) { 
                    $totSteps+=intval($row['steps']); ?>
                    <div class="steprow"><?=$row['posted']?>&nbsp;&nbsp;<b><?=$row['steps']?></b></div>
              <?php  }  ?>
              <p>Totalt antal steg: <b><?=$totSteps?></b></p>
              <?php 
                $sql="SELECT * FROM tblteam WHERE teamid=$team";
                $res=$db->runQuery($sql);
                $t=$res->fetch_assoc();
                $teamname=$t['teamname'];
                $totsteps=0;
                $sql="SELECT * FROM tbluser WHERE team=$team";
                $res=$db->runQuery($sql);
                $members=$res->num_rows;
                $sql="SELECT DISTINCT * FROM tbluser WHERE team=$team";
                $result=$db->runQuery($sql);
                while ($row=$result->fetch_assoc()){ ?>
                    <div class="row">
                        <b><?=$row['name']?></b>&nbsp;&nbsp;<?=getUserSteps(intval($row['userid']))?>
                    </div>
              <?php  }
              ?>
              <h2><?=$teamname?></h2>
              <p>Totalt antal steg:&nbsp;<?=$totsteps?></p>
        </section>
        <?php }; ?>
        </div>
    </main>
    <footer class="cen">&copy;j4rl</footer>
    
</body>
</html>