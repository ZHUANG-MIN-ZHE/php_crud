<?php
session_start();
if (isset($_POST['Abort'])) header("Location: list.php");
$ErrMsg = '';
if (!isset($account)) $account = '';
if (!isset($name)) $name = '';
if (!isset($gender)) $gender = '';
if (!isset($birthday)) $birthday = date("m-d");
if (!isset($email)) $email = '';
if (!isset($text)) $text = '';

if (isset($_POST['Confirm'])) {
	if (isset($_POST['account'])) $account = $_POST['account'];
	if (isset($_POST['name'])) $name = $_POST['name'];
	if (isset($_POST['gender'])) $gender = $_POST['gender'];
	if (isset($_POST['birthday'])) $birthday = $_POST['birthday'];
	if (isset($_POST['email'])) $email = $_POST['email'];
	if (isset($_POST['text'])) $text = $_POST['text'];
	
	
	if (empty($account)) $ErrMsg = '帳號不可為空白\n';
	if (empty($name)) $ErrMsg = '姓名不可為空白\n';
	if (empty($gender)) $ErrMsg = '性別不可為空白\n';
	if (empty($birthday)) $ErrMsg = '生日不可為空白\n';
	if (empty($email)) $ErrMsg = '信箱不可為空白\n';
	
	if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}/", $birthday)) $ErrMsg = '生日格式錯誤\n';
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $ErrMsg = '信箱格式錯誤\n';
	if (empty($ErrMsg)) {
		$_SESSION['account'] = $account;
		$_SESSION['name'] = $name;
		$_SESSION['gender'] = $gender;
		$_SESSION['birthday'] = $birthday;
		$_SESSION['email'] = $email;
		$_SESSION['text'] = $text;
		
		header("Location: doublecheck.php");
	}
	else {
		echo '<script type ="text/JavaScript">';  
		echo "alert('$ErrMsg')";  
		echo '</script>';
	}
}
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="veiwport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
	<title>create</title>
</head>
<body>
	<h2 align="center">新增資料</h2>
	<div>
		<form method="POST" action="" align="center">
			<table align="center">
				<tr>
					<th>帳號</th>
					<td><input type="text" name="account" size="30" value="<?php echo $account ?>"></td>
				</tr>
				<tr>
					<th>姓名</th>
					<td><input type="text" name="name" size="10" value="<?php echo $name ?>"></td>
				</tr>
				<tr>
					<th>性別</th>
					<td><input type="text" name="gender" size="5" value="<?php echo $gender ?>"></td>
				</tr>
				<tr>
					<th>生日</th>
					<td><input type="date" name="birthday" size="20" value="<?php echo date("Y-m-d") ?>"></td>
				</tr>
				<tr>
					<th>信箱</th>
					<td><input type="text" name="email" size="30" value="<?php echo $email ?>"></td>
				</tr>
				<tr>
					<th>備註</th>
					<td><input type="text" name="text" size="50" value="<?php echo $text ?>"></td>
				</tr>
			</table>
			<input type="submit" name="Confirm" value="存檔送出">
			<input type="submit" name="Abort" value="放棄新增">
		</form>
	</div>
</body>
</html>