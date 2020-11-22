var lista = [];
const listaCarrito = document.querySelector('.lista_carrito');
window.onload = function() {
  if (localStorage.getItem("carrito")) {
  	var list = JSON.parse(localStorage.getItem("carrito"));
  	JSON.stringify(list);	
  	mostrar(list);
  }
};

function mostrarDiv()
{

    document.getElementById('imagen').style.display='block';

}

function mostrarDivCarrito()
{

    document.getElementById('carrito').style.display='block';

}

function ocultarDiv()
{

    document.getElementById('imagen').style.display='none';

}

function ocultarDivCarrito()
{

    document.getElementById('carrito').style.display='none';

}

function handleFiles(e)	{
    let ctx	=	document.getElementById('canvas').getContext('2d');
    let img	=	new	Image;
    img.src	=	URL.createObjectURL(e.target.files[0]);
    img.onload	=	function()	{
                    ctx.drawImage(img,	20,20);
    }
    
    localStorage.setItem('name', document.getElementById('nameSt').value);
     
}

function borrarStorage(){
    localStorage.removeItem('name');
}

function borrarStorageCarrito(){
    localStorage.removeItem("carrito");
}

function insertarCarrito(id_producto, nombre, id_cliente){
   
    const producto = {
        id_prod: id_producto,
        name: nombre,
        id_cli: id_cliente,
  };
    if(localStorage.getItem("carrito")) {
        lista = JSON.parse(localStorage.getItem("carrito"));
        JSON.stringify(lista);
        lista.push(producto);
        localStorage.setItem("carrito", JSON.stringify(lista));
    } else {
        lista.push(producto);
        localStorage.setItem("carrito", JSON.stringify(lista));
    }
    mostrar(lista);
}

function mostrar(lista) {
	listaCarrito.innerHTML = '';
	var pos = 0
	lista.forEach(function(valor) {
        const li = document.createElement('li');
        li.setAttribute('class', 'listar_productos');
        li.innerHTML = `
      	Id_Producto: ${valor.id_prod} - Nombre: ${valor.name} - Id_cliente: ${valor.id_cli}
      	<input class="borrarCarrito" value="X" onclick="borrarCarrito(${pos})">
    	`;
	    listaCarrito.append(li);
        pos++;
    });
}

function borrarCarrito(id) {
	lista = JSON.parse(localStorage.getItem("carrito"));
	JSON.stringify(lista);
	lista.splice(id,1);
	localStorage.setItem("carrito", JSON.stringify(lista));
	mostrar(lista);
}

document.getElementById('carrito').style.display='none';

document.getElementById('imagen').style.display='none';
document.getElementById('nameSt').value = localStorage.getItem('name');