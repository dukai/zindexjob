<?php

class MysqlDb{
	private $con;
	public function __construct($host, $db, $username, $password, $port){
		$con = mysql_connect("{$host}:{$port}",$username,$password);
		mysql_select_db($db, $con);
		mysql_query("set names utf8");
	}
	
	public function fetchRow($cmd){
		$result = mysql_query($cmd);
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	public function fetchAll($cmd){
		$arr = array();
		$result = mysql_query($cmd);
		while($row = mysql_fetch_array($result)){
			$arr[] = $row;
		}
		return $arr;
	}
	
	public function query($cmd){
		return mysql_query($cmd);
	}
	
	public function fetchOne($cmd){
		$row = $this->fetchRow($cmd);
		
		return $row[0];
	}
	
	public function lastId(){
		return mysql_insert_id();
	}
}
