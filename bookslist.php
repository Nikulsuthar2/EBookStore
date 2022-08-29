<?php
session_start();
include 'db.php';

if(!isset($_SESSION['ausername']))
{
    header('location: AdminLogin.php');
}
if(isset($_GET['del']))
{
    $q1 = "delete from book where book_id = $_GET[del]";
    $r1 = mysqli_query($con, $q1);
    if($r1)
    {
        header("location: bookslist.php");
    }
}
?>

<html>
<head>
    <title>Books</title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/adminhome.css">
    <link rel="stylesheet" href="CSS/booklist.css">
</head>
<body>
    <?php include 'adminnavbar.php';?>
    <hr>
    <div class="mainbody">
        <div class="header">
            <h1>Manage E-Books</h1>
            <div style="display: flex; gap:10px;">
                <a class="primarybtn" href="BookCategoryList.php">Add Book Category</a>
                <a class="primarybtn" href="addbook.php">+ Add Book</a>
            </div>
        </div>
        <div class="mainlist">
            <div class="litopbar">
                <label>E-Book List</label>
            </div>
            <div class="litable">
                <table>
                    <tr>
                        <th width="60px">Sno</th>
                        <th width="90px">Thumbnail</th>
                        <th>Book Name</th>
                        <th>price</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th width="100px">Publish Date</th>
                        <th width="100px">Language</th>
                        <th width="120px">Operations</th>
                    </tr>
                    <?php
                    if(isset($_GET["cat"])){
                        $sql = "select * from book where category = $_GET[cat] order by name";
                    }
                    else{
                        $sql = "select * from book order by name";
                    }
                    $res = mysqli_query($con,$sql);
                    if($res){
                        $count = 1;
                        while($row = mysqli_fetch_assoc($res)){
                            echo "<tr>
                                <td>$count</td>
                                <td><a href='$row[booklink]'><img src='$row[thumbnail]' width='50px' height='60px'></a></td>
                                <td>$row[name]</td>
                                <td> &#8377 $row[price]</td>
                                <td>$row[author]</td>
                                <td>$row[publisher]</td>
                                <td>$row[publishdate]</td>
                                <td>$row[language]</td>
                                <td>
                                    <a class='editbtn' href='AddBook.php?updt=$row[book_id]'>EDIT</a>
                                    <a class='editbtn deletebtn' href='bookslist.php?del=$row[book_id]'>DELETE</a>
                                </td>
                            </tr>";
                            $count += 1;
                        }
                    }                      
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>