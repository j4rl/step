<?php
session_start();
$db=new Database("mockelngymnasie");

function makeConn($dbname, $dbserver="localhost", $dbuser="root", $dbpass=""){
    $conn=mysqli_connect($dbserver,$dbuser,$dbpass,$dbname);
    return $conn;
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
        $strFix=htmlentities($strFix, ENT_QUOTES);
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
        return $this->mysqli->query($strSQL);
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
        $user=$this->fix($username);

        $query="SELECT * FROM tbluser WHERE username='$username' AND password='$pass'";
        $result=$this->mysqli->query($query);
        if($row=$result->fetch_assoc()){
            if($result->num_rows==1){
                $_SESSION["uid"]=$row["id"];
                $_SESSION["name"]=$row["name"];
                $_SESSION["lvl"]=$row["userlevel"];
                //$this->$loggedIn=true;
                return true;
            }else{
                session_destroy();
                //$this->$loggedIn=false;
                return false;
            }
        }

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
        return $this->mysqli->query($query)->fetch_all();
    }
    /**
     * close
     * Closes the database connection
     * @return boolean
     */
    public function close(){
        return $this->mysqli->close();
    }

}

?>