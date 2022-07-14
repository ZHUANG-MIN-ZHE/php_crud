<?php 
// session_start();
require_once("./object.php");
$db = new MySQLConnect('php_crud', '127.0.0.1', 'root', '');
$db_conn = $db->conndb();

$ItemPerPage = 5;
$sqlcmd = "SELECT count(*) AS reccount FROM account_info ";
$rs = $db->querytable($db_conn, $sqlcmd, []);
$RecCount = $rs[0]['reccount'];
$TotalPage = (int) ceil($RecCount/$ItemPerPage);
if (!isset($Page)) {
    if (isset($_SESSION['CurPage'])) $Page = $_SESSION['CurPage'];
    else $Page = 1;
}
if (isset($_POST['Page'])) {
	$Page = $_POST['Page'];
}
if ($Page<1) $Page = 1;
if ($Page > $TotalPage) $Page = $TotalPage;
$_SESSION['CurPage'] = $Page;
$StartRec = ($Page-1) * $ItemPerPage;
$sqlcmd = "SELECT * FROM account_info LIMIT $StartRec,$ItemPerPage";
$DataContent = $db->querytable($db_conn, $sqlcmd, []);


?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
	<meta http-equiv="pragma" content="no-cache">
	<meta name="veiwport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.6">
	<title>show</title>
	<link rel="stylesheet" href="./css/table.css">
</head>
<body>
	<div>
		<table border="0" align="center" cellspacing="0"cellpadding="2">
			<tr>
			  <td width="50%" align="left">
				<?php if ($TotalPage > 1) { ?>
					<form name="SelPage" method="POST" action="">
						第<select name="Page" onchange="submit();">
						<?php 
							for ($p=1; $p<=$TotalPage; $p++) { 
								echo '  <option value="' . $p . '"';
								if ($p == $Page) echo ' selected';
								echo ">$p</option>\n";
							}
						?>
						</select>頁 共<?php echo $TotalPage ?>頁
					</form>
				<?php } ?>
			  <td align="right" width="15%">
				<a href="" target="_EXCEL">上傳</a>
				<a href="">下載</a>
				<a href="./create.php">新增</a>
			  </td>
			</tr>
		</table>
		<table align="center" style="border: 3px solid black; border-collapse: collapse;">
			<tr>
				<th width="10%">刪除</th>
				<th width="10%">修改</th>
				<th width="15%">帳號</th>
				<th width="10%">姓名</th>
				<th width="8%">性別</th>
				<th width="10%">生日</th>
				<th width="15%">信箱</th>
				<th width="15%">備註</th>
			</tr>
				<?php
					foreach ($DataContent AS $item) {
					  $Account = $item['帳號'];
					  $Name = $item['姓名'];
					  $Gender = $item['性別'];
					  $Date = $item['生日'];
					  $Email = $item['信箱'];
					  $Text = $item['備註'];
				?>
					<tr>
					<td><a href="./delete.php?account=<?php echo $Account; ?>">刪除</a></td>
					<td><a href="./modify.php?account=<?php echo $Account; ?>">修改</a></td>
					<td><?php echo $Account ?></td>
					<td><?php echo $Name ?></td>
					<td><?php echo $Gender ?> </td>
					<td><?php echo $Date ?></td>  
					<td><?php echo htmlspecialchars($Email); ?></td>
					<td><?php echo $Text ?></td>       
					</tr>
				<?php
				}
				?>
		</table>
	</div>
</body>
</html>