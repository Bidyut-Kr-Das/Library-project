<?php
include("connection/connection.php");
session_start();

$id = $_SESSION['id'];

$bookId = $_REQUEST['bookid'];
$bookQuantity = $_REQUEST['quantity'];
$borrowtime = $_REQUEST['borrowtime'];
// echo"<script>alert('first check')</script>";
// echo $bookQuantity;

if ($_REQUEST['decider'] == "bookBook") {
    // echo"<script>alert('second check')</script>";

    //Query for inserting into booksTaken table------------------------------------>
    $issuedate = date("Y-m-d");
    // echo "<script>alert(".$issuedate.")</script>";

    $query1 = "INSERT INTO `bookstaken` SET `student-id`='$id' ,`BookId`='$bookId' ,`IssueDate`='$issuedate',`borrowtime`='$borrowtime' ";
    $result1 = mysqli_query($connection, $query1);
    $bidyut = 5;
    // $bookQuantity=$bookQuantity-1;

    //Query for updating the `book_info` table------------------------------------->
    if ($bookQuantity == 0) {
        $query2 = "UPDATE `book_info` SET `AVL book`='$bookQuantity' WHERE `Id`='$bookId' ";
        $result2 = mysqli_query($connection, $query2);
        if ($result1 && $result2) {
            header("location:LibraryHomepage.php?msg=Book purchased!&#secondDivbgImage");
        }

    } else {
        //reducing the quantity of selected book.----------------------------------------->

        $bookQuantity -= 1;

        $query2 = "UPDATE `book_info` SET `AVL book`='$bookQuantity' WHERE `Id`='$bookId' ";
        $result2 = mysqli_query($connection, $query2);
        if ($result1 && $result2) {
            header("location:LibraryHomepage.php?msg=Book purchased!&#secondDivbgImage");
        }
    }

} else if ($_REQUEST['decider'] == "returnBook") {

    //query to delete the taken book from database---------------------------------------->

    $query1 = "DELETE FROM `bookstaken` WHERE `BookId`='$bookId' AND`student-id`='$id' ";
    $result1 = mysqli_query($connection, $query1);

    //query to change the book in the book_info table---------------------------------------->
    $bookQuantity += 1;
    $query2 = "UPDATE `book_info` SET `AVL book`='$bookQuantity' WHERE `Id`='$bookId' ";
    $result2 = mysqli_query($connection, $query2);
    if ($result1 && $result2) {
        header("location:LibraryHomepage.php?msg=Book returned successfully!&#secondDivbgImage");
        // echo"<script>alert('third check')</script>";
    } else {
        echo "nono";
    }

}

?>