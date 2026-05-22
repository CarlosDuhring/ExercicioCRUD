<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'agenda');
 
try {
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4';
	$pdo = new PDO($dsn, DB_USER, DB_PASS, [
    	PDO::ATTR_ERRMODE        	=> PDO::ERRMODE_EXCEPTION,
    	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    	PDO::ATTR_EMULATE_PREPARES   => false,
	]);	
} catch (PDOException $e) {
	die('Erro de conexão: ' . $e->getMessage());
}

//ERRMODE_EXCEPTION	Lança exceção automaticamente
//ERRMODE_SILENT	Não mostra erro; precisa verificar manualmente
?>