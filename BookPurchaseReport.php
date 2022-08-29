<?php
session_start();
include 'db.php';

if(!isset($_SESSION['ausername']))
    header('location: AdminLogin.php');
    
?>
<html>
<head>
    <title>Book Purchase Report</title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/adminhome.css">
    <link rel="stylesheet" href="CSS/booklist.css">
</head>
<body>
    <?php include 'adminnavbar.php';?>
    <hr>
    <div class="mainbody">
        <div class="header">
            <h1>Book Purchase Report</h1>
        </div>
        <div class="mainlist">
            <div class="litopbar">
                <label>Payement list</label>
            </div>
            <div class="litable">
                <table>
                    <tr>
                        <th width="60px">Sno</th>
                        <th width="90px">User id</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Total Amount Paid</th>
                        <th>Payment Date</th>
                    </tr>
                    <?php
                    $sql = "select * from payment order by id desc";
                    $res = mysqli_query($con,$sql);
                    if($res){
                        $count = 1;
                        while($row = mysqli_fetch_assoc($res)){
                            $paydate = date_format(date_create($row["paymentdate"]),"d-M-Y");
                            echo "<tr>
                                <td>$count</td>
                                <td>$row[user_id]</td>
                                <td>$row[name]</td>
                                <td>$row[email]</td>
                                <td>&#8377 $row[amount]</td>
                                <td>$paydate</td>
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