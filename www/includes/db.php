<?php

define("DBNAME", "bookstore");
define("DBUSER", "root");
define("DBPASS", "vagrant");

try {
	#prepare a pdo instance
$pdo = new PDO('mysql: host=localhost; dbname='.DBNAME, DBUSER, DBPASS);

#set verbose error modes
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

}catch(PDOException $e){
	echo $e->getMessage();
}

?>