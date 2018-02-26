<?php
// created by ZHAOYU
// 目的：管理员修改图书馆已有书的相关属性

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
// 修改属性

$ISBN = $_POST['ISBN'];
$newtotal = $_POST['total'];
$newcopy = $_POST['copy'];
$newlocation = $_POST['location'];
$newkey1 = $_POST['key1'];
$newkey2 = $_POST['key2'];
$newkey3 = $_POST['key3'];

$response = "";

if(empty($ISBN)) {
	$response.="Invalid ISBN.";
	echo $response;
	exit();
}

$sql_book = "SELECT * FROM BOOKNAME WHERE ISBN = '".$ISBN."'";
$book = $conn->query($sql_book);

if (mysqli_num_rows($book) == 0) {
	$response.="Invalid ISBN.";
	echo $response;
	exit();
}

if(!empty($newtotal)) {
	
	$sql = "UPDATE STORAGE SET TOTAL = '".$newtotal."' WHERE ISBN = '".$ISBN."'";
	
	if(mysqli_query($conn, $sql) === TRUE) {
		$response.= "Successfully update total.   ";
	}
	else {
		$response.="Failed in updating total.   ";
	}
}

if(!empty($newcopy)) {
	
	$sql = "UPDATE STORAGE SET COPY = '".$newcopy."' WHERE ISBN = '".$ISBN."'";
	
	if(mysqli_query($conn, $sql) === TRUE) {
		$response.= "Successfully update copy.   ";
	}
	else {
		$response.="Failed in updating copy.   ";
	}
}

if(!empty($newlocation)) {
	
	$sql = "UPDATE STORAGE SET LOCATE = '".$newlocation."' WHERE ISBN = '".$ISBN."'";
	
	if(mysqli_query($conn, $sql) === TRUE) {
		$response.= "Successfully update location.   ";
	}
	else {
		$response.="Failed in updating location.   ";
	}
}

if(!empty($newkey1)) {
	
	$sql = "UPDATE BOOKKEY SET KEY_1 = '".$newkey1."' WHERE ISBN = '".$ISBN."'";
	
	if(mysqli_query($conn, $sql) === TRUE) {
		$response.= "Successfully update key1.   ";
	}
	else {
		$response.="Failed in updating key1.   ";
	}
}

if(!empty($newkey2)) {
	
	$sql = "UPDATE BOOKKEY SET KEY_2 = '".$newkey2."' WHERE ISBN = '".$ISBN."'";
	
	if(mysqli_query($conn, $sql) === TRUE) {
		$response.= "Successfully update key2.  ";
	}
	else {
		$response.="Failed in updating key2.   ";
	}
}

if(!empty($newkey3)) {
	
	$sql = "UPDATE BOOKKEY SET KEY_3 = '".$newkey3."' WHERE ISBN = '".$ISBN."'";
	
	if(mysqli_query($conn, $sql) === TRUE) {
		$response.= "Successfully update key3.   ";
	}
	else {
		$response.="Failed in updating key3.   ";
	}
}

echo $response;

// ----------------------------------------------------------------------
// 关闭连接
mysqli_close($conn);

?>
