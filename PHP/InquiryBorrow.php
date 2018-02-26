<?php
// ZHAOYU
// 目的：管理员查询借书情况

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
// 混合查询

$reArray = array(); //结果

$ifset = array(empty($_POST['starttime']), empty($_POST['RID']), empty($_POST['ISBN']));

switch($ifset) {
	
	case array(false,false,false):
	    $sql = "SELECT * FROM BORROW 
			    WHERE STIME = '".$_POST['starttime']."'
			        AND RID = '".$_POST['RID']."'
			        AND ISBN = '".$_POST['ISBN']."'";
        break;
		
	case array(false,false,true):
	    $sql = "SELECT * FROM BORROW 
			    WHERE STIME = '".$_POST['starttime']."'
			        AND RID = '".$_POST['RID']."'";
	    break;
		
	case array(false,true,false):
	    $sql = "SELECT * FROM BORROW 
			    WHERE STIME = '".$_POST['starttime']."'
			        AND ISBN = '".$_POST['ISBN']."'";
	    break;
		
	case array(true,false,false):
	    $sql = "SELECT * FROM BORROW
			    WHERE RID = '".$_POST['RID']."'
				    AND ISBN = '".$_POST['ISBN']."'";
	    break;
		
	case array(false,true,true):
	    $sql = "SELECT * FROM BORROW 
			    WHERE STIME = '".$_POST['starttime']."'";
	    break;
		
	case array(true,false,true):
	    $sql = "SELECT * FROM BORROW 
			    WHERE RID = '".$_POST['RID']."'";
	    break;
		
	case array(true,true,false):
	    $sql = "SELECT * FROM BORROW 
			    WHERE ISBN ='".$_POST['ISBN']."'";
	    break;
	
	case array(true,true,true):
	    $sql = "SELECT * FROM BORROW";
		break;
		
	default:
	    echo json_encode($reArray);
		exit ();
		
}

$bresult = $conn->query($sql);

if (mysqli_num_rows($bresult) > 0) {
	
	while($brow = mysqli_fetch_assoc($bresult)) {
		
		$tem['ISBN'] = $brow['ISBN'];
		$tem['RID'] = $brow['RID'];
		$tem['STIME'] = $brow['STIME'];
		$tem['DONE'] = $brow['DONE'];
		$tem['ETIME'] = $brow['ETIME'];
		
		array_push($reArray, $tem);
	}
}

echo json_encode($reArray);

// ---------------------------------------------------------------------
// 关闭连接
mysqli_close($conn);

?>

