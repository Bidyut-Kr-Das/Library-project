<?php
include("connection/connection.php");
session_start();
//----------------checking if user getting in without logging in-----------------------------
if (empty($_SESSION['id'])) {
    // echo '<script> alert("no id")</script>';
    header("location:index.php");
    exit();
}
//---------------------checking if user is admin---------------------------------------------
if ($_SESSION['admin'] != 'Y') {
    // echo '<script>alert("no admin")</script>';
    header("location:LibraryHomepage.php");
    exit();
}

//---------------------------variables for input fields---------------------------------------
$oldBookName = "";
$oldAuthor = "";
$oldDescription = "";
$oldBookId = "";
$oldQuantity = "";


//-------------putting values in input fields incase of edit book-----------------------------
if (!empty($_REQUEST['idOfBook'])) {
    $idOfBook = $_REQUEST['idOfBook'];
    $query1 = "SELECT * FROM `book_info` WHERE `Id`='$idOfBook' ";
    $result1 = mysqli_query($connection, $query1);
    $rowarr1 = mysqli_fetch_array($result1);
    $oldBookName = $rowarr1['Book name'];
    $oldAuthor = $rowarr1['Author'];
    $oldDescription = $rowarr1['description'];
    $oldBookId = $rowarr1['BOOK id'];
    $oldQuantity = $rowarr1['AVL book'];

}
//---------------------------query for adding new book--------------------------------------
if (isset($_REQUEST['mode1'])) {
    $bookName = $_REQUEST['bookName'];
    $bookName = str_replace("'", "\'", $bookName);
    $author = $_REQUEST['author'];
    $description = $_REQUEST['desc'];
    $bookId = $_REQUEST['bookId'];
    $quantity = $_REQUEST['quantity'];
    $query = "INSERT INTO `book_info` SET `Book name`='$bookName',
                                                                                `Author`='$author',
                                                                                `description`='$description',
                                                                                `BOOK id`='$bookId',
                                                                                `AVL book`='$quantity' ";
    $result = mysqli_query($connection, $query);
    if ($result) {
        header("location:LibraryHomepage.php?msg=New Book added successfully!");
    }
}
//---------------------------query to update editted book-------------------------------------
if (isset($_REQUEST['mode2'])) {
    $id = $_REQUEST['mode2'];
    $bookName = $_REQUEST['bookName'];
    $bookName = str_replace("'", "\'", $bookName);
    $author = $_REQUEST['author'];
    $description = $_REQUEST['desc'];
    $bookId = $_REQUEST['bookId'];
    $quantity = $_REQUEST['quantity'];
    $query = "UPDATE `book_info` SET `Book name`='$bookName',
                                                                                `Author`='$author',
                                                                                `description`='$description',
                                                                                `BOOK id`='$bookId',
                                                                                `AVL book`='$quantity' 
                                                                                WHERE `Id`='$id' ";
    $result = mysqli_query($connection, $query);
    if ($result) {
        header("location:LibraryHomepage.php?msg=Book updated successfully!");
    } 
}


?>
<!DOCTYPE html>
<html>

<head>
    <?php
    if (!empty($_REQUEST['idOfBook'])) {
        ?>
        <title>Edit book</title>
        <?php
    } else {
        ?>
        <title>Add new Book</title>
        <?php
    }
    ?>
    <link rel="stylesheet" href="css/test.css" type="text/css">
</head>

<body>
    <script src=""></script>
    <div class="mainDiv">
        <div class="bgImage kenburns-top"></div>
        <div class="mainSubDiv puff-in-center">
            <div id="marginDiv1">
                <form action="">
                    <?php
                    if (!empty($_REQUEST['idOfBook'])){
                        ?>
                        <div class="heading slide-right-heading">Edit book details</div>

                    <?php
                    } else {
                        ?>
                        <div class="heading slide-right-heading">Add new book details</div>
                        <?php
                    }
                    ?>
                    <div class="Bookname slide-right-bookName">
                        <label for="bookName">Book name</label>
                        <input type="text" name="bookName" id="bookName" value="<?php echo $oldBookName; ?>" required
                            autocomplete="off">
                    </div>
                    <div class="author slide-right-author">
                        <label for="author">Author</label>
                        <input type="text" name="author" id="author" value="<?php echo $oldAuthor; ?>" required
                            autocomplete="off">
                    </div>
                    <div class="description slide-right-description">
                        <label for="description">Description</label>
                        <textarea name="desc" id="description" maxlength="500"
                            value="<?php echo $oldDescription; ?>"></textarea>
                    </div>
                    <div class="bookId slide-right-bookId">
                        <label for="bookId">Book ID</label>
                        <input type="text" name="bookId" id="bookId" value="<?php echo $oldBookId; ?>" required
                            autocomplete="off">
                    </div>
                    <div class="quantity slide-right-quantity">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" value="<?php echo $oldQuantity; ?>" required
                            autocomplete="off">
                    </div>
                    <div class="button slide-right-button">
                        <?php
                        // <---------------------changing buttons according to request----------------------------------->                        
                        if (empty($_REQUEST['idOfBook'])) {
                            ?>
                            <input type="hidden" name="mode1" value="1">
                            <input type="submit" value="Add Book" id="button">
                            <?php
                        } else {
                            ?>
                            <input type="hidden" name="mode2" value="<?php echo $idOfBook; ?>">
                            <input type="submit" value="Update" id="button">
                            <?php
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>