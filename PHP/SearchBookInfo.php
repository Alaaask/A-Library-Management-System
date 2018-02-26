<?php
// 目的：管理员查看书籍信息
// 资次模糊查询

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LIBRARY";

$ISBN = $_POST['ISBN'];
$BNAME = $_POST['BNAME'];
$AUTHOR = $_POST['AUTHOR'];
$KEY = $_POST['KEY'];
$PRESS = $_POST['PRESS'];
$PTIME = $_POST['PTIME'];
$TOTAL = $_POST['TOTAL'];
$COPY = $_POST['COPY'];
$LOCATE = $_POST['LOCATE'];

// ---------------------------------------------------------------------
// 创建链接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 检查链接
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
} 

// ---------------------------------------------------------------------
// 设置查询
$sql = "SELECT BOOKNAME.ISBN AS ISBN, BNAME, AUTHOR, KEY_1, KEY_2, KEY_3, 
               PRESS, PTIME, TOTAL, COPY, LOCATE
        FROM BOOKNAME NATURAL JOIN BOOKAUTHOR NATURAL JOIN 
             BOOKKEY NATURAL JOIN PRESSLIST NATURAL JOIN STORAGE ";
$condition = array();

if(empty($ISBN) == false) {
	$tem = " BOOKNAME.ISBN LIKE '".$ISBN."%' ";
	array_push($condition, $tem);
}

if(empty($BNAME) == false) {
	$tem = " BNAME LIKE '%".$BNAME."%' ";
	array_push($condition, $tem);
}

if(empty($AUTHOR) == false) {
	$tem = " AUTHOR LIKE '%".$AUTHOR."%' ";
	array_push($condition, $tem);
}

if(empty($PRESS) == false) {
	$tem = " PRESS LIKE '%".$PRESS."%' ";
	array_push($condition, $tem);
}

if(empty($PTIME) == false) {
	$tem = " PTIME LIKE '%".$PTIME."%' ";
	array_push($condition, $tem);
}

if(empty($TOTAL) == false) {
	$tem = " TOTAL = ".$TOTAL." ";
	array_push($condition, $tem);
}

if(empty($COPY) == false) { //对零的特殊判断
    if ($COPY == "zero") {
		$tem = " COPY = 0 ";
	}
	else {
	    $tem = " COPY = ".$COPY." ";
	}
	array_push($condition, $tem);
}

if(empty($LOCATE) == false) {
	$tem = " LOCATE LIKE '%".$LOCATE."%' ";
	array_push($condition, $tem);
}

if(empty($KEY) == false) {
	if(empty($condition)) {
		$tem = " KEY_1 LIKE '%".$KEY."%' OR KEY_2 LIKE '%".$KEY."%' OR KEY_3 LIKE '%".$KEY."%' ";
	}
	else {
	    $tem = " (KEY_1 LIKE '%".$KEY."%' OR KEY_2 LIKE '%".$KEY."%' OR KEY_3 LIKE '%".$KEY."%') ";
	}
	array_push($condition, $tem);
}

if(empty($condition) == false) {
	
	$len = count($condition);
	
	$sql .= " WHERE ";
	
	for( $i = 0; $i < $len-1; $i++) {
        $sql .= $condition[$i];
        $sql .= "AND";	
	}
	
	$sql .= $condition[$len-1];
}

$sql .= ";";

// ----------------------------------------------------------------------
// 查询结果
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {

    $reArray = array();
	while($row = mysqli_fetch_assoc($result)) {
		$data['ISBN'] = $row['ISBN'];
		$data['BNAME'] = $row['BNAME'];
		$data['AUTHOR'] = $row['AUTHOR'];
		$data['KEY_1'] = $row['KEY_1'];
		$data['KEY_2'] = $row['KEY_2'];
		$data['KEY_3'] = $row['KEY_3'];
		$data['PRESS'] = $row['PRESS'];
		$data['PTIME'] = $row['PTIME'];
		$data['TOTAL'] = $row['TOTAL'];
		$data['COPY'] = $row['COPY'];
		$data['LOCATE'] = $row['LOCATE'];
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