<?php
session_start();
include 'db.php';
include 'Module/bookCard.php';

if(!isset($_SESSION['username']) || !isset($_SESSION['userid']))
    header('location: UserLogin.php');
else
{
    $userq = "select * from user where id = $_SESSION[userid]";
    $ures = mysqli_query($con,$userq);
    if($ures)
        $udata = mysqli_fetch_assoc($ures);
}

?>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/userhome.css">
    <link rel="stylesheet" href="CSS/userprofile.css">
</head>
<body>
    <?php include 'usernavbar.php';?>
    <hr>
    <div class="mainbody">
        <div class="header">
            <h1>User Profile</h1>
        </div>
        <div class="user-info-section">
            <div class="user-info">
                <label class="info">Name    &nbsp;:  <?php echo $udata["name"]?></label>
                <label class="info">Email   &nbsp;&nbsp;:  <?php echo $udata["email"]?></label>
            </div>
            <div class="user-books">
                
            </div>
        </div>
    </div>
</body>
</html>