<?php
session_start();

$cur_rid = $_SESSION['uid'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LIBRARY";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$re = "Successfully delete these reservations.";

$input = $_REQUEST['returnisbn'];
for ($i = 0; $i < count($input); $i++) {
    $tem = EXPLODE(" ", $input[$i]);
    $sql = "DELETE FROM RESERVE 
            WHERE RID = '$cur_rid'
            AND ISBN = '".$tem[0]."'";
    mysqli_query($conn, $sql);
}

echo $re;

$conn->close();
?>