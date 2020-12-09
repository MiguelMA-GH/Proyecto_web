<main>
	<h1>Listar productos: </h1>
	<h2> Filtros </h2>
	 <input list="productos" name="producto" id="producto" onchange="buscarProducto(this)">
	 <datalist id="productos"></datalist>
	<p> precio mínimo <input type="text" id="minimo" name="minimo"> precio máximo <input type="text" name="maximo" id="maximo"> <input type="submit" name="enviar" value="Aplicar" onclick="filtrarPorPrecio()"></p>

	<div class="visor" id="visualizameesta">

	</div>
</main>
