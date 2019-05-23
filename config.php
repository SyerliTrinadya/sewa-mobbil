<?php
$server="localhost";
$user="root";
$password="";
$nama_database="sewa";

$db = mysqli_connect($server, $user, $password, $nama_database);

if(!$db){
    die("Gaga; terhubung dengan database" . mysqli_connect_error());
}
?>