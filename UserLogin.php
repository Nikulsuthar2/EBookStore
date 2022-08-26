<?php
include 'db.php';
?>

<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/loginsignin.css">
</head>
<body>
    <nav>
        <label class="Logo">E-Book Store</label>
        <a class="primarybtn" href="AdminLogin.php">ADMIN</a>
    </nav>
    <hr>
    <div class="mainbody">
        <form action="" method="POST">
            <h1 class="heading1">Login</h1>
            <div class="formcontrols">
                <label class="ilabel">Email ID</label>
                <input type="email" class="inputfield" name="Uemail" placeholder="Enter your email address">
                <label class="ilabel">Password</label>
                <input type="password" class="inputfield" name="Upswd" placeholder="Enter your password">
            </div>
            <?php
            session_start();
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $email = mysqli_real_escape_string($con,$_POST['Uemail']);
                $password = mysqli_real_escape_string($con,$_POST['Upswd']);
            
                $sql = "select * from user where email='$email' and password='$password'";
                $result = mysqli_query($con,$sql);

                $count = mysqli_num_rows($result);
                $userdtl = mysqli_fetch_row($result);

                if($count == 1){
                    setcookie("username",$userdtl[1],time()+86400);
                    setcookie("userid",$userdtl[0],time()+86400);
                    $_SESSION['username'] = $userdtl[1];
                    $_SESSION['userid'] = $userdtl[0];

                    header("location: UserHome.php");
                }
                else{
                    if(isset($_POST['login']))
                    {
                        echo "<p style='color: red;'>Account doesn't Exist</p>";
                        unset($_POST['login']);
                    }
                }
            }
            
            ?>
            <input class="loginbutton" type="submit" value="LOG IN" name="login">
            <label class="ilabel2">Don't have an account? 
                <a href="UserSignin.php">Sign Up</a>
            </label>
        </form>
    </div>
</body>
</html>