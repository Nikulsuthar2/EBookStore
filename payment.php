<?php
session_start();
include 'db.php';

$items = [];
if(!isset($_SESSION['username']) || !isset($_SESSION['userid']))
    header('location: UserLogin.php');
else
{
    $usql = "select * from user where id = $_SESSION[userid]";
    $ures = mysqli_query($con,$usql);
    if($ures)
        $udata = mysqli_fetch_assoc($ures);
    if(isset($_GET["cart"]))
    {
        $getb ="select * from cart where user_id = $_SESSION[userid]";
        $res = mysqli_query($con,$getb);
        if($res)
        {
            while($cartitem = mysqli_fetch_array($res))
            {
                array_push($items,$cartitem);
            }
        }
    }
    else if(isset($_GET["solo"]))
    {
        $items[0] = array("book_id" => $_GET["solo"]);
    }
}
?>
<html>
<head>
    <title>Payment</title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/userhome.css">
    <link rel="stylesheet" href="CSS/payment.css">
    <link rel="stylesheet" href="CSS/booklist.css">
</head>
<body>
    <div class="header">
        <h1>Payment</h1>
    </div>
    <div class="main">
        <div class="itmdtl">
            <table border="1">
                <tr>
                    <th>Sno</th>
                    <th>Name</th>
                    <th>Price</th>
                </tr>
                <?php
                $count = 1;
                $total = 0;
                foreach($items as $itm)
                {
                    $booksql = "select name,price from book where book_id = ".$itm["book_id"];
                    $res1 = mysqli_query($con,$booksql);
                    if($res1)
                    {
                        $bookdtl = mysqli_fetch_assoc($res1);
                        echo "<tr>
                        <td>$count</td>
                        <td>$bookdtl[name]</td>
                        <td>&#8377 $bookdtl[price]</td>
                        </tr>";
                        $total += $bookdtl["price"];
                    }
                    $count++;
                }
                echo "<tr>
                <td colspan=2>Total : </td>
                <td>&#8377 $total</td>
                </tr>";
                ?>
            </table>
        </div>
        <form class="carddtl" action="" method="POST">
            <div>
                <label>Card Holder Name</label>
                <input class="inputbox" type="text" placeholder="Enter Card Holder Name" required>
            </div>
            <div>
                <label>Card Number</label>
                <input class="inputbox" type="text" name="cardnum" placeholder="Enter Card Number" minlength="16" maxlength="16" required>
            </div>
            <div>
                <label>CVV</label>
                <input class="inputbox" type="text" name="cvv" placeholder="Enter CVV" minlength="3" maxlength="3" required>
            </div>
            <input class="paybtn" type="submit" name="paybtn" value="PAY">
        </form>
    </div>
    <?php
    $paid = false;
    if(isset($_POST["paybtn"]))
    {
        $curdate = date("Y-m-d");
        $paysql = "insert into payment(user_id,name,email,amount,paymentdate) 
        values($udata[id],'$udata[name]','$udata[email]',$total,'$curdate')";
        $payres = mysqli_query($con,$paysql);
        if($payres){
            $paid = true;

            foreach($items as $itm)
            {
                $addbook = "insert into purchased values($udata[id],$itm[book_id])";
                $mybookres = mysqli_query($con,$addbook);

                $clearcart = "delete from cart where user_id = $udata[id] and book_id = $itm[book_id]";
                $cartcres = mysqli_query($con,$clearcart);
            }
            
        }
        if($paid){
            echo "<script>
            alert('Payement Succesful');
            window.location.href = 'userhome.php';
            </script>";
            //header("location: userhome.php");
        }
    }
    ?>
</body>
</html>