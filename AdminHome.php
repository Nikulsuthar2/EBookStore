<?php
session_start();
include 'db.php';

if(!isset($_SESSION['ausername']))
{
    header('location: AdminLogin.php');
}
?>

<html>
<head>
    <title>Admin Home</title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/adminhome.css">
</head>
<body>
    <?php include 'adminnavbar.php';?>
    <hr>
    <div class="mainbody">
        <div class="header">
            <h1>Dashboard</h1>
        </div>
        <div class="adminhomemain">
            <a class="itemcard" href="Users.php?ah=TU">
                <h3 class="itemlabel">Total User</h3>
                <label class="itemvalue">
                    <?php
                    $q1 = "select * from user";
                    $res1 = mysqli_query($con,$q1);
                    $usercount = mysqli_num_rows($res1);
                    if($res1)
                    {
                        echo $usercount;
                    }
                    ?>
                </label>
            </a>
            <a class="itemcard" href="bookslist.php">
                <h3 class="itemlabel">Total Books</h3>
                <label class="itemvalue">
                    <?php
                    $q2 = "select * from book";
                    $res2 = mysqli_query($con,$q2);
                    $moviecount = mysqli_num_rows($res2);
                    if($res2)
                    {
                        echo $moviecount;
                    }
                    ?>
                </label>
            </a>
        </div>
    </div>
</body>
</html>