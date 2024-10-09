<?php
$orderid=$_GET['orderid'];
echo "received orderid=$orderid";
$conn=new mysqli("localhost","root","","acme24_jul",3306);
include "../shared/connection.php";
mysqli_query($conn,"delete from orderproduct where orderid=$orderid");

header("location:trackorder.php");





?>