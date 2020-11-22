<?php


function table2html_prod($table)
{
    global $pdo;

    $query = "SELECT * FROM  $table;";
    $rows = $pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

    if (is_array($rows) && count($rows) > 0) {/* Creamos un listado como una tabla HTML*/
        print '<table><thead>';
        foreach($rows[0] as $key => $value) {
            echo "<th>", $key,"</th>";
        }
            echo "<th>Accion</th>";
        print "</thead>";
        foreach ($rows as $row) {
            print "<tr>";
            foreach ($row as $key => $val) {
                if ( $key == 'imagen'){
                    echo "<td><img src=", $val, "></td>";
                }
                else
                    echo "<td>", $val, "</td>";
            }
            ?>
            <td><button onclick="insertarCarrito(<?php echo $row['product_id'] ?>, '<?php echo $row['nombre'] ?>' ,<?php echo 4 ?>)">Añadir</button></td>
            <?php
            print "</tr>";
            
        }
        print "</table>";
    } 
    else
        print "<h1> No hay resultados </h1>"; 
}

function table2html_carr($table)
{
    global $pdo;

    $query = "SELECT * FROM  $table;";
   
    $rows = $pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    
    if (is_array($rows) && count($rows) > 0) {/* Creamos un listado como una tabla HTML*/
        print '<table><thead>';
        foreach($rows[0] as $key => $value) {
            echo "<th>", $key,"</th>";
        }
            echo "<th>Accion</th>";
        print "</thead>";
        foreach ($rows as $row) {
            print "<tr>";
            foreach ($row as $key => $val) {
                echo "<td>", $val, "</td>";
            }
            echo "<td><a href=\"portal.php?action=eliminar_del_carrito&item_id=",$row['item_id'],"\"><input type=\"submit\" value=\"Eliminar\" /></a></td>";
            print "</tr>";
            
        }
        print "</table>";
    } 
    else
        print "<h1> No hay resultados </h1>"; 
}


?>