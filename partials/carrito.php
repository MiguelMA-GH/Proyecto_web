<main>
    <div id = "carrito" class="carrito" >
        <button  onclick="ocultarDivCarrito()" id="cerrar">X</button>
        <h1 class="h1Carrito">PRODUCTOS EN EL CARRITO DE LA COMPRA</h1>
        <form action="?action=listar_productos" method="GET"> 
            <ul class="lista_carrito">

            </ul>
            <input type="submit" class="bottonComprar" onclick="borrarStorageCarrito()" value="Comprar">
        </form>
    </div>
</main>