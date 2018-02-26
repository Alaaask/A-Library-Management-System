<?php
include "admin_book_plus_index.html";
// Information about database

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LIBRARY";

// Information about books
$cur_bname = "NULL";
$cur_author = "NULL";
$cur_key_1 = "NULL";
$cur_key_2 = "NULL";
$cur_key_3 = "NULL";
$cur_press = "NULL";
$cur_locate = "NULL";

$cur_isbn = $_POST["isbn"];
$cur_bname = $_POST["bname"];
$cur_author = $_POST["author"];
$cur_key_1 = $_POST["key_1"];
$cur_key_2 = $_POST["key_2"];
$cur_key_3 = $_POST["key_3"];
$cur_press = $_POST["press"];
$cur_ptime = $_POST["ptime"];
$cur_total = $_POST["total"];
$cur_copy = $_POST["total"];
$cur_locate = $_POST["locate"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($cur_ptime == "") {
        $sql_time_1 = "SELECT CURDATE() AS CURTIME";
        if ($result = mysqli_query($conn, $sql_time_1)) {
            $row = $result->fetch_assoc();
            $cur_ptime = $row["CURTIME"];
            mysqli_free_result($result);
        }
}

if ($cur_isbn == ""){
    echo "<script language='javascript' type='text/javascript'>";
    echo "alert(\"Without isbn, please check your input!!!\");";
    echo "</script>";
}

else if ($cur_total == ""){
    echo "<script language='javascript' type='text/javascript'>";
    echo "alert(\"Without the amount of books, please check your input!!!\");";
    echo "</script>";
}

else {

    $sql_check = "SELECT ISBN FROM BOOKNAME WHERE ISBN = '$cur_isbn'";

    if ($result = mysqli_query($conn, $sql_check)) {
        $row = $result->fetch_assoc();
        $tmp = $row["ISBN"];
        mysqli_free_result($result);
    }

    if ($tmp != "") {
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert(\"This ISBN has already existed!!!\");";
        echo "</script>";
    }
    else{

        $sql_1 = "INSERT INTO BOOKNAME(ISBN, BNAME)
          VALUES('$cur_isbn', '$cur_bname')";

        $sql_2 = "INSERT INTO BOOKAUTHOR(ISBN, AUTHOR)
          VALUES('$cur_isbn','$cur_author')";

        $sql_3 = "INSERT INTO BOOKKEY(ISBN, KEY_1, KEY_2, KEY_3)
          VALUES('$cur_isbn', '$cur_key_1', '$cur_key_2', '$cur_key_3')";

        $sql_4 = "INSERT INTO PRESSLIST(ISBN, PRESS, PTIME)
          VALUES('".$cur_isbn."', '".$cur_press."', '".$cur_ptime."')";

        $sql_5 = "INSERT INTO STORAGE(ISBN, TOTAL, COPY, LOCATE)
          VALUES('$cur_isbn', '$cur_total', '$cur_copy', '$cur_locate')";

        if (mysqli_query($conn, $sql_1) &&
            mysqli_query($conn, $sql_2) &&
            mysqli_query($conn, $sql_3) &&
            mysqli_query($conn, $sql_4) &&
            mysqli_query($conn, $sql_5)
        ) {

            echo "<script language='javascript' type='text/javascript'>";
            echo "alert(\"Successfully add a book!\");";
            echo "</script>";
        }

        else{

            $sql_delete_1 = "DELETE FROM BOOKNAME WHERE ISBN = '$cur_isbn'";
            $sql_delete_2 = "DELETE FROM BOOKKEY WHERE ISBN = '$cur_isbn'";
            $sql_delete_3 = "DELETE FROM PRESSLIST WHERE ISBN = '$cur_isbn'";
            $sql_delete_4 = "DELETE FROM STORAGE WHERE ISBN = '$cur_isbn'";
            $sql_delete_5 = "DELETE FROM BOOKAUTHOR WHERE ISBN = '$cur_isbn'";
            mysqli_query($conn, $sql_delete_1);
            mysqli_query($conn, $sql_delete_2);
            mysqli_query($conn, $sql_delete_3);
            mysqli_query($conn, $sql_delete_4);
            mysqli_query($conn, $sql_delete_5);

            echo "<script language='javascript' type='text/javascript'>";
            echo "alert(\"Fail to add a book!\");";
            echo "</script>";
        }
    }
}
$conn->close();
?>