<?php

function encestar_producto($table)
{
    global $pdo;

    $query = "INSERT INTO $table (client_id,product_id,fecha)
                          VALUES (?,?,?)";
    try { 
        $consult = $pdo->prepare($query);
        $a = $consult->execute(array($_REQUEST['cliente'], $_REQUEST['id_producto'],date("Y-m-d")));
        
        if (1>$a) echo "<h1> Inserción incorrecta </h1>";
        else echo "<h1> Añadido el producto registrado! </h1>";
   
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}

?>