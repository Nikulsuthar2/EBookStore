<?php
session_start();
include 'db.php';

$pagetitle = "Add E-Book";
if(!isset($_SESSION['ausername']))
    header('location: AdminLogin.php');
    
if(isset($_GET['updt']))
{
    $pagetitle = "Update E-Book";
    $upq1 = "select * from book where book_id ='$_GET[updt]'";
    $r1 = mysqli_query($con,$upq1);
    if($r1)
        $bookdtl = mysqli_fetch_assoc($r1);
}
?>
<html>
<head>
    <title><?php echo $pagetitle;?></title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/adminhome.css">
    <link rel="stylesheet" href="CSS/booklist.css">
</head>
<body>
    <?php include 'adminnavbar.php';?>
    <hr>
    <div class="mainbody">
        <div class="header">
            <h1><?php echo $pagetitle;?></h1>
            <a class="primarybtn" href="bookslist.php">Go Back</a>
        </div>
        <div class="mainform">
            <div class="litopbar">
                <label>book details</label>
            </div>
            <form class="bookdtlform" action="" method="POST" enctype="multipart/form-data">
                <div class="inputsec">
                    <label class="lblfrm">Book Name</label>
                    <input class="txtbox" type="text" name="bname" placeholder="Enter the name of Book" 
                    value="<?php if(isset($_GET['updt'])){echo $bookdtl['name'];}?>" required autofocus>
                </div>
                <div class="inputsec">
                    <label class="lblfrm">Price</label>
                    <input class="txtbox" type="number" name="bookprice" placeholder="Enter the price of book"
                    value="<?php if(isset($_GET['updt'])){echo $bookdtl['price'];}?>" required>
                </div>
                <div class="inputsec">
                    <label class="lblfrm">Author Name</label>
                    <input class="txtbox" type="text" name="authname" placeholder="Enter the name of Author"
                    value="<?php if(isset($_GET['updt'])){echo $bookdtl['author'];}?>" required>
                </div>
                <div class="inputsec">
                    <label class="lblfrm">Publisher Name</label>
                    <input class="txtbox" type="text" name="pubname" placeholder="Enter the name of Publisher"
                    value="<?php if(isset($_GET['updt'])){echo $bookdtl['publisher'];}?>" required>
                </div>
                <div class="inputsec">
                    <label class="lblfrm">Publish Date</label>
                    <input class="txtbox" type="date" name="bookpubdate"
                    value="<?php if(isset($_GET['updt'])){echo $bookdtl['publishdate'];}?>" required>
                </div>
                <div class="inputsec">
                    <label class="lblfrm">Language</label>
                    <input class="txtbox" type="text" name="booklang" placeholder="Enter the Language of Book"
                    value="<?php if(isset($_GET['updt'])){echo $bookdtl['language'];}?>" required>
                </div>
                <div class="inputsec">
                    <label class="lblfrm">Category</label>
                    <select class="txtbox" name="bookcat">
                    <?php 
                        $q = "select * from category order by cat_name";
                        $result = mysqli_query($con,$q);
                        if($result)
                        {
                            while($row1 = mysqli_fetch_assoc($result))
                            {
                                if($row1['cat_id'] == $bookdtl['category'])
                                    echo "<option value='$row1[cat_id]' selected>".$row1['cat_name']."</option>";
                                else
                                    echo "<option value='$row1[cat_id]'>".$row1['cat_name']."</option>";      
                            }
                        } 
                    ?>
                    </select>
                </div>
                <div class="inputsec">
                    <label class="lblfrm">Description</label>
                    <textarea class="descbox" name="bookdesc" rows="3" cols="40" placeholder="Book Description"><?php if(isset($_GET['updt'])){echo $bookdtl['description'];}?></textarea>
                </div>
                <div class="inputsec">
                    <label class="lblfrm">Book Poster</label>
                    <input class="txtbox" type="file" name="bookthumb">
                </div>
                <div class="inputsec">
                    <label class="lblfrm">Book File</label>
                    <input class="txtbox" type="file" name="bookfile">
                </div>
                <input class="addbookbtn" type="submit" name="addbook" value="<?php echo $pagetitle;?>">
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    if(isset($_POST['addbook'])){
                        $bookthumb = $_FILES['bookthumb']['name'];
                        $bookthumbtmp = $_FILES['bookthumb']['tmp_name'];
                        $bookfile = $_FILES['bookfile']['name'];
                        $bookfiletmp = $_FILES['bookfile']['tmp_name'];

                        if (isset($bookfile) && !empty($bookfile)) {
                            if (move_uploaded_file($bookfiletmp, "content/book/" . $bookfile))
                                echo "Book uploaded";
                            else
                                echo "Book not uploaded";
                        }
                        if (isset($bookthumb) && !empty($bookthumb)) {
                            if (move_uploaded_file($bookthumbtmp, "content/thumbnail/" . $bookthumb))
                                echo "thumbnail uploaded";
                            else
                                echo "thumbnail not uploaded";
                        }
                        $bookname = $_POST['bname'];
                        $authname = $_POST['authname'];
                        $pubname = $_POST['pubname'];
                        $pubdate = $_POST['bookpubdate'];
                        $lang = $_POST['booklang'];
                        $bookcat = $_POST['bookcat'];
                        $price = $_POST['bookprice'];
                        $bookdesc = $_POST['bookdesc'];
                        $thumbloc = "content/thumbnail/". $bookthumb;
                        $bookloc = "content/book/" . $bookfile;
                        if($pagetitle == "Update E-Book"){
                            $sql = 'update book set name = "'.$bookname.'", author = "'.$authname.'", publisher = "'.$pubname.'",
                            publishdate = "'.$pubdate.'", language = "'.$lang.'", category = "'.$bookcat.'", price = '.$price.',
                            description = "'.$bookdesc.'", booklink = "'.$bookloc.'", thumbnail = "'.$thumbloc.'" where book_id = '.$_GET["updt"];
                        }
                        else
                        {
                            $sql = "insert into book(name,author,publisher,publishdate,language,category,price,description,booklink,thumbnail) 
                            values('$bookname','$authname','$pubname','$pubdate','$lang',$bookcat,$price,'$bookdesc','$bookloc','$thumbloc')";
                        }
                        $res = mysqli_query($con,$sql);
                        if($res)
                            echo "<script>window.location.href = 'bookslist.php'</script>";
                        else
                            echo "Error :- ".mysqli_error($con);
                        unset($_POST['addbook']);
                    }
                }
                ?>
            </form>
        </div>
    </div>
</body>
</html>