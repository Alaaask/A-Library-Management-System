<?php
// 目的：管理员查看预约表的所有记录及email及copy

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

// ---------------------------------------------------------------------
// 查询预约
$sql = "SELECT READER.RID AS RID,RESERVE.ISBN AS ISBN,COPY,STIME,EMAIL 
        FROM RESERVE,READER,STORAGE 
		WHERE RESERVE.RID = READER.RID AND RESERVE.ISBN = STORAGE.ISBN";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {

	$reArray = array();
	while($row = mysqli_fetch_assoc($result)) {
		$tem['RID'] = $row['RID'];
		$tem['ISBN'] = $row['ISBN'];
		$tem['COPY'] = $row['COPY'];
		$tem['STIME'] = $row['STIME'];
		$tem['EMAIL'] = $row['EMAIL'];
		//echo $row['RID']." ".$row['ISBN']." ".$row['EMAIL'];

		array_push($reArray, $tem);
	}

	echo json_encode($reArray);
}
// ----------------------------------------------------------------------
// 关闭连接
mysqli_close($conn);

?>

