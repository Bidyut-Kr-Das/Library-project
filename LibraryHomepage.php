<?php

include("connection/connection.php");
session_start();
if (empty($_SESSION['id'])) { //               ! isset($_SESSION['id'])----!True----false
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


//method to calculate the fine and date of return and all


if (isset($_REQUEST['returnactivation'])) {
    $bookid2 = $_REQUEST['returnactivation'];
    $query5 = "SELECT * FROM `book_info` WHERE `Id`='$bookid2' ";
    $result5 = mysqli_query($connection, $query5);
    $rowarr6 = mysqli_fetch_array($result5);
    $name1 = $rowarr6['Book name'];
    $query6 = "SELECT * FROM `bookstaken` WHERE `student-id`='$newid' AND `BookId`='$bookid2' ";
    $result6 = mysqli_query($connection, $query6);
    $rowarr7 = mysqli_fetch_array($result6);
    $issuedate = $rowarr7['IssueDate'];
    $borrowtime = $rowarr7['borrowtime'];
    $returndate = strtotime(date('Y-m-d', strtotime($issuedate . '+' . $borrowtime)));

    $currentdate = strtotime(date('Y-m-d'));
    $returndateObj = date_create(date('Y-m-d', strtotime($issuedate . '+' . $borrowtime)));
    $currdateObj = date_create(date('Y-m-d'));
    //date create function created a dateTimeObject which is required in date_diff() function
    $dateDifference = date_diff($currdateObj, $returndateObj);
    if ($returndate >= $currentdate) { // this line is required to check if return date has exceeded current date.
        $hasfine = false;
        $timeLeft = ((int) $dateDifference->format("%a")) + 7;
    } else {
        $timeLeft = ((int) $dateDifference->format("%a"));
        if ($timeLeft > 7) {
            $hasfine = true;
            $fine = ($timeLeft - 7) * 5;
            $timeLeft -= 7;
        } else {
            $hasfine = false;
        }
        // echo "current date";
    }
    //amake ekhane date plus korte hobe and date take function a pathtate hobee tarpor oi div a 
    //value rakhte hobe tarpor input type hidden a value paste korte hobe.
    //nahole form refresh hoe jabe. 


}

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
    $borrowtime = $_REQUEST['duration'];
    $bookQuantity = $rowarr3['AVL book'];
    header("location:bookUpdate.php?decider=bookBook&bookid=$bookid1&quantity=$bookQuantity&borrowtime=$borrowtime");
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


//add book page redirect(admin)---------------------------------------------------->

if (isset($_REQUEST['redirect'])) {
    header("location:bookinfo.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Welcome
        <?php echo $name; ?>
    </title>
    <link href="css/floatingWindow.css" rel="stylesheet">
    <link href="css/css-homepage.css" rel="stylesheet">
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
                    <?php echo $name; ?>
                </div>
                <div class="navigationBar" id="navigatonBAr">
                    <div id="home"><a href="#bgImage" id="profile">Home</a></div>
                    <div id="Wishlist">Wishlist</div>
                    <div id="Profile"><a onclick="" id="profile">Profile</a></div>
                    <div id="Logout"><a href="logout.php" id="logout">Logout</a></div>
                    <div id="searchBar">
                        <div class="clearIcon" onclick="clearIcon()"><i class="fa-solid fa-xmark"></i></div>
                        <input type="text" name="" id="SearchBox" placeholder="Search Book"
                            value="<?php echo $searching; ?>" onclick="isSearching()">
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
                    <!-- <form id="form1" action="#secondDivbgImage" onsubmit="" method="post">
                        <input type="hidden" name="mode1" value="1">
                        <input type="submit" value="Browse Books" id="button1">
                    </form> -->
                    <div id="form1">
                        <a href="#secondDivbgImage"> <input type="button" value="Browse Books" id="button1"> </a>
                    </div>
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
                                $w = $rowarr2['Book name'];
                                $x = $rowarr2['Author'];
                                $y = $rowarr2['BOOK id'];
                                $z = $rowarr2['Id'];
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
                                        <td><a href="bookinfo.php?idOfBook=<?php echo $rowarr2['Id']; ?>" id="edit">Edit</a>
                                        </td>
                                        <td><a href="" id="delete">Delete</a></td>
                                    <?php } else {
                                        if (in_array($rowarr2['Id'], $arr)) {
                                            ?>
                                            <td><a onclick="returnWindow(`<?php echo $z; ?>`)" id="return">Return</a>
                                                | <a href="returnRenew.php?action=renew" id="renew">Renew</a></td>
                                            <?php
                                        } else {
                                            if ($rowarr2['AVL book'] == 0) {
                                                ?>
                                                <td>
                                                    <div id="outofstock">Out Of Stock</div>
                                                </td>
                                                <?php
                                            } else {
                                                ?>
                                                <td><a name="value1" id="booknow"
                                                        onclick="callConfirmBook(`<?php echo $w; ?>`,`<?php echo $x; ?>`,`<?php echo $y; ?>`,`<?php echo $z; ?>`)"
                                                        value="">Book Now</a>
                                                </td>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <td id=checkboxDiv>
                                            <label class="container">
                                                <input type="hidden" name="name1" value="<?php echo $rowarr2['Id']; ?>">
                                                <input type="checkbox" value="checked" name="wishlist-box" id="checkboxWishlist">
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
                <div class="addWishlistBtn"><input type="submit" name="addToWishlist" id="addToWishlist"
                        value="Add to Wishlist">
                </div>
                <div class="mainBox invisible">
                    <div class="contentwhole">
                        <div class="circleCross" onclick="cross()">
                            <div class="x">x</div>
                        </div>
                        <form action="">
                            <div class="contentBox">
                                <div class="bookname"><strong>B</strong>ook name: <span class="phpvar" id="bookName">
                                    </span></div>
                                <div class="author"><strong>A</strong>uthor: <span class="phpvar"
                                        id="bookAuthor"></span></div>
                                <div class="bookId"><strong>B</strong>ook Id: <span class="phpvar" id="BookId"></span>
                                </div>
                                <div class="bookTime">You want to take book for : -</div>
                                <div class="radioBtn">
                                    <input type="radio" class="radioButtons" name="duration" id="radio-1"
                                        value="10 days" required>
                                    <label for="radio-1">10 days</label>
                                    <input type="radio" class="radioButtons" name="duration" id="radio-2"
                                        value="20 days" required>
                                    <label for="radio-2">20 days</label>
                                    <input type="radio" class="radioButtons" name="duration" id="radio-3"
                                        value="30 days" required>
                                    <label for="radio-3">30 days</label>
                                </div>
                                <div class="info"><strong>Note!</strong> You need to return within 7 days after the
                                    return date.
                                    Further delay will be charged for 5rs/day.</div>
                                <div class="confirmButton">
                                    <input type="checkbox" name="terms" id="checkbox1" value="good"
                                        onclick="acceptTnC1()">
                                    <label for="checkbox1">I accept all terms and conditions</label>
                                    <input type="hidden" class="h1" name="bookBook" value="" id="id1">
                                    <input type="submit" value="Confirm" id="confirmbtn1" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mainBox2 invisible">
                    <!-- <script>returnVisible()</script> -->
                    <div class="contentwhole">
                        <div class="circleCross" onclick="returnInvisible()">
                            <div class="x">x</div>
                        </div>
                        <form action="">
                            <div class="contentBox">
                                <div class="bookname"><strong>B</strong>ook name: <span class="phpvar"
                                        id="ReturnBookName"><?php echo $name1; ?></span></div>
                                <div class="issueDate"><strong>I</strong>ssue Date: <span class="phpvar">
                                        <?php echo $issuedate; ?>
                                    </span></div>
                                <div class="returnPeriod"><strong>R</strong>eturn Period: <span class="phpvar">
                                        <?php
                                        if ($hasfine) {
                                            echo "Over " . $timeLeft . " days";
                                        } else {
                                            echo $timeLeft . " days";
                                        }

                                        ?>
                                    </span>
                                </div>
                                <?php if ($hasfine) { ?>
                                    <div class="fineText">Your fine is: <span class="fine">
                                            <?php echo $fine; ?>/-
                                        </span></div>
                                <?php } ?>
                                <div class="info"><strong>Note!</strong>Return period is valid for 7 days after return
                                    date is over. No fine is charged if returned within return period. Further delay is
                                    charged for 5/- per day.</div>
                                <div class="payButton">
                                    <input type="checkbox" name="terms" id="checkbox2" value="good"
                                        onclick="acceptTnC2()">
                                    <label for="checkbox2">I accept the the above fine</label>
                                    <input type="hidden" name="returnBook" value="<?php echo $bookid2; ?>">
                                    <input type="submit" value="<?php if ($hasfine) {
                                        echo "Pay";
                                    } else {
                                        echo "Return";
                                    } ?>" id="confirmbtn2" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/search.js"></script>
        <?php
        $msg = "";
        if (isset($_REQUEST['msg'])) {
            $msg = $_REQUEST['msg'];
        }
        ?>
        <div class="snackbarbox">
            <div id="snackbar">
                <?php echo $msg; ?>
            </div>
        </div>
    </div>
    <?php
    if (isset($_REQUEST['msg'])) {
        $msg = $_REQUEST['msg'];
        echo "<script>
                        myFunction();  
                    </script>";
    }
    //this bottom part is to check if url have returnactivation and make the return popup visible
    if (isset($_REQUEST['returnactivation'])) {
        echo "<script>returnVisible()</script>";
    }
    ?>
</body>

</html>