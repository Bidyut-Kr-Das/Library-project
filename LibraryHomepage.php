<?php
    include("connection.php");
    session_start();
    if(empty($_SESSION['id'])){
        header("location:index.php");
        exit();
    }
    $newid=$_SESSION['id'];
    $query1="SELECT * FROM `information` WHERE `id`='$newid'";
    $result1=mysqli_query($connection,$query1);
    $rowarr1=mysqli_fetch_array($result1);
    $name=$rowarr1['Firstname'];

    $query2="SELECT * FROM `book_info` ORDER BY `Id`";
    $result2=mysqli_query($connection,$query2);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome <?php echo $name;?></title>
        <link href="css-homepage.css" rel="stylesheet">
    </head>
    <body>
        <script src=""></script>
        <div class="bgImage" id="bgImage"></div>
        <div id="supermainDiv">
            <div class="maindiv" id="mainDiv">
                <div class="logo" id="logo">
                    <div id="welcomename">Hello, <?php echo $name;?></div>
                    <div class="navigationBar" id="navigatonBAr">
                            <div id="home">Home</div>
                            <div id="Wishlist">Wishlist</div>
                            <div id="Profile"><a href="" id="profile">Profile</a></div>
                            <div id="Logout"><a href="logout.php" id="logout">Logout</a></div>
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
                        <form id="form2" action="" onsubmit="return false">
                            <!-- <input type="hidden" name="mode2" value="1"> -->
                            <input type="submit" value="Wishlist" id="button2">
                        </form>
                    </div>
                </div>
                <div id="imageArea">
                </div>
                <svg id="wavediv" viewBox="0 0 1440 165">
                    <path fill="#0099ff" fill-opacity="1" d="M0,0L48,10.7C96,21,192,43,288,53.3C384,64,480,64,576,64C672,64,768,64,864,85.3C960,107,1056,149,1152,149.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
                <div id="secondDivbgImage">
                    <table>
                        <tr>
                            <th>Book name</th>
                            <th>Author</th>
                            <th>Quantity remaining</th>
                            <th>Action</th>
                            <th>wishllist</th>
                        </tr>
                        <?php
                        while($rowarr2=mysqli_fetch_array($result2))
                        {
                        ?>
                        <tr id="book-detail">
                            <td><?php echo $rowarr2['Book name'];?></td>
                            <td><?php echo $rowarr2['Author'];?></td>
                            <td><?php echo $rowarr2['AVL book'];?></td>
                            <td><a  id="booknow"href="bookInfo.php?bookid=<?php echo $rowarr2['BOOK id']?>">Book Now</a></td>
                            <td id=checkboxDiv>
                                <label class="container">
                                    <input type="checkbox" value="checked" name="wishlist-box" id="checkbox">
                                    <div class="checkmark"></div>
                                </label>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        
    </body>
</html>