<?php
session_start();
include "login_index.html";
// How to log in
// Check if the reader exists
// Check the password through table readers

$_SESSION['uid'] = $_POST["uid"];
$cur_id = $_SESSION['uid'];
$cur_pwd = $_POST["upwd"];
$url_customer = "customer_home_index.html";
$url_admin = "admin_page_index.html";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LIBRARY";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_rpwd = "SELECT RPWD FROM READER WHERE RID = '$cur_id'";
$sql_apwd = "SELECT MPWD FROM ADMIN WHERE MID = '$cur_id'";

if ($result = mysqli_query($conn, $sql_rpwd)){
    $row = $result->fetch_assoc();
    $tmp_cus = $row["RPWD"];
    mysqli_free_result($result);
}

if ($result = mysqli_query($conn, $sql_apwd)){
    $row = $result->fetch_assoc();
    $tmp_adm = $row["MPWD"];
    mysqli_free_result($result);
}

//Whether it exists
if($tmp_cus == "" && $tmp_adm == "") {
    echo "<script language='javascript' type='text/javascript'>";
    echo "alert(\"This ID does not exist!!!\");";
    echo "</script>";
}

//Check whether the password is right
else{
    if ($tmp_cus === $cur_pwd){
        echo "<script language='javascript' type='text/javascript'>";
        echo "window.location.href='$url_customer'";
        echo "</script>";
    }

    else if ($tmp_adm === $cur_pwd){
        echo "<script language='javascript' type='text/javascript'>";
        echo "window.location.href='$url_admin'";
        echo "</script>";
    }

    else{
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert(\"Wrong password!!!\");";
        echo "</script>";
    }
}

$conn->close();
?>