<?php
session_start();
include("conexion.php");
$con = conectar();
if (!$con) {
    echo "Error de conexión: " . mysqli_connect_error();
    exit();
}

$errors = array();

// Inicio de sesión
if (isset($_POST['login_button'])) {
    $usuario = mysqli_real_escape_string($con, $_POST['usuario']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$password'";
    $results = mysqli_query($con, $query);

    if (mysqli_num_rows($results) == 1) {
        // Inicio de sesión exitoso
        $_SESSION['usuario'] = $usuario;
        header('location: datos.php');
        exit();
    } else {
        $errors[] = "Nombre de usuario/contraseña inválidos";
    }
}

// Cierre de sesión
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['usuario']);
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- /*-------------------------------------------------------------------*/ -->
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="EstiloLogin.css">
    <style>
.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
}

.header-right {
    display: flex;
    align-items: center;
}

.header-right form {
    display: inline;
    margin-left: 10px;
}

.header-right span {
    margin-right: 10px;
    font-weight: bold;
}

.header-right input[type="submit"] {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
}

.header-right input[type="submit"]:hover {
    background-color: #e2e6ea;
}

    </style>
</head>
    <!-- /*-------------------------------------------------------------------*/ -->

<body>

<?php
// Función para generar el menú
function generarMenu()
{
    ?>
    <link rel="stylesheet" href="EstiloDatos.css">
    <header>
    <link href="https://fonts.cdnfonts.com/css/metal-gear-solid" rel="stylesheet">    

        <h2 class="cabeza">Biblioteca
        <?php
        if (isset($_SESSION['usuario'])) {
            ?>
            <div class="header-right">
                <span><?php echo $_SESSION['usuario']; ?></span>
                <form action="login.php" method="GET">
                    <input type="hidden" name="logout" value="1">
                    <input type="submit" value="Cerrar Sesión">
                </form>
            </div>
        </h2>
            <?php
        }
        ?>
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
            <?php
            // Verificar si el usuario ha iniciado sesión
            if (isset($_SESSION['usuario'])) {
                ?>
                <!-- <li>
                    <form action="login.php" method="GET">
                        <input type="hidden" name="logout" value="1">
                        <input type="submit" value="Cerrar Sesión">
                    </form>
                </li> -->
                <?php
            }
            ?>
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
                <form action="login.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Inicio de sesión</h2>

                    <?php
                    if (count($errors) > 0) {
                        echo "<div class='alert alert-danger' role='alert'>";
                        foreach ($errors as $error) {
                            echo $error . "<br>";
                        }
                        echo "</div>";
                    }
                    ?>

                    <section class="controls" class="form-login">
                        <div class="campo" class="form-group mb-3">
                            <input type="text" name="usuario" class="usuario" placeholder="Nombre usuario" required>
                        </div>
                        <div class="campo" class="form-group mb-3">
                            <input type="password" name="password" class="usuario" placeholder="Contraseña" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="submit" name="login_button" class="buttons" value="Acceder">
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
