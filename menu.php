<?php
session_start();
function generarMenu() {
  ?>
	  <link rel="stylesheet" href="css/EstiloDatos.css">
	  <header>
		<h2>Biblioteca</h2>
	  </header>
	  <nav class="principal">
		  <ul class="nav">
			  <li><a href="index.php">Inicio</a></li>
			  <li><a href="">Juegos</a>
				  <ul>
					  <li><a href="datos.php">TODOS</a></li>
					  <li><a href="datos.php">Gameboy</a></li>
					  <li><a href="datos.php">NES</a></li>
					  <li><a href="datos.php">SNES</a></li>
					  <li><a href="datos.php">Nintendo64</a></li>
					  <li><a href="datos.php">PlayStation</a></li>
				  </ul>
			  </li>			  	  
		<?php if (isset($_SESSION['usuario'])): ?>
			  <li><a href="">Mi Colección</a>
				  <ul>
					  <li><a href="datos.php">TODOS</a></li>
					  <li><a href="datos.php">Gameboy</a></li>
					  <li><a href="datos.php">NES</a></li>
					  <li><a href="datos.php">SNES</a></li>
					  <li><a href="datos.php">Nintendo64</a></li>
					  <li><a href="datos.php">PlayStation</a></li>
				  </ul>
			  </li>
			  <li><a href="juego.php">Añadir</a></li>
		<?php endif; ?>
			<div>
			<?php if (isset($_SESSION['usuario'])): ?>
				<li class="right"><a href="login.php?logout='1'">Cerrar sesión (<?php echo $_SESSION['usuario']; ?>)</a></li>
			<?php else: ?>	  
				<li class="right"><a href="login.php">LogIn</a></li>
				<li class="right"><a href="Nuevo.php">Registrate</a></li>
			<?php endif; ?>
			</div>
		</ul>
	  </nav>
<?php
  }
?>