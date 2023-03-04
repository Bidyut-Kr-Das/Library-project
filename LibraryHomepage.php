<?php
include("connection/connection.php");
session_start();
if (empty($_SESSION['id'])) {
    header("location:index.php");
    exit();
}
$newid = $_SESSION['id']; //session id
$admin = $_SESSION['admin']; // admin session
$query1 = "SELECT * FROM `information` WHERE `id`='$newid'";
$result1 = mysqli_query($connection, $query1);
$rowarr1 = mysqli_fetch_array($result1);
$name = $rowarr1['Firstname'];
//-----------------------searching which books are taken by user-------------------------->    
$arr = array();
$query4 = "SELECT * FROM `bookstaken` WHERE `student-id`='$newid' ";
$result4 = mysqli_query($connection, $query4);
while ($rowarr5 = mysqli_fetch_array($result4)) {
    array_push($arr, $rowarr5['BookId']); //adding the book ids in an array using while loop
}
//array[ ]={4,5}

// searching metod------------------------------------------------------------------------->

$searching = "";
if (isset($_REQUEST['search'])) {
    $searching = $_REQUEST['search'];
    $query2 = "SELECT * FROM `book_info` WHERE `Book name` LIKE '%$searching%' OR `BOOK id` LIKE '%$searching%' ";
    $result2 = mysqli_query($connection, $query2);
} else {
    $query2 = "SELECT * FROM `book_info` ORDER BY `Id`";
    $result2 = mysqli_query($connection, $query2);
}

//confirmation and quantity update method------------------------------------------------>


if (isset($_REQUEST['bookBook'])) {
    $bookid1 = $_REQUEST['bookBook'];
    $query3 = "SELECT * FROM `book_info` WHERE `Id`='$bookid1' ";
    $result3 = mysqli_query($connection, $query3);
    $rowarr3 = mysqli_fetch_array($result3);
    $bookQuantity = $rowarr3['AVL book'];
    header("location:bookUpdate.php?decider=bookBook&bookid=$bookid1&quantity=$bookQuantity");
}

//return book query------------------------------------------------------------------------->
if (isset($_REQUEST['returnBook'])) {
    $bookid1 = $_REQUEST['returnBook'];
    $query3 = "SELECT * FROM `book_info` WHERE  `Id`='$bookid1' ";
    $result3 = mysqli_query($connection, $query3);
    $rowarr3 = mysqli_fetch_array($result3);
    $bookQuantity = $rowarr3['AVL book'];
    // echo "<script>alert(".$bookid1.")</script>";
    header("location:bookUpdate.php?decider=returnBook&bookid=$bookid1&quantity=$bookQuantity");
}


//add book page redirect---------------------------------------------------->

