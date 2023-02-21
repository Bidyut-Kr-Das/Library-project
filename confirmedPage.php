<?php
include("connection/connection.php");
session_start();
$id=$_SESSION['id'];
$bookId= $_REQUEST['bookid'];
$bookQuantity=$_REQUEST['quantity'];

//Query for inserting into booksTaken table------------------------------------>

$query1="INSERT INTO `bookstaken` SET `student-id`='$id' ,`BookId`='$bookId' ";
$result1=mysqli_query($connection,$query1);

//reducing the quantity of selected book.----------------------------------------->

$bookQuantity-=1;

//Query for updating the `book_info` table------------------------------------->

$query2="UPDATE `book_info` SET `AVL book`='$bookQuantity' WHERE `Id`='$bookId' ";
$result2=mysqli_query($connection,$query2);
if($result1&&$result2){
    header("location:LibraryHomepage.php");
}



?>