<?php


$server = "localhost"; // Dades per fer la connexio
$user = "root";
$pass = "";
$DB = "bd_esqui";

$conn = mysqli_connect($server, $user, $pass, $DB); //cridem la connexio

if(!$conn){ // Si surt un error ens hauria de visualitzarlo
    die("La connexió ha fallat: " . mysqli_connect_error());
}

?>