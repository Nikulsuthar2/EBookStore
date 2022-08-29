<?php
session_start();
if(isset($_GET["id"])){
    if($_GET["id"] == 1){
        unset($_SESSION['username']);
        unset($_SESSION['userid']);
        session_destroy();
        header("location: UserLogin.php");
    }
    if($_GET["id"] == 2){
        unset($_SESSION['ausername']);
        session_destroy();
        header("location: AdminLogin.php");
    }
}
?>