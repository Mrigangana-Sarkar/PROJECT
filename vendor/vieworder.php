<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    .pdt{
        background-color:bisque;
        display:inline-block;
        margin:10px;
        padding:10px;

    }
    .pdt-img{
        width:100%;
        height:80%;
    }
    .name
    {
        font-size:24px;
        font-weight:bold;
        color:blueviolet;
    }
    .price{
        font-size:25px;
        font-weight:bolder;
    }
    .price::after{
        content:" Rs";
        font-size:12px;
    }
    </style>
</head>

</html>

<?php
include "authguard.php";
include "../shared/connection.php";
include "menu.html";
$sql_result=mysqli_query($conn,"select * from orderproduct join product on orderproduct.pid=product.pid where owner=$_SESSION[userid]");
while($dbrow=mysqli_fetch_assoc($sql_result)){
    //print_r($dbrow);
    //echo "<br>";

    echo "<div class='pdt'>

    <div class='name'>$dbrow[name]</div>
    <div class='price'>$dbrow[price]</div>
    
    <img class='pdt-img' src='$dbrow[impath]'>
    <div>$dbrow[detail]</div>
    <div>Ordered by Customer with userid=$dbrow[userid]</div>
   
    
    </div>";
}


?>

