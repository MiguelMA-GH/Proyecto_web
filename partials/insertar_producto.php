<main>
	<h1>Datos del producto: </h1>
	<form class="form_ins_prod" action="?action=registrar_producto" method="POST">

		<label for="nombre">Nombre</label>
	
		<input type="text" id="nameSt" name="name" class="item_requerid" size="20" maxlength="25" value="" required
		/>
		
		<label for="imagen">Imagen</label>
		
		<input type="text" name="imagen" class="item_requerid" size="20" maxlength="25" value="<?php if (isset($_FILES["upload"]["name"]))echo "img/".$_FILES["upload"]["name"] ?>" required
		/>
		
		<p><input type="submit" onclick="borrarStorage()" value="Enviar">
		<input type="reset" value="Deshacer">
		</p>
	</form>

    <label for="upload_imagen">Subir imagen</label>
    <button  onclick="mostrarDiv()">Subir imagen</button>

    <div id="imagen" class="imagen">
    <button  onclick="ocultarDiv()" id="cerrar">X</button>
        <form action="?action=upload" method="post" enctype="multipart/form-data" id="form_imagen">
            <b>Selecciona	una	imagen:</b>
            <input type="file" class="uploadFile" accept="image/*" name="upload" id="upload" onchange="handleFiles(event)">
			<canvas id="canvas" class="canvas"></canvas>

            <input type="submit" class ="botonCentrado" value="SUBIR" name="submit">
        </form>
    </div>

</main>