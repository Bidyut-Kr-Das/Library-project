<?php
include("connection/connection.php");
session_start();

$id=$_SESSION['id'];

$bookId= $_REQUEST['bookid'];
$bookQuantity=$_REQUEST['quantity'];
echo"<script>alert('first check')</script>";

if($_REQUEST['decider']=="bookBook"){
    echo"<script>alert('second check')</script>";

    //Query for inserting into booksTaken table------------------------------------>

    $query1="INSERT INTO `bookstaken` SET `student-id`='$id' ,`BookId`='$bookId' ";
    $result1=mysqli_query($connection,$query1);

    //reducing the quantity of selected book.----------------------------------------->

    $bookQuantity -= 1 ;
    // $bookQuantity=$bookQuantity-1;

    //Query for updating the `book_info` table------------------------------------->

    $query2="UPDATE `book_info` SET `AVL book`='$bookQuantity' WHERE `Id`='$bookId' ";
    $result2=mysqli_query($connection,$query2);
    if($result1&&$result2){
        header("location:LibraryHomepage.php?msg=Book purchased!&#secondDivbgImage");
    }
}
else if($_REQUEST['decider']=="returnBook"){

    //query to delete the taken book from database---------------------------------------->
    
    $query1="DELETE FROM `bookstaken` WHERE `BookId`='$bookId' AND`student-id`='$id' ";
    $result1=mysqli_query($connection,$query1);

    //query to change the book in the book_info table---------------------------------------->
    $bookQuantity+=1;
    $query2="UPDATE `book_info` SET `AVL book`='$bookQuantity' WHERE `Id`='$bookId' ";
    $result2=mysqli_query($connection,$query2);
    if($result1&&$result2){
        header("location:LibraryHomepage.php?msg=Book returned successfully!&#secondDivbgImage");
        // echo"<script>alert('third check')</script>";
    }
    else{
        echo "nono";
    }

}



?>