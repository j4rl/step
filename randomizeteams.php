<?php
require_once("func.php");
//randomize teams from given users in getusers.php
//open tbl users and assign them to random teams
//distribute users by max number of members in a team
//make random team names from hype words

/*
Slumpa lag från användare utvalda till filen getusers.php
öppna tabellen tbluser och sätt lagnummer slumpmässigt
Antal lag bestäms av GET['numteams'] som är antalet lag 
eller GET['teammax'] som bestämmer max antal i ett lag
Slumpa lagnamn av buzzwords av tech och pedagogik

*/
if(isset($_GET['numteams'])){
     $teamNames=randomTeamNames(intval($_GET['numteams']));
 foreach ($teamNames as $teamname) {
    echo $teamname . "<br>";
}
}else{
    echo "No param!";
}

?>