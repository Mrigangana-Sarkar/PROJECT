<?php
$cartid=$_GET['cartid'];
echo "received cartid=$cartid";
$conn=new mysqli("localhost","root","","acme24_jul",3306);
include "../shared/connection.php";
mysqli_query($conn,"delete from cart where cartid=$cartid");

header("location:viewcart.php");





?>