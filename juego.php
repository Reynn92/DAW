<?php
  session_start();
  include("conexion.php");
  $con=conectar();
  if(!$con){
      echo"error de conexion: " . mysqli_connect_error();
      exit();
  }
$errors = array();
// Si se ha enviado el formulario
if (isset($_POST['login_button'])) {
 //asignamos las variables que vamos a recibir por el metodo post desde el formulario
$nombre = $_POST["Nombre"];
$plataforma = $_POST["Plataforma"];
$lanzamiento = $_POST["Lanzamiento"];
//hacemos la consulta para insertar datos en la tabla de la base de datos 
$insertar = "INSERT INTO juegos (Nombre,Plataforma,Lanzamiento) VALUES(
    '$nombre', 
    '$plataforma', 
    '$lanzamiento')";
//lanzamos la consulta 
$query = mysqli_query($con, $insertar);
//si la consulta funcioa volvemos con el header al "inicio"
if ($query) {
    header("location: datos.php"); 
    exit();
    }
    else {
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Nuevo juego</title>
  <link href="https://fonts.cdnfonts.com/css/metal-gear-solid" rel="stylesheet">
  <link rel="stylesheet" href="EstiloLogin.css">
</head>
<body>
<?php
function generarMenu() {
    ?>
        <link rel="stylesheet" href="EstiloDatos.css">
        <header>
        <h2>Biblioteca</h2>
        </header>
        <nav class="principal">
        <ul class="nav">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="">Plataformas</a>
        <ul>
        <li><a href="datos.php">Gameboy</a></li>
        <li><a href="">NES</a></li>
        <li><a href="">SnES</a></li>
        <li><a href="">Nintendo64</a>
        <ul>
        <li><a href="">E-mail</a></li>
        <li><a href="">Telefono</a></li>
        </ul>
        </li>
        </ul>
        </li>
        <li><a href="">Sagas</a>
        <ul>
        <li><a href="">Zelda</a></li>
        <li><a href="">Mario</a></li>
        <li><a href="">Final Fantasy</a></li>
        <li><a href="">Pokemon</a></li>
        </ul>
        </li>
        <li><a href="juego.php">Añadir</a></li>
        <li><a href="login.php">LogIn</a></li>
        <li><a href="Nuevo.php">Registrate</a></li>
        </ul>
        </nav>
        <?php
    }
    
    // Llamar a la función para generar el menú
    generarMenu();
    ?>

          
   
  <div class="container">
    <div class="d-flex min-vh-100">
      <div class="row d-flex flex-grow-1 justify-content-center align-items-center">
        <div class="col-md-4 form login-form">
          <form action="juego.php" method="POST" autocomplete="off">
            <h2 class="text-center">Añadir juego</h2>
              
              <?php
              if (count($errors) > 0) {
                echo "<div class='alert alert-danger' role='alert'>";
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
                echo "</div>";
              }
              ?>
              <section class ="controls" class="form-login">
              <div  class="campo" class="form-group mb-3">
                  <input type="text" name="Nombre" class="usuario" placeholder="Nombre" required>
              </div>
              <div  class="campo" class="form-group mb-3">
                  <input type="text" name="Plataforma" class="usuario" placeholder="Plataforma" required>
              </div>
              <div class="campo" class="form-group mb-3">
                  <input type="number" name="Lanzamiento" class="usuario" placeholder="Año de lanzamiento" required>
              </div>
              <div class="form-group mb-3">
                  <input type="submit" name="login_button" class="buttons" value="Añadir">
              </div>
              </section>
          </form>
        </div>
      </div>
    </div>
  </div>  
</body>
</html>