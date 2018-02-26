<?php
include "admin_book_minus_index.html";
// How to delete a book
// If this book exists
// Whether it can be deleted
// Not return or reservation
// Delete it

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LIBRARY";

$cur_isbn=$_POST["isbn"];

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Whether it exists
$sql_exist = "SELECT COUNT(ISBN) AS EXIST
              FROM BOOKNAME
              WHERE ISBN = '$cur_isbn'";

if ($result = mysqli_query($conn, $sql_exist)){

    $row = $result->fetch_assoc();
    $exist = $row["EXIST"];

    mysqli_free_result($result);
}
// It does not exist
if ($exist == 0){
    echo "<script language='javascript' type='text/javascript'>";
    echo "alert(\"This book does not exist or you input wrongly!!!\");";
    echo "</script>";
}

// Exists
else {
// Whether it can be deleted
    $sql_borrow = "SELECT COUNT(ISBN) AS CUR_BORROW
               FROM BORROW
               WHERE ISBN = '$cur_isbn'
               AND DONE='F'";
    if ($result = mysqli_query($conn, $sql_borrow)) {

        $row = $result->fetch_assoc();
        $borrow = $row["CUR_BORROW"];

        mysqli_free_result($result);
    }

    $sql_reserve = "SELECT COUNT(ISBN) AS CUR_RESERVE
                FROM RESERVE
                WHERE ISBN = '$cur_isbn'";

    if ($result = mysqli_query($conn, $sql_reserve)) {

        $row = $result->fetch_assoc();
        $reserve = $row["CUR_RESERVE"];

        mysqli_free_result($result);
    }

// You can not delete
    if ($borrow > 0 || $reserve > 0){
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert(\"These books are in borrow or reservation!!!\");";
        echo "</script>";
    }

// You can delete
    else {
        $sql_bookname = "DELETE FROM BOOKNAME WHERE ISBN = '$cur_isbn'";
        $sql_bookauthor = "DELETE FROM BOOKAUTHOR WHERE ISBN = '$cur_isbn'";
        $sql_bookkey = "DELETE FROM BOOKKEY WHERE ISBN = '$cur_isbn'";
        $sql_presslist = "DELETE FROM PRESSLIST WHERE ISBN = '$cur_isbn'";
        $sql_storage = "DELETE FROM STORAGE WHERE ISBN = '$cur_isbn'";
        $sql_borrow = "DELETE FROM BORROW WHERE ISBN = '$cur_isbn'";
        $sql_reserve = "DELETE FROM RESERVE WHERE ISBN = '$cur_isbn'";

        if (mysqli_query($conn, $sql_bookname) &&
            mysqli_query($conn, $sql_bookauthor) &&
            mysqli_query($conn, $sql_bookkey) &&
            mysqli_query($conn, $sql_presslist) &&
            mysqli_query($conn, $sql_storage) &&
            mysqli_query($conn, $sql_borrow) &&
            mysqli_query($conn, $sql_reserve)
        ) {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert(\"Delete this book successfully.\");";
            echo "</script>";
        }
        else {
            echo "Error";
        }
    }
}

$conn->close();
?>