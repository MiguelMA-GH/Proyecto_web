<?php 

	$resOk = array('resultado' => "OK" );
	$resKo = array('resultado' => "KO" );

	$prods = $_GET['productos']; 

	
	$porciones = explode(",", $prods);
	
	if ($porciones[0] == ''){
		echo json_encode($resKo);
	}else{
		echo json_encode($resOk);
	}
	


?> 