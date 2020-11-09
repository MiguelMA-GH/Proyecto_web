<main>
	<h1>Datos del producto: </h1>
	<form class="form_ins_prod" action="?action=insertar_producto" method="POST">

		<label for="nombre">Nombre</label>
	
		<input type="text" name="name" class="item_requerid" size="20" maxlength="25" value=""
		/>
		
		<label for="imagen">Imagen</label>
		
		<input type="text" name="imagen" class="item_requerid" size="20" maxlength="25" value=""
		/>
		
		
		
		<p><input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
		</p>
	</form>

    <label for="upload_imagen">Subir imagen</label>
    <button  onclick="mostrarDiv()">Subir imagen</button>

    <div id="imagen" class="imagen">
    <button  onclick="ocultarDiv()" id="cerrar">X</button>
        <form action="?action=upload" method="post" enctype="multipart/form-data" id="form_imagen">
            <b>Selecciona	una	imagen:</b>
            <input type="file" class="uploadFile" accept="image/*" name="tmp_file" id="upload" onchange="handleFiles(event)">
			<canvas id="canvas" class="canvas"></canvas>
            <input type="submit" class ="botonCentrado" value="SUBIR" name="submit">
        </form>
    </div>

</main>