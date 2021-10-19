<?php
define('SQL_DSN','mysql:dbname=seinova;host=localhost');
define('SQL_USERNAME','root');
define('SQL_PASSWORD','');

try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=seinova;charset=utf8', 'root', '');
		}
		catch (Exception $e)
		{
		        die('Erreur : ' . $e->getMessage());
		}

?>