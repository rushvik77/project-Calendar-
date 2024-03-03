<?php

$servername = "localhost";
$username ="root";
$password ="";
$database ="calendar";


$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("sorry not connected". mysqli_connect_error());
}

?>