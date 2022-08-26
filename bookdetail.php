<?php
session_start();
include 'db.php';

if(!isset($_SESSION['username']) || !isset($_SESSION['userid']))
    header('location: UserLogin.php');

$price = $category = "";
$purchased = false;
if(isset($_GET['bookid']))
{
    $booksql = "select * from book where book_id ='$_GET[bookid]'";
    $res = mysqli_query($con,$booksql);
    if($res)
    {
        $bookdtl = mysqli_fetch_assoc($res);
        $catsql = "select * from category where cat_id = $bookdtl[category]";
        $res1 = mysqli_query($con,$catsql);
        if($res1)
            $category = mysqli_fetch_assoc($res1)["cat_name"];
        if($bookdtl["price"] == 0)
            $price = "Free";
        else
            $price = "&#8377 ".$bookdtl["price"];

        $buysql = "select * from purchased where user_id = $_SESSION[userid] and book_id = $bookdtl[book_id]";
        $buyres = mysqli_query($con,$buysql);
        if($buyres){
            if(mysqli_num_rows($buyres) > 0)
                $purchased = true;
        }
    }
}

?>
<html>
<head>
    <title>Book Details</title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/userhome.css">
</head>
<body>
    <?php include 'usernavbar.php';?>
    <hr>
    <div class="mainbody">
        <div style="display: flex;">
            <div class="bookimgsec">
                <img src="<?php echo $bookdtl["thumbnail"]?>" width="250px" height="400px">
            </div>
            <div class="bookdtlsec">
                <h1 class="bookheading"><?php  echo $bookdtl["name"]?></h1><br>
                <h3>Description</h3>
                <p><?php  echo $bookdtl["description"]?></p>
                <table border="0">
                    <tr><td>Author</td><td><?php  echo $bookdtl["author"]?></td></tr>
                    <tr><td>Publisher</td><td><?php  echo $bookdtl["publisher"]?></td></tr>
                    <tr><td>Publish Date</td><td><?php  echo date_format(date_create($bookdtl["publishdate"]),"d-M-Y")?></td></tr>
                    <tr><td>Language</td><td><?php  echo $bookdtl["language"]?></td></tr>
                    <tr><td>Publisher</td><td><?php  echo $bookdtl["publisher"]?></td></tr>
                    <tr><td>Category</td><td><?php  echo $category?></td></tr>
                    <tr><td>Price</td><td><?php  echo $price?></td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td colspan="2" style="text-align: center;">
                    <?php
                    if($bookdtl["price"] != 0){
                        if($purchased)
                            echo "<div class='buybtn'><a href='$bookdtl[booklink]' target='_blank' style='text-decoration:none;color:white'>Open</a></div>";
                        else
                            echo "<div class='buybtn'><a href='payment.php?cart=0'style='text-decoration:none;color:white'>Buy</a></div>";
                    }
                    else
                        echo "<div class='buybtn'><a href='$bookdtl[booklink]' target='_blank' style='text-decoration:none;color:white'>Open</a></div>";
                    ?>
                    </td></tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>