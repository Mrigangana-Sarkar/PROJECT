<?php
print_r($_POST);
$conn=new mysqli("localhost","root","","acme24_jul",3306);
mysqli_query($conn,"insert into user(username,password,usertype) values('$_POST[username]','$_POST[password1]','$_POST[usertype]')");


?>