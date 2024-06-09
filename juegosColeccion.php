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

//declaramos la consulta en este caso para mostrarla en forma de tabla 
$consulta = "SELECT ID,Nombre,Plataforma,Lanzamiento,Imagen, juegos_usuario.Usuario FROM `juegos` inner JOIN juegos_usuario on juegos.ID=juegos_usuario.ID_Juego wHERE juegos_usuario.usuario='".$_SESSION['usuario']."'";
$resultado = $con->query($consulta);
//la metemos en un condicional con las lineas afectadas mayor 2que 0 y le ponemos borde y 
// th para que tenga encabezado, teniendo en cuenta que es una matriz de datos 
?>
<div class="container">
    <div class="flex-container">
	<?php
		if ($resultado->num_rows > 0) {
			$row =$resultado ->fetch_assoc();
			$resultado -> data_seek(0);
			while ($row=$resultado->fetch_assoc()){				       
				echo "<div><div class='contact-box center-version'>";
				echo "<a > <img alt='image' class='img-circle' src='{$row['Imagen']}' width='120' height='120'>";
				echo "<h3 ><strong>".$row['Nombre']."</strong></h3>";

				echo "<div class='font-bold'>".$row['Lanzamiento']."</div>";
				echo "<div >";
				echo "<strong>".$row['Plataforma']."</strong>";
				echo "</div> </a><div class=''><table style='width:100%'><tr >";
				if ($row['Usuario'] !='') {
					echo "<td style='background-color:transparent'><div class='btnColeccionEliminar'></div></td>";
				} else {
					echo "<td style='background-color:transparent'><div class='btnColeccionAñadir'></div></td>";
					}                        
				echo "<td style='background-color:transparent'><div class='btnAcabadoSi'></div></td>";
				echo "<td style='background-color:transparent'><div class='btnCompararSi'></div></td>";
				echo "<td style='background-color:transparent'><div class='btnEditar'></div></td></tr></table></div>";
				echo "</div></div>";
		} }?>
		
		<div class="flex-container">
            <div>
				<form action="añadirJuego.php" method="post" Style="margin:40px 0px">
					<input type="hidden" name="accion" value="nuevo">
					<button type="submit" class="btnNuevo" id="btn"></button>
				</form>   
            </div>
        </div>
    </div>
</div>
</div>
  


</div>
  
</body>
</html>