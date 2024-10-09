<?php
$conn=new mysqli("localhost","root","","acme24_jul",3306);
$pid=$_GET['pid'];
include "authguard.php";
include "../shared/connection.php";
mysqli_query($conn,"insert into cart(userid,pid) values($_SESSION[userid],$pid)");
header("location:viewcart.php");
?>