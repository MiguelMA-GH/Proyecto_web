<?php

/** The name of the database  */
define('DB_NAME', 'al351809_ei1036_42');

/** Fatabase username */
define('DB_USER', 'al351809');

/** Database password */
define('DB_PASSWORD', '48725381L');

/** Database hostname */
define('DB_HOST', "db-aules.uji.es");

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


function crearTablas() {
    global $pdo;
  $producto="CREATE TABLE IF NOT EXISTS  producto (product_id SERIAL PRIMARY KEY, nombre VARCHAR(50) NOT NULL, imagen VARCHAR(50) NOT NULL, precio float NOT NULL);";
  $carrito="CREATE TABLE IF NOT EXISTS  carrito (item_id SERIAL PRIMARY KEY, client_id int NOT NULL, product_id int NOT NULL, fecha date, precio float NOT NULL);";
  try{
        $consulta_1 = $pdo->prepare($producto);
        $consulta_1->execute();
        $consulta_2 = $pdo->prepare($carrito);
        $consulta_2->execute();
    }
    catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }
}


if (!isset($pdo)){
  try{
   $pdo = new PDO("pgsql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
  }
  catch (PDOException $e) {
		//echo "Failed to get DB handle: " . $e->getMessage() . "\n";
		$pdo = new PDO(
      'sqlite::memory:',
      null,
      null,
      array(PDO::ATTR_PERSISTENT => true)
    );

    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    include_once("sqlite_test.php");
  }
}	

crearTablas();					  

?>
