<?php
session_start();

if (isset($_POST['Abort'])) header("Location: list.php");

require_once("./object.php");
$db = new MySQLConnect('php_crud', '127.0.0.1', 'root', '');
$db_conn = $db->conndb();

if (isset($_GET['account'])) $account = $_GET['account'];
$sqlcmd = "SELECT * FROM account_info WHERE 帳號=:account";
$exec = [':account' => $account];
$rs = $db->querytable($db_conn, $sqlcmd, $exec);

if (count($rs)>0) {
	$account = $rs[0]['帳號'];
	$name = $rs[0]['姓名'];
	$gender = $rs[0]['性別'];
	$birthday = $rs[0]['生日'];
	$email = $rs[0]['信箱'];
	$text = $rs[0]['備註'];
}
else die("查無資料");

if (isset($_POST['Confirm'])) {
	$sqlcmd="DELETE FROM account_info WHERE 帳號=:account";
	$exec = [':account' => $_GET['account']];
	$db->updatetable($db_conn, $sqlcmd, $exec);
	
	header("Location: list.php");
}
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="veiwport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
	<title>insert</title>
</head>
<body>
	<h2 align="center">再次確認</h2>
	<div>
		<form method="POST" action="" align="center">
			<table align="center">
				<tr>
					<th>帳號</th>
					<td><?php echo $account; ?></td>
				</tr>
				<tr>
					<th>姓名</th>
					<td><?php echo $name; ?></td>
				</tr>
				<tr>
					<th>性別</th>
					<td><?php echo $gender; ?></td>
				</tr>
				<tr>
					<th>生日</th>
					<td><?php echo $birthday; ?></td>
				</tr>
				<tr>
					<th>信箱</th>
					<td><?php echo $email; ?></td>
				</tr>
				<tr>
					<th>備註</th>
					<td><?php echo $text; ?></td>
				</tr>
			</table>
			<input type="submit" name="Confirm" value="確認刪除">
			<input type="submit" name="Abort" value="放棄刪除">
		</form>
	</div>
</body>
</html>