<?php
session_start();
if (isset($_POST['Abort'])) header("Location: list.php");
require_once("./object.php");
$db = new MySQLConnect('php_crud', '127.0.0.1', 'root', '');
$db_conn = $db->conndb();

// print_r($_GET);
if (isset($_GET['account'])) $account = $_GET['account'];
// else header("Location: list.php");
// echo $account;
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
$ErrMsg = '';

if (isset($_POST['Confirm'])){
	// if (!isset($_SESSION['account']) || empty($_SESSION['account'])) $ErrMsg = '帳號不可為空白\n';
    if (!isset($_POST['Name']) || empty($_POST['Name'])) $ErrMsg = '姓名不可為空白\n';
	if (!isset($_POST['Gender']) || empty($_POST['Gender'])) $ErrMsg = '性別不可為空白\n';
	if (!isset($_POST['Birthday']) || empty($_POST['Birthday'])) $ErrMsg = '生日不可為空白\n';
	if (!isset($_POST['Email']) || empty($_POST['Email'])) $ErrMsg = '信箱不可為空白\n';
	print_r($_POST);
	if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}/", $_POST['Birthday'])) $ErrMsg = '生日格式錯誤\n';
	if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) $ErrMsg = '信箱格式錯誤\n';
	
	if (empty($ErrMsg)){
		$_SESSION['account'] = $account;
		$_SESSION['name'] = $_POST['Name'];
		$_SESSION['gender'] = $_POST['Gender'];
		$_SESSION['birthday'] = $_POST['Birthday'];
		$_SESSION['email'] = $_POST['Email'];
		$_SESSION['text'] = $_POST['Text'];
		header("Location: checkmod.php");
	}
	
}
echo $ErrMsg;

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
	<h2 align="center">修改資料</h2>
	<div>
		<form method="POST" action="" align="center">
			<table align="center">
				<tr>
					<th>帳號</th>
					<td><?php echo $account; ?></td>
				</tr>
				<tr>
					<th>姓名</th>
					<td><input type="text" name="Name" size="10" value="<?php echo $name; ?>"></td>
				</tr>
				<tr>
					<th>性別</th>
					<td><input type="text" name="Gender" size="5" value="<?php echo $gender; ?>"></td>
				</tr>
				<tr>
					<th>生日</th>
					<td><input type="date" name="Birthday" size="20" value="<?php echo $birthday; ?>"></td>
				</tr>
				<tr>
					<th>信箱</th>
					<td><input type="text" name="Email" size="30" value="<?php echo $email; ?>"></td>
				</tr>
				<tr>
					<th>備註</th>
					<td><input type="text" name="Text" size="50" value="<?php echo $text; ?>"></td>
				</tr>
			</table>
			<input type="submit" name="Confirm" value="存檔送出">
			<input type="submit" name="Abort" value="放棄修改">
		</form>
	</div>
</body>
</html>