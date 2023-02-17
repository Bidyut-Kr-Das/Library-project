<?php
    include("connection.php");
    $errormsg="";
    $wrongPass="";
    if(isset($_REQUEST['mode'])){
        $usernameGiven=$_REQUEST['username'];
        $passwordGiven = $_REQUEST['password'];
        $result="SELECT * FROM `logindata` WHERE `username`='$usernameGiven'";
        $query=mysqli_query($connection,$result);
        $rowarr= mysqli_fetch_array($query);
        if($rowarr==NULL){
            $errormsg="No user data found! Please signup";
        }
        else{
            if($passwordGiven==$rowarr['Password']){
                session_start();
                $_SESSION['id']=$rowarr['info-id'];
                header("location:LibraryHomepage.php");
            }
            else{
                $wrongPass="Incorrect Password";
            }
        }

        
    }

?>


<!DOCTYPE html>
<html>

<head>
    <title>Login to your account</title>
    <link href="css-LibraryLogin.css" rel="stylesheet">
</head>

<body>
    <script src=""></script>
    <div class="bgImage" id="bgImage"></div>
    <div id="textDiv">Welcome <span id="to">to</span> <div id="textDiv2">Library</div>
    <div id="errormsg"><?php echo $errormsg;?></div>
    </div>
    <div class="mainDiv" id="mainDiv">
        <form action="" method="post" >
            <input type="hidden" name="mode" value="1">
            <div id="loginText"><span id="login">Login</span> to Your Account</div>
            <div class="inputfield1" id="inputfield1">
                <input type="text" id="inputbox1" name="username" required="required" autocomplete="off">
                <span class="usernameText" id="usernameText">Username</span>
            </div>
            <div class="inputfield2" id="inputfield2">
                <input type="password" id="inputbox2" name="password" required="required" autocomplete="off">
                <span class="passwordText" id="passwordText">Password</span>
                <div id="wrongpass"><?php echo $wrongPass;?></div>
            </div>
            <div class="thirdDiv" id="thirdDiv">
                <input type="checkbox" name="rememberMe" value="Remember Me" id="checkbox1">
                <span class="rememberMe" id="rememberME">Remember me</span>
            </div>
            <div class="forthDiv" id="forthDiv">
                <input type="submit" value="Login" id="Submit">
            </div>
            <div class="register" id="register">Don't Have account? <a href="LibrarySignup.php" id="here">Register Here</a></div>
            <div class="loginButton" id="loginButton"></div>
        </form>
    </div>
</body>

</html>