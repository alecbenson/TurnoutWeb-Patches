<?php
	error_reporting(0);
	ini_set('display_errors',0);
	
	session_start();
	
	require_once('lib/TemplatePower.class.php');
	require_once('lib/mysql.class.php');
	require_once('auth.inc.php');
	
	$_DB = new mysql;
	$_DB->connect('localhost', 'root', 'Farnsworth', 'turnoutweb');
	
	$_AUTH = new Auth($_DB);
	
	$_CONF = array();
	$_CONF['upload_path'] = 'uploads/';
?>
