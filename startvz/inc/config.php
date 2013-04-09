<?php
/*
	This file is to set the DB information, panel name, etc.
*/
$config = array();
$config['db_host'] = 'localhost'; // database host - usually localhost
$config['db_user'] = 'root'; // database username
$config['db_pass'] = ''; // database password
$config['db_name'] = 'startvz'; // database name

$config['site']['basepath'] = 'localhost/startvz'; // Site basepath: ex localhost/startvz
$config['site']['title'] = 'StartVZ Control Panel'; // Site name
$config['site']['theme'] = 'default_v1';

$db = new PDO('mysql:host='.$config['db_host'].';dbname='.$config['db_name'], $config['db_user'], $config['db_pass']);
?>