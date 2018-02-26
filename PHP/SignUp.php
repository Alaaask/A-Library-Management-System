<?php
session_start();
header("Content-type: text/html; charset=UTF-8");

$_SESSION['uid'] = $_POST['username'];
$user = $_POST['username'];  
$pwd = $_POST['password'];
$email = $_POST['email'];

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

$sql = "SELECT * FROM READER WHERE RID = '".$user."'";
$result = $conn->query($sql);
 
    if($row = mysqli_fetch_assoc($result)) { 
	
        echo 1;//用户已存在  
    }
	
	else {//注册成功  
        $sql = "INSERT INTO READER(RID,RPWD,EMAIL) VALUES ('".$user."','".$pwd."','".$email."')";
		
        if(mysqli_query($conn, $sql) === TRUE) { 
            echo 2;
		}
        else {
        	echo 3;
		}			
    }  


// ----------------------------------------------------------------------
// 关闭连接
mysqli_close($conn);

?>