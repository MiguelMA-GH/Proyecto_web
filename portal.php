<?php


session_start();

include(dirname(__FILE__)."/includes/ejecutarSQL.php");
include(dirname(__FILE__)."/partials/header.php");
include(dirname(__FILE__)."/partials/menu.php");

include(dirname(__FILE__)."/includes/conector_BD.php");
include(dirname(__FILE__)."/includes/table2html.php");

include(dirname(__FILE__)."/includes/registrar_usuario.php");
include(dirname(__FILE__)."/includes/autentificar_usuario.php");
include(dirname(__FILE__)."/includes/encestar_producto.php");
include(dirname(__FILE__)."/includes/eliminar_producto_cesta.php");
include(dirname(__FILE__)."/includes/registrar_producto.php");


if (isset($_REQUEST['action'])) $action = $_REQUEST["action"];
else $action = "home";

$central = "Partials/centro.php";

switch ($action) {
    case "home":
        $central = "/partials/centro.php";
        break;
    case "login": 
        $central = "/partials/login.php"; //formulario login 
        break;
    case "do_login":
        $central = autentificar_usuario(); //fijar $_SESSION["usuario"]
        break;
    case "registrar_usuario":
        $central = "/partials/registro_usuario.php"; //formulario usuarios
        break;
    case "insertar_usuario":
        $central = registrar_usuario("usuarios"); //tabla usuarios
        break;
    case "listar_productos":
        $central = table2html_prod("producto"); //tabla productos
        break;
    case "registrar_producto":
        $central = registrar_producto("producto"); //formulario producto
        break;
    case "insertar_producto":
        $central = "/partials/insertar_producto.php"; //tabla productos
        break;
    case "upload":
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["upload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["upload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 2000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["upload"]["name"])). " has been uploaded.";
            } else {
            echo "Sorry, there was an error uploading your file.";
            }
        }
        $central = "/partials/insertar_producto.php";
    break;
    case "ver_cesta":
        $central = table2html_carr("carrito");; //cesta en $_SESSION["cesta"]
        break;
    case "encestar":
        $central = encestar_producto("carrito"); //tabla compras
        break;
    case "realizar_compra":
        $central = "<p>Todavía no puedo añadir a la cesta</p>"; //cesta en $_SESSION["cesta"]
        break;
    case "eliminar_del_carrito":
        $central = eliminar_producto_cesta("carrito"); 
        break;
    default:
        $data["error"] = "Accion No permitida";
        $central = "/partials/centro.php";
}

if ($central <> "") include(dirname(__FILE__).$central);

include(dirname(__FILE__)."/partials/footer.php");
?>