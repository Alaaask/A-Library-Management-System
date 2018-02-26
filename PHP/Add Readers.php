<?php
include "admin_customer_plus_index.html";
// Information about database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LIBRARY";

// Information about readers
$CUR_RID=$_POST["rid"];
$CUR_RPWD=$_POST["rpwd"];
$CUR_EMAIL=$_POST["email"];

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($CUR_RID == "" || $CUR_RPWD == "" || $CUR_EMAIL == ""){
    echo "<script language='javascript' type='text/javascript'>";
    echo "alert(\"Lack of some important information, please check your input!!!\");";
    echo "</script>";
}

else {

    $sql_check = "SELECT RID FROM READER WHERE RID = '$CUR_RID'";
    if ($result = mysqli_query($conn, $sql_check)) {
        $row = $result->fetch_assoc();
        $tmp = $row["RID"];
        mysqli_free_result($result);
    }
    if ($tmp != "") {
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert(\"This ID has already existed!!!\");";
        echo "</script>";
    }
    else {
        $sql = "INSERT INTO READER(RID, RPWD, EMAIL)
                VALUES('$CUR_RID', '$CUR_RPWD', '$CUR_EMAIL')";

        if (mysqli_query($conn, $sql)) {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert(\"Successfully add a reader!\");";
            echo "</script>";
        }
    }
}

$conn->close();
?>