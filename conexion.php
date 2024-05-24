<?php
//archivo para mantener la conexion , se establecen todos los valores y se pone el nombre de nuestra base de datos 
function conectar(){

    $host = "localhost";
    $user ="root";
    $pass ="";
    $bd ="prueba";
    $con=mysqli_connect($host,$user,$pass);
    mysqli_select_db($con,$bd);
    return $con;


}
?>