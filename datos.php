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
        $sql = "DELETE FROM usuarios WHERE ID='" . $_POST['idaborrar'] . "'";

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
<link rel="stylesheet" href="EstiloDatos.css">
<body>
    <header>
    <link href="https://fonts.cdnfonts.com/css/metal-gear-solid" rel="stylesheet">    

        <h2 >Encabezado con imagen</h2>
    </header>
    <!------------------- INICIO DEL MENU --------------------------------------->
    <!--contenedor nav que actua como un div donde estaran todos los elementos del menu y la barra-->
    <nav class="principal">
        <!-- un ul para hacer la lista y la clase nav para darle estilo donde estaran las opciones principales del menu -->
        <ul class="nav">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="">Tutoria</a>
                <!-- primer submenu para tutoria desplegandose a la derecha con la configuracion del css -->
                <ul>
                    <li><a href="">Tutores</a></li>
                    <li><a href="">Especialidades</a></li>
                    <li><a href="">Pruebas</a></li>
                    <li><a href="">Contacto</a>
                        <!-- submenu dentro del anterior para desplegarse denuevo en este caso para contacto desde el anterior -->
                        <ul>
                            <li><a href="">E-mail</a></li>
                            <li><a href="">Telefono</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- otra opcion del menu principal con un submenu -->
            <li><a href="">Cursos</a>
                <!-- aqui dicho submenu con las opciones que apareceran en el desplegable -->
                <ul>
                    <li><a href="">Informatica</a></li>
                    <li><a href="">Cocina</a></li>
                    <li><a href="">Peluqueria</a></li>
                    <li><a href="">Electricidad</a></li>
                </ul>
            </li>
            <li><a href="">Contacto</a></li>
            <li><a href="login.php">LogIn</a></li>
            <li><a href="Nuevo.php">Registrate</a></li>
        </ul>
    </nav>
    <!------------------------ FIN DEL MENU  ---------------------------------->
    <?php 
//incluimos la conexion siempre al principio


//declaramos la consulta en este caso para mostrarla en forma de tabla 
$consulta = "SELECT ID,Nombre,Email,Usuario FROM usuarios";
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
            <form action="datos.php" method="post">
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
        <form action="Nuevo.php" method="post">
            <input type="hidden" name="accion" value="nuevo">
            <button type="submit" class="btnNuevo" id="btn"></button>
        </form>
    </div>    
</div>
    </div>
  
</body>
</html>