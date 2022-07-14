<?php
// 變數及函式處理，請注意其順序
require_once("./include/configure.php");
require_once("./include/db_func.php");
$db_conn = connect2db($dbhost, $dbuser, $dbpwd, $dbname);
// $sqlcmd = "SELECT * FROM user WHERE valid='Y'";
$sqlcmd = 'SELECT * FROM users';
$stmt = $db_conn->prepare($sqlcmd);
$stmt->execute([]);
$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($rs);
?>