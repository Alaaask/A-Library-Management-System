<?php

//目的：管理员删除预约表中的记录

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LIBRARY";

// ---------------------------------------------------------------------
// 创建链接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 检查链接
if (!$conn) {
die("连接失败: " . mysqli_connect_error());
}

$re = "Successfully delete these records";

$input = $_REQUEST['returnBook'];
for ($i=0; $i < count($input); $i++) {
	$tem = explode(" ", $input[$i]);
	$sql = "DELETE FROM RESERVE WHERE ISBN = '".$tem[1]."' AND RID = '".$tem[0]."'";
	mysqli_query($conn, $sql);
}

echo $re;

// ----------------------------------------------------------------------
// 关闭连接
mysqli_close($conn);

?>