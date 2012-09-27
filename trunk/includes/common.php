<?php
require_once "MysqlDb.php";
require_once "helper.php";
date_default_timezone_set('Asia/Shanghai');

$config = array(
	'host' => 'localhost',
	'db' => 'zindexjob_db',
	'port' => '3306',
	'username' => 'root',
	'password' => '1'
);

function getDb(){
	global $config;
	return new MysqlDb($config['host'], $config['db'], $config['username'], $config['password'], $config['port']);
}


function redirec($url, $msg = '', $seconds = 3){
	$jobId = intval($jobId);
	$db->query("delete from jobs where job_id={$jobId}");
	header('Content-Type: text/html; charset=utf-8');
	header('refresh:3;url=job-manage.php');
	echo "{$msg}";
}

function error(){
	
}

Helper::companySelector();