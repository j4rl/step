<?php 
    require_once("func.php");
    ob_start();
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
    <section id="show">
                <?php if(isLoggedIn()){ ?><a href="regsteps.php?comp=<?=$comp?>" class="blink">Registrera&nbsp;steg</a><?php }; ?>
    </section>
</main>
<?php require_once("_footer.php") ?> 
</body>
</html>
<?php } ?>
<script>
                // URL till JSON-data
const url = '_json_teamdata.php?comp=<?=$comp?>';

// Funktion för att hämta JSON-data från URL
async function fetchJSONData(url) {
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return await response.json();
  } catch (error) {
    console.error('There was a problem fetching the data:', error);
  }
}

// Funktion för att presentera lagdata
function presentTeamData(teamData, vdo) {
    var retstr="";
  retstr+=`<div class="row"><details class="usr_row"><summary><b>${vdo} ${teamData[0].team}</b><span class="grow">&nbsp;</span>`;

  const totalSteps = teamData.reduce((acc, member) => acc + member.user_steps, 0);
  retstr+=`<span>${teamData[0].team_quota} steg per person</span></summary>`;
  retstr+=`<h5>Totalt antal steg för laget: ${totalSteps}</h5>`;
  teamData.forEach(member => {
    retstr+=`<div class="row"> ${member.user} <span class="grow">&nbsp;</span> ${member.user_steps} steg</div>`;
  });
  retstr+='</details></div>';
  return retstr;
}
// Funktion för att sortera lagdata baserat på kvoten (från störst till minst)
function sortTeamDataByQuota(teamData) {
  return teamData.sort((a, b) => b.team_quota - a.team_quota);
}
// Funktion för att hämta unika lagnamn från JSON-datan
function getUniqueTeams(jsonData) {
  const teams = new Set();
  jsonData.data.users.forEach(member => {
    teams.add(member.team);
  });
  return Array.from(teams);
}

// Hämta JSON-data från URL och behandla den
fetchJSONData(url)
  .then(jsonData => {
    const uniqueTeams = getUniqueTeams(jsonData);
    const section=document.getElementById('show');
    var x=1;
    uniqueTeams.forEach(team => {
      const teamData = jsonData.data.users.filter(member => member.team === team);
      const sortedTeamData = sortTeamDataByQuota(teamData); // Sortera lagdata baserat på kvoten
      section.innerHTML+=presentTeamData(teamData,x);
      x++;
    });
  });
        </script>