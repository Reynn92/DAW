<?php
    include("conexion.php");
    $con=conectar();

    if (isset($_POST['idaborrar']))
    {
        if(!$con){
            echo"error de conexion: " . mysqli_connect_error();
            exit();
        }
        // es la consulta mas sencilla se asigna a un idaborrar que esta en el boton eliminar asignado en hidden
        $sql = "DELETE FROM juegos WHERE ID='" . $_POST['idaborrar'] . "'";

        $resultado = mysqli_prepare($con,$sql);
        $ok = mysqli_stmt_execute($resultado);
        if(!$ok){

            echo"error en la consulta";
        }else{

            echo "datos borrados corractamente";
        }
    }
?>

<head>
</head>
<link rel="stylesheet" href="css/EstiloDatos.css">
<body>
    <header>
    <link href="https://fonts.cdnfonts.com/css/metal-gear-solid" rel="stylesheet"> 

    <?php
		include("menu.php");
      
      // Llamar a la función para generar el menú
      generarMenu();
      ?>
    
    <?php 
//incluimos la conexion siempre al principio


//declaramos la consulta en este caso para mostrarla en forma de tabla 
$consulta = "SELECT ID,Nombre,Plataforma,Lanzamiento,Imagen FROM juegos";
$resultado = $con->query($consulta);
//la metemos en un condicional con las lineas afectadas mayor 2que 0 y le ponemos borde y 
// th para que tenga encabezado, teniendo en cuenta que es una matriz de datos 
?>

<div class="contenedorTabla" >
<?php
if ($resultado->num_rows > 0)
    {
        ?>
            <table border='1' style='width: 100%';>
        <?php
    //aqui la matriz de datos
    $row =$resultado ->fetch_assoc();
    echo "<tr>";
    foreach($row as $campo =>$valor){
        echo "<th>$campo</th>";
    }
    echo "</tr>";
    //lo mismo que arriba manteniendo cada campo y asignandolo a la matriz usando un bucle foreach
    $resultado -> data_seek(0);
    while ($row=$resultado->fetch_assoc()){
        echo "<tr id='". $row['ID']  ."'>";
        foreach ($row as $valor){
            echo "<td>$valor</td>";
        }
        ?>
        <!-- formulario para borrar directamente sin necesidad de hacer uno extenso , con esto sobra -->
        <td>
            <form action="juegos.php" method="post">
                <input type="hidden"  name="idaborrar" value="<?php echo $row['ID']; ?>">
                <button type="submit" class="btnEliminar" id="btn"></button>
            </form>
        </td>
        <!-- aqui lo mismo , en este caso solo es para el boton editar que lo necesitamos
        y asignamos al input un valor oculto con el name y el value  -->
        <td>
            <form action="editar.php" method="post">
                <input type="hidden" name="idaeditar" value="<?php echo $row['ID']; ?>">
                <button type="submit" class="btnEditar" id="btn"></button>
            </form>
        </td>
        
       
       <?php
        echo "</tr>";
    }
    echo "</table>";
    
}else{
    //echo"No hay resultados";
};
?>

</div>

<div class="boton1">
    <div class="col-md-12 text-center">
        <form action="añadirJuego.php" method="post">
            <input type="hidden" name="accion" value="nuevo">
            <button type="submit" class="btnNuevo" id="btn"></button>
        </form>
    </div>    
</div>
    </div>
  
</body>
</html>