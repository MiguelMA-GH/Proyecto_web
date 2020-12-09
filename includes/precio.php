<?php
	include 'conector_BD.php';
    global $pdo;
    header('Content-type: application/json');
    $min = $_POST['minimo'];
    $max = $_POST['maximo'];
    $query = "SELECT * FROM  producto WHERE precio >=".$min."AND precio <= ".$max.";";
    $rows = $pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($rows);
    

?>