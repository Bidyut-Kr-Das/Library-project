<?php
    include("connection.php");
    $check="";
    
    $phoneNumberTaken="";
    $userNameTaken="";
    
    $FirstName= "";
    $MiddleName="";
    $LastName= "";
    $MobileNo= "";
    $emailID="";
    $Username="";
    $password="";
    $confpassword="";
    
    if(isset($_REQUEST['mode'])){

        $FirstName= $_REQUEST['Fname'];
        $MiddleName= $_REQUEST['Mname'];
        $LastName= $_REQUEST['Lname'];
        $MobileNo= $_REQUEST['Mobile'];
        $emailID=$_REQUEST['email'];
        $Username=$_REQUEST['Username'];
        $password=$_REQUEST['Password'];
        $confpassword=$_REQUEST['confPassword'];

        $query1=" SELECT * FROM `information` WHERE `phone number`='$MobileNo' ";
        $query2="SELECT * FROM `logindata` WHERE  `username`='$Username' ";
        $result1=mysqli_query($connection,$query1);
        $result2=mysqli_query($connection,$query2);
        $rowarr1=mysqli_fetch_array($result1);
        $rowarr2=mysqli_fetch_array($result2);
        if($rowarr1==NULL){
            if($rowarr2==NULL){
                $query3="INSERT INTO `information` SET 
                                    `Firstname`='$FirstName',
                                    `Middlename`='$MiddleName ',
                                    `last Name`='$LastName',
                                    `phone number`='$MobileNo',
                                    `EmailId`='$emailID' ";
                $result3=mysqli_query($connection,$query3);
                $query4="SELECT * FROM `information` WHERE `phone number`='$MobileNo' ";
                $result4=mysqli_query($connection,$query4);
                $rowarr4=mysqli_fetch_array($result4);
                $id1=$rowarr4['id'];
                $query5="INSERT INTO `logindata` SET
                                    `username`='$Username',
                                    `Password`='$password',
                                    `info-id`='$id1' ";
                $result5=mysqli_query($connection,$query5);
                if($result3&&$result5){
                    session_start();
                    $_SESSION['id']=$id1;
                    header("location:LibraryHomepage.php");
                }
            }
            else{
                $userNameTaken="Username already taken!";
            }
        }
        else{
            $phoneNumberTaken="Phone number is already registered";
        }
        

}
    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create account</title>
        <link href="css-LibrarySignup.css" rel="stylesheet">
    </head>
    <body>
        <script src=""></script>
        <div class="bgImage" id="bgImage"></div>
        <!-- <div class="textdiv" id="textDiv">Create an account <div class="textdiv2" id="textDiv2">to use library</div>
        </div> -->
        <div class="secondDiv hello" id="secondDiv">
            <form action="" method="post" onsubmit="">
                <input type="hidden" name="mode" value="1">
                <div class="jointext" id="jointext">Create an <span class="us" id="us">account</span></div>
                    <div id="fields1">
                        <input type="text" name="Fname" class="slide-right-Fname" id="Fname"  value="<?php echo $FirstName;?>" required="required" autocomplete="off">
                        <span class="slide-right-Fname" id="FnameText">First Name</span>
                        <input type="text" name="Mname" class="slide-right-Mname" id="Mname"  value="<?php echo $MiddleName;?>" autocomplete="off" required>
                        <span class="slide-right-Mname" id="MnameText">Middle Name</span>
                        <input type="text" name="Lname" class="slide-right-Lname" id="Lname"  value="<?php echo $LastName;?>" required="required" autocomplete="off">
                        <span class="slide-right-Lname" id="LnameText">Last Name</span>
                    </div>
                    <div id="fields2">
                        <input type="text" name="Mobile" class="slide-right-mobile" id="Mobile"  value="<?php echo $MobileNo;?>" required="required" autocomplete="off">
                        <span class="slide-right-mobile" id="mobileText">Contact No.</span>                        
                        <input type="text" name="email" class="slide-right-email" id="email"  value="<?php echo $emailID;?>" required="required" autocomplete="off">
                        <span class="slide-right-email" id="emailText">Email</span>
                    </div>
                    <div id="fields6"><div id="errormsg1"><?php echo $phoneNumberTaken; ?></div></div>
                    <div id="fields3">
                        <input type="text" name="Username" class="slide-right-username" id="username"  value="<?php echo $Username;?>" required="required" autocomplete="off">                        
                        <span class="slide-right-username" id="usernameText">Username</span>
                        
                    </div>
                    <div id="fields7"><div id="errormsg2"><?php echo $userNameTaken; ?></div></div>          
                    <div id="fields4">
                        <input type="password" name="Password"  class="slide-right-pass" id="Password"  value="<?php echo $password;?>" required="required" autocomplete="off">
                        <span  class="slide-right-pass" id="passwordText">Password</span>    
                        <input type="password" name="confPassword"  class="slide-right-confPass" id="confPassword"  value="<?php echo $confpassword;?>" required="required" autocomplete="off">
                        <span  class="slide-right-confPass" id="confPasswordText">Confirm Password</span>
                    </div>
                    <div id="fields5">
                        <input type="submit" name="submit" value="Sign up" class="slide-right-submit"id="signup">  
                    </div>
            </form>
        </div>
    </body>
</html>