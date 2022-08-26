<?php
session_start();
include 'db.php';
include 'Module/bookCard.php';

$cattitle = "";

if(!isset($_SESSION['username']) || !isset($_SESSION['userid']))
    header('location: UserLogin.php');

if(isset($_GET["query"]))
{
    $cattitle = "Search for \"$_GET[query]\"";
    $searchq = "select * from book where upper(name) like upper('%$_GET[query]%') order by name";
    $catresult = mysqli_query($con, $searchq);
}
else if(isset($_GET["recentid"])){
    $rid = $_GET["recentid"];
    $cattitle = $_GET["name"];
    if($rid==1)
        $recentq = "select * from book order by book_id";
    else if($rid==2)
        $recentq = "select * from book where price = 0 order by name";
    $catresult = mysqli_query($con, $recentq);
}
else if(isset($_GET["catid"])){
    $cattitle = $_GET["name"];
    $catq = "select * from book where category = '$_GET[catid]' order by name";
    $catresult = mysqli_query($con, $catq);
}
?>
<html>
<head>
    <title><?php echo $cattitle?></title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/userhome.css">
</head>
<body>
    <?php include 'usernavbar.php';?>
    <hr>
    <div class="mainbody">
    <div class="book-category">
            <div class='cat-Title'>
                <h1><?php echo $cattitle?></h1>
            </div>
            <div class="cat-list-expand">
                <?php 
                if($catresult)
                {
                    while($booklist = mysqli_fetch_assoc($catresult))
                    {
                        $incart = $isbuyed = false;
                        $buysql = "select * from purchased where user_id = $_SESSION[userid] and book_id = $booklist[book_id]";
                        $buyq = mysqli_query($con, $buysql);
                        if(mysqli_num_rows($buyq) > 0) $isbuyed = true;

                        $cartq = "select * from cart where user_id = $_SESSION[userid] and book_id = $booklist[book_id]";
                        $cres = mysqli_query($con,$cartq);
                        if(mysqli_num_rows($cres) > 0) $incart = true;

                        bookCard($booklist["thumbnail"],$booklist["name"],$booklist["price"],
                        $booklist["book_id"],$incart,$isbuyed,$booklist["booklink"]);
                    }
                    if(mysqli_num_rows($catresult) == 0){
                        echo "No Result Found";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>