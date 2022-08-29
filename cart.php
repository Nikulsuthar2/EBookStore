<?php
session_start();
include 'db.php';

if(!isset($_SESSION['username']) || !isset($_SESSION['userid']))
    header('location: UserLogin.php');
else
{
    $cartsql = "select * from cart where user_id = $_SESSION[userid]";
    $cartres = mysqli_query($con,$cartsql);
}
if(isset($_GET['del']))
{
    $q1 = "delete from cart where user_id = $_SESSION[userid] and book_id = $_GET[del]";
    $r1 = mysqli_query($con, $q1);
    if($r1)
    {
        header("location: cart.php");
    }
}
?>
<html>
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/userhome.css">
    <link rel="stylesheet" href="CSS/booklist.css">
</head>
<body>
    <?php include 'usernavbar.php';?>
    <hr>
    <div class="mainbody">
        <div class="header">
            <h1>Cart</h1>
        </div>
        <div class="mainlist">
            <div class="litopbar">
                <label>Your Cart Items</label>
            </div>
            <div class="litable">
                <table>
                    <tr>
                        <th width="60px">Sno</th>
                        <th width="90px">Thumbnail</th>
                        <th>Book Name</th>
                        <th>price</th>
                        <th width="120px">Operations</th>
                    </tr>
                    <?php
                    $count = 1;
                    $totalpay = 0;
					if($cartres){
						while($itm = mysqli_fetch_assoc($cartres)){
							$booksql = "select * from book where book_id = $itm[book_id]";
							$bookres = mysqli_query($con,$booksql);
							if($bookres)
							{
								$row = mysqli_fetch_assoc($bookres);
								$totalpay += $row["price"];
								echo "<tr>
									<td>$count</td>
									<td><img src='$row[thumbnail]' width='50px' height='60px'></td>
									<td>$row[name]</td>
									<td>&#8377 $row[price]</td>
									<td>
										<a class='editbtn deletebtn' href='cart.php?del=$row[book_id]'>REMOVE</a>
									</td>
								</tr>";
								$count += 1;
							}
						} 
					}					
                    echo "<tr><td colspan=3 style='text-align:end;padding-right:30px;font-size: 25px;'><b>Total Amount : </b></td>
                    <td colspan=2 style='color:green;font-size: 25px;'><b>&#8377 $totalpay</b></td></tr>"; 
                    if($count > 1){
                        echo "<tr><td colspan=5 height='50px'><div>
                        <a class='buybtn' href='payment.php?cart=1'>Purchase</a>
                    </div></td></tr>"; 
                    }            
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>