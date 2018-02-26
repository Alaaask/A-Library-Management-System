<?php
// How to search a book
// Reader input information
// Check which information is not null
// Combine sql sentences

$flg = $_POST["choice"];

$cur_text = $_POST["input"];
$cur_name = $cur_text;
$cur_author = $cur_text;
$cur_key = $cur_text;

// Information about books
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LIBRARY";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Necessary sql sentences
$sql = "SELECT BOOKNAME.ISBN, BNAME, PRESS, PTIME, AUTHOR, TOTAL, COPY, LOCATE, KEY_1, KEY_2, KEY_3
        FROM BOOKNAME, BOOKAUTHOR, PRESSLIST, STORAGE, BOOKKEY
        WHERE BOOKAUTHOR.ISBN = BOOKNAME.ISBN
        AND PRESSLIST.ISBN = BOOKAUTHOR.ISBN
        AND STORAGE.ISBN = PRESSLIST.ISBN
        AND BOOKKEY.ISBN = STORAGE.ISBN";

// Possible sql sentences
$sql_name = "AND BNAME LIKE '%$cur_name%'";
$sql_author = "AND AUTHOR LIKE '%$cur_author%'";
$sql_key = "HAVING KEY_1 LIKE '%$cur_key%' OR KEY_2 LIKE '%$cur_key%' OR KEY_3 LIKE '%$cur_key%'";
$sql_group = "GROUP BY BOOKNAME.ISBN, BNAME, PRESS, PTIME, AUTHOR, TOTAL, COPY, LOCATE, KEY_1, KEY_2, KEY_3";

// Connect sentences
$sql_search = $sql;
if ($flg == "value1") $sql_search = $sql_search . " " . $sql_name;
if ($flg == "value2") $sql_search = $sql_search. " " . $sql_author;
$sql_search = $sql_search. " " .$sql_group;
if ($flg == "value3") $sql_search = $sql_search. " " . $sql_key;

$result = $conn->query($sql_search);

if (mysqli_num_rows($result) > 0) {

    $reArray = array();
    while($row = mysqli_fetch_assoc($result)){
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

    echo json_encode($reArray);
}

$conn->close();
?>