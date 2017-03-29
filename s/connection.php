<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "id1120660_csas";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn)
{
die("Connection Failed : ".mysqli_connect_error());
}
else
{
//echo "Connection SuccessFull";
}

?>