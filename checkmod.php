<?php
session_start();

if (isset($_POST['Abort'])) header("Location: list.php");

require_once("./object.php");
$db = new MySQLConnect('php_crud', '127.0.0.1', 'root', '');
$db_conn = $db->conndb();

if (isset($_POST['Confirm'])) {
	$sqlcmd="UPDATE account_info SET 姓名=:name,性別=:gender,生日=:birthday,信箱=:email,備註=:text "
            . "WHERE 帳號=:account";
	$exec = [':name' => $_SESSION['name'], ':gender' => $_SESSION['gender'], ':birthday' => $_SESSION['birthday'], ':email' => $_SESSION['email'], ':text' => $_SESSION['text'], ':account' => $_SESSION['account']];
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
					<td><?php echo $_SESSION['account']; ?></td>
				</tr>
				<tr>
					<th>姓名</th>
					<td><input type="text" name="Name" size="10" value="<?php echo $_SESSION['name']; ?>"></td>
				</tr>
				<tr>
					<th>性別</th>
					<td><input type="text" name="Gender" size="5" value="<?php echo $_SESSION['gender']; ?>"></td>
				</tr>
				<tr>
					<th>生日</th>
					<td><input type="date" name="Birthday" size="20" value="<?php echo $_SESSION['birthday']; ?>"></td>
				</tr>
				<tr>
					<th>信箱</th>
					<td><input type="text" name="Email" size="30" value="<?php echo $_SESSION['email']; ?>"></td>
				</tr>
				<tr>
					<th>備註</th>
					<td><input type="text" name="Text" size="50" value="<?php echo $_SESSION['text']; ?>"></td>
				</tr>
			</table>
			<input type="submit" name="Confirm" value="存檔送出">
			<input type="submit" name="Abort" value="放棄新增">
		</form>
	</div>
</body>
</html>