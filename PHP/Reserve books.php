<?php
session_start();

$cur_rid = $_SESSION['uid'];
$reArray = array();

// Information about database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LIBRARY";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$input = $_REQUEST['returnBook'];
for ($i = 0; $i < count($input); $i++) {

    $tem = EXPLODE(" ", $input[$i]);
    echo $tem[0];

    $sql_check = "SELECT COPY FROM STORAGE WHERE ISBN = '".$tem[0]."'";
    if ($result = mysqli_query($conn, $sql_check)) {
        $row = $result->fetch_assoc();
        $copy = $row["COPY"];
        mysqli_free_result($result);
    }

    if ($copy > 0) {
        $sql_time_1 = "SELECT CURDATE() AS CURTIME";
        if ($result = mysqli_query($conn, $sql_time_1)) {
            $row = $result->fetch_assoc();
            $stime = $row["CURTIME"];
            mysqli_free_result($result);
        }
    }
    else {
        $sql_time_2 = "SELECT ETIME AS CURTIME
                       FROM BORROW
                       WHERE ISBN = '".$tem[0]."'";
        if ($result = mysqli_query($conn, $sql_time_2)) {
            $row = $result->fetch_assoc();
            $stime = $row["CURTIME"];
            mysqli_free_result($result);
        }
    }
    echo $stime;
    $sql_update = "INSERT INTO RESERVE(ISBN, RID, STIME) VALUES('".$tem[0]."', '$cur_rid', '$stime')";
    $result = mysqli_query($conn, $sql_update);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $tem['ISBN'] = $row['ISBN'];
            $tem['BNAME'] = $row['BNAME'];
            $tem['PTIME'] = $row['PTIME'];
            $tem['PRESS'] = $row['PRESS'];
            $tem['AUTHOR'] = $row['AUTHOR'];
            $tem['LOCATE'] = $row['LOCATE'];
            $tem['KEY_1'] = $row['KEY_1'];
            $tem['KEY_2'] = $row['KEY_2'];
            $tem['KEY_3'] = $row['KEY_3'];

            array_push($reArray, $tem);
        }
    }
    echo json_encode($reArray);

}

$conn->close();
?>