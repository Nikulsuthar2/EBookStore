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
    <title>Book Category</title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/adminhome.css">
    <link rel="stylesheet" href="CSS/booklist.css">
</head>
<body style="font-family: 'Segoe UI';">
    <div class="header">
        <h1>Book Category</h1>
        <a class="primarybtn" href="bookslist.php">Go Back</a>
    </div>
    <div class="flex juspabet">
        <div class="book-cat-list">
            <table border="1">
                <tr>
                    <th width="100px">Category ID</th>
                    <th width="200px">Category Name</th>
                </tr>
                <?php
                
                $sql = "select * from category";
                $res = mysqli_query($con, $sql);

                if($res){
                    while($cat = mysqli_fetch_assoc($res)){
                        echo "<tr>
                            <td>$cat[cat_id]</td>
                            <td>$cat[cat_name]</td>
                        </tr>";
                    }
                }
                ?>
            </table>
        </div>
        <div class="add-book-cat">
            <form class="addcatform" action="" method="POST">
                <h3>Add New Category</h3>
                <input class="txtbox" size="30" type="text" name="newcat" placeholder="Enter New Category Name" required>
                <input class="addbookbtn" type="submit" name="addcat" value="ADD">
            </form>
        </div>
    </div>
    <?php
    if(isset($_POST["addcat"])){
        $catname = $_POST["newcat"];
        if($catname != ""){
            $addsql = "insert into category(cat_name) values('$catname')";
            $addres = mysqli_query($con, $addsql);
            if($addres){
                header("location: BookCategoryList.php");
            }
        }
    }
    ?>
</body>
</html>