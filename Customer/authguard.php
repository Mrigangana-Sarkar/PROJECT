<?php

session_start();
if(!isset($_SESSION["login_status"]))
{
    echo "Illegal attempt by skipping login";
    die;
}

if($_SESSION["login_status"]==false)
{
    echo "Unauthorized access";
    die;
}
if($_SESSION['usertype']!="Customer")
{
echo "Forbidden Access";
die;
}

?>