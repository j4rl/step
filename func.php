<?php
session_start();
$db=new Database("mockelngymnasie");



function assignTeamNumbers(&$users, $numTeams, $offsetOfTeamnumber) {
    // Calculate the minimum number of users per team
    $minUsersPerTeam = ceil(count($users) / (2 * $numTeams));
    $d = new Database("mockelngymnasie");

    // Initialize an array to store assigned team numbers
    $teamNumbers = array_fill($offsetOfTeamnumber, $numTeams, 0);

    // Shuffle the array of users
    shuffle($users);

    // Loop through each user and assign a team number
    foreach ($users as &$user) {
        // Find the team with the minimum count and assign it to the user
        $teamNumber = array_search(min($teamNumbers), $teamNumbers);
        $teamNumbers[$teamNumber]++;

        // Update the user's team number in the database
        $sql = "UPDATE tbluser SET team = $teamNumber WHERE userid = $user";
        $d->runQuery($sql);
    }

    // Break the reference with the last element to avoid unexpected behavior elsewhere
    unset($user);
}


// Function to get an available team number
function getAvailableTeam($teamNumbers, $numTeams, $minUsersPerTeam) {
    // Iterate through team numbers and return the first team that hasn't reached the minimum
    for ($i = 1; $i <= $numTeams; $i++) {
        if (!isset($teamNumbers[$i]) || $teamNumbers[$i] < $minUsersPerTeam) {
            return $i;
        }
    }

    // If all teams have reached the minimum, return the team with the fewest users
    $minTeam = array_search(min($teamNumbers), $teamNumbers);
    return $minTeam;
}


//$numTeams = 3; // Set the desired number of teams

// Assign team numbers to users
//assignTeamNumbers($users, $numTeams);




function randomTeamNames($numTeams) {
    $buzzwords = ["Mästarmindarna", "Innovationsgänget", "Framtidsfabriken", "Tekniktriben", "Kreativa Kraftverket", "Äventyrsalliansen", "Drömläget", "Hjärnstormarna", "Revolutionära Rävarna", "Smartglidarna", "Future Fusion", "Framtidsfantomerna", "Magimakarna", "Strategiska Stjärnorna", "Ändringsagenterna", "Innovativ passus", "SmartSquad", "Digitala Diamanter", "Tänktanken", "Skaparstormen", "Möjligheternas Mästare", "Visionära Vindarna", "Kreativitetskraften", "Innovationssamurajerna", "Rationell Reform", "Äventyrsälgarna", "Kreativa Katalysatorn", "Future Fighters", "Analog Pedagog", "GeniusGänget", "Formativa Kaptenerna", "Skaparstjärnorna", "Kognitiv Tornado", "Drömmarnas Drakar", "Äventyrliga Änglarna", "Innovationsvågen"];
    $teamNames =array(); 
    if(!($numTeams>count($buzzwords))){
        shuffle($buzzwords); // Slumpa buzzwords för att få en slumpmässig ordning

        // Om antalet lag är större än antalet unika buzzwords, använd endast unika buzzwords för att undvika upprepningar
        $numUniqueTeams = min($numTeams, count($buzzwords));
        $uniqueTeamNames = array_slice($buzzwords, 0, $numUniqueTeams);
        $teamNames=$uniqueTeamNames;
    }else{
        $teamNames =array(); 
        for ($i = 1; $i <= $numTeams; $i++) {
            $teamNames[] = "Lag " . $i;
        }
    }
    // Om det finns fler lag än unika buzzwords, upprepa unika buzzwords för att fylla upp laglistan
    
    return $teamNames;
}


function dateDiff($startDate, $endDate){
    // Konvertera datumsträngarna till timestamps
    $startTimestamp = strtotime($startDate);
    $endTimestamp = strtotime($endDate);

    // Beräkna antalet sekunder mellan de två timestampen
    $differenceInSeconds = $endTimestamp - $startTimestamp;

    // Omvandla antalet sekunder till dagar
    $daysDifference = floor($differenceInSeconds / (60 * 60 * 24));

    return $daysDifference;

}

function maxCompSteps($comp){
    
}

function server(){
    return $_SERVER['HTTP_HOST'];
}


