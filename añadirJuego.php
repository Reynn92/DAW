<?php
include("conexion.php");
$con = conectar();

if (!$con) {
    echo "Error de conexion: " . mysqli_connect_error();
    exit();
}

$errors = array();

if (isset($_POST['login_button'])) {
    $nombre = $_POST["Nombre"];
    $plataforma = $_POST["Plataforma"];
    $lanzamiento = $_POST["Lanzamiento"];
    
    // Comprobamos si se ha subido un archivo
    if (isset($_FILES['Imagen']) && $_FILES['Imagen']['error'] == 0) {
        $imagen = $_FILES['Imagen']['name'];
        $temp_name = $_FILES['Imagen']['tmp_name'];
        $folder = "uploads/";

        // Creamos el directorio si no existe
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $file_path = $folder . basename($imagen);
        if (move_uploaded_file($temp_name, $file_path)) {
            // Utilizamos prepared statements para evitar SQL injection
            $stmt = $con->prepare("INSERT INTO juegos (Nombre, Plataforma, Lanzamiento, Imagen) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $nombre, $plataforma, $lanzamiento, $file_path);

            if ($stmt->execute()) {
                header("location: juegos.php");
                exit();
            } else {
                $errors[] = "Error al insertar los datos: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $errors[] = "Error al subir la imagen.";
        }
    } else {
        $errors[] = "Por favor, sube una imagen.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nuevo juego</title>
    <link href="https://fonts.cdnfonts.com/css/metal-gear-solid" rel="stylesheet">
    <link rel="stylesheet" href="css/EstiloLogin.css">
</head>
<body>

<?php
include("menu.php");
generarMenu();
?>

<div class="container">
    <div class="d-flex min-vh-100">
        <div class="row d-flex flex-grow-1 justify-content-center align-items-center">
            <div class="col-md-4 form login-form">
                <form action="añadirJuego.php" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                    <section class="controls form-login">
                        <div class="campo form-group mb-3">
                            <input type="text" name="Nombre" class="usuario" placeholder="Nombre" required>
                        </div>
                        <div class="campo form-group mb-3">
							<select name="Plataforma" required>
							  <option value="GameBoy">GameBoy</option>
							  <option value="NES">NES</option>
							  <option value="SNES">SNES</option>
							  <option value="Nintendo64">Nintendo64</option>
							  <option value="PlayStation">PlayStation</option>
							</select>
                        </div>
                        <div class="campo form-group mb-3">
                            <input type="date" name="Lanzamiento" class="usuario" placeholder="Año de lanzamiento" required>
                        </div>
                        <div class="campo form-group mb-3">
                            <input type="file" name="Imagen" class="usuario" required>
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