if (isset($_REQUEST['redirect'])) {
    header("location:addEditBooks.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Welcome
        <?php echo $name; ?>
    </title>
    <link href="css/css-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <script src="js/scroll.js" defer>
            // function hehe(){
            //     var navBar= document.getElementById("navigatonBAr");
            //     navBar.classList.add("hello");
            // }
            // window.onscroll=function() {hehe()};
            // var navBar=document.getElementById("navigatonBAr");
            // var sticky=navBar.offsetTop;
            // function hehe(){
            //     if(window.pageYOffset>sticky){
            //         navBar.classList.add("sticky");
            //     }
            //     else{
            //         navBar.classList.remove("sticky");
            //     }
            // }
    </script>
    <div class="bgImage" id="bgImage"></div>
    <div class="borderTop" id="borderTop"></div>
    <!-- <div class="borderLeft" id="borderLeft"></div> -->
    <div id="supermainDiv">
        <div class="maindiv" id="mainDiv">
            <div class="scrollToggle" id="scrollToggle"></div>
            <div class="logo" id="logo">
                <div id="welcomename">Hello,
                    <?php echo $name; ?>
                </div>
                <div class="navigationBar" id="navigatonBAr">
                    <div id="home"><a href="#bgImage" id="profile">Home</a></div>
                    <div id="Wishlist">Wishlist</div>
                    <div id="Profile"><a onclick="" id="profile">Profile</a></div>
                    <div id="Logout"><a href="logout.php" id="logout">Logout</a></div>
                    <div id="searchBar">
                        <input type="text" name="" id="SearchBox" placeholder="Search Book"
                            value="<?php echo $searching; ?>">
                        <div class="searchIcon" onclick="searchBook()"><i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div id="textArea">
                <div id="welcomeText">
                    <div id="welcome">Welcome</div>
                    <div id="ToTheLibrary">to the Library</div>
                </div>
                <div id="buttonDiv">
                    <form id="form1" action="#secondDivbgImage" onsubmit="" method="post">
                        <!-- <input type="hidden" name="mode1" value="1"> -->
                        <input type="submit" value="Browse Books" id="button1">
                    </form>
                    <?php
                    if ($admin == 'Y') { ?>
                        <form id="form2" action="" onsubmit="">
                            <input type="hidden" name="redirect" value="hehe">
                            <input type="submit" value="Add Book" id="button2">
                        </form>
                    <?php } else {
                        ?>
                        <form id="form2" action="" onsubmit="return false">
                            <!-- <input type="hidden" name="mode2" value="1"> -->
                            <input type="submit" value="Wishlist" id="button2">
                        </form>
                    <?php } ?>
                </div>
            </div>
            <div id="imageArea"></div>
            <svg id="wavediv" viewBox="0 0 1440 165">
                <path fill="#0099ff" fill-opacity="1"
                    d="M0,0L48,10.7C96,21,192,43,288,53.3C384,64,480,64,576,64C672,64,768,64,864,85.3C960,107,1056,149,1152,149.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
            <div id="secondDivbgImage">
                <div class="tablescroll">
                    <table>
                        <?php
                        // $rowarr4=mysqli_fetch_array($result2);
                        if (mysqli_num_rows($result2) == 0) {
                            ?>
                            <th id="noBook" rowspan="4">No Book was found with keyword "
                                <?php echo $searching; ?>"
                            </th>
                            <?php
                        } else {


                            ?>
                            <tr>
                                <th>Book name</th>
                                <th>Author</th>
                                <th>Quantity remaining</th>
                                <th id="action" <?php if ($admin == 'Y') {
                                    echo "colspan=2";
                                } ?>>Action</th>
                                <?php if ($admin == 'N') { ?>
                                    <th>wishllist</th>
                                <?php } ?>
                            </tr>
                            <?php
                            while ($rowarr2 = mysqli_fetch_array($result2)) {
                                $x = $rowarr2['Book name'];
                                $y = $rowarr2['Id'];
                                ?>
                                <tr id="book-detail">
                                    <td>
                                        <?php echo $rowarr2['Book name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowarr2['Author']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowarr2['AVL book']; ?>
                                    </td>
                                    <?php if ($admin == 'Y') { ?>
                                        <td><a href="addEditBooks.php?idOfBook=<?php echo $rowarr2['Id']; ?>" id="edit">Edit</a></td>
                                        <td><a href="" id="delete">Delete</a></td>
                                    <?php } else {
                                        if (in_array($rowarr2['Id'], $arr)) {
                                            ?>
                                            <td><a onclick="returnConfirm(`<?php echo $x; ?>`,`<?php echo $y; ?>`)" id="return">Return</a>
                                                | <a href="returnRenew.php?action=renew" id="renew">Renew</a></td>
                                            <?php
                                        } else {

                                            ?>
                                            <td><a name="value1" id="booknow"
                                                    onclick="callConfirm(`<?php echo $x; ?>`,`<?php echo $y; ?>`)" value="">Book Now</a>
                                            </td>
                                        <?php } ?>
                                        <td id=checkboxDiv>
                                            <label class="container">
                                                <input type="hidden" name="name1" value="<?php echo $rowarr2['Id']; ?>">
                                                <input type="checkbox" value="checked" name="wishlist-box" id="checkbox">
                                                <div class="checkmark"></div>
                                            </label>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                            }
                        }
                        ?>

                    </table>
                </div>
                <div class="confirmation invisible">
                    <div class="confirmationtext">Do you want to purchase</div>
                    <div class="bookName"></div>
                    <div class="buttonDiv">
                        <form action="" class="buttonDiv1" method="post">
                            <input type="hidden" class="h1" name="bookBook" value="" id="id1">
                            <input type="submit" value="Confirm" id="confirmButton">
                        </form>
                        <form action="" class="buttonDiv2" onsubmit="return false">
                            <!-- <input type="hidden" name="mode2" value="1"> -->
                            <input type="button" value="Cancel" id="cancelButton" onclick="cancelled()">
                        </form>
                    </div>
                </div>
                <div class="returnConfirmation invisible">
                    <div class="confirmationtext1">Do you want to return</div>
                    <div class="bookName1"></div>
                    <div class="buttonDivReturn">
                        <form action="" class="buttonDiv1" method="post">
                            <input type="hidden" class="h1" name="returnBook" value="" id="id2">
                            <input type="submit" value="Confirm" id="confirmButton1">
                        </form>
                        <form class="buttonDiv2" onsubmit="return false">
                            <!-- <input type="hidden" name="mode2" value="1"> -->
                            <input type="button" value="Cancel" id="cancelButton1" onclick="cancelled()">
                        </form>
                    </div>
                </div>
                <script src="js/search.js" defer></script>
                <?php
                $msg = "";
                if (isset($_REQUEST['msg'])) {
                    $msg = $_REQUEST['msg'];
                }
                ?>
                <div id="snackbar">
                    <?php echo $msg; ?>
                </div>
            </div>
            <script>
                function myFunction() {
                    var x = document.getElementById("snackbar");
                    x.className = "show";
                    setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
                }
            </script>
            <?php
            if (isset($_REQUEST['msg'])) {
                $msg = $_REQUEST['msg'];
                echo "<script>
                        myFunction();  
                    </script>";
            }


            ?>
        </div>
    </div>


</body>

</html>