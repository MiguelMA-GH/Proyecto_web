<?php

function registrar_producto($table)
{
    global $pdo;

    $datos = $_REQUEST;
    if (count($_REQUEST) < 2) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }
    $query = "INSERT INTO $table (nombre, imagen)
                          VALUES (?,?)";
    try { 
        $consult = $pdo -> prepare($query);
        $a = $consult->execute(array($_REQUEST['name'], $_REQUEST['imagen']  ));

        if (1>$a) echo "<h1> Inserción incorrecta </h1>";
        else echo "<h1> Producto registrado! </h1>";

    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}

?>