<?php
interface db_func {
	public function conndb();
	public function querytable($db_conn, $sqlcmd, $exec);
	public function deletetable($db_conn, $sqlcmd, $exec);
	public function inserttable($db_conn, $sqlcmd, $exec);
	public function updatetable($db_conn, $sqlcmd, $exec);
}

class MySQLcontent {
	private $dbname;
	private $dbhost;
	private $dbuser;
	private $dbpwd;
}

class MySQLConnect extends MySQLcontent implements db_func{
	
	function __construct($dbname, $dbhost, $dbuser, $dbpwd){
		$this->dbname = $dbname;
		$this->dbhost = $dbhost;
		$this->dbuser = $dbuser;
		$this->dbpwd = $dbpwd;
	}
	
	public function get_all(){
		return $this->dbname . ' ' . $this->dbhost . ' ' . $this->dbuser . ' ' . $this->dbpwd;
	}
	public function conndb(){
		$dsn = "mysql:host=$this->dbhost;dbname=$this->dbname";
		try {
			$db_conn = new PDO($dsn, $this->dbuser, $this->dbpwd);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
			die ("錯誤: 無法連接到資料庫");
		}
		$db_conn->query("SET NAMES UTF8");
		return $db_conn;
	}
	public function querytable($db_conn, $sqlcmd, $exec){
		$stmt = $db_conn->prepare($sqlcmd);
		$stmt->execute($exec);
		$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rs;
	}
	public function deletetable($db_conn, $sqlcmd, $exec){
		$stmt = $db_conn->prepare($sqlcmd);
		$stmt->execute($exec);
	}
	public function inserttable($db_conn, $sqlcmd, $exec){
		$stmt = $db_conn->prepare($sqlcmd);
		$stmt->execute($exec);
	}
	public function updatetable($db_conn, $sqlcmd, $exec){
		$stmt = $db_conn->prepare($sqlcmd);
		$stmt->execute($exec);
	}
}

// $dbconn = new MySQLConnect('php_crud', '127.0.0.1', 'root', '');
// echo $dbconn->get_all();

// $db_conn = $dbconn->conndb();
// $sqlcmd = 'SELECT * FROM account_info';
// $rs = $dbconn->querytable($db_conn, $sqlcmd);
// print_r($rs);

//創建
// $sqlcmd = 'CREATE TABLE admin (' .
		// '帳號 VARCHAR(30) NOT NULL DEFAULT "" PRIMARY KEY,' .
		// '姓名 VARCHAR(10) NOT NULL DEFAULT "",' .
		// '性別 VARCHAR(5) NOT NULL DEFAULT "",' .
		// '生日 DATE NOT NULL DEFAULT "2000-01-01",' .
		// '信箱 VARCHAR(50) NOT NULL DEFAULT "",' .
		// '備註 text NOT NULL DEFAULT "" )';
// $dbconn->createtable($db_conn, $sqlcmd);

// 刪除
// $sqlcmd = 'DROP TABLE admin';
// $dbconn->deletetable($db_conn, $sqlcmd);
?>