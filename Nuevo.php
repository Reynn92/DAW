<?php
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
$email = $_POST["Email"];
$usuario = $_POST["Usuario"];
$password = $_POST["Password"];
//hacemos la consulta para insertar datos en la tabla de la base de datos 
$insertar = "INSERT INTO usuarios (Nombre, Email,Usuario, Password) VALUES(
    '$nombre', 
    '$email',
    '$usuario', 
    '$password')";
//lanzamos la consulta 
$query = mysqli_query($con, $insertar);
//si la consulta funcioa volvemos con el header al "inicio"
if ($query) {
    header("location: juegos.php"); 
    exit();
    }
    else {
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Nuevo Registro</title>
  <link href="https://fonts.cdnfonts.com/css/metal-gear-solid" rel="stylesheet">    
  <link rel="stylesheet" href="css/EstiloLogin.css">
</head>
<body>
<?php
	include("menu.php");
  
  // Llamar a la función para generar el menú
  generarMenu();
  ?>

          
   
  <div class="container">
    <div class="d-flex min-vh-100">
      <div class="row d-flex flex-grow-1 justify-content-center align-items-center">
        <div class="col-md-4 form login-form">
          <form action="Nuevo.php" method="POST" autocomplete="off">
            <h2 class="text-center">Registro Usuario</h2>
              
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
                  <input type="email" name="Email" class="usuario" placeholder="Email" required>
              </div>
              <div class="campo" class="form-group mb-3">
                  <input type="text" name="Usuario" class="usuario" placeholder="Nombre usuario" required>
              </div>
              <div  class="campo" class="form-group mb-3">
                  <input type="password" name="Password" class="usuario" placeholder="Contraseña" required>
              </div>
              <div class="form-group mb-3">
                  <input type="submit" name="login_button" class="buttons" value="Registrarse">
              </div>
              </section>
          </form>
        </div>
      </div>
    </div>
  </div>  
</body>
</html>