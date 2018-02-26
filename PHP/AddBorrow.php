<?php
// 目的：管理员增加借书记录

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LIBRARY";

$ISBN = $_POST['bkid'];
$RID = $_POST['id'];
$response = "";

// ---------------------------------------------------------------------
// 创建链接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 检查链接
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
} 

// ---------------------------------------------------------------------
// 判断id是否合法
$sql = "SELECT * FROM READER";
$result = $conn->query($sql);

$invalidRID = true;

if (mysqli_num_rows($result) > 0) {
	
	while($row = mysqli_fetch_assoc($result)) {
		if($row["RID"] == $RID) {
		$invalidRID = false;
		break;
		}
	}
}

if($invalidRID) {
	$response.="Invalid READER ID. ";
	echo $response;
	exit();
}

// ----------------------------------------------------------------------
// 判断他是否这段时间已借阅此书的其他副本

$sql = "SELECT * FROM BORROW WHERE ISBN = '".$ISBN."' AND RID = '".$RID."' AND DONE = 'F'";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
	$response .= "One reader can only have borrowed at most 1 copy of every book at the same time. ";
	echo $response;
	exit();
}


// ----------------------------------------------------------------------
// 判断书籍是否合法且可借
$sql = "SELECT * FROM STORAGE";
$result = $conn->query($sql);

$invalidISBN = true;
$nocopy = true;

if (mysqli_num_rows($result) > 0) {
	
	while($row = mysqli_fetch_assoc($result)) {
		
		if($row['ISBN'] == $ISBN) {
			
			$invalidISBN = false;
			
			if($row['COPY'] >= 1) {
				
				$nocopy = false;
				
				$sql = "UPDATE STORAGE SET COPY = '".$row['COPY']."'-1 WHERE ISBN = '".$ISBN."'";
				mysqli_query($conn, $sql);
				
				break;
				
			}
		}
	}
}

// 判断书籍合法？及有无副本
if ($invalidISBN) {
	$response.="Invalid ISBN.  ";
	echo $response;
	exit();
}

if ($nocopy) {
	$response.="No copy.  ";
	echo $response;
	exit();
}

// ----------------------------------------------------------------------
// 借书
// 删除预约
$sql = "DELETE FROM RESERVE WHERE RID='".$RID."' AND ISBN='".$ISBN."'";
mysqli_query($conn, $sql);

$sql = "INSERT INTO BORROW (ISBN, RID, STIME, DONE, ETIME)
      VALUES('".$ISBN."', '".$RID."', curdate(), 'F', date_add(curdate(),interval 2 month))";
	  
if (mysqli_query($conn, $sql) === TRUE) {
	$response.="Successfully update.  ";
    echo $response;
	exit();
} 
else {
    $response.="Wrong with sql.  ";
    echo $response;
	exit();
}

// ----------------------------------------------------------------------
// 关闭连接
mysqli_close($conn);

?>
