<?php
require_once("func.php");
if(isset($_GET["comp"])){
    $comp=intval($_GET["comp"]);
    $sql="SELECT 
    t1.team,
    t1.user,
    SUM(t1.steps) AS user_steps,
    t2.team_steps,
    t2.team_steps / t2.user_count AS team_quota
FROM 
    tblsteps t1 
JOIN (
    SELECT 
        team,
        SUM(steps) AS team_steps,
        COUNT(DISTINCT user) AS user_count
    FROM 
        tblsteps
    WHERE 
        comp = $comp 
    GROUP BY 
        team
) t2 ON t1.team = t2.team
WHERE 
    t1.comp = $comp 
GROUP BY 
    t1.team,
    t1.user,
    t2.team_steps,
    t2.user_count;
";
    $res=$db->runQuery($sql);
    while ($row=$res->fetch_assoc()) {

    }
}


?>