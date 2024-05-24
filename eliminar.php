<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    //$ID_Empleado = $_POST["idaborrar"];

    //el php de borrar con su conexion al principio como los demas 

    include("conexion.php");
    $con=conectar();
    if(!$con){
        echo"error de conexion: " . mysqli_connect_error();
        exit();
    }
    // es la consulta mas sencilla se asigna a un idaborrar que esta en el boton eliminar asignado en hidden
    $sql = "DELETE FROM usuarios WHERE ID='" . $_POST['ID'] . "'";

    $resultado = mysqli_prepare($con,$sql);
    $ok = mysqli_stmt_execute($resultado);
    if(!$ok){

        echo"error en la consulta";
    }else{

        header('location: datos.php');

        // if (isset($_GET["ID_Empleado"])){
        //     $sql="DELETE * FROM equipoempleado WHERE ID_Empleado='$_GET[ID_Empleado]'"; 
        //     $con->query($sql);
        // }
        
        // $sql="SELECT * FROM equipoempleado";
        // $resultado=$con->query($sql);

}
    ?>
</body>
</html>