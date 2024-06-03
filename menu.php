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
          </li>
          </ul>
          </li>
          <li><a href="juego.php">Añadir</a></li>
          <li><a href="login.php">LogIn</a></li>
          <li><a href="Nuevo.php">Registrate</a></li>
          </ul>
          </nav>
          <?php
      }
      ?>