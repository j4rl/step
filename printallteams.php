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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stegtävling</title>
      <style>
        h1,h2,h3{
          font-family:system-ui;
        }
        summary{
          font-size:2rem;
          font-family:system-ui;
        }
        details{
          font-family:system-ui;
        }
      </style>
</head>
<body>
<header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Stegtävling</header>


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
  retstr+=`<h1>${vdo} ${teamData[0].team}</h1>`;

  const totalSteps = teamData.reduce((acc, member) => acc + member.user_steps, 0);
  retstr+=`<h2>${teamData[0].team_quota} steg per person</h2>`;
  retstr+=`<h3>Totalt antal steg för laget: ${totalSteps}</h3>`;
  teamData.forEach(member => {
    retstr+=`<p> ${member.user}:  ${member.user_steps} steg</p>`;
  });
  retstr+='';
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