function isLevel($level){
    $succ=false;
    if(isset($_SESSION["lvl"])){
        $sessLevel=intval($_SESSION["lvl"]);
        if($sessLevel<$level){
            $succ=false;
        }else{
            $succ=true;
        }
    }
    return $succ;
}

function isLoggedIn(){
    return isLevel(10);
}


function fixDate($var){
    $date=date('Y-m-d H:i', $var);
    return $date;
}

function getUserSteps($uid){
    $totsteps=0;
    $d=new Database("mockelngymnasie");
    $sql="SELECT * FROM tblsteps WHERE user = $uid";
    $res=$d->runQuery($sql);
    while($row=$res->fetch_assoc()){
        $totsteps+=$row['steps'];
    }
    return $totsteps;
}
function getUserStepsTeam($uid, $teamid){
    $uid=intval($uid);
    $teamid=intval($teamid);
    $totsteps=0;
    $d=new Database("mockelngymnasie");
    $sql="SELECT * FROM tblsteps WHERE user = $uid AND team=$teamid";
    $res=$d->runQuery($sql);
    while($row=$res->fetch_assoc()){
        $totsteps+=$row['steps'];
    }
    return $totsteps;
}

function getTeamSteps($teamid){
    $teamid=intval($teamid);
    $totsteps=0;
    $d=new Database("mockelngymnasie");
    $sql="SELECT * FROM tblsteps WHERE team = $teamid";
    $res=$d->runQuery($sql);
    while($row=$res->fetch_assoc()){
        $totsteps=$totsteps+intval($row['steps']);
    }
    return $totsteps;
}



/**
 * Crypt
 */
class Crypt{
    private $password;
    /**
     * Constructor
     * sets the passkey to the provided string otherwise a default passkey is set
     * @param string $passkey
     */
    function __construct($passkey="My current passkey is 100% safe!")
    {
        $this->password=$passkey;
    }
    /**
     * enc
     * Encodes the provided string to crypted string
     * @param string $plaintext
     * @return string Crypted string
     */
    function enc($plaintext) {
        $method="AES-256-CBC";
        $key = hash('sha256', $this->password, true);
        $iv = openssl_random_pseudo_bytes(16);
        $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
        $hash = hash_hmac('sha256', $ciphertext, $key, true);
        $ret=$iv.$hash.$ciphertext;
        return base64_encode($ret);
    }
    /**
     * dec
     * Decodes a crypted string
     * @param string $ivHashCiphertext A crypted string
     * @return string The uncrypted string
     */
    function dec($ivHashCiphertext) {
        $ivHashCiphertext=base64_decode($ivHashCiphertext);
        $method="AES-256-CBC";
        $iv = substr($ivHashCiphertext, 0, 16);
        $hash = substr($ivHashCiphertext, 16, 32);
        $ciphertext = substr($ivHashCiphertext, 48);
        $key = hash('sha256', $this->password, true);
        if (hash_hmac('sha256', $ciphertext, $key, true) !== $hash) return null;
        return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
    }
}

/**
 * Database
 */
class Database extends Crypt
{
    private $userTable="tbluser";
    public $loggedIn=false;
    /**
     * Constructor
     * connects to a database with the given parameters otherwise default values are set.
     * @param string $db_name
     * @param string $host (default value localhost)
     * @param string $username (default value root)
     * @param string $password (default value blank)
     */
    function __construct($db_name, $host="localhost", $username="mockelngymnasie", $password="PPeTExVh") {
        $this->mysqli = mysqli_connect($host, $username, $password, $db_name);
    }
    /**
     * fix
     * Takes a string and fixes malicous stuff in it, for use with SQL questions
     * @param string $strFix The string to be fixed
     * @return string The fixed string
     */
    public function fix($strFix){
        $strFix=htmlspecialchars($strFix);
        //$strFix=htmlentities($strFix, ENT_QUOTES);
        return $this->mysqli->real_escape_string($strFix);
    }
    /**
     * runQuery
     * Runs a SQL-question to the database and returns the resulting object or value
     * @param string $strQuery
     * @return object or integer
     */
    public function runQuery($strQuery){
        //$strSQL=$this->fix($strQuery);
        $strSQL=$strQuery;
        if($res=$this->mysqli->query($strSQL)){
            return $res;
        }else{
            return false;
        };
    }
    /**
     * delRow
     * Deletes a row from the database
     * @param integer $ID
     * @param string $table
     * @return boolean
     */
    public function delRow($ID,$table){
        $strTable=strtolower(substr($table,3,strlen($table)));
        $tmpSTrID=$strTable."id";
        $query=$this->fix("DELETE FROM $table WHERE $tmpSTrID=$ID");
        return $this->mysqli->query($query);
    }
    public function setUserTable($utable){
        $userTable=$utable;
    }

