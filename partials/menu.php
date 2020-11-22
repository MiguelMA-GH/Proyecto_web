<nav>
	<ul>
		<li>
			<a href="./portal.php?action=home">Home</a>
		</li>
		<li>
			<a href="?action=insertar_producto">Insertar producto</a>
		</li>
		<li>
			<a href="?action=listar_productos">Productos</a>
		</li>
		

		<?php 
		
		 if (!isset($_SESSION['usuario'])){
			echo '<li><a href="?action=login">Autentificar</a></li>';
			echo '<li><a href="?action=registrar_usuario">Registrarme</a></li>';
		 }
		elseif (isset($_SESSION['usuario']) and $_SESSION['usuario'] == 'admin')
			echo '<li><a href="?action=registrar_producto">Registrar Producto</a></li>';
		elseif (isset($_SESSION['usuario']))
		    echo '<li><"<a href="?action=ver_cesta">Cesta de Compra</a></li>';
        ?>
        <li>
			<img class = "imagenCarrito" onclick="mostrarDivCarrito()"  src ="/img/icon_market_car.png" >
		</li>
	</ul>
</nav>