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
            <a class="itemcard" href="Userlist.php">
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
            <a class="itemcard" href="BookPurchaseReport.php">
                <h3 class="itemlabel">Total Purchased Book</h3>
                <label class="itemvalue">
                    <?php
                    $q3 = "select * from purchased";
                    $res3 = mysqli_query($con,$q3);
                    $sells = mysqli_num_rows($res3);
                    if($res3)
                    {
                        echo $sells;
                    }
                    ?>
                </label>
            </a>
            <a class="itemcard" href="BookCategoryList.php">
                <h3 class="itemlabel">Total Book Category</h3>
                <label class="itemvalue">
                    <?php
                    $q4 = "select * from category";
                    $res4 = mysqli_query($con,$q4);
                    $catno = mysqli_num_rows($res4);
                    if($res4)
                    {
                        echo $catno;
                    }
                    ?>
                </label>
            </a>
            <a class="itemcard" href="BookPurchaseReport.php">
                <h3 class="itemlabel">Total Earnings</h3>
                <label class="itemvalue">&#8377
                    <?php
                    $q5 = "select sum(amount) from payment";
                    $res5 = mysqli_query($con,$q5);
                    $earn = mysqli_fetch_row($res5)[0];
                    if($res5)
                    {
                        echo $earn;
                    }
                    ?>
                </label>
            </a>
            <?php
            $catq = "select distinct a.cat_id, a.cat_name from category a, book b where a.cat_id = b.category";
            $catresult = mysqli_query($con,$catq);
            if($catresult)
            {
                while($category = mysqli_fetch_assoc($catresult))
                {
                    $catbookq = "select * from book where category = $category[cat_id]";
                    $catres = mysqli_query($con, $catbookq);
                    $count = mysqli_num_rows($catres);
                    echo "<a class='itemcard redcard' href='Bookslist.php?cat=$category[cat_id]'>
                        <h3 class='itemlabel'>Total $category[cat_name] Books</h3>
                        <label class='itemvalue'>
                            $count
                        </label>
                    </a>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>