    public function checkUser($username,$password){
        $pass=md5($password);
        $user=htmlentities($this->fix($username), ENT_QUOTES);

        $query="SELECT * FROM tbluser WHERE username='$username' AND password='$pass'";
        $result=$this->mysqli->query($query);
        if($row=$result->fetch_assoc()){
            if($result->num_rows==1){
                $_SESSION["uid"]=$row["userid"];
                $_SESSION["name"]=$row["name"];
                $_SESSION["lvl"]=$row["userlevel"];
                $_SESSION["team"]=$row["team"];
                //$this->$loggedIn=true;
                return true;
            }else{
                session_destroy();
                //$this->$loggedIn=false;
                return false;
            }
        };


    }
    /**
    * data2JSON
    * Returns data from database formatted as JSON with the object name data
    * @param $connOBJ {object} the database connection object.
    * @param $txtSQL {string} String with SQL-formatted question.
    * @return JSON formatted string
    */
    public function data2JSON($txtSQL){
        $txtQuery=$this->fix($txtSQL);
        $result = $this->mysqli->query($txtQuery);
        $str= '{"data":[';
            while($rad=$result->fetch_assoc()){
                $userID=$rad['userID'];
                $username=$rad['username'];
                $password=$rad['password'];
                $userlevel=$rad['userlevel'];
                $str=$str.'{"userID":'.$userID.',"username":"'.$username.'","password":"'.$password.'","userlevel":'.$userlevel.'},';
            };   
            $str=rtrim($str, ",");
            $str=$str."]}";
            return $str;
}

    /**
     * getAll
     * Gets all records from a specific table
     * @param string $table
     * @return object or integer
     */
    public function getAll($table)
    {
        $query = $this->fix("SELECT * FROM $table");
        return $this->mysqli->query($query)->fetch_assoc();
    }
    /**
     * close
     * Closes the database connection
     * @return boolean
     */
    public function close(){
        return $this->mysqli->close();
    }

    public function updateCompTotSteps(){
        $sql="SELECT * FROM tblsteps WHERE NOT team=0";
        $res=$this->mysqli->query($sql);
        while ($row=$res->fetch_assoc()){
            $comp=intval($row['comp']);
            $sql="SELECT * FROM tblsteps WHERE comp=$comp AND NOT team=0";
            $tstep=0;
            $result=$this->mysqli->query($sql);
            while($r=$result->fetch_assoc()){
                $tstep+=intval($r['steps']);
            }
            $sql="UPDATE tblcomp SET totsteps=$tstep WHERE compid=$comp";
            if($this->mysqli->query($sql)){};

        }
    }

    public function getTeamName($teamid){
        $id=intval($teamid);
        $sql="SELECT * FROM tblteam WHERE teamid=$id";
        if($row = $this->mysqli->query($sql)->fetch_assoc()){
            return $row['teamname'];
        }else{
            return "Hittade inte lagnamnet";
        };
        
    }

    public function isTeamMember($uid,$teamid){
        $uid=intval($uid);
        $teamid=intval($teamid);
        $sql="SELECT * FROM tbluser WHERE userid=$uid AND team=$teamid";
        if($row = $this->runQuery($sql)->fetch_assoc()){
            return true;
        }else{
            return false;
        }
    }


    public function getCompName($compid){
        $id=intval($compid);
        $sql="SELECT * FROM tblcomp WHERE compid=$id";
        $row = $this->mysqli->query($sql)->fetch_assoc();
        return $row['compname'];
    }
    public function getUserName($userid){
        $id=intval($userid);
        $sql="SELECT * FROM tbluser WHERE userid=$id";
        $row = $this->mysqli->query($sql)->fetch_assoc();
        return $row['username'];
    }
    public function getName($userid){
        $id=intval($userid);
        $sql="SELECT * FROM tbluser WHERE userid=$id";
        $row = $this->mysqli->query($sql)->fetch_assoc();
        return $row['name'];
    }

