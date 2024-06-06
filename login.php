<!DOCTYPE html>
<html>
<head>
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="css/EstiloLogin.css">
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
<body>

<?php
include("menu.php");
// Llamar a la función para generar el menú
generarMenu();

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
        header('location: juegos.php');
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
