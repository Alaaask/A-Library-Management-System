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

// Select history borrow records
$sql = "SELECT BORROW.ISBN, BNAME, STIME, ETIME, DONE
        FROM BORROW, BOOKNAME
        WHERE BORROW.ISBN = BOOKNAME.ISBN
        AND BORROW.RID = '$cur_rid'";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {

    $reArray = array();
    while($row = mysqli_fetch_assoc($result)){
        $tem['ISBN'] = $row['ISBN'];
        $tem['BNAME'] = $row['BNAME'];
        $tem['STIME'] = $row['STIME'];
        $tem['ETIME'] = $row['ETIME'];
        if ($row['DONE'] == 'F') $tem['DONE'] = "In Borrow";
        else $tem['DONE'] = "Returned";

        array_push($reArray, $tem);
    }
    echo json_encode($reArray);
}
$conn->close();
?>