    public function getTotStepsForComp($compid){
        $id=intval($compid);
        $sql="SELECT * FROM tblcomp WHERE compid=$id";
        $r=$this->mysqli->query($sql)->fetch_assoc();
        return intval($r['totsteps']);
    }
    public function getTotStepsForTeam($teamid){
        $teamid=intval($teamid);
        $sql="SELECT SUM(steps) AS totsteps FROM tblsteps WHERE team=$teamid";
        $r=$this->runQuery($sql)->fetch_assoc();
        return intval($r['totsteps']);
    }
    public function getStepfactorForTeamComp($team, $comp){
        $team=intval($team);
        $comp=intval($comp);
        $totStepsTemComp=$this->getTotStepsForTeamComp($team, $comp); 
        $numTeamMembers=$this->getNumTeamMembers($team);
        if($numTeamMembers) {
        return intval($totStepsTemComp/$numTeamMembers);
        } else {
            return 0;
        }
    }
    public function getTotStepsForTeamComp($teamid, $compid){
        $teamid=intval($teamid);
        $compid=intval($compid);
        $sql="SELECT SUM(steps) AS totsteps FROM tblsteps WHERE team=$teamid AND comp=$compid";
        $r=$this->runQuery($sql)->fetch_assoc();
        return intval($r['totsteps']);
    }
    public function getTotStepsForUser($userid){
        $id=intval($userid);
        $sql="SELECT SUM(steps) AS totsteps FROM tblsteps WHERE user=$id";
        $r=$this->mysqli->query($sql)->fetch_assoc();
        return intval($r['totsteps']);
    }

    public function getUserIdArray($compid){
        $id=intval($compid);
        $sql="SELECT user FROM tblsteps WHERE compid = $id";
        $res=$this->mysqli->query($sql);
        $idArray=array();
        while($row=$res->fetch_assoc()){
            $idArray[]=intval($row['user']);
        }
        return $idArray;
    }
    public function ifTeamExists($team) {
        $tid=intval($team);
        $sql="SELECT * FROM tblteam WHERE teamid = $tid";
        $numTeams=$this->runQuery($sql)->num_rows;
        return $numTeams;

    }
    public function getNumTeamMembers($team) {
        $tid=intval($team);
        $sql="SELECT * FROM tbluser WHERE team = $tid";
        $numMembers=$this->runQuery($sql)->num_rows;
        return $numMembers;
    }
    /**
     * function to clean all teams from steps that no longer exists
     * ...so if deleting a team, steps regisrtred for user will remain but the team it was registred will be removed
     *
     * @return void
     */
    public function cleanSteps(){
        //Get all records from tblsteps and crosscheck with all records of tblteam and replace team in tblssteps with null if there isn't a teamid that corresponds
        $sql="UPDATE tblsteps SET team = 0 WHERE team NOT IN (SELECT teamid FROM tblteam)";
        if($res=$this->runQuery($sql)){
            return true;
        }else{
            return false;
        };
    }
    public function cleanTeamleader($uid,$team){
        $uid=intval($uid);
        $team=intval($team);
        if(!$this->ifTeamExists($team)){
            $sql="UPDATE tbluser SET team=0 WHERE userid=$uid";
            $r=$this->runQuery($sql);
        }
    }

    public function getUserStepsTeam($uid, $teamid){
        $uid=intval($uid);
        $teamid=intval($teamid);
        $totsteps=0;
        $sql="SELECT * FROM tblsteps WHERE user = $uid AND team=$teamid";
        $res=$this->runQuery($sql);
        while($row=$res->fetch_assoc()){
            $totsteps+=$row['steps'];
        }
        return $totsteps;
    }
    public function getTeamRank($teamid){
        $teamid=intval($teamid);
        $sql="SELECT team, totsteps, RANK() OVER (ORDER BY totsteps DESC) AS team_rank FROM (SELECT team, SUM(steps) AS totsteps FROM tblsteps GROUP BY team) AS team_totals WHERE team=$teamid";
        if($res=$this->runQuery($sql)->fetch_assoc()){
            return $res['team_rank'];
        };  
    }

    public function getTeamsByJSON($compid){
        
    }

}

?>