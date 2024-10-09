
<?php
$pid=$_GET['pid'];
echo "received pid=$pid";
$conn=new mysqli("localhost","root","","acme24_jul",3306);
include "../shared/connection.php";
mysqli_query($conn,"delete from product where pid=$pid");

header("location:view.php");





?>