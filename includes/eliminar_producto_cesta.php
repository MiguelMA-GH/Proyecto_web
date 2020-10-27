<?php

function eliminar_producto_cesta($table)
{
    global $pdo;

    $query = "DELETE FROM $table WHERE item_id=?";
    try { 
        $consult = $pdo->prepare($query);
        $a = $consult->execute(array($_REQUEST['item_id']));
        
        if (1>$a) echo "<h1> Eliminado incorrecta </h1>";
        else echo "<h1> Eliminado el producto registrado! </h1>";
   
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}

?>