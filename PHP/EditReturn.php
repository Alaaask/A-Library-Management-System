<?php
// created by ZHAOYU
// 目的：管理员记录还书

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
	$response.="Invalid RID. ";
	echo $response;
	exit();
}

// ----------------------------------------------------------------------
// 判断书籍是否合法及有无未还记录
$sql = "SELECT * FROM STORAGE";
$storage = $conn->query($sql);

$invalidISBN = true;

if (mysqli_num_rows($storage) > 0) {
	
	while($srow = mysqli_fetch_assoc($storage)) {
		
		if($srow['ISBN'] == $ISBN) {
			$invalidISBN = false;
			break;
		}
		
	}
}

// 判断书籍合法？
if($invalidISBN) {
	$response.="Invalid ISBN. ";
	echo $response;
	exit();
}

// 判断有无未还记录
$sql = "SELECT * FROM BORROW";
$borrow = $conn->query($sql);

$invalidrecord = true;

while($brow = mysqli_fetch_assoc($borrow)) {
	
	if($brow['ISBN'] == $ISBN and $brow['RID'] == $RID and $brow['DONE'] == 'F') {
		$invalidrecord = false;
		break;
	}
	
}

if($invalidrecord) {
	$response.="There is no record in table borrow. ";
	echo $response;
	exit();
}

// ----------------------------------------------------------------------
// 还书
// 每个人同一段时间只能借一本书的一个副本，保证一次只能还一本

$sql = "UPDATE BORROW SET ETIME = curdate(),DONE = 'T' 
		WHERE ISBN = '".$ISBN."' AND RID = '".$RID."' AND DONE = 'F'";	  

if (mysqli_query($conn, $sql) === TRUE) {
	
	$sql = "UPDATE STORAGE SET COPY = '".$srow['COPY']."'+1 WHERE ISBN = '".$ISBN."'";
	
		if (mysqli_query($conn, $sql) === TRUE) {
			
			$response.="Successfully return the book. ";
	        echo $response;
			
            mysqli_close($conn); // 关闭连接
			exit();
		}
		else {
			$response.="Failed in updating copy in table storage. ";
	        echo $response;
			exit ();
		}
	}
		
else {
	$response.="Failed in updating table borrow. ";
	echo $response;
	exit ();
}

?>
