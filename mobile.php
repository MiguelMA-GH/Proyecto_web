<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
  <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
  <script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>

  <style>
    .miItem {margin:10px;}
    .elimina {background-color:red;}
  </style>
</head>
<body>
  
<ons-navigator id="appNavigator" swipeable swipe-target-width="80px">
  <ons-page>
    <ons-splitter id="appSplitter">
      <ons-splitter-side id="sidemenu" page="sidemenu.html" swipeable side="right" collapse="" width="260px"></ons-splitter-side>
      <ons-splitter-content page="tabbar.html"></ons-splitter-content>
    </ons-splitter>
  </ons-page>
</ons-navigator>

<template id="sidemenu.html">
   <ons-page>
    <ons-list-title>Menú</ons-list-title>
    <ons-list>
       <ons-list-item onclick="fn.loadView(0)">Hola</ons-list-item>
    </ons-list>
</template>

<template id="tabbar.html">
  <ons-page id="tabbar-page">
    <ons-toolbar>
      
      <div class="center">Asociación de Jaboneros expertos en la fabricación a base de grasas humanas</div>
      <img src="./img/logo_jabon.jpg" class="center" style="width:50px"/>
      <div class="right">
        <ons-toolbar-button onclick="fn.toggleMenu()">
          <ons-icon icon="ion-navicon, material:md-menu"></ons-icon>
        </ons-toolbar-button>
      </div>
    </ons-toolbar>

    <ons-tabbar swipeable id="appTabbar" position="auto"> 
      <ons-tab label="Productos" icon="ion-home" page="page1.html" active></ons-tab>
      <ons-tab label="Cesta" icon="ion-edit" page="page2.html"></ons-tab>
    </ons-tabbar>

  </ons-page>
</template>

<template id="page1.html">
  <ons-page id="page1">
   
   <ons-toolbar>
    <div class="left">
      <ons-toolbar-button onclick="prev()">
        <ons-icon icon="md-chevron-left"></ons-icon>
      </ons-toolbar-button>
    </div>
    <div class="center">Productos</div>
    <div class="right">
      <ons-toolbar-button onclick="next()">
        <ons-icon icon="md-chevron-right"></ons-icon>
      </ons-toolbar-button>
    </div>
  </ons-toolbar>
  <ons-carousel fullscreen swipeable auto-scroll overscrollable id="carousel" style="background-color:lightblue">
    <!-- inicialmente estará vacío -->
    <div class="visor" id="visualizameesta">
    </ons-carousel-item>
  </ons-carousel>
  </ons-page>
</template>

<template id="page2.html">
  <ons-page id="page2" >
    <ons-toolbar>
      <div class="center">Cesta</div>
    </ons-toolbar>
   
    <ons-list id="cesta" style="background-color:#FFFFE0">
    <!-- inicialmente estará vacío -->
    </ons-list>

    <ons-button modifier="large" onclick="comprar()">Comprar</ons-button>
  </ons-page>

</template>
  
<script>
var lista = [];
var productos = new Array();
var direccion = "comprar.php?productos=";

window.onload = function() {
  if (localStorage.getItem("carrito")) {
    var list = JSON.parse(localStorage.getItem("carrito"));
    JSON.stringify(list);	
    iniciarProductos(list);
  	mostrarCesta(list);

  }
};


function iniciarProductos(lista){
  lista.forEach(x => {
    listar(x.id_prod);
  })
 
}

function mostrarProductos() {
    fetch('./includes/JSON_productos.php')
    .then(response => response.json())
    .then(data => recorrerProducto(data));
}

function recorrerProducto(data) {

data.forEach(x => {
    let nodo = document.createElement('ons-carousel-item')

    nodo.innerHTML = `<div style="text-align: center; font-size: 30px; margin-top: 20px; ">
    ${x['product_id']}-${x['nombre']}</br>
    <img src='${x['imagen']}'>
    </img></br>
    ${x['precio']}€ </br>
    <ons-button onclick=intermedia(${x['product_id']})>Añadir al carrito</ons-button>
    </div>`
    document.getElementById('carousel').appendChild(nodo)
})

}


function mostrarCesta(lista){
    
    var myobj = document.getElementById('cesta')
    
    myobj.innerHTML = ''
    
    var pos = 0
    lista.forEach(x => {
        let nodo = document.createElement('ons-carousel-item')
        nodo.innerHTML = ` <ons-list-item><span class="miItem">Id_Producto: ${x.id_prod} - Nombre: ${x.name} </span> <ons-button class="elimina" onclick="borrarCarrito(${pos})">X</ons-button></ons-list-item>
    	`
        pos++

        
        document.getElementById('cesta').appendChild(nodo)
    
        
    }) 
}

function intermedia(id){
    fetch('./includes/JSON_productos.php')
    .then(response => response.json())
    .then(data => insertarCarrito(id,data));
}

function insertarCarrito(id_producto, data){
    var nombre
    listar(id_producto)
    data.forEach(x => {
        if (x['product_id'] == id_producto){
             nombre = x['nombre']
        }   
    })

   const producto = {
       id_prod: id_producto,
       name: nombre,
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
   mostrarCesta(lista);
};

function listar(id){
  productos.push(id);
}

function borrarCarrito(id) {
	lista = JSON.parse(localStorage.getItem("carrito"));
	JSON.stringify(lista);
  lista.splice(id,1);
  borrarlista(id)
	localStorage.setItem("carrito", JSON.stringify(lista));
	mostrarCesta(lista);
}

function borrarlista(id){
  var i = productos.indexOf(id);
  productos.splice(id,1);
}

function comprar() {
    direccion = "comprar.php?productos=";
		for (var i = 0; i < productos.length; i++) {
      if (i == 0){
        direccion=direccion+productos[i];
      }  
      else{
        direccion=direccion+","+productos[i];
      }
		}
    fetch('./mobile/'+direccion)
  	.then(response => response.json())
  	.then(data => {
      if(data["resultado"] == "KO") {
  				alert("KO");
  			} else {
  				alert("OK");
          lista = []
          localStorage.removeItem("carrito");
          mostrarCesta(lista);
  			}
    });
	}



  /* Funciones para mover el carrusel */
  var prev = function() {
    var carousel = document.getElementById('carousel');
    carousel.prev();
  };

  var next = function() {
    var carousel = document.getElementById('carousel');
    carousel.next();
  };


  /* Ejemplo para añadir elementos al carrusel cuando se carga una página */
  document.addEventListener("init", function(event) {
        var page = event.target;
        if( page.matches('#page1') ) { 
            mostrarProductos()
        }

        if( page.matches('#page2') ) { 
            mostrarCesta()
        }
  })


</script>

</body>
</html>