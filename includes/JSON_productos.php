<?php
	include 'conector_BD.php';
    global $pdo;
    header('Content-type: application/json');
    $query = "SELECT * FROM  producto;";
    $rows = $pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($rows);

?>