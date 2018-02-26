<?php
// 目的：管理员查看往前往后推一周(共两周)的未还书记录

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
// 查询上周和未来一周应还未还书
$sql = "SELECT * FROM BORROW WHERE DONE = 'F' 
       AND ETIME<=date_add(curdate(),interval 1 week) 
	   AND ETIME>=date_add(curdate(),interval -1 week)";
	   
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
	
   $reArray = array();
	while($row = mysqli_fetch_assoc($result)) {
		
		$data['RID'] = $row['RID'];
		$data['ISBN'] = $row['ISBN'];
		$data['STIME'] = $row['STIME'];
		$data['ETIME'] = $row['ETIME'];
		
		array_push($reArray, $data);
	}
	echo json_encode($reArray);
}

else {
	echo 0;
}

// ----------------------------------------------------------------------
// 关闭连接
mysqli_close($conn);

?>
