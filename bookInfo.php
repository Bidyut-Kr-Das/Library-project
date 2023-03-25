<?php
include("connection/connection.php");
session_start();
if (!isset($_SESSION['id'])) {
    header("location:index.php");
    exit();
}
if ($_SESSION['admin'] != 'Y') {
    header("location:LibraryHomepage.php?msg=Admin privilage required.");
}

//declaring empty variables for add book------------------------------------------------>

$oldBookName = "";
$oldAuthor = "";
$oldBookId = "";
$oldDescription = "";
$oldQuantity = "";
$editing = false;

// this part is for edit book------------------------------------------------->


if (!empty($_REQUEST['idOfBook'])) {
    $editing = true;
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
//query to add new book------------------------------------------------------------------>
if (isset($_REQUEST['add'])) {
    $bookName = $_REQUEST['Bookname'];
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
        header("location:LibraryHomepage.php?msg=New Book added successfully!&#secondDivbgImage");
    }
}
//---------------------------query to update editted book-------------------------------------
if (isset($_REQUEST['edit'])) {
    $id = $_REQUEST['edit'];
    $bookName = $_REQUEST['Bookname'];
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
        header("location:LibraryHomepage.php?msg=Book updated successfully!&#secondDivbgImage");
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Welcome
    </title>
    <link rel="stylesheet" href="css/css-bookInfo.css">
    <!-- <link href="css/css-bookInfo.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <script src="js/scroll.js" defer></script>
    <script src="js/floatingWindow.js" defer></script>
    <div class="bgImage" id="bgImage"></div>
    <div class="borderTop" id="borderTop"></div>
    <!-- <div class="borderLeft" id="borderLeft"></div> -->
    <div id="supermainDiv">
        <div class="maindiv" id="mainDiv">
            <div class="scrollToggle" id="scrollToggle"></div>
            <div class="logo" id="logo">
                <div id="welcomename">Hello,
                    <?php echo "name"; ?>
                </div>
                <div class="navigationBar" id="navigatonBAr">
                    <div id="home"><a href="LibraryHomepage.php#bgImage" id="profile">Home</a></div>
                    <div id="Wishlist">Wishlist</div>
                    <div id="Profile"><a onclick="" id="profile">Profile</a></div>
                    <div id="Logout"><a href="logout.php" id="logout">Logout</a></div>
                    <div id="searchBar">
                        <input type="text" name="" id="SearchBox" placeholder="Search Book" value="">
                        <div class="searchIcon" onclick="searchBook()"><i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                </div>
            </div>
            <form action="">
                <div class=form>
                    <div class="inputBox1">
                        <div class="field1">
                            <input type="text" name="Bookname" id="bookName" value="<?php echo $oldBookName; ?>"
                                required autocomplete="off">
                            <span id="bookNameText">Book Name</span>
                        </div>
                        <div class="field2">
                            <input type="text" name="author" id="author" value="<?php echo $oldAuthor; ?>" required
                                autocomplete="off">
                            <span id="authorText">Author</span>
                        </div>
                    </div>
                    <div class="inputBox2">
                        <div class="field3">
                            <label for="Description" id="descriptionText">Description</label>
                            <textarea name="desc" id="Description" value="<?php echo $oldDescription; ?>"></textarea>
                        </div>
                        <div class="field4">
                            <div class="subfield1">
                                <input type="text" name="bookId" id="bookId" value="<?php echo $oldBookId; ?>" required
                                    autocomplete="off">
                                <span id="bookIdText">Book Id</span>
                            </div>
                            <div class="subfield2">
                                <input type="number" name="quantity" id="quantity" value="<?php echo $oldQuantity; ?>"
                                    required autocomplete="off">
                                <span id="quantityText">Quantity</span>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($editing) {
                        ?>
                        <div class="buttondiv">
                            <input type="hidden" name="edit" value="<?php echo $idOfBook; ?>">
                            <input type="submit" value="Update" class="button">
                        </div>
                        <?php
                    } else {

                        ?>
                        <div class="buttondiv">
                            <input type="hidden" name="add" value="<?php echo $idOfBook; ?>">
                            <input type="submit" value="Add Book" class="button">
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php

?>