<?php
include "admin_customer_minus_index.html";
// How to delete a Reader
// Books have not return-whether can delete
// Delete information in table reader
// Delete information in table reserve
// Delete information in table borrow

$cur_rid = $_POST["rid"];
$info = "F";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LIBRARY";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_exist = "SELECT RID AS TRID FROM READER WHERE RID = '$cur_rid'";
if ($result = mysqli_query($conn, $sql_exist)){
    $row = $result->fetch_assoc();
    $ret = $row["TRID"];
    mysqli_free_result($result);
}
echo $cur_rid;

// You cannot delete
if ($ret == ""){
    echo "<script language='javascript' type='text/javascript'>";
    echo "alert(\"This reader does not exist!!!\");";
    echo "</script>";
}

else {
// Whether it can delete
    $sql_1 = "SELECT COUNT(DONE) AS CUR_RET
          FROM BORROW
          WHERE RID = '$cur_rid'
          AND DONE = '$info'";

    if ($result = mysqli_query($conn, $sql_1)) {
        $row = $result->fetch_assoc();
        $ret = $row["CUR_RET"];
        mysqli_free_result($result);
    }

// You cannot delete
    if ($ret > 0) {
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert(\"This reader has books which have not returned!!!\");";
        echo "</script>";
    } // Delete table reader, reserve, borrow
    else {

        $sql_reader = "DELETE FROM READER WHERE RID = '$cur_rid'";
        $sql_reserve = "DELETE FROM RESERVE WHERE RID = '$cur_rid'";
        $sql_borrow = "DELETE FROM BORROW WHERE RID = '$cur_rid'";

        if (mysqli_query($conn, $sql_reader) &&
            mysqli_query($conn, $sql_reserve) &&
            mysqli_query($conn, $sql_borrow)
        ) {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert(\"Successfully delete this reader!\");";
            echo "</script>";
        }
    }
}

$conn->close();
?>