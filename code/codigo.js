var lista = [];
var Prod2ID = {};
const listaCarrito = document.querySelector('.lista_carrito');
window.onload = function() {
  if (localStorage.getItem("carrito")) {
  	var list = JSON.parse(localStorage.getItem("carrito"));
  	JSON.stringify(list);	
  	mostrar(list);
    let params = (new URL(document.location)).searchParams;
    let url_actual = params.get('action'); 
    if(url_actual == "listar_productos") {
        mostrarProductos();
    }

  }
};

function mostrarProductos() {
    fetch('./includes/JSON_productos.php')
    .then(response => response.json())
    .then(data => arribaEspaña(data));
}

function arribaEspaña(data) {

    data.forEach(x => {
        let item = document.createElement('div');
        item.setAttribute("id",x['product_id']);
        item.setAttribute("class","item");
        document.getElementById('visualizameesta').appendChild(item);
    })

    data.forEach(x => {
        item = document.getElementById(x['product_id']);
        var parrafo = document.createElement('p');
        var texto = document.createTextNode(x['nombre']+" "+x['precio']);
        parrafo.appendChild(texto);
        var foto = document.createElement('img');
        foto.setAttribute("heigth","100");
        foto.setAttribute("width","100");
        foto.setAttribute("src",x['imagen']);

        var boton = document.createElement('button');
        boton.setAttribute("type","submit");
        boton.innerHTML = "Comprar";
        item.appendChild(foto);
        item.appendChild(parrafo);
        item.appendChild(boton);
        let n = document.createElement('option');
        n.value = x['nombre'];
        Prod2ID[x['nombre']] = x['product_id'];
        document.getElementById('productos').appendChild(n);

    })
}

function buscarProducto(texto) {
    id = Prod2ID[texto.value];
    document.getElementById(id).scrollIntoView()
}

function filtrarPorPrecio() {
    var min = document.getElementById("minimo").value;
    var max = document.getElementById("maximo").value;
    const data = new FormData()
    data.append('minimo', min);
    data.append('maximo', max);

    fetch('./includes/precio.php', { method: 'POST',  body: data })
    .then(response => response.json())
    .then(data => {
        document.getElementById("visualizameesta").innerHTML = "";
        arribaEspaña(data)
    })
    .then(console.log)
    .catch(console.log)
}


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