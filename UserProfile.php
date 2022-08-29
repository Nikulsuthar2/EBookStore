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
            <h1>My Books</h1>
            <div class="user-books">
                <?php
                    $mybooksql = "select * from purchased where user_id = $_SESSION[userid]";
                    $res = mysqli_query($con,$mybooksql);
                    if($res){
                        while($book = mysqli_fetch_assoc($res))
                        {
                            $bookq ="select * from book where book_id = $book[book_id]";
                            $bres = mysqli_query($con,$bookq);
                            if($bres){
                                $bookdtl = mysqli_fetch_assoc($bres);
                                bookCard($bookdtl["thumbnail"],$bookdtl["name"],$bookdtl["price"],
                                $bookdtl["book_id"],false,true,$bookdtl["booklink"]);
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>