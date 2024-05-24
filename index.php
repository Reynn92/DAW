<head>
</head>
<link href="https://fonts.cdnfonts.com/css/metal-gear-solid" rel="stylesheet">    
<link rel="stylesheet" href="css/EstiloDatos.css">
<body>
    <?php
    function generarMenu() {
      ?>
          <link rel="stylesheet" href="css/EstiloDatos.css">
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
    
</body>
</html>