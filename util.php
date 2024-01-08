<?php
//                    util.php
//    Toolbox PHP file with functions to use
//    Author: Charlie Jarl
//    Revion date: 2016-03-10


function initBarMath($strRO, $maxHeight_in_px) {
	//make recordset
	$RO3NumSteps=totSteps("RO3");
	$RO4NumSteps=totSteps("RO4");
	$scaleFactor=($maxHeight_in_px/($RO3NumSteps	+ $RO4NumSteps));
	switch ($strRO) {
		case "RO3":
			$transImgHeight=intval($scaleFactor*$RO4NumSteps);
			$barImgHeight=intval($scaleFactor*$RO3NumSteps);
			break;
		case "RO4":
			$transImgHeight=intval($scaleFactor*$RO3NumSteps);
			$barImgHeight=intval($scaleFactor*$RO4NumSteps);
			break;
		default:
			echo "Error";
	}
    $returnString="<img src='trans.gif' height='".$transImgHeight."px' width='100%'/><br/><img src='bar.gif' height='".$barImgHeight."px' width='100%' class='barimg' />";
	return $returnString;
};


function totSteps($strRO) {
	$intNumSteps=mysqli_query("SELECT SUM('steps') from tblSteps WHERE RO='".$strRO."';", data()) or die(mysql_error());
	return intval($intNumSteps/$contestants);
};
function data(){
	//return $connection
};

function topList($strRO){
	//get all names
	// SELECT * FROM tblNames WHERE RO=$strRO
	$co=mysqli_connect("localhost", "root", "", "dynosaur_se");
	if(!$co) die(mysqli_connect_error());
	$sql="SELECT * FROM tblNames WHERE RO='".$strRO."'";
	$result=mysqli_query($co, $sql);
	if (mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			$sql2="SELECT SUM('steg') FROM tblSteps WHERE namn='".$row['namn']."'";
			$result2=mysqli_query(data(), $sql2);
			$arrList[$row['namn']]=$result2;
	//make a do while and create an array with the sum of steps of each name
	// SELECT SUM('steg') FROM tblSteps WHERE namn=$strName
		}
	}else{
		return 0;
	};
	//retur array
	mysqli_close($co);
	return sort($arrList);	
	
	
};

function showTopList($arrTopList,$numberOfNames) {
	//return $numberOfNames top results
	//present as string with <ul>
};


class Database {
 
    private $host;
    private $user;
    private $pass;
    private $name;
    private $link;
    private $error;
    private $errno;
    private $query;
 
    function __construct($host, $user, $pass, $name = "", $conn = 1) {
        $this -> host = $host;
        $this -> user = $user;
        $this -> pass = $pass;
        if (!empty($name)) $this -> name = $name;      
        if ($conn == 1) $this -> connect();
    }
 
    function __destruct() {
        @mysql_close($this->link);
    }
 
    public function connect() {
        if ($this -> link = mysql_connect($this -> host, $this -> user, $this -> pass)) {
            if (!empty($this -> name)) {
                if (!mysqli_select_db($this -> name)) $this -> exception("Could not connect to the database!");
            }
        } else {
            $this -> exception("Could not create database connection!");
        }
    }
 
    public function close() {
        @mysql_close($this->link);
    }
 
    public function query($sql) {
        if ($this->query = @mysql_query($sql)) {
            return $this->query;
        } else {
            $this->exception("Could not query database!");
            return false;
        }
    }
 
    public function num_rows($qid) {
        if (empty($qid)) {         
            $this->exception("Could not get number of rows because no query id was supplied!");
            return false;
        } else {
            return mysql_num_rows($qid);
        }
    }
 
    public function fetch_array($qid) {
        if (empty($qid)) {
            $this->exception("Could not fetch array because no query id was supplied!");
            return false;
        } else {
            $data = mysql_fetch_array($qid);
        }
        return $data;
    }
 
    public function fetch_array_assoc($qid) {
        if (empty($qid)) {
            $this->exception("Could not fetch array assoc because no query id was supplied!");
            return false;
        } else {
            $data = mysql_fetch_array($qid, MYSQL_ASSOC);
        }
        return $data;
    }
 
    public function fetch_all_array($sql, $assoc = true) {
        $data = array();
        if ($qid = $this->query($sql)) {
            if ($assoc) {
                while ($row = $this->fetch_array_assoc($qid)) {
                    $data[] = $row;
                }
            } else {
                while ($row = $this->fetch_array($qid)) {
                    $data[] = $row;
                }
            }
        } else {
            return false;
        }
        return $data;
    }
 
    public function last_id() {
        if ($id = mysql_insert_id()) {
            return $id;
        } else {
            return false;
        }
    }
 
    private function exception($message) {
        if ($this->link) {
            $this->error = mysql_error($this->link);
            $this->errno = mysql_errno($this->link);
        } else {
            $this->error = mysql_error();
            $this->errno = mysql_errno();
        }
        if (PHP_SAPI !== 'cli') {
        ?>
 
            <div class="alert-bad">
                <div>
                    Database Error
                </div>
                <div>
                    Message: <?php echo $message; ?>
                </div>
                <?php if (strlen($this->error) > 0): ?>
                    <div>
                        <?php echo $this->error; ?>
                    </div>
                <?php endif; ?>
                <div>
                    Script: <?php echo @$_SERVER['REQUEST_URI']; ?>
                </div>
                <?php if (strlen(@$_SERVER['HTTP_REFERER']) > 0): ?>
                    <div>
                        <?php echo @$_SERVER['HTTP_REFERER']; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php
        } else {
                    echo "MYSQL ERROR: " . ((isset($this->error) && !empty($this->error)) ? $this->error:'') . "\n";
        };
    }
 
}

?>