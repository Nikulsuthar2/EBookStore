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
    <title>Users</title>
    <link rel="stylesheet" href="CSS/comman.css">
    <link rel="stylesheet" href="CSS/adminhome.css">
    <link rel="stylesheet" href="CSS/booklist.css">
</head>
<body>
    <?php include 'adminnavbar.php';?>
    <hr>
    <div class="mainbody">
        <div class="header">
            <h1>Users</h1>
        </div>
        <div class="mainlist">
            <div class="litopbar">
                <label>Users List</label>
            </div>
            <div class="litable">
                <table>
                    <tr>
                        <th width="60px">Sno</th>
                        <th width="90px">User id</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Total Book Purchased</th>
                        <th>Total Amount Spend</th>
                    </tr>
                    <?php
                    $sql = "select * from user order by name";
                    $res = mysqli_query($con,$sql);
                    if($res){
                        $count = 1;
                        while($row = mysqli_fetch_assoc($res)){
                            $bookq = "select * from purchased where user_id = $row[id]";
                            $totalbook = mysqli_num_rows(mysqli_query($con,$bookq));

                            $amtq = "select nvl(sum(amount),'0') from payment where user_id = $row[id]";
                            $totalamt = mysqli_fetch_row(mysqli_query($con,$amtq))[0];

                            echo "<tr>
                                <td>$count</td>
                                <td>$row[id]</td>
                                <td>$row[name]</td>
                                <td>$row[email]</td>
                                <td>$totalbook</td>
                                <td>&#8377 $totalamt</td>
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