<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "ebookstore";
$con = mysqli_connect($hostname,$username,$password,$database);
if(!$con)
{
    die("connection error");
}
?>