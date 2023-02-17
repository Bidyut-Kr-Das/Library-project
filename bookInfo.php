<?php
    include("connection.php");
    session_start();
    $bookId=$_REQUEST['bookid'];
    $id=$_SESSION['id'];
    $query1="SELECT * FROM `information` WHERE `id`='$id' ";
    $result1=mysqli_query($connection,$query1);
    $rowarr1=mysqli_fetch_array($result1);
    $name=$rowarr1['Firstname'];

    $query2="SELECT * FROM `book_info` WHERE `BOOK id`='$bookId' ";
    $result2=mysqli_query($connection,$query2);
    $rowarr2=mysqli_fetch_array($result2);

    if(!empty($_REQUEST['mode1'])){
        $query3="INSERT INTO `bookstaken` SET `student-id`='$id',
                                                                                            `book-id`='$bookId'";
        $result3=mysqli_query($connection,$query3);
        header("location:LibraryHomepage.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome <?php echo $name;?></title>
        <link href="css-bookInfo.css" rel="stylesheet">
    </head>
    <body>
        <script src=""></script>
        <div class="bgImage" id="bgImage"></div>
        <div id="supermainDiv">
            <div class="maindiv" id="mainDiv">
                <div class="logo" id="logo">
                    <div id="welcomename">Hello, <?php echo $name;?></div>
                    <div class="navigationBar" id="navigatonBar">
                            <div id="home">Home</div>
                            <div id="Wishlist">Wishlist</div>
                            <div id="Profile"><a href="" id="profile">Profile</a></div>
                            <div id="Logout"><a href="logout.php" id="logout">Logout</a></div>
                    </div>
                </div>
                <div id="textArea">
                    <?php
                    if($rowarr2==NULL){
                    ?>
                    <div id="bookInfo">Book is not available!</div>
                    <?php
                    }
                    else{
                    ?>
                    ?>
                    <div id="bookInfo">
                        <div id="bookname"><?php echo $rowarr2['Book name']?></div>
                        <div id="bookAuthor">Author: <?php echo $rowarr2['Author']?></div>
                        <div id="description">Description: </div>
                    </div>
                    <div id="confirmation">
                        <div id="confirmationText">Confirm your purchase?</div>
                        <div id="buttonDiv">
                            <form action="#" class="buttonDiv">
                                <input type="hidden" name="mode1" value="1">
                                <input type="submit" name="confirm" id="confirmButton" value="Confirm">
                            </form>
                            <form action="" class="buttonDiv">
                                <input type="hidden" name="mode2">
                                <input type="submit" name="cancel" id="cancelButton" value="Cancel">
                            </form>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>