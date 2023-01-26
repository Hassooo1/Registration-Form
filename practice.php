<?php

$servername = 'localhost';
$uname = 'admin';
$password = '';
$database = 'mydb';
$connection = mysqli_connect($servername,$uname,$password,$database);
if(mysqli_connect_errno()){
    echo "Failed to connect" mysqli_connect_errno();
}

?>