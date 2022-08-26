<?php
session_start();
include 'db.php';
?>

<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/loginsignin.css">
</head>
<body>
    <nav>
        <label class="Logo">E-Book Store</label>
        <a class="primarybtn" href="UserLogin.php">Buy E-Books</a>
    </nav>
    <hr>
    <div class="mainbody">
        <form method="POST" action="<?php $_PHP_SELF ?>">
            <h1 class="heading1">Admin Login</h1>
            <div class="formcontrols">
                <label class="ilabel">Email ID</label>
                <input type="email" class="inputfield" name="Uemail" placeholder="Enter your email address">
                <label class="ilabel">Password</label>
                <input type="password" class="inputfield" name="Upswd" placeholder="Enter your password">
            </div>
            <?php
            if(isset($_POST['adminlogin']))
            {
                echo $_POST['Uemail'].$_POST['Upswd'];
                $email = mysqli_real_escape_string($con,$_POST['Uemail']);
                $password = mysqli_real_escape_string($con,$_POST['Upswd']);
            
                $sql = "select * from admin where email='$email' and password='$password'";
                $result = mysqli_query($con,$sql);

                $count = mysqli_num_rows($result);
                $userdtl = mysqli_fetch_row($result);

                if($count == 1){
                    setcookie("ausername",$userdtl[1],time()+86400);
                    setcookie("auserid",$userdtl[0],time()+86400);
                    $_SESSION['ausername'] = $userdtl[1];
                    $_SESSION['auserid'] = $userdtl[0];

                    header("location: AdminHome.php");
                }
                else{
                    if(isset($_POST['adminlogin']))
                    {
                        echo "<p style='color: red;'>Account doesn't Exist</p>";
                        unset($_POST['adminlogin']);
                    }
                }
            }
            ?>
            <input class="loginbutton" name="adminlogin" type="submit" value="LOG IN" >
        </form>
    </div>
</body>
</html>