<?php
include 'db.php';
?>

<html>
<head>
    <title>User Signin</title>
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
            <h1 class="heading1">Create Account</h1>
            <div class="formcontrols">
                <label class="ilabel">Name</label>
                <input type="username" class="inputfield" name="Uname" placeholder="Enter your full name" required autofocus>
                <label class="ilabel">Email ID</label>
                <input type="email" class="inputfield" name="Uemail" placeholder="Enter your email address" required>
                <label class="ilabel">Password</label>
                <input type="password" class="inputfield" name="Upswd" placeholder="Enter your password" minlength="8" maxlength="16" required>
            </div>
            <?php
            session_start();
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if(isset($_POST['signin'])){
                    $name = mysqli_real_escape_string($con,$_POST['Uname']);
					$email = mysqli_real_escape_string($con,$_POST['Uemail']);
					$password = mysqli_real_escape_string($con,$_POST['Upswd']);

					$sql = "select * from user where email='$email'";
					$result = mysqli_query($con,$sql);

					$count = mysqli_num_rows($result);

					if($count == 0){
						$q = "insert into user(name,email,password) values('".$name."','".$email."','".$password."')";
						$res = mysqli_query($con,$q);

						if($res){
							$_SESSION['curruser'] = $name;
							setcookie('username',$name,time()+86400);
						}
						else{
							echo "Error :-".mysqli_error($con);
							die();
						}
						header("location: UserLogin.php");
					}
					else{
						echo "<p style='color: red;'>User Already Exist</p>";
					}
                    unset($_POST['signin']);
                }
            }
            ?>
            <input class="loginbutton" type="submit" value="SIGN IN" name="signin">
            <label class="ilabel2">Already have an account? 
                <a href="UserLogin.php">Login</a>
            </label>
        </form>
    </div>
</body>
</html>