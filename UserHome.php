<?php
session_start();
include 'db.php';
include 'Module/bookCard.php';

if(!isset($_SESSION['username']) || !isset($_SESSION['userid']))
    header('location: UserLogin.php');

if(isset($_GET['addcart']) && !empty($_GET['addcart']))
{
    $checkbook = "select * from book where book_id = $_GET[addcart]";
    $bookexist = mysqli_query($con,$checkbook);
    if(mysqli_num_rows($bookexist) > 0)
    {
        $checkcart = "select * from cart where user_id = $_SESSION[userid] and book_id = $_GET[addcart]";
        $cartexist = mysqli_query($con, $checkcart);
        if(!(mysqli_num_rows($cartexist) > 0))
        {
            $cartsql = "insert into cart(user_id,book_id) values($_SESSION[userid],$_GET[addcart])";
            $cartres = mysqli_query($con,$cartsql);
        }
    }
    header("location: UserHome.php");
}
//====****************=======#############=======***************
if(isset($_GET["addbuy"])&& !empty($_GET['addbuy'])){

}
//====****************=======#############=======***************

?>
<html>
<head>
    <title>HOME</title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/userhome.css">
</head>
<body>
    <?php include 'usernavbar.php';?>
    <hr>
    <div class="mainbody">
        <div class="book-category">
            <div class='cat-Title'>
                <h2>Recently Added</h2>
                <a class='viewmorebtn' href='CategoryResult.php?recentid=1&name=Recently Added'>View More</a>
            </div>
            <div class="cat-list">
                <?php 
                $recentq = "select * from book order by book_id desc limit 10";
                $recentr = mysqli_query($con, $recentq);
                if($recentr)
                {
                    while($recentlist = mysqli_fetch_assoc($recentr))
                    {
                        $incart = $isbuyed = false;
                        $buysql = "select * from purchased where user_id = $_SESSION[userid] and book_id = $recentlist[book_id]";
                        $buyq = mysqli_query($con, $buysql);
                        if(mysqli_num_rows($buyq) > 0) $isbuyed = true;

                        $cartq = "select * from cart where user_id = $_SESSION[userid] and book_id = $recentlist[book_id]";
                        $cres = mysqli_query($con,$cartq);
                        if(mysqli_num_rows($cres) > 0) $incart = true;

                        bookCard($recentlist["thumbnail"],$recentlist["name"],$recentlist["price"],
                        $recentlist["book_id"],$incart,$isbuyed,$recentlist["booklink"]);
                    }
                }
                ?>
            </div>
        </div>
        <?php
            $catq = "select distinct a.cat_id, a.cat_name from category a, book b where a.cat_id = b.category";
            $catresult = mysqli_query($con,$catq);
            if($catresult)
            {
                while($category = mysqli_fetch_assoc($catresult))
                {
                    echo "<div class='book-category'>
                    <div class='cat-Title'>
                        <h2>".$category['cat_name']."</h2>
                        <a class='viewmorebtn' href='CategoryResult.php?catid=$category[cat_id]&name=$category[cat_name]'>View More</a>
                    </div>
                    <div class='cat-list'>";
                    
                    $catbookq = "select * from book where category = $category[cat_id]";
                    $catres = mysqli_query($con, $catbookq);
                    $count = mysqli_num_rows($catres);
                    if($catres)
                    {
                        while($recentlist = mysqli_fetch_assoc($catres))
                        {
                            $incart = $isbuyed = false;
                            $buysql = "select * from purchased where user_id = $_SESSION[userid] and book_id = $recentlist[book_id]";
                            $buyq = mysqli_query($con, $buysql);
                            if(mysqli_num_rows($buyq) > 0) $isbuyed = true;

                            $cartq = "select * from cart where user_id = $_SESSION[userid] and book_id = $recentlist[book_id]";
                            $cres = mysqli_query($con,$cartq);
                            if(mysqli_num_rows($cres) > 0) $incart = true;
                            
                            bookCard($recentlist["thumbnail"],$recentlist["name"],$recentlist["price"],
                            $recentlist["book_id"],$incart,$isbuyed,$recentlist["booklink"]);
                        }
                    }     
                    echo "</div></div>";
                }
            }
        ?>
    </div>
</body>
